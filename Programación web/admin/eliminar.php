<?php

require_once __DIR__ . '/../includes/sesion.inc.php';
require_once __DIR__ . '/../classes/Viaje.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$viaje = Viaje::obtenerViaje($id);

if (!$viaje) {
    die('Viaje no encontrado');
}

Viaje::eliminarViaje($id);

header('Location: index.php');
exit;