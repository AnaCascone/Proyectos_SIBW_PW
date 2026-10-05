<?php
require_once __DIR__ . '/../includes/sesion.inc.php';
require_once __DIR__ . '/../classes/Viaje.php';

$viajes = Viaje::obtenerViajes(0, 999);

$titulo = 'Administración';
$cssPagina = 'admin.css';
$bodyClass = 'fondo-gamer';
$rutaBase = '../';

include __DIR__ . '/../includes/cabecera.inc.php';
?>

<main class="admin-container">

    <h2>Panel de administración</h2>

    <p>
        <a href="crear.php" class="btn-admin btn-crear">
            Nuevo viaje
        </a>
    </p>

    <table class="admin-tabla">

        <tr>
            <th>ID</th>
            <th>Destino</th>
            <th>País</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($viajes as $viaje): ?>

            <tr>

                <td>
                    <?= $viaje->devolverValor('id') ?>
                </td>

                <td>
                    <?= htmlspecialchars($viaje->devolverValor('destino')) ?>
                </td>

                <td>
                    <?= htmlspecialchars($viaje->devolverValor('pais')) ?>
                </td>

                <td>
                    <?= number_format($viaje->devolverValor('precio'), 2) ?> €
                </td>

                <td>

                    <div class="admin-acciones">

                        <a
                            href="editar.php?id=<?= $viaje->devolverValor('id') ?>"
                            class="btn-admin btn-editar">
                            Editar
                        </a>

                        <a
                            href="eliminar.php?id=<?= $viaje->devolverValor('id') ?>"
                            class="btn-admin btn-borrar"
                            onclick="return confirm('¿Seguro que quieres eliminar este viaje?')">
                            Eliminar
                        </a>

                    </div>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</main>

<?php include __DIR__ . '/../includes/pie.inc.php'; ?>