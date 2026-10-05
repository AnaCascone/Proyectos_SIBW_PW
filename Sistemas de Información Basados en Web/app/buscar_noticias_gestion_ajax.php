<?php

session_start();

require_once 'vendor/autoload.php';

require_once 'conexion.php';
require_once 'src/noticias.php';
require_once 'src/permisos.php';

if(!esGestor()){
    exit;
}

$loader =
    new \Twig\Loader\FilesystemLoader(
        'templates'
    );

$twig =
    new \Twig\Environment(
        $loader
    );

$titulo =
    trim($_GET['titulo'] ?? '');

$descripcion =
    trim($_GET['descripcion'] ?? '');

$noticias =
    buscarNoticias(

        $mysqli,

        $titulo,

        $descripcion

    );

echo $twig->render(

    '_lista_noticias_gestion.html.twig',

    [
        'noticias' => $noticias
    ]

);