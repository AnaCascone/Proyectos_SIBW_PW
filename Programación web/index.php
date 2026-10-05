<?php
require_once __DIR__ . '/classes/Viaje.php';

$titulo = 'Inicio';
$cssPagina = 'index.css';
$paginaActiva = 'inicio';
$jsPagina = array(
    'carrusel.js',
    'validarFormulario.js'
);

// Para el carrusel, obtenemos los 6 primeros viajes (si hay menos de 6, se mostrarán los que haya)
$viajesCarrusel = Viaje::obtenerViajesCarrusel();

include 'includes/cabecera.inc.php';
?>

<main>

    <section class="hero">
        <div class="hero-content">
            <img src="imagenes/logo_sinfondo.png" alt="Nexus Gate" class="hero-logo">
            
            <h2>Explora mundos como nunca antes</h2>
            <p>Viajes únicos para gamers en Japón, Estados Unidos y más</p>
        
            <a href="viajes.php" class="cta">Explorar viajes</a>
        </div>
    </section>

    <section class="info">
        <h2>Nexus Gate</h2>
        <p>
            En Nexus Gate te llevamos más allá del turismo tradicional.
            <br>
            Descubre experiencias diseñadas para gamers en destinos como Japón,
            Corea del Sur o Estados Unidos. Vive la cultura, los eventos y los
            lugares más icónicos del mundo gaming.
        </p>
    </section>

    <section class="carrusel">

        <button id="anterior">
            ◀
        </button>

        <?php foreach ($viajesCarrusel as $viaje): ?>

            <article class="slide">

                <a href="viaje.php?id=<?= $viaje->devolverValor('id') ?>">

                    <img
                        src="imagenes/<?= htmlspecialchars($viaje->devolverValor('imagen')) ?>"
                        alt="<?= htmlspecialchars($viaje->devolverValor('destino')) ?>">

                    <h3>
                        <?= htmlspecialchars($viaje->devolverValor('destino')) ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($viaje->devolverValor('frase_promo')) ?>
                    </p>

                </a>

            </article>

        <?php endforeach; ?>

        <button id="siguiente">
            ▶
        </button>

    </section>

    <section class="buscador">
        <h2>Encuentra tu próximo viaje</h2>

        <div id="errores-js"></div>

        <form action="viajes_buscados.php" method="get">
            <input id="buscar_destino" type="text" name="buscar_destino" placeholder="Destino">
            <input id="fecha" type="text" name="buscar_fecha" placeholder="YYYY-MM-DD">
            <button type="submit">Buscar</button>
        </form>
    </section>

</main>

<?php include 'includes/pie.inc.php'; ?>