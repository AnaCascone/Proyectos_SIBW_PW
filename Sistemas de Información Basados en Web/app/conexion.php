<?php

// ======================================================
//      CONEXIÓN A LA BASE DE DATOS
// ======================================================

// Creamos una nueva conexión con MySQL utilizando mysqli.
//
// Parámetros:
// - "db"        -> nombre del servicio del contenedor MySQL en Docker
// - "usuario"   -> usuario de la base de datos
// - "password"  -> contraseña del usuario
// - "sibw"      -> nombre de la base de datos

$mysqli = new mysqli(
    "db",
    "usuario",
    "password",
    "sibw"
);

// ======================================================
//      COMPROBACIÓN DE ERRORES DE CONEXIÓN
// ======================================================

// Si ocurre algún error al conectar con la base de datos,
// mostramos un mensaje y detenemos la ejecución del script.

if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// ======================================================
//      CONFIGURACIÓN DE CARACTERES
// ======================================================

// Establecemos utf8mb4 como juego de caracteres
// para permitir caracteres especiales, tildes,
// e incluso emojis si fuera necesario.

$mysqli->set_charset("utf8mb4");

?>