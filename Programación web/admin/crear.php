<?php
require_once __DIR__ . '/../includes/sesion.inc.php';
require_once __DIR__ . '/../classes/Viaje.php';
require_once __DIR__ . '/../classes/Pais.php';

$paises = Pais::obtenerPaises();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    Viaje::insertarViaje(
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

$titulo = 'Crear viaje';
$cssPagina = 'admin.css';
$bodyClass = 'fondo-gamer';
$rutaBase = '../';
$jsPagina = 'validarFormulario.js';

include __DIR__ . '/../includes/cabecera.inc.php';
?>

<main class="form-container">

    <section class="form-box">

        <h2>Nuevo viaje</h2>

        <div id="errores-js"></div>

        <form method="post">

            <label for="destino">Destino</label>
            <input type="text" id="destino" name="destino" >

            <label for="pais_id">País</label>
            <select id="pais_id" name="pais_id" >

                <?php foreach ($paises as $pais): ?>

                    <option value="<?= $pais->devolverValor('id') ?>">
                        <?= htmlspecialchars($pais->devolverValor('nombre')) ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <label for="descripcion">Descripción</label>
            <textarea
                id="descripcion"
                name="descripcion"
                rows="8"
            ></textarea>

            <label for="frase_promo">Frase promocional</label>
            <input type="text" id="frase_promo" name="frase_promo" >

            <label for="imagen">Imagen</label>
            <input type="text" id="imagen" name="imagen" >

            <label for="precio">Precio</label>
            <input type="text" step="0.01" id="precio" name="precio" >

            <label for="fecha_inicio">Fecha inicio</label>
            <input type="text" id="fecha_inicio" name="fecha_inicio" >

            <label for="fecha_fin">Fecha fin</label>
            <input type="text" id="fecha_fin" name="fecha_fin" >

            <div class="acciones-formulario">

                <button type="submit" class="btn-formulario">
                    Crear viaje
                </button>

                <a href="index.php" class="btn-cancelar">
                    Cancelar
                </a>

            </div>

        </form>

    </section>

</main>

<?php include __DIR__ . '/../includes/pie.inc.php'; ?>