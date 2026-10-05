<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variables que DEBEN DEFINIR cada pagina antes de incluir este fichero
$titulo = $titulo ?? '';
$cssPagina = $cssPagina ?? '';
$paginaActiva = $paginaActiva ?? '';
$bodyClass = $bodyClass ?? '';
$mostrarLogin = $mostrarLogin ?? true;
$rutaBase = $rutaBase ?? '';

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nexus Gate | <?= $titulo ?></title>
        <link rel="stylesheet" href="<?= $rutaBase ?>css/base.css">
        <?php if ($cssPagina): ?>
        <link rel="stylesheet" href="<?= $rutaBase ?>css/<?= $cssPagina ?>">
        <?php endif; ?>
        <link rel="stylesheet" href="<?= $rutaBase ?>css/responsive.css">
        <link rel="icon" href="<?= $rutaBase ?>imagenes/logo_simple_sinfondo.png" type="image/png">
    </head>
    <body class="<?= $bodyClass ?>">
        <header>

            <section class="top-bar">

                <a href="<?= $rutaBase ?>index.php" class="logo">
                    <img src="<?= $rutaBase ?>imagenes/logo_simple_sinfondo.png" alt="Nexus Gate">
                    <div class="logo-text">
                        <h1>Nexus Gate</h1>
                        <p class="tagline">Travel Beyond Worlds</p>
                    </div>
                </a>

                <?php if ($mostrarLogin): ?>
                <section class="login">
                    
                    <!-- Si el usuario esta logueado, muestra su nombre y un enlace para cerrar sesion. Si no, muestra el formulario de login y el enlace de registro -->

                    <?php if (isset($_SESSION['nombre_usuario'])): ?>
                        <span class="usuario-activo">
                            <?= htmlspecialchars($_SESSION['nombre_usuario']) ?> (<?= htmlspecialchars($_SESSION['tipo']) ?>)
                            
                            <!-- Si el usuario es admin, muestra un enlace a la administración -->
                            <?php if ($_SESSION['tipo'] === 'administrador'): ?>
                                <a href="<?= $rutaBase ?>admin/index.php" class="registro">
                                    Administración
                                </a>
                            <?php endif; ?>
                        </span>
                        <a href="<?= $rutaBase ?>logout.php" class="registro">Cerrar sesión</a>
                    <?php else: ?>
                        <a href="<?= $rutaBase ?>registro.php" class="registro">Registrarse</a>

                        <form action="<?= $rutaBase ?>login.php" method="post">
                            <input type="text" name="usuario" placeholder="Usuario">
                            <input type="password" name="contrasenia" placeholder="Contraseña">
                            <button type="submit">Entrar</button>
                        </form>

                        <?php if (isset($_SESSION['error_login'])): ?>
                            <p class="error"><?= $_SESSION['error_login'] ?></p>
                            <?php unset($_SESSION['error_login']); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                </section>
                <?php endif; ?>

            </section>

            <nav>
                <ul>
                    <li><a href="<?= $rutaBase ?>index.php" <?= $paginaActiva === 'inicio' ? 'class="active"' : '' ?>>Inicio</a></li>
                    <li><a href="<?= $rutaBase ?>viajes.php" <?= $paginaActiva === 'viajes' ? 'class="active"' : '' ?>>Viajes</a></li>
                    <li><a href="<?= $rutaBase ?>viajes_grupo.php" <?= $paginaActiva === 'grupo' ? 'class="active"' : '' ?>>Viajes en grupo</a></li>
                    <li><a href="<?= $rutaBase ?>ofertas.php" <?= $paginaActiva === 'ofertas' ? 'class="active"' : '' ?>>Ofertas</a></li>
                    <li><a href="<?= $rutaBase ?>sobre_agencia.php" <?= $paginaActiva === 'agencia' ? 'class="active"' : '' ?>>Sobre nuestra agencia</a></li>
                    <li><a href="<?= $rutaBase ?>sugerencias.php" <?= $paginaActiva === 'sugerencias' ? 'class="active"' : '' ?>>Sugerencias</a></li>
                </ul>
            </nav>

        </header>