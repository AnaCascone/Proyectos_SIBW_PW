<?php
require_once __DIR__ . '/../includes/sesion.inc.php';
require_once __DIR__ . '/../classes/Viaje.php';
require_once __DIR__ . '/../classes/Pais.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$viaje = Viaje::obtenerViaje($id);

if (!$viaje) {
    die('Viaje no encontrado');
}

$paises = Pais::obtenerPaises();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    Viaje::actualizarViaje(
        $id,
        $_POST['destino'],
        $_POST['pais_id'],
        $_POST['descripcion'],
        $_POST['frase_promo'],
        $_POST['imagen'],
        $_POST['precio'],
        $_POST['fecha_inicio'],
        $_POST['fecha_fin']
    );

    header('Location: index.php');
    exit;
}

$titulo = 'Editar viaje';
$cssPagina = 'admin.css';
$bodyClass = 'fondo-gamer';
$rutaBase = '../';
$jsPagina = 'validarFormulario.js';

include __DIR__ . '/../includes/cabecera.inc.php';
?>

<main class="form-container">

    <section class="form-box">

        <h2>Editar viaje</h2>

        <div id="errores-js"></div>

        <form method="post">

            <label for="destino">Destino</label>
            <input
                type="text"
                id="destino"
                name="destino"
                value="<?= htmlspecialchars($viaje->devolverValor('destino')) ?>"
                >

            <label for="pais_id">País</label>
            <select id="pais_id" name="pais_id" >

                <?php foreach ($paises as $pais): ?>

                    <option
                        value="<?= $pais->devolverValor('id') ?>"
                        <?= ($pais->devolverValor('id') == $viaje->devolverValor('pais_id')) ? 'selected' : '' ?>>

                        <?= htmlspecialchars($pais->devolverValor('nombre')) ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <label for="descripcion">Descripción</label>
            <textarea
                id="descripcion"
                name="descripcion"
                rows="8"
                ><?= htmlspecialchars($viaje->devolverValor('descripcion')) ?></textarea>

            <label for="frase_promo">Frase promocional</label>
            <input
                type="text"
                id="frase_promo"
                name="frase_promo"
                value="<?= htmlspecialchars($viaje->devolverValor('frase_promo')) ?>"
                >

            <label for="imagen">Imagen</label>
            <input
                type="text"
                id="imagen"
                name="imagen"
                value="<?= htmlspecialchars($viaje->devolverValor('imagen')) ?>"
                >

            <label for="precio">Precio</label>
            <input
                type="text"
                step="0.01"
                id="precio"
                name="precio"
                value="<?= $viaje->devolverValor('precio') ?>"
                >

            <label for="fecha_inicio">Fecha inicio</label>
            <input
                type="text"
                id="fecha_inicio"
                name="fecha_inicio"
                value="<?= $viaje->devolverValor('fecha_inicio') ?>"
                >

            <label for="fecha_fin">Fecha fin</label>
            <input
                type="text"
                id="fecha_fin"
                name="fecha_fin"
                value="<?= $viaje->devolverValor('fecha_fin') ?>"
                >

            <div class="acciones-formulario">

                <button type="submit" class="btn-formulario">
                    Guardar cambios
                </button>

                <a href="index.php" class="btn-cancelar">
                    Cancelar
                </a>

            </div>

        </form>

    </section>

</main>

<?php include __DIR__ . '/../includes/pie.inc.php'; ?>