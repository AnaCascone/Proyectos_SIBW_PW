<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'conexion.php';
require_once 'src/comentarios.php';
require_once 'src/permisos.php';


// ======================================================
//      PROTEGER ACCESO
// ======================================================

if(!esModerador()){

    die("Acceso denegado");

}


// ======================================================
//      INICIALIZAR TWIG
// ======================================================

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);


// ======================================================
//      BUSCADOR
// ======================================================

$busqueda = "";

if(isset($_GET['busqueda'])){

    $busqueda = trim($_GET['busqueda']);

}


// ======================================================
//      CARGAR COMENTARIOS
// ======================================================

$comentarios =
    getTodosComentarios(
        $mysqli,
        $busqueda
    );


// ======================================================
//      RENDERIZAR
// ======================================================

echo $twig->render(
    'gestionar_comentarios.html.twig',
    [

        'comentarios' => $comentarios,
        'busqueda' => $busqueda,
        'usuarioSesion' => $_SESSION['usuario'] ?? null

    ]
);

?>