// =======================================
//      VARIABLES GLOBALES
// =======================================

const panel = document.getElementById("panel-comentarios");

const trigger = document.getElementById("trigger-panel");

const btnNuevo = document.getElementById("btnNuevoComentario");

const formComentario = document.getElementById("formComentario");

const btnCancelar = document.getElementById("btnCancelarComentario");

const erroresDiv = document.getElementById("erroresFormulario");

const textarea = document.getElementById("comentario");

const formLogin = document.getElementById("formLogin");

const formRegistro = document.getElementById("formRegistro");

const formCrearNoticia = document.getElementById("formCrearNoticia");

const formEditarNoticia = document.getElementById("formEditarNoticia");


// =======================================
//      PANEL DE COMENTARIOS
// =======================================

if(panel && trigger){

    // Abrir panel
    trigger.addEventListener("mouseenter", () => {

        panel.classList.add("panel-activo");

    });

    // Cerrar panel
    document.addEventListener("click", (e) => {

        if(
            !panel.contains(e.target)
            &&
            !trigger.contains(e.target)
        ) {

            panel.classList.remove("panel-activo");

        }

    });

}


// =======================================
//      FORMULARIO COMENTARIOS
// =======================================

if(formComentario && btnNuevo && btnCancelar){

    // Mostrar formulario
    btnNuevo.addEventListener("click", () => {

        formComentario.classList.toggle("oculto");

        limpiarErrores();

    });

    // Enviar comentario
    formComentario.addEventListener("submit", (e) => {

        const errores =
            validarComentario();

        limpiarErrores();

        if(errores.length > 0){

            e.preventDefault();

            erroresDiv.classList.remove("oculto");

            erroresDiv.innerHTML =
                errores.join("<br>");

        }

    });

    // Cancelar comentario
    btnCancelar.addEventListener("click", () => {

        formComentario.reset();

        formComentario.classList.add("oculto");

        limpiarErrores();

    });

}


// =======================================
//      TEXTAREA LOCALIDADES
// =======================================

const contenedorLocalidades = document.getElementById("datos-localidades");

if(textarea && contenedorLocalidades){

    const localidades = JSON.parse(
        contenedorLocalidades.dataset.localidades
    );

    textarea.addEventListener("input", () => {

        let texto = textarea.value;

        localidades.forEach(localidad => {

            const regex =
                new RegExp(
                    `\\b${localidad}\\b`,
                    "gi"
                );

            texto = texto.replace(
                regex,
                localidad.toUpperCase()
            );

        });

        textarea.value = texto;

    });

}


// =======================================
//      LOGIN
// =======================================

if(formLogin){

    formLogin.addEventListener("submit", (e) => {

        const errores =
            validarLogin();

        if(errores.length > 0){

            e.preventDefault();

            alert(
                errores.join("\n")
            );

        }

    });

}


// =======================================
//      REGISTRO
// =======================================

if(formRegistro){

    formRegistro.addEventListener("submit", (e) => {

        const errores =
            validarRegistro();

        if(errores.length > 0){

            e.preventDefault();

            alert(
                errores.join("\n")
            );

        }

    });

}


// =======================================
//      FUNCIONES AUXILIARES
// =======================================

// Limpiar errores
function limpiarErrores(){

    if(erroresDiv){

        erroresDiv.innerHTML = "";

        erroresDiv.classList.add("oculto");

    }

}


// =======================================
//      VALIDAR COMENTARIO
// =======================================

function validarComentario(){

    const texto =
        document.getElementById("comentario")
        .value
        .trim();

    let errores = [];

    if(!texto){

        errores.push(
            "El comentario no puede estar vacío"
        );

    }

    else if(texto.length > 1000){

        errores.push(
            "El comentario no puede superar los 1000 caracteres"
        );

    }

    return errores;

}


// =======================================
//      VALIDAR LOGIN
// =======================================

function validarLogin(){

    const identificador =
        document.getElementById("identificador")
        .value
        .trim();

    const password =
        document.getElementById("password")
        .value
        .trim();

    let errores = [];

    if(!identificador){

        errores.push(
            "El usuario o email es obligatorio"
        );

    }

    if(!password){

        errores.push(
            "La contraseña es obligatoria"
        );

    }

    else if(password.length < 6){

        errores.push(
            "La contraseña debe tener al menos 6 caracteres"
        );

    }
    

    return errores;

}


// =======================================
//      VALIDAR REGISTRO
// =======================================

function validarRegistro(){

    const nombre =
        document.getElementById("nombre")
        .value
        .trim();

    const email =
        document.getElementById("email")
        .value
        .trim();

    const password =
        document.getElementById("password")
        .value
        .trim();

    let errores = [];

    // Nombre
    if(!nombre){

        errores.push(
            "El nombre es obligatorio"
        );

    }

    const regexNombre =
        /^[a-zA-Z0-9_]+$/;

    if(nombre && !regexNombre.test(nombre)){

        errores.push(
            "El nombre solo puede contener letras, números y guiones bajos"
        );

    }

    // Email
    if(!email){

        errores.push(
            "El email es obligatorio"
        );

    }

    // Regex email
    const regexEmail =
        /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if(email && !regexEmail.test(email)){

        errores.push(
            "El correo electrónico no es válido"
        );

    }

    // Password
    if(!password){

        errores.push(
            "La contraseña es obligatoria"
        );

    }

    else if(password.length < 6){

        errores.push(
            "La contraseña debe tener al menos 6 caracteres"
        );

    }

    return errores;

}

// =======================================
//      DROPDOWN USUARIO
// =======================================

const btnUsuario = document.getElementById("btnUsuario");

const menuUsuario = document.getElementById("menuUsuario");

if(btnUsuario && menuUsuario){

    // Abrir / cerrar menú
    btnUsuario.addEventListener("click", (e) => {

        e.stopPropagation(); // Evitar que el se cierre instantáneamente al hacer click en el botón

        menuUsuario.classList.toggle("oculto");

    });

    // Cerrar al hacer click fuera
    document.addEventListener("click", (e) => {

        if(
            !menuUsuario.contains(e.target)
            &&
            !btnUsuario.contains(e.target)
        ){

            menuUsuario.classList.add("oculto");

        }

    });

}

// =======================================
//      CREAR NOTICIA
// =======================================

if(formCrearNoticia){

    formCrearNoticia.addEventListener(
        "submit",
        (e) => {

            const errores = validarNoticia();

            if(errores.length > 0){

                e.preventDefault();

                alert(
                    errores.join("\n")
                );

            }

        }
    );

}


// =======================================
//      EDITAR NOTICIA
// =======================================

if(formEditarNoticia){

    formEditarNoticia.addEventListener(
        "submit",
        (e) => {

            const errores = validarNoticia();

            if(errores.length > 0){

                e.preventDefault();

                alert(
                    errores.join("\n")
                );

            }

        }
    );

}

// =======================================
//      VALIDAR NOTICIA
// =======================================

function validarNoticia(){

    const titulo = document.getElementById("titulo").value.trim();

    const cuerpo = document.getElementById("cuerpo").value.trim();

    const fecha = document.getElementById("fecha").value.trim();

    let errores = [];

    // Título
    if(!titulo){

        errores.push(
            "El título es obligatorio"
        );

    }

    else if(titulo.length > 200){

        errores.push(
            "El título es demasiado largo"
        );

    }

    // Cuerpo
    if(!cuerpo){

        errores.push(
            "El cuerpo es obligatorio"
        );

    }

    // Fecha
    if(!fecha){

        errores.push(
            "La fecha es obligatoria"
        );

    }

    // Imagen
    if(archivo && archivo.value.trim() !== ""){

        const regexImagen =
            /\.(jpg|jpeg|png|webp)$/i;

        if(!regexImagen.test(archivo.value.trim())){

            errores.push(
                "La imagen debe ser JPG, PNG o WEBP"
            );

        }

    }

    return errores;

}


// =======================================
//       NOTICIA PUBLICADA
// =======================================

activarCheckboxesPublicado();

function activarCheckboxesPublicado(){

    const checkboxes =
        document.querySelectorAll(
            ".checkbox-publicado"
        );

    checkboxes.forEach(checkbox => {

        checkbox.addEventListener("change", () => {

            const id = checkbox.dataset.id;

            const publicado = checkbox.checked ? 1 : 0;

            fetch(
                "cambiar_publicado.php",
                {
                    method: "POST",

                    headers: {
                        "Content-Type":
                        "application/x-www-form-urlencoded"
                    },

                    body:
                        "id=" + id +
                        "&publicado=" + publicado
                }
            );

        });

    });

}

// =======================================
//      BUSCADOR AJAX
// =======================================

const buscador =
    document.getElementById(
        "busquedaNoticias"
    );

const resultados =
    document.getElementById(
        "resultadosBusqueda"
    );

if(buscador){

    buscador.addEventListener(
        "input",
        () => {

            const texto =
                buscador.value;

            if(texto.length < 2){

                resultados.innerHTML = "";

                return;

            }

            fetch(

                "buscar_noticias_ajax.php?q=" +

                encodeURIComponent(texto)

            )

            .then(
                response => response.json()
            )

            .then(datos => {

                resultados.innerHTML = "";

                datos.forEach(noticia => {

                    const enlace =
                        document.createElement("a");

                    enlace.href =
                        "noticia.php?id=" +
                        noticia.id;

                    enlace.textContent =
                        noticia.titulo;

                    resultados.appendChild(
                        enlace
                    );

                });

            });

        }
    );

}



// =======================================
//      BUSCADOR GESTOR AJAX
// =======================================


// Escuchar escritura
const tituloInput =
    document.getElementById(
        "tituloBusqueda"
    );

const descripcionInput =
    document.getElementById(
        "descripcionBusqueda"
    );

// Ejecutar al escribir

if(
    tituloInput &&
    descripcionInput
){

    function buscarNoticiasGestion(){

        const titulo =
            tituloInput.value;

        const descripcion =
            descripcionInput.value;

        fetch(

            "buscar_noticias_gestion_ajax.php" +

            "?titulo=" +

            encodeURIComponent(titulo)

            +

            "&descripcion=" +

            encodeURIComponent(descripcion)

        )

        .then(
            response => response.text()
        )

        .then(html => {

            document.getElementById(
                "resultadosNoticias"
            ).innerHTML = html;

            activarCheckboxesPublicado();

        });

    }

    tituloInput.addEventListener(
        "input",
        buscarNoticiasGestion
    );

    descripcionInput.addEventListener(
        "input",
        buscarNoticiasGestion
    );

}