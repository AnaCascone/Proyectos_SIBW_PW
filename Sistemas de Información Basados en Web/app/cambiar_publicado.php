<?php

    session_start();

    require_once 'conexion.php';
    require_once 'src/noticias.php';
    require_once 'src/permisos.php';

    if(!esGestor()){
        http_response_code(403);
        exit;
    }

    $id = (int) $_POST['id'];
    $publicado = (int) $_POST['publicado'];

    cambiarPublicado(
        $mysqli,
        $id,
        $publicado
    );

    echo json_encode([
        'ok' => true
    ]);

?>