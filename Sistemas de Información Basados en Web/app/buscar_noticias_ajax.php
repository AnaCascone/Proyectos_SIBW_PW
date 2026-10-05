<?php

    require_once 'conexion.php';
    require_once 'src/noticias.php';

    $texto =
        trim($_GET['q'] ?? '');

    if(strlen($texto) < 2){

        echo json_encode([]);
        exit;

    }

    $noticias =
        buscarNoticiasPublicadasAjax(
            $mysqli,
            $texto
        );

    header('Content-Type: application/json');

    echo json_encode(
        $noticias
    );

?>