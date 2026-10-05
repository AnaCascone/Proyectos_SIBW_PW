<?php

session_start();

// ======================================================
//      CARGA DE DEPENDENCIAS
// ======================================================

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/noticias.php';
require_once 'src/comentarios.php';
require_once 'src/localidades.php';
require_once 'src/permisos.php';
require_once 'src/imagenes.php';
require_once 'src/hashtags.php';


// ======================================================
//      INICIALIZACIÓN DE TWIG
// ======================================================

// Indicamos a Twig dónde se encuentran las plantillas.

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// ======================================================
//      VALIDACIÓN DEL ID DE LA NOTICIA
// ======================================================

// Comprobamos que la URL contiene el parámetro id.

if (!isset($_GET['id'])) {

    die("ID no especificado");

}

// Convertimos el parámetro recibido a entero
// para evitar inyecciones SQL y valores inválidos.

$id = (int) $_GET['id'];

// Comprobamos que el ID es un número positivo.

if ($id <= 0) {

    die("ID inválido");

}

// ======================================================
//      INSERTAR COMENTARIO
// ======================================================

/* Insertamos ahora isset($_SESSION['usuario'] para comprobar que tiene sesión iniciada */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && usuarioLogueado()) {

    // Eliminamos espacios innecesarios al principio y al final de los campos

    $nombre = $_SESSION['usuario']['nombre']; 

    $email = $_SESSION['usuario']['email']; 

    $texto = trim($_POST['comentario']);

    $errores = [];

    // ----- Nombre -----

    if (empty($nombre)) {

        $errores[] = "El nombre es obligatorio";

    }

    elseif (strlen($nombre) > 100) {

        $errores[] = "El nombre no puede tener más de 100 caracteres";

    }

    // ----- Email -----

    if (empty($email)) {

        $errores[] = "El email es obligatorio";

    }

    // Validamos que tenga el formato correcto 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errores[] = "El email no es válido";

    }

    // ----- Comentario -----

    if (empty($texto)) {

        $errores[] = "El comentario es obligatorio";

    }

    elseif (strlen($texto) > 1000) {

        $errores[] = "El comentario no puede tener más de 1000 caracteres";

    }

    // ==================================================
    //      INSERTAR COMENTARIO SI TODO ES CORRECTO
    // ==================================================

    // Si no hay errores de validación,
    // insertamos el comentario en la base de datos.

    if (empty($errores)) {

        insertarComentario(

            $mysqli,
            $id,
            $nombre,
            $email,
            $texto

        );

        header("Location: noticia.php?id=$id");

        exit;

    }

}

// ======================================================
//      CARGAR INFORMACIÓN DE LA NOTICIA
// ======================================================

$noticia = getNoticia($mysqli, $id);

// Proteger acceso a noticias no publicadas
if(
    !$noticia['publicado']
    &&
    !esGestor()
){
    die("No encontrada");
}

$imagenes = getImagenes($mysqli, $id);

$comentarios = getComentarios($mysqli, $id);

$localidades = getLocalidades($mysqli);

$hashtags = getHashtagsNoticia($mysqli, $id);


// ======================================================
//      RENDERIZADO DE LA PLANTILLA
// ======================================================

echo $twig->render(
    'noticia.html.twig',
    [
        'noticia' => $noticia,
        'imagenes' => $imagenes,
        'comentarios' => $comentarios,
        'localidades' => $localidades,
        'hashtags' => $hashtags,
        'usuarioSesion' => $_SESSION['usuario'] ?? null,

        'esModerador' => esModerador(),
        'esGestor' => esGestor(),
    ]
);

$mysqli->close();

?>