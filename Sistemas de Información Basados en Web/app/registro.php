<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/usuarios.php';

// ======================================================
//      INICIALIZAR TWIG
// ======================================================

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);


// ======================================================
//      PROCESAR FORMULARIO
// ======================================================

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre']);

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    // ----- VALIDACIONES -----

    if (empty($nombre)) {

        $errores[] = "El nombre es obligatorio";

    }

    elseif(
        !preg_match(
            "/^[a-zA-Z0-9_]+$/",
            $nombre
        )
    ) {

        $errores[] =
            "El nombre solo puede contener letras, números y guiones bajos";

    }


    if (empty($email)) {

        $errores[] = "El email es obligatorio";

    }    

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errores[] = "El email no es válido";

    }

    
    if (empty($password)) {

        $errores[] = "La contraseña es obligatoria";

    }

    elseif (strlen($password) < 6) {

        $errores[] = "La contraseña debe tener al menos 6 caracteres";

    }

    // ----- COMPROBAR EMAIL REPETIDO -----

    $usuarioExistente = getUsuarioPorEmail(
        $mysqli,
        $email
    );

    if ($usuarioExistente) {

        $errores[] =
            "Ya existe un usuario con ese email";

    }

    // ----- COMPROBAR NOMBRE REPETIDO -----

    $usuarioNombreExistente = getUsuarioPorNombre(
        $mysqli,
        $nombre
    );

    if ($usuarioNombreExistente) {

        $errores[] =
            "Ya existe un usuario con ese nombre";

    }


    // ----- INSERTAR USUARIO -----

    if (empty($errores)) {

        insertarUsuario(
            $mysqli,
            $nombre,
            $email,
            $password
        );

        header("Location: login.php");

        exit;

    }

}


// ======================================================
//      RENDERIZAR
// ======================================================

echo $twig->render(
    'registro.html.twig',
    [
        'errores' => $errores,
        'usuarioSesion' => $_SESSION['usuario'] ?? null,
        'mostrarAuthHeader' => false
    ]
);

?>