<?php

session_start();

require_once 'conexion.php';
require_once 'src/hashtags.php';
require_once 'src/permisos.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(
    !esGestor()
    &&
    !esSuperusuario()
){

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
//      ELIMINAR
// ======================================================

eliminarHashtag(
    $mysqli,
    $id
);


// ======================================================
//      REDIRECCIÓN
// ======================================================

header(
    "Location: gestionar_hashtags.php"
);

exit;

?>