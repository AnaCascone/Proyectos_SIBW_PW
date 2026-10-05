<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/usuarios.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(!isset($_SESSION['usuario'])){

    header("Location: login.php");

    exit;

}

// INICIALIZAR TWIG

$loader =
    new \Twig\Loader\FilesystemLoader('templates');

$twig =
    new \Twig\Environment($loader);


// ======================================================
//      DATOS USUARIO
// ======================================================

$id = $_SESSION['usuario']['id'];

$usuario = getUsuarioPorId($mysqli, $id);

$errores = [];


// ======================================================
//      ACTUALIZAR PERFIL
// ======================================================

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nombre = trim($_POST['nombre']);

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    // ----- VALIDACIONES -----

    if(empty($nombre)){

        $errores[] = "El nombre es obligatorio";

    }

    elseif(
        !preg_match(
            "/^[a-zA-Z0-9_]+$/",
            $nombre
        )
    ){

        $errores[] = "El nombre solo puede contener letras, números y guiones bajos";

    }

    if(empty($email)){

        $errores[] = "El email es obligatorio";

    }

    elseif(
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ){

        $errores[] = "El email no es válido";

    }

    if(
        !empty($password)
        &&
        strlen($password) < 6
    ){

        $errores[] =
            "La contraseña debe tener al menos 6 caracteres";

    }


    // ----- ACTUALIZAR -----

    if(empty($errores)){

        actualizarUsuario(

            $mysqli,
            $id,
            $nombre,
            $email,
            $password

        );

        // Actualizar sesión
        $_SESSION['usuario']['nombre'] =
            $nombre;

        $_SESSION['usuario']['email'] =
            $email;

        header("Location: perfil.php");

        exit;

    }

}

$error = null;

if(isset($_GET['error'])){

    $error =
        $_GET['error'];

}


// ======================================================
//      RENDERIZAR
// ======================================================

echo $twig->render(
    'perfil.html.twig',
    [

        'error' => $error,
        'usuario' => $usuario,
        'errores' => $errores,
        'usuarioSesion' => $_SESSION['usuario']

    ]
);

?>