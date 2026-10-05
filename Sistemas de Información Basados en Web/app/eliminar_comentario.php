<?php

session_start();

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

$id =
    (int) $_GET['id'];

if($id <= 0){

    die("ID inválido");

}


// ======================================================
//      ELIMINAR
// ======================================================

eliminarComentario(
    $mysqli,
    $id
);


// ======================================================
//      VOLVER ATRÁS
// ======================================================

header(
    "Location: " . $_SERVER['HTTP_REFERER']
);

exit;

?>