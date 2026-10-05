<?php

$titulo = 'Contacto';
$bodyClass = 'fondo-gamer';
$jsPagina = 'validarFormulario.js';

include 'includes/cabecera.inc.php';
?>

<main class="form-container">

    <section class="form-box">

        <h2>Contacto</h2>

        <p><strong>Nombre:</strong> Ana Cascone Hernández</p>
        <p><strong>Email:</strong> anach2173@correo.ugr.es</p>
        <p><strong>Asignatura:</strong> Programación Web</p>
        <p><strong>Curso:</strong> 2025-2026</p>

    </section>

    <section class="form-box">

        <h2>Envíanos un mensaje</h2>

        <div id="errores-js"></div>

        <form action="#" method="post">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre">

            <label for="email">Email</label>
            <input type="text" id="email" name="email">

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje"></textarea>

            <button type="submit" class="btn-formulario">Enviar</button>

        </form>

    </section>
   
</main>

<?php include 'includes/pie.inc.php'; ?>