<?php

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
            $query['count'] = $prepare->rowCount();
            return $query['count'];
        }

        if ($isFetchAll) {
            return (object) [
                'count' =>  $query['count'] ?? $prepare->rowCount(),
                'rows' => $prepare->fetchAll()
            ];
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