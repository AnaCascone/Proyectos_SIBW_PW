<?php

session_start();

require_once 'conexion.php';

require_once 'src/usuarios.php';


// ======================================================
//      SOLO USUARIOS LOGUEADOS
// ======================================================

if(!isset($_SESSION['usuario'])){

    header("Location: login.php");

    exit;

}


$id =
    $_SESSION['usuario']['id'];


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
//      EVITAR ELIMINAR ÚLTIMO SUPERUSUARIO
// ======================================================

if($usuario['rol'] === 'superusuario'){

    $totalSuperusuarios =

        contarSuperusuarios(
            $mysqli
        );

    if($totalSuperusuarios <= 1){

        header(
            "Location: perfil.php?error=superusuario"
        );

        exit;

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
//      CERRAR SESIÓN
// ======================================================

session_destroy();


// ======================================================
//      REDIRECCIÓN
// ======================================================

header(
    "Location: portada.php"
);

exit;

?>