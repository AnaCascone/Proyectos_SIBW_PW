<?php
require_once __DIR__ . '/classes/Viaje.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Buscamos el viaje
$viaje = Viaje::obtenerViaje($id);

if (!$viaje) {
    die('Viaje no encontrado');
}

$viajesRelacionados = Viaje::viajesPorPais($viaje->devolverValor('pais_id'));

$titulo = $viaje->devolverValor('destino');
$cssPagina = 'viaje_individual.css';
$paginaActiva = 'viajes';

include __DIR__ . '/includes/cabecera.inc.php';

?>

<main>

    <section class="viaje-hero">

        <img
            src="imagenes/<?= htmlspecialchars($viaje->devolverValor('imagen')) ?>"
            alt="<?= htmlspecialchars($viaje->devolverValor('destino')) ?>">

    </section>

    <section class="viaje-contenido">

        <section class="viaje-info">

            <h2><?= htmlspecialchars($viaje->devolverValor('destino')) ?></h2>

            <h3>Información del viaje</h3>

            <p>
                <strong>País:</strong>
                <?= htmlspecialchars($viaje->devolverValor('pais')) ?>
            </p>

            <p>
                <strong>Continente:</strong>
                <?= htmlspecialchars($viaje->devolverValor('continente')) ?>
            </p>

            <p>
                <strong>Precio:</strong>
                <?= number_format($viaje->devolverValor('precio'), 2) ?> €
            </p>

            <p>
                <strong>Fecha de inicio:</strong>
                <?= $viaje->devolverValor('fecha_inicio') ?>
            </p>

            <p>
                <strong>Fecha de fin:</strong>
                <?= $viaje->devolverValor('fecha_fin') ?>
            </p>

            <h3>Frase promocional</h3>

            <p>
                <?= htmlspecialchars($viaje->devolverValor('frase_promo')) ?>
            </p>

            <h3>Descripción</h3>

            <p>
                <?= nl2br(htmlspecialchars($viaje->devolverValor('descripcion'))) ?>
            </p>

        </section>

        <aside class="viaje-relacionados">

            <h3>
                Más viajes en <?= htmlspecialchars($viaje->devolverValor('pais')) ?>
            </h3>

            <ul>

                <?php foreach ($viajesRelacionados as $relacionado): ?>

                    <?php
                    if ($relacionado->devolverValor('id') == $viaje->devolverValor('id')) {
                        continue;
                    }
                    ?>

                    <li>
                        <a href="viaje.php?id=<?= $relacionado->devolverValor('id') ?>">
                            <?= htmlspecialchars($relacionado->devolverValor('destino')) ?>
                        </a>
                    </li>

                <?php endforeach; ?>

            </ul>

        </aside>
    </section>

</main>

<?php
include __DIR__ . '/includes/pie.inc.php';
?>

