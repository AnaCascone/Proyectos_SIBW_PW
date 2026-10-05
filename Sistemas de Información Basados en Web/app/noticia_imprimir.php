<?php

session_start();

// ======================================================
//      CARGA DE DEPENDENCIAS
// ======================================================

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/noticias.php';
require_once 'src/imagenes.php';

// ======================================================
//      INICIALIZACIÓN DE TWIG
// ======================================================

// Indicamos a Twig que las plantillas se encuentran
// dentro de la carpeta "templates".

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);

// ======================================================
//      VALIDACIÓN DEL ID
// ======================================================

// Comprobamos que la URL contiene el parámetro id.

if (!isset($_GET['id'])) {

    die("ID no especificado");

}

// Convertimos el valor recibido a entero para evitar
// posibles inyecciones SQL o valores inválidos.

$id = (int) $_GET['id'];

// ======================================================
//      CARGAR INFORMACIÓN DE LA NOTICIA
// ======================================================

$noticia = getNoticia($mysqli, $id);

$imagenes = getImagenes($mysqli, $id);

// ======================================================
//      RENDERIZADO DE LA PLANTILLA
// ======================================================

echo $twig->render(

    'noticia_imprimir.html.twig',

    [

        'noticia' => $noticia,
        'imagenes' => $imagenes,
        'usuarioSesion' => $_SESSION['usuario'] ?? null

    ]

);

$mysqli->close();

?>