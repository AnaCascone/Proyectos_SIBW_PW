// Esperamos a que cargue toda la página
document.addEventListener('DOMContentLoaded', function () {

    const formularios = document.querySelectorAll('main form');

    if (!formularios) {
        return;
    }

    formularios.forEach(function (formulario) {
        formulario.addEventListener('submit', function (evento) {

            let errores = [];

            // ---------- CAMPOS OBLIGATORIOS ----------

            const campos = formulario.querySelectorAll('input, textarea, select');

            let hayCampoVacio = false;

            campos.forEach(function (campo) {

                // Ignoramos botones
                if (campo.type === 'submit' || campo.type === 'button') {
                    return;
                }

                if (campo.value.trim() === '') {
                    hayCampoVacio = true;
                }

            });

            if (hayCampoVacio) {
                errores.push('Todos los campos son obligatorios.');
            }

            const camposTexto = formulario.querySelectorAll('input[type="text"]');

            let hayCamposLargos = false;

            camposTexto.forEach(function(campo) {

                if (campo.value.length > 255) {
                    hayCamposLargos = true;
                }

            });

            if (hayCamposLargos) {
                errores.push('Algún campo supera la longitud máxima permitida.');
            }

            // ---------- NOMBRE COMPLETO ----------

            const nombre = document.getElementById('nombre');

            if (nombre && nombre.value.trim() !== '') {

                const expresionNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñÜü\s]+$/;

                if (!expresionNombre.test(nombre.value)) {
                    errores.push('El nombre completo solo puede contener letras y espacios.');
                }

            }

            // ---------- NOMBRE DE USUARIO ----------

            const usuario = document.getElementById('usuario');

            if (usuario && usuario.value.trim() !== '') {

                const expresionUsuario = /^[A-Za-z0-9_]+$/;

                if (!expresionUsuario.test(usuario.value)) {
                    errores.push('El nombre de usuario solo puede contener letras, números y _.');
                }

            }

            // ---------- EMAIL ----------

            const email = document.getElementById('email');

            if (email && email.value.trim() !== '') {

                const expresionEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!expresionEmail.test(email.value)) {
                    errores.push('El correo electrónico no tiene un formato válido.');
                }

            }

            // ---------- CONTRASEÑA ----------

            const password = document.getElementById('password');

            if (password && password.value.length < 6) {
                errores.push('La contraseña debe tener al menos 6 caracteres.');
            }

            // ---------- FECHA ----------

            const fecha = document.getElementById('fecha');

            if (fecha && fecha.value.trim() !== '') {

                const expresionFecha = /^\d{4}-\d{2}-\d{2}$/;

                if (!expresionFecha.test(fecha.value)) {
                    errores.push('La fecha debe tener formato YYYY-MM-DD.');
                }

                const fechaObj = new Date(fecha.value);

                if (isNaN(fechaObj.getTime())) {
                    errores.push('La fecha no es válida.');
                }

            }

            // ---------- PRECIO ----------

            const precio = document.getElementById('precio');

            if (precio) {

                if (isNaN(Number(precio.value))) {
                    errores.push('El precio debe ser un número.');
                }

                else if (Number(precio.value) <= 0) {
                    errores.push('El precio debe ser mayor que 0.');
                }

                if (Number(precio.value) > 100000) {
                    errores.push('El precio debe estar entre 0 y 100000 euros.');
                }

            }

            // ---------- FECHAS DE VIAJE ----------

            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin');

            if (
                fechaInicio &&
                fechaFin &&
                fechaInicio.value.trim() !== '' &&
                fechaFin.value.trim() !== ''
            ) {

                if (fechaFin.value < fechaInicio.value) {
                    errores.push('La fecha de fin no puede ser anterior a la fecha de inicio.');
                }

                const fechaObj_ini = new Date(fechaInicio.value);
                const fechaObj_fin = new Date(fechaFin.value);

                if (isNaN(fechaObj_ini.getTime())) {
                    errores.push('La fecha de inicio no es válida.');
                }

                if (isNaN(fechaObj_fin.getTime())) {
                    errores.push('La fecha de fin no es válida.');
                }

            }

            // ---------- IMAGEN ----------

            const imagen = document.getElementById('imagen');

            if (imagen && imagen.value.trim() !== '') {

                const expresionImagen = /\.(jpg|jpeg|png|webp)$/i;

                if (!expresionImagen.test(imagen.value)) {
                    errores.push('La imagen debe ser JPG, JPEG, PNG o WEBP.');
                }

            }

            // ---------- MOSTRAR ERRORES ----------

            if (errores.length > 0) {

                evento.preventDefault();

                const contenedorErrores = document.getElementById('errores-js');

                if (contenedorErrores) {

                    contenedorErrores.innerHTML = '';

                    errores.forEach(function(error) {

                        contenedorErrores.innerHTML +=
                            '<p class="error">' + error + '</p>';

                    });

                }

            }

        });
    });

});