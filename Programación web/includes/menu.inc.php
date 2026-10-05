<?php
require_once __DIR__ . '/../classes/Pais.php';

$paises = Pais::obtenerPaises();

$continenteActual = '';
?>

<aside class="menu-lateral">

    <h2>Destinos</h2>

    <?php foreach ($paises as $pais): ?>

        <?php
        $continente = $pais->devolverValor('continente');

        if ($continente !== $continenteActual):
            if ($continenteActual !== '') {
                echo '</ul>';
            }

            echo '<h3>' . htmlspecialchars($continente) . '</h3>';
            echo '<ul>';

            $continenteActual = $continente;
        endif;
        ?>

        <li>
            <a href="viajes.php?pais=<?= $pais->devolverValor('id') ?>">
                <?= htmlspecialchars($pais->devolverValor('nombre')) ?>
            </a>
        </li>

    <?php endforeach; ?>

    </ul>

</aside>