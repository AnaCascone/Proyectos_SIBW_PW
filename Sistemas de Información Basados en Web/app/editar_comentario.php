<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/comentarios.php';
require_once 'src/permisos.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(!esModerador()){

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
//      CARGAR COMENTARIO
// ======================================================

$comentario =
    getComentarioPorId(
        $mysqli,
        $id
    );

if(!$comentario){

    die("Comentario no encontrado");

}


$errores = [];


// ======================================================
//      EDITAR
// ======================================================

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $texto =
        trim($_POST['texto']);

    // Validación
    if(empty($texto)){

        $errores[] =
            "El comentario no puede estar vacío";

    }

    elseif(strlen($texto) > 1000){

        $errores[] =
            "El comentario no puede superar los 1000 caracteres";

    }


    // Actualizar
    if(empty($errores)){

        actualizarComentario(

            $mysqli,
            $id,
            $texto

        );

        header(
            "Location: noticia.php?id=" .
            $comentario['id_noticia']
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
    'editar_comentario.html.twig',
    [

        'comentario' => $comentario,
        'errores' => $errores,
        'usuarioSesion' => $_SESSION['usuario']

    ]
);

?>