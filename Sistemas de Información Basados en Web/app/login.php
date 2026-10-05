<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/usuarios.php';

// ======================================================
//      TWIG
// ======================================================

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);


// ======================================================
//      LOGIN
// ======================================================

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $identificador = trim($_POST['identificador']);

    $password = trim($_POST['password']);

    // Buscar usuario

    $usuario =
    getUsuarioPorNombreOEmail(
        $mysqli,
        $identificador
    );

    // Comprobar usuario y contraseña

    if (
        !$usuario ||
        !password_verify(
            $password,
            $usuario['password']
        )
    ) {

        $errores[] =
            "Email, usuario o contraseña incorrectos";

    }

    else {

        // Guardar sesión

        $_SESSION['usuario'] = [

            'id' => $usuario['id'],

            'nombre' => $usuario['nombre'],

            'email' => $usuario['email'],

            'rol' => $usuario['rol']

        ];

        header("Location: portada.php");

        exit;

    }

}


// ======================================================
//      RENDER
// ======================================================

echo $twig->render(
    'login.html.twig',
    [
        'errores' => $errores,
        'usuarioSesion' => $_SESSION['usuario'] ?? null,
        'mostrarAuthHeader' => false
    ]
);

?>