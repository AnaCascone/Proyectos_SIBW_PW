<?php
require_once __DIR__ . '/classes/Usuario.php';

$errores = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $fecha = $_POST['fecha'] ?? '';

    // Comprobaciones en el servidor 
    if ($nombre === '' || $usuario === '' || $email === '' || $password === '' || $fecha === '') {
        $errores[] = 'Tienes que rellenar todos los campos.';
    }
    if ($usuario !== '' && Usuario::existeUsuario($usuario)) {
        $errores[] = 'Ese nombre de usuario ya está en uso.';
    }
    if ($email !== '' && Usuario::existeEmail($email)) {
        $errores[] = 'Ese correo ya está registrado.';
    }

    if (empty($errores)) {
        Usuario::insertarUsuario($usuario, $nombre, $email, $password, $fecha);
        header('Location: alta_ok.php');
        exit;
    }
}

$titulo = 'Alta de Usuarios';
$cssPagina = 'formulario.css';
$bodyClass = 'fondo-gamer layout-base';
$jsPagina = 'validarFormulario.js';

require 'includes/cabecera.inc.php';
?>
        <main class="form-container">

            <section class="form-box">

                <h2>Crear cuenta</h2>

                <div id="errores-js"></div>

                <?php foreach ($errores as $error): ?>
                    <p class="error"><?= $error ?></p>
                <?php endforeach; ?>

                <form action="registro.php" method="post">

                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre">

                    <label for="usuario">Nombre de usuario</label>
                    <input type="text" id="usuario" name="usuario">

                    <label for="email">Correo electrónico</label>
                    <input type="text" id="email" name="email">

                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password">

                    <label for="fecha">Fecha de nacimiento</label>
                    <input type="text" id="fecha" name="fecha" placeholder="YYYY-MM-DD">

                    <button type="submit" class="btn-formulario">Registrarse</button>

                </form>

            </section>

        </main>
<?php require 'includes/pie.inc.php'; ?>