<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/noticias.php';
require_once 'src/permisos.php';
require_once 'src/imagenes.php';
require_once 'src/hashtags.php';


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


$errores = [];


// ======================================================
//      CREAR NOTICIA
// ======================================================

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $titulo = trim($_POST['titulo']);

    $cuerpo = trim($_POST['cuerpo']);

    $fecha = trim($_POST['fecha']);

    $resumen = trim($_POST['resumen']);

    $concejalia = trim($_POST['concejalia']);

    $responsables = trim($_POST['responsables']);

    $archivo = $_FILES['archivo'];

    $descripcionImagen = trim($_POST['descripcion_imagen']);

    $hashtags = trim($_POST['hashtags']);

    $publicado = isset($_POST['publicado']) ? 1 : 0;


    // Validaciones

    if(empty($titulo)){

        $errores[] =
            "El título es obligatorio";

    }

    if(empty($cuerpo)){

        $errores[] =
            "El cuerpo es obligatorio";

    }

    if(empty($fecha)){

        $errores[] =
            "La fecha es obligatoria";

    }


    // Insertar

    if(empty($errores)){

        $idNoticia = 
            insertarNoticia(

                $mysqli,
                $titulo,
                $cuerpo,
                $fecha,
                $resumen,
                $concejalia,
                $responsables,
                $publicado

            );

        if(
            isset($_FILES['archivo']) &&
            $_FILES['archivo']['error'] === 0
        ){

            $nombreArchivo =
                basename(
                    $_FILES['archivo']['name']
                );

            move_uploaded_file(

                $_FILES['archivo']['tmp_name'],

                "img/" . $nombreArchivo

            );

            insertarImagen(

                $mysqli,

                $idNoticia,

                $nombreArchivo,

                $descripcionImagen

            );

        }

        if(!empty($hashtags)){

            procesarHashtags(

                $mysqli,
                $idNoticia,
                $hashtags

            );
        }

        header(
            "Location: gestionar_noticias.php"
        );

        exit;

    }

}


// ======================================================
//      RENDERIZAR
// ======================================================

echo $twig->render(
    'crear_noticia.html.twig',
    [

        'errores' => $errores,
        'usuarioSesion' => $_SESSION['usuario']

    ]
);

?>