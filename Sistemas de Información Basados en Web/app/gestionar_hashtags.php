<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/hashtags.php';
require_once 'src/permisos.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(
    !esGestor()
    &&
    !esSuperusuario()
){

    die("Acceso denegado");

}


// ======================================================
//      PROCESAR EDICIÓN
// ======================================================

$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $id =

        isset($_POST['id'])
        ? (int) $_POST['id']
        : 0;

    $nombre =

        trim($_POST['nombre']);

    // ==============================================
    // VALIDACIONES
    // ==============================================

    if($id <= 0){

        $errores[] =
            "ID inválido";

    }

    if(empty($nombre)){

        $errores[] =
            "El hashtag no puede estar vacío";

    }

    elseif(strlen($nombre) > 50){

        $errores[] =
            "El hashtag es demasiado largo";

    }

    // ==============================================
    // ACTUALIZAR
    // ==============================================

    if(empty($errores)){

        actualizarHashtag(

            $mysqli,
            $id,
            $nombre

        );

        header(
            "Location: gestionar_hashtags.php"
        );

        exit;

    }

}


// ======================================================
//      OBTENER HASHTAGS
// ======================================================

$hashtags = getHashtags($mysqli);


// ======================================================
//      TWIG
// ======================================================

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);


// ======================================================
//      RENDER
// ======================================================

echo $twig->render(

    'gestionar_hashtags.html.twig',

    [

        'hashtags' => $hashtags,
        'errores' => $errores,
        'usuarioSesion' =>  $_SESSION['usuario'] ?? null

    ]

);

?>