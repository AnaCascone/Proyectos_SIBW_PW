<?php
require_once __DIR__ . '/classes/Usuario.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuario = $_POST['usuario'] ?? '';
$contrasenia = $_POST['contrasenia'] ?? '';

$resultado = Usuario::comprobarLogin($usuario, $contrasenia);

if ($resultado) {
    // Guardamos en la sesion lo que necesita la cabecera
    $_SESSION['nombre_usuario'] = $resultado->devolverValor('nombre_usuario');
    $_SESSION['tipo'] = $resultado->devolverValor('tipo');
} else {
    $_SESSION['error_login'] = 'Usuario o contraseña incorrectos.';
}

header('Location: index.php');
exit;