<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Debe existir un usuario logueado
if (!isset($_SESSION['tipo'])) {
    header('Location: ../index.php');
    exit;
}

// Debe ser administrador
if ($_SESSION['tipo'] !== 'administrador') {
    header('Location: ../index.php');
    exit;
}