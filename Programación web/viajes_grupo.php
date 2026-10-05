<?php

$titulo = 'Viajes en grupo';
$cssPagina = 'viajes_grupo.css';
$paginaActiva = 'grupo';
$bodyClass = 'fondo-gamer';

include 'includes/cabecera.inc.php';
?>

<main class="container viajes-grupo-main">
    
    <h2>Viajes en grupo</h2>

    <section class="viajes-grupo-lista">

        <!-- SEÚL -->
        <article class="viaje-grupo">

            <div class="viaje-img">
                <img src="imagenes/grupo_seul.jpg" alt="Viaje a Corea en grupo">
            </div>

            <div class="viaje-info">

                <h3>Seúl eSports Tour</h3>

                <p><strong>Fechas:</strong> 5 - 12 Mayo 2026</p>
                <p><strong>Alojamiento:</strong> Hotel en Seúl</p>

                <p><strong>Itinerario:</strong> Seúl, Gangnam</p>

                <p><strong>Actividades:</strong> Visita a arenas eSports, gaming cafés y eventos locales.</p>

            </div>

        </article>

        <!-- TOKIO -->
        <article class="viaje-grupo">

            <div class="viaje-img">
                <img src="imagenes/grupo_tokio.jpg" alt="Viaje en grupo a Japón">
            </div>

            <div class="viaje-info">

                <h3>Japón Gamer Experience</h3>

                <p><strong>Fechas:</strong> 10 - 20 Junio 2026</p>
                <p><strong>Alojamiento:</strong> Hotel 4★ en Tokio</p>

                <p><strong>Itinerario:</strong> Tokio, Akihabara, Kioto</p>

                <p><strong>Actividades:</strong> Visita a Akihabara, torneos gaming, cultura tradicional japonesa.</p>

            </div>

        </article>

        <!-- USA -->
        <article class="viaje-grupo">

            <div class="viaje-img">
                <img src="imagenes/grupo_los_angeles.jpg" alt="Viaje en grupo a Los Ángeles">
            </div>

            <div class="viaje-info">

                <h3>Los Ángeles Gaming & Hollywood</h3>

                <p><strong>Fechas:</strong> 15 - 25 Julio 2026</p>
                <p><strong>Alojamiento:</strong> Hotel 4★ en Los Ángeles</p>

                <p><strong>Itinerario:</strong> Los Ángeles, Hollywood, Santa Mónica</p>

                <p><strong>Actividades:</strong> Estudios de cine, eventos gaming, playas y ocio nocturno.</p>

            </div>

        </article>

        <!-- ALEMANIA -->
        <article class="viaje-grupo">

            <div class="viaje-img">
                <img src="imagenes/grupo_berlin.jpg" alt="Viaje en grupo a Berlín">
            </div>

            <div class="viaje-info">

                <h3>Berlín Indie Gaming Tour</h3>

                <p><strong>Fechas:</strong> 10 - 18 Agosto 2026</p>
                <p><strong>Alojamiento:</strong> Hotel céntrico en Berlín</p>

                <p><strong>Itinerario:</strong> Berlín, Potsdam</p>

                <p><strong>Actividades:</strong> Estudios indie, ferias gaming, cultura urbana y museos.</p>

            </div>

        </article>

        <!-- ESPAÑA -->
        <article class="viaje-grupo">

            <div class="viaje-img">
                <img src="imagenes/grupo_malaga.jpg" alt="Viaje en grupo a Málaga">
            </div>

            <div class="viaje-info">

                <h3>Málaga FreakCon Experience</h3>

                <p><strong>Fechas:</strong> 23 - 25 Agosto 2026</p>
                <p><strong>Alojamiento:</strong> Hotel en el centro de Málaga</p>

                <p><strong>Itinerario:</strong> Málaga ciudad</p>

                <p><strong>Actividades:</strong> FreakCon, cosplay, videojuegos, eventos y turismo urbano.</p>

            </div>

        </article>

    </section>

</main>

<?php include 'includes/pie.inc.php'; ?>