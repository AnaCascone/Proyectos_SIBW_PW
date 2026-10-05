<?php
require_once __DIR__ . '/classes/Viaje.php';

$titulo = 'Viajes';
$cssPagina = 'viajes.css';
$paginaActiva = 'viajes';
$bodyClass = 'fondo-gamer';

include __DIR__ . '/includes/cabecera.inc.php';
?>

<main class="container viajes-main">

    <?php include __DIR__ . '/includes/menu.inc.php'; ?>

    <section class="viajes-content">

        <?php 

            // ----- ENTRADA A LA PÁGINA -----

            // Comprobamos si se ha indicado una página en la URL, si no, por defecto será la 1
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

            // Evitamos que alguien intente acceder a una página negativa, cero o demasiado alta
            if ($pagina < 1 || $pagina > 1000) {
                $pagina = 1;
            }

            // ----- CONSULTA DE VIAJES -----

            // Calculamos la posición del primer viaje de la página
            $inicio = ($pagina - 1) * TAMANIO_PAGINA;

            // Comprobamos si se ha indicado un país en la URL para filtrar por ese país
            $paisId = isset($_GET['pais']) ? (int)$_GET['pais'] : null;

            if ($paisId === null){
                // No se ha indicado un país, mostramos todos los viajes
                $viajes = Viaje::obtenerViajes($inicio, TAMANIO_PAGINA);
                $totalViajes = Viaje::contarViajes();
            }
            else {
                // Se ha indiicado un país, mostramos solo los viajes de ese país
                $viajes = Viaje::obtenerViajesPorPais($paisId, $inicio, TAMANIO_PAGINA);
                $totalViajes = Viaje::contarViajesPorPais($paisId);
            }

            // ----- PAGINACIÓN -----

            // Calculamos el número total de páginas
            $totalPaginas = ceil($totalViajes / TAMANIO_PAGINA); // redondeamos hacia arriba

            // Evitamos que alguien intente acceder a una página que no existe
            if ($pagina > $totalPaginas) {
                $pagina = $totalPaginas;
            }
            
        ?>

        <section class="viajes-grid">

            <?php foreach ($viajes as $viaje): ?>

                <article class="viaje">

                    <a href="viaje.php?id=<?= $viaje->devolverValor('id') ?>">

                        <img
                            src="imagenes/<?= htmlspecialchars($viaje->devolverValor('imagen')) ?>"
                            alt="<?= htmlspecialchars($viaje->devolverValor('destino')) ?>">

                        <h3><?= htmlspecialchars($viaje->devolverValor('destino')) ?></h3>

                        <p class="fechas">
                            <?= date('d/m/Y', strtotime($viaje->devolverValor('fecha_inicio'))) ?>
                            -
                            <?= date('d/m/Y', strtotime($viaje->devolverValor('fecha_fin'))) ?>
                        </p>

                        <p><?= htmlspecialchars($viaje->devolverValor('frase_promo')) ?></p>

                        <p class="precio">
                            <?= number_format($viaje->devolverValor('precio'), 2) ?> €
                        </p>

                    </a>

                </article>

            <?php endforeach; ?>

        </section>

        <nav class="paginacion">

            <!-- Si la búsqueda es por país, mantenemos el filtro en los enlaces de paginación -->

            <?php if ($pagina > 1): ?>
                <a href="viajes.php?<?= 
                    ($paisId !== null)
                        ? 'pais=' . $paisId . '&pagina=' . ($pagina - 1)
                        : 'pagina=' . ($pagina - 1)                
                    ?>">
                        Anterior
                </a>
            <?php endif; ?>

            <?php if ($pagina < $totalPaginas): ?>
                <a href="viajes.php?<?= 
                    ($paisId !== null)
                        ? 'pais=' . $paisId . '&pagina=' . ($pagina + 1)
                        : 'pagina=' . ($pagina + 1)                
                    ?>">
                        Siguiente
                </a>
            <?php endif; ?>

        </nav>

    </section>

</main>

<?php include __DIR__ . '/includes/pie.inc.php'; ?>