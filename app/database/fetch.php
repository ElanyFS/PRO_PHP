<?php

use Doctrine\Inflector\InflectorFactory;

$query = [];

function read($table, $fields = '*')
{
    global $query;

    $query = [];

    $query['table'] = $table;

    $query['read'] = true;
    $query['execute'] = [];

    $query['sql'] = "Select {$fields} from {$table}";
}


function limit($limit)
{
    global $query;

    if (isset($query['page'])) {
        throw new Exception('O limit não pode ser chamado com o pagination.');
    }

    $query['limit'] = true;
    $query['sql'] = "{$query['sql']} limit {$limit}";
}

function order($by, $order = 'asc')
{
    global $query;

    if (isset($query['limit'])) {
        throw new Exception('Necessário chamar o order antes do limit.');
    }

    if (isset($query['page'])) {
        throw new Exception('O order não pode ser chamado depois do pagination.');
    }

    $query['order'] = true;

    $query['sql'] = "{$query['sql']} order by {$by} {$order}";
}

function pagination($perPage)
{
    global $query;

    if (isset($query['limit'])) {
        throw new Exception('O pagination não pode ser chamado com o limit');
    }

    $query['page'] = true;

    $rowCount = execute(rowCount: true);

    //Pagina atual 
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    $page = $page ?? 1;
    $query['currentPage'] = (int)$page;

    //Total de paginas
    $query['pageCount'] = (int)ceil($rowCount / $perPage);

    $offset = ($page - 1) * $perPage;

    // var_dump($rowCount, $page, $offset, $query['pageCount']);
    // die();

    $query['sql'] = "{$query['sql']} limit {$perPage} offset {$offset}";

    // var_dump($query['sql']);
}

function render()
{
    global $query;

    $pageCount = (int)$query['pageCount'];
    $pagecurrent = (int)$query['currentPage'];

    $links = '<ul class="pagination">';
    $back = $pagecurrent - 1;
    $next = $pagecurrent + 1;
    $maxLinks = 5;

    // $links .= "<li class='page-item'><a class='page-link material-symbols-outlined' href='?page={$back}'>keyboard_double_arrow_left</a></li>";

    $linkPageA = http_build_query(array_merge($_GET, ['page' => $back]));
    $links .= "<li class='page-item'> <a class='page-link' href='?{$linkPageA}' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a> </li>";

    for ($i = $pagecurrent - $maxLinks; $i <= $pagecurrent + $maxLinks; $i++) {
        if ($i > 0  && $i <= $pageCount) {
            $page = "?page={$i}";
            $linkPage = http_build_query(array_merge($_GET, ['page' => $i]));
            $links .= "<li class='page-item'><a class='page-link' href='?{$linkPage}'>{$i}</a></li>";
        }
    }

    $linkPageB = http_build_query(array_merge($_GET, ['page' => $next]));
    $links .= "<li class='page-item'> <a class='page-link' href='?{$linkPageB}' aria-label='Previous'><span aria-hidden='true'>&raquo;</span></a> </li>";

    // $links .= "<li class='page-item'><a class='page-link material-symbols-outlined' href='?page={$next}'>keyboard_double_arrow_right</a></li>";

    $links .= '</ul>';

    return $links;
}

// function where($field, $operator, $value)
// {
//     global $query;

//     if(!isset($query['read'])){
//         throw new Exception('Necessário chamar o read antes do where.');
//     }

//     if(func_num_args() !== 3){
//         throw new Exception('Where precisa de exatamente 3 parâmetros.  ');
//     }

//     $query['where'] = true;

//     $query['execute'] = array_merge($query['execute'],[$field => $value]);

//     $query['sql'] = "{$query['sql']} where {$field} {$operator} :{$field}";
// }

function where()
{
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    if (!isset($query['read'])) {
        throw new Exception('Necessário chamar o read antes do where.');
    }

    if (func_num_args() !== 3) {
        throw new Exception('Where precisa de exatamente 3 parâmetros.  ');
    }

    if ($numArgs == 2) {
        $field = $args[0];
        $operator = '=';
        $value = $args[1];
    }

    if ($numArgs == 3) {
        $field = $args[0];
        $operator = $args[1];
        $value = $args[2];
    }

    $query['where'] = true;

    $query['execute'] = array_merge($query['execute'], [$field => $value]);

    $query['sql'] = "{$query['sql']} where {$field} {$operator} :{$field}";
}

// function orAndWhere($field, $operator, $value, $typeWhere = 'or')
// {
//     global $query;

//     if(!isset($query['read'])){
//         throw new Exception('Necessário chamar o read antes do where.');
//     }

//     if(!isset($query['where'])){
//         throw new Exception('Necessário chamar o where antes do orAndWhere.');
//     }

//     if(func_num_args() < 3){
//         throw new Exception('Where precisa de exatamente 3 ou 4 parâmetros.  ');
//     }

//     $query['orAndWhere'] = true;

//     $query['execute'] = array_merge($query['execute'],[$field => $value]);

//     $query['sql'] = "{$query['sql']} {$typeWhere} {$field} {$operator} :{$field}";
// }

function orAndWhere($field, $operator, $value, $typeWhere = 'or')
{
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    if (!isset($query['read'])) {
        throw new Exception('Necessário chamar o read antes do where.');
    }

    if (!isset($query['where'])) {
        throw new Exception('Necessário chamar o where antes do orAndWhere.');
    }

    if (func_num_args() < 3) {
        throw new Exception('Where precisa de exatamente 3 ou 4 parâmetros.  ');
    }

    $data = match ($numArgs) {
        2 => whereTwoParameters($args),
        3 => whereThreeParameters($args),
        4 => $args,
    };

    [$field, $operator, $value, $typeWhere] = $data;

    $query['orAndWhere'] = true;

    $query['execute'] = array_merge($query['execute'], [$field => $value]);

    $query['sql'] = "{$query['sql']} {$typeWhere} {$field} {$operator} :{$field}";
}

function whereTwoParameters(array $args)
{
    $field = $args[0];
    $operator = '=';
    $value = $args[1];
    $typeWhere = 'or';

    return [$field, $operator, $value, $typeWhere];
}

function whereThreeParameters(array $args)
{
    $field = $args[0];
    $operators = ['=', '<', '>', '!=='];
    $operator = in_array($args[1], $operators) ? $args[1] : '=';
    $value = in_array($args[1], $operators) ? $args[2] : $args[1];
    $typeWhere = $args[2] === 'and' ? 'and' : 'or';

    return [$field, $operator, $value, $typeWhere];
}

// function whereFourParameters(array $args)
// {
//     $field = $args[0];
//     $operator = $args[1];
//     $value = $args[2];
//     $typeWhere = $args[3];

//     return [$field, $operator, $value, $typeWhere];
// }

function whereIn($field, array $args)
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Where não pode ser chamado com o Where In');
    }

    $query['where'] = true;

    $query['sql'] = "{$query['sql']} where {$field} in (" . '\' ' . implode('\' , \'', $args) . '\'' . ")";
}

function fieldFK($table, $field)
{

    $inflector = InflectorFactory::create()->build();
    $tableToSingular = $inflector->singularize($table);

    return $tableToSingular . ucfirst($field);
}

function tableJoin($table, $fieldFK, $typeJoin = 'inner')
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Where não pode ser chamado antes do Join.');
    }

    $fkToJoin = fieldFK($query['table'], $fieldFK);

    $query['sql'] = "{$query['sql']} {$typeJoin} join {$table} on {$table}.{$fkToJoin} = {$query['table']}.{$fieldFK}";
}

function tableJoinReverse($table, $fieldFK, $typeJoin = 'inner')
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Where não pode ser chamado antes do Join.');
    }

    $fkToJoin = fieldFK($table, $fieldFK);

    $query['sql'] = "{$query['sql']} {$typeJoin} join {$table} on {$table}.{$fieldFK} = {$query['table']}.{$fkToJoin}";
}

function search(array $search)
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Where não pode ser chamado junto com a busca.');
    }

    if (!arrayAssociative($search)) {
        throw new Exception('Necessário ser um array associativo.');
    }

    $sql = "{$query['sql']} where ";

    $execute = [];

    foreach ($search as $field => $searched) {
        $sql .= "{$field} like :{$field} or ";
        $execute[$field] = "%{$searched}%";
    }

    $sql = rtrim($sql, ' or ');

    // var_dump($sql);

    $query['sql'] = $sql;
    $query['execute'] = $execute;
}

function execute($isFetchAll = true, $rowCount = false)
{
    global $query;

    // var_dump($query['sql']);
    // die();

    try {
        $connect = connect();

        // var_dump($query['sql']);
        // die();

        if (!$query['sql']) {
            throw new Exception('Query não existente.');
        }

        $prepare = $connect->prepare($query['sql']);
        $prepare->execute($query['execute'] ?? []);

        if ($rowCount) {
            return $prepare->rowCount();
        }

        if ($isFetchAll) {
            return $prepare->fetchAll();
        }

        return $prepare->fetch();
    } catch (Exception $e) {
        // $message = "Erro no arquivo {$e->getFile()} na linha {$e->getLine()} com a mensagem: {$e->getMessage()}";
        // $message .= '<br>'. $query['sql'];

        $error = [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
            'sql' => $query['sql']
        ];

        ddd($error);

        // var_dump($message);
    }
}

function all($table, $fields = '*')
{
    try {
        $connect = connect();

        $query = $connect->query("Select {$fields} from {$table}");
        return $query->fetchAll();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}

function findBy($table, $fields = '*', $field, $value)
{
    try {
        $connect = connect();

        $prepare = $connect->prepare("select {$fields} from {$table} where {$field} = :{$field}");
        $prepare->execute([
            $field => $value
        ]);
        return $prepare->fetchObject();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}
