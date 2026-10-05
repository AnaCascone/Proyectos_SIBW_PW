<?php

$titulo = 'Sobre nosotros';
$cssPagina = 'sobre_agencia.css';
$paginaActiva = 'agencia';
$bodyClass = 'fondo-gamer';

include 'includes/cabecera.inc.php';
?>

<main class="container">

   <section class="oficinas">
        <article class="oficina">

            <div class="oficina-mapa">
                <img src="imagenes/mapa_madrid.png" alt="Ubicación oficina Madrid">
            </div>

            <div class="oficina-info">
                <h2>Oficina Nexus Gate Madrid</h2>

                <p><strong>Dirección:</strong> Gran Vía, 25, Madrid</p>

                <p><strong>Horario:</strong> Lunes a viernes, 9:00 - 18:00</p>

                <p><strong>Viajes disponibles:</strong></p>
                <ul>
                    <li>Tokio Gamer Experience</li>
                    <li>Seúl eSports Experience</li>
                    <li>Gamescom Alemania</li>
                </ul>
            </div>

        </article>

        <article class="oficina">

            <div class="oficina-mapa">
                <img src="imagenes/mapa_granada.png" alt="Ubicación oficina Granada">
            </div>

            <div class="oficina-info">
                <h2>Oficina Nexus Gate Granada</h2>

                <p><strong>Dirección:</strong> Calle Recogidas, 12, Granada</p>

                <p><strong>Horario:</strong> Lunes a Viernes, 9:30 - 18:30</p>

                <p><strong>Viajes disponibles:</strong></p>
                <ul>
                    <li>Kioto Tradicional & Gaming</li>
                    <li>Seúl eSports Experience</li>
                    <li>Berlín Indie Gaming</li>
                </ul>
            </div>

        </article>

        <article class="oficina">

            <div class="oficina-mapa">
                <img src="imagenes/mapa_malaga.png" alt="Ubicación oficina Málaga">
            </div>

            <div class="oficina-info">
                <h2>Oficina Nexus Gate Málaga</h2>

                <p><strong>Dirección:</strong> Calle Larios, 8, Málaga</p>

                <p><strong>Horario:</strong> Lunes a Sábado, 10:00 - 20:00</p>

                <p><strong>Viajes disponibles:</strong></p>
                <ul>
                    <li>Málaga FreakCon Experience</li>
                    <li>Los Angeles Gaming & Hollywood</li>
                    <li>Tokyo Gamer Experience</li>
                </ul>
            </div>

        </article>

    </section>
</main>

<?php include 'includes/pie.inc.php'; ?>