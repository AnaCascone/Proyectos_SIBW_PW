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
//      VALIDAR ID
// ======================================================

if(!isset($_GET['id'])){

    die("ID no especificado");

}

$id = (int) $_GET['id'];

if($id <= 0){

    die("ID inválido");

}


// ======================================================
//      OBTENER NOTICIA
// ======================================================

$noticia =
    getNoticia(
        $mysqli,
        $id
    );

if(!$noticia){

    die("Noticia no encontrada");

}

$imagenes = 
    getImagenes(
        $mysqli,
        $id
    );

$hashtagsActuales =
    getHashtagsNoticia(
        $mysqli,
        $id
    );

$nombresHashtags =
    array_column(
        $hashtagsActuales,
        'nombre'
    );

$hashtagsTexto =
    implode(
        ", ",
        $nombresHashtags
    );


$errores = [];

if(isset($_SESSION['error'])){

    $errores[] =
        $_SESSION['error'];

    unset($_SESSION['error']);

}


// ======================================================
//      EDITAR NOTICIA
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

    // Validaciones

    if(empty($titulo)){

        $errores[] = "El título es obligatorio";

    }

    elseif(strlen($titulo) > 200){

        $errores[] = "El título es demasiado largo";

    }

    if(empty($cuerpo)){

        $errores[] = "El cuerpo es obligatorio";

    }

    elseif(strlen($cuerpo) > 1000){

        $errores[] = "El cuerpo es demasiado largo";

    }

    if(empty($fecha)){

        $errores[] = "La fecha es obligatoria";

    }

    // Actualizar
    if(empty($errores)){

        actualizarNoticia(

            $mysqli,
            $id,
            $titulo,
            $cuerpo,
            $fecha,
            $resumen,
            $concejalia,
            $responsables

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

                $id,

                $nombreArchivo,

                $descripcionImagen

            );

        }

        eliminarHashtagsNoticia(
            $mysqli,
            $id
        );

        if(!empty($hashtags)){

            procesarHashtags(

                $mysqli,
                $id,
                $hashtags

            );

        }

        
        eliminarHashtagsHuerfanos($mysqli);

        header(
            "Location: gestionar_noticias.php"
        );

        exit;

    }

}


// ======================================================
//      TWIG
// ======================================================

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);


// ======================================================
//      RENDERIZAR
// ======================================================

echo $twig->render(
    'editar_noticia.html.twig',
    [

        'noticia' => $noticia,
        'errores' => $errores,
        'usuarioSesion' => $_SESSION['usuario'] ?? null,
        'imagenes' => $imagenes,
        'hashtagsTexto' => $hashtagsTexto

    ]
);

?>