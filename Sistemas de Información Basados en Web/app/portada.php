<?php

session_start();

// ======================================================
//      CARGA DE DEPENDENCIAS
// ======================================================

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/noticias.php';
require_once 'src/permisos.php';
require_once 'src/hashtags.php';

// ======================================================
//      INICIALIZACIÓN DE TWIG
// ======================================================

// Indicamos a Twig dónde se encuentran las plantillas.

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$busqueda = "";

if(isset($_GET['hashtag'])){

    $busqueda =
        trim($_GET['hashtag']);

}


if(!empty($busqueda)){

    $noticias =
        getNoticiasPorHashtag(

            $mysqli,
            $busqueda

        );

}

else{

    $noticias = getNoticiasPublicadas($mysqli);

}


// RENDERIZADO DE LA PLANTILLA

echo $twig->render('portada.html.twig', [
    'noticias' => $noticias,
    'busqueda' => $busqueda,
    
    'usuarioSesion' => $_SESSION['usuario'] ?? null
]);

$mysqli->close();

?>