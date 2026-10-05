<?php

session_start();

require_once 'conexion.php';
require_once 'src/noticias.php';
require_once 'src/permisos.php';
require_once 'src/hashtags.php';
require_once 'src/imagenes.php';

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

$id =
    (int) $_GET['id'];

if($id <= 0){

    die("ID inválido");

}

// ======================================================
//      BORRAR IMAGEN DE IMG
// ======================================================

$imagenes = 
    getImagenes(
        $mysqli,
        $id
    );

foreach($imagenes as $imagen){

    $rutaImagen = "img/" . $imagen['archivo'];

    if(file_exists($rutaImagen)){

        unlink($rutaImagen);

    }

}


// ======================================================
//      ELIMINAR NOTICIA
// ======================================================

eliminarNoticia(
    $mysqli,
    $id
);

eliminarHashtagsHuerfanos($mysqli);


// ======================================================
//      REDIRECCIÓN
// ======================================================

header(
    "Location: gestionar_noticias.php"
);

exit;

?>