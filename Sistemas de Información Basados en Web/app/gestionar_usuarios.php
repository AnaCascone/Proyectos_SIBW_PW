<?php

session_start();

require_once 'vendor/autoload.php';
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
//      PROCESAR CAMBIO DE ROL
// ======================================================

$errores = [];

$rolesValidos = [

    'registrado',
    'moderador',
    'gestor',
    'superusuario'

];


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // ==============================================
    // DATOS
    // ==============================================

    $idUsuario =

        isset($_POST['id'])
        ? (int) $_POST['id']
        : 0;

    $nuevoRol =

        trim($_POST['rol']);

    // ==============================================
    // VALIDAR ID
    // ==============================================

    if($idUsuario <= 0){

        $errores[] =
            "Usuario inválido";

    }

    // ==============================================
    // VALIDAR ROL
    // ==============================================

    if(
        !in_array(
            $nuevoRol,
            $rolesValidos
        )
    ){

        $errores[] =
            "Rol inválido";

    }

    // ==============================================
    // OBTENER USUARIO
    // ==============================================

    $usuario =
        getUsuarioPorId(
            $mysqli,
            $idUsuario
        );

    if(!$usuario){

        $errores[] =
            "El usuario no existe";

    }

    // ==============================================
    // EVITAR QUEDARSE SIN SUPERUSUARIO
    // ==============================================

    if(

        empty($errores)

        &&

        $usuario['rol'] === 'superusuario'

        &&

        $nuevoRol !== 'superusuario'

    ){

        $totalSuperusuarios =

            contarSuperusuarios(
                $mysqli
            );

        if($totalSuperusuarios <= 1){

            $errores[] =

                "Debe existir al menos un superusuario";

        }

    }

    // ==============================================
    // ACTUALIZAR ROL
    // ==============================================

    if(empty($errores)){

        actualizarRolUsuario(

            $mysqli,
            $idUsuario,
            $nuevoRol

        );

        header(
            "Location: gestionar_usuarios.php"
        );

        exit;

    }

}


// ======================================================
//      OBTENER USUARIOS
// ======================================================

$usuarios = getUsuarios($mysqli);


// ======================================================
//      TWIG
// ======================================================

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);


// ======================================================
//      RENDER
// ======================================================

echo $twig->render(

    'gestionar_usuarios.html.twig',

    [

        'usuarios' => $usuarios,
        'errores' => $errores,

        'usuarioSesion' => $_SESSION['usuario'] ?? null

    ]

);

?>