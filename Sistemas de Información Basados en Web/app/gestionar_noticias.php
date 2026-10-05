<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/noticias.php';
require_once 'src/permisos.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(!esGestor()){

    die("Acceso denegado");

}


// ======================================================
//      INICIALIZAR TWIG
// ======================================================

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);


// ======================================================
//      CARGAR NOTICIAS
// ======================================================

$titulo = "";

$descripcion = "";

if(isset($_GET['titulo'])){

    $titulo =
        trim($_GET['titulo']);

}

if(isset($_GET['descripcion'])){

    $descripcion =
        trim($_GET['descripcion']);

}

$noticias =
    buscarNoticias(

        $mysqli,
        $titulo,
        $descripcion

    );


// ======================================================
//      RENDERIZAR
// ======================================================

echo $twig->render(
    'gestionar_noticias.html.twig',
    [

        'noticias' => $noticias,
        'titulo' => $titulo,
        'descripcion' => $descripcion,

        'usuarioSesion' => $_SESSION['usuario'] ?? null
    ]
);

?>