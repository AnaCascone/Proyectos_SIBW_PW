<?php

// ======================================================
//      COMPROBAR LOGIN
// ======================================================

function usuarioLogueado() {

    return isset($_SESSION['usuario']);

}


// ======================================================
//      OBTENER ROL
// ======================================================

function getRolUsuario() {

    if (!isset($_SESSION['usuario'])) {

        return null;

    }

    return $_SESSION['usuario']['rol'];

}


// ======================================================
//      ROLES
// ======================================================


function esModerador() {

    $rol = getRolUsuario();

    return (
        $rol === 'moderador' ||
        $rol === 'superusuario'
    );

}


function esGestor() {

    $rol = getRolUsuario();

    return (
        $rol === 'gestor' ||
        $rol === 'superusuario'
    );

}


function esSuperusuario() {

    return getRolUsuario() === 'superusuario';

}

?>