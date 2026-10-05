<?php
require_once __DIR__ . '/classes/Viaje.php';

$destino = trim($_GET['buscar_destino'] ?? '');
$fecha = $_GET['buscar_fecha'] ?? '';

$viajes = array();

if ($destino !== '' && $fecha !== '') {
    $viajes = Viaje::buscarViajes($destino, $fecha);
}

$titulo = 'Resultados de búsqueda';
$cssPagina = 'viajes.css';
$paginaActiva = 'viajes';
$bodyClass = 'fondo-gamer';

include __DIR__ . '/includes/cabecera.inc.php';
?>

<main class="container">

    <section class="viajes-content">

    <h2>Resultados de búsqueda</h2>

    <?php if (empty($viajes)): ?>

        <p>
            No se han encontrado viajes para los criterios indicados.
        </p>

    <?php else: ?>

        <section class="viajes-grid">

            <?php foreach ($viajes as $viaje): ?>

                <article class="viaje">

                    <a href="viaje.php?id=<?= $viaje->devolverValor('id') ?>">

                        <img
                            src="imagenes/<?= htmlspecialchars($viaje->devolverValor('imagen')) ?>"
                            alt="<?= htmlspecialchars($viaje->devolverValor('destino')) ?>">

                        <h3>
                            <?= htmlspecialchars($viaje->devolverValor('destino')) ?>
                        </h3>

                        <p class="fechas">
                            <?= date('d/m/Y', strtotime($viaje->devolverValor('fecha_inicio'))) ?>
                            -
                            <?= date('d/m/Y', strtotime($viaje->devolverValor('fecha_fin'))) ?>
                        </p>

                        <p>
                            <?= htmlspecialchars($viaje->devolverValor('frase_promo')) ?>
                        </p>

                        <p class="precio">
                            <?= number_format($viaje->devolverValor('precio'), 2) ?> €
                        </p>

                    </a>

                </article>

            <?php endforeach; ?>

        </section>

    <?php endif; ?>

    </section>

</main>

<?php include __DIR__ . '/includes/pie.inc.php'; ?>