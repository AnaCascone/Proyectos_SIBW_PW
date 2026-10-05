<?php

session_start();

require_once 'conexion.php';

require_once 'src/usuarios.php';

require_once 'src/permisos.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(!esSuperusuario()){

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
//      OBTENER USUARIO
// ======================================================

$usuario =

    getUsuarioPorId(
        $mysqli,
        $id
    );

if(!$usuario){

    die("Usuario no encontrado");

}


// ======================================================
//      EVITAR AUTOELIMINACIÓN
// ======================================================

if($usuario['id'] == $_SESSION['usuario']['id']){

    die("No puedes eliminarte a ti mismo");

}


// ======================================================
//      EVITAR ELIMINAR ÚLTIMO SUPERUSUARIO
// ======================================================

if($usuario['rol'] === 'superusuario'){

    $totalSuperusuarios =

        contarSuperusuarios(
            $mysqli
        );

    if($totalSuperusuarios <= 1){

        die(
            "Debe existir al menos un superusuario"
        );

    }

}


// ======================================================
//      ELIMINAR USUARIO
// ======================================================

eliminarUsuario(
    $mysqli,
    $id
);


// ======================================================
//      REDIRECCIÓN
// ======================================================

header(
    "Location: gestionar_usuarios.php"
);

exit;

?>