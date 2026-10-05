<?php

session_start();

require_once 'conexion.php';
require_once 'src/imagenes.php';
require_once 'src/permisos.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(!esGestor()){

    die("Acceso denegado");

}


// ======================================================
//      VALIDAR ID
// ======================================================

if(
    !isset($_GET['id'])
    ||
    !isset($_GET['noticia'])
){

    die("Datos incompletos");

}

$idImagen =
    (int) $_GET['id'];

$idNoticia =
    (int) $_GET['noticia'];

if(
    $idImagen <= 0
    ||
    $idNoticia <= 0
){

    die("ID inválido");

}

$imagenes =

    getImagenes(
        $mysqli,
        $idNoticia
    );

$errores = [];

if(count($imagenes) <= 1){

    $errores[] = "La noticia debe tener al menos una imagen";

}

// ======================================================
//      ELIMINAR IMAGEN
// ======================================================

if(empty($errores)){

    eliminarImagen(
        $mysqli,
        $idImagen
    );

}

else{

    $_SESSION['error'] = $errores[0];

}

// ======================================================
//      REDIRECCIÓN
// ======================================================

header(
    "Location: editar_noticia.php?id=$idNoticia"
);

exit;

?>