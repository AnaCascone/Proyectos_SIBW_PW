<?php

$titulo = 'Ofertas';
$cssPagina = 'ofertas.css';
$paginaActiva = 'ofertas';
$bodyClass = 'fondo-gamer';

include 'includes/cabecera.inc.php';
?>

<main class="container">
    <h2>Calendario de ofertas</h2>

    <div class="tabla-wrapper">
        <table class="calendario">

            <tr>
                <th colspan="7">Marzo</th>
                <th colspan="7">Abril</th>
            </tr>

            <tr>
                <td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td>
                <td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td>
            </tr>

            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td class="media">1</td>
                <td></td><td></td><td class="baja">1</td><td class="baja">2</td><td class="baja">3</td><td class="media">4</td><td class="media">5</td>
            </tr>

            <tr>
                <td class="baja">2</td><td class="baja">3</td><td class="baja">4</td><td class="baja">5</td><td class="baja">6</td><td class="media">7</td><td class="media">8</td>
                <td class="baja">6</td><td class="baja">7</td><td class="baja">8</td><td class="baja">9</td><td class="baja">10</td><td class="media">11</td><td class="media">12</td>
            </tr>

            <tr>
                <td class="baja">9</td><td class="baja">10</td><td class="baja">11</td><td class="baja">12</td><td class="baja">13</td><td class="media">14</td><td class="media">15</td>
                <td class="baja">13</td><td class="baja">14</td><td class="baja">15</td><td class="baja">16</td><td class="baja">17</td><td class="media">18</td><td class="media">19</td>
            </tr>

            <tr>
                <td class="baja">16</td><td class="baja">17</td><td class="baja">18</td><td class="baja">19</td><td class="baja">20</td><td class="media">21</td><td class="media">22</td>
                <td class="baja">20</td><td class="baja">21</td><td class="baja">22</td><td class="baja">23</td><td class="baja">24</td><td class="media">25</td><td class="media">26</td>
            </tr>

            <tr>
                <td class="alta">23</td><td class="alta">24</td><td class="alta">25</td><td class="alta">26</td><td class="alta">27</td><td class="alta">28</td><td class="alta">29</td>
                <td class="baja">27</td><td class="baja">28</td><td class="baja">29</td><td class="baja">30</td><td></td><td></td><td></td>
            </tr>

            <tr>
                <td class="baja">30</td><td class="baja">31</td><td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>

            <tr class="separador"><td colspan="14"></td></tr>

            <tr>
                <th colspan="7">Mayo</th>
                <th colspan="7">Junio</th>
            </tr>

            <tr>
                <td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td>
                <td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td>
            </tr>

            <tr>
                <td></td><td></td><td></td><td></td><td class="alta">1</td><td class="media">2</td><td class="media">3</td>
                <td class="media">1</td><td class="media">2</td><td class="media">3</td><td class="media">4</td><td class="media">5</td><td class="alta">6</td><td class="alta">7</td>
            </tr>

            <tr>
                <td class="baja">4</td><td class="baja">5</td><td class="baja">6</td><td class="baja">7</td><td class="baja">8</td><td class="media">9</td><td class="media">10</td>
                <td class="alta">8</td><td class="alta">9</td><td class="alta">10</td><td class="alta">11</td><td class="alta">12</td><td class="alta">13</td><td class="alta">14</td>
            </tr>

            <tr>
                <td class="baja">11</td><td class="baja">12</td><td class="baja">13</td><td class="baja">14</td><td class="alta">15</td><td class="media">16</td><td class="media">17</td>
                <td class="alta">15</td><td class="alta">16</td><td class="alta">17</td><td class="alta">18</td><td class="alta">19</td><td class="alta">20</td><td class="alta">21</td>
            </tr>

            <tr>
                <td class="baja">18</td><td class="baja">19</td><td class="baja">20</td><td class="baja">21</td><td class="baja">22</td><td class="media">23</td><td class="media">24</td>
                <td class="alta">22</td><td class="alta">23</td><td class="alta">24</td><td class="alta">25</td><td class="alta">26</td><td class="alta">27</td><td class="alta">28</td>
            </tr>

            <tr>
                <td class="baja">25</td><td class="baja">26</td><td class="baja">27</td><td class="baja">28</td><td class="baja">29</td><td class="media">30</td><td class="media">31</td>
                <td class="alta">29</td><td class="alta">30</td><td></td><td></td><td></td><td></td><td></td>
            </tr>

        </table>
    </div>

    <section class="leyenda">
        <p><span class="baja"></span> Temporada baja</p>
        <p><span class="media"></span> Temporada media</p>
        <p><span class="alta"></span> Temporada alta</p>
    </section>

    <section class="ofertas-lista">

        <h2>Ofertas disponibles</h2>

        <article>
            <h3>Temporada baja</h3>
            <p>Descuentos del 30% en viajes a Japón.</p>
        </article>

        <article>
            <h3>Temporada media</h3>
            <p>Ofertas en eventos gaming en Europa.</p>
        </article>

        <article>
            <h3>Temporada alta</h3>
            <p>Viajes exclusivos a ferias internacionales.</p>
        </article>

    </section>
</main>

<?php include 'includes/pie.inc.php'; ?>