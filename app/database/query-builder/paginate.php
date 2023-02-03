<?php

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