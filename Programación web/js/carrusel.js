const slides = document.querySelectorAll('.slide');

const botonAnterior = document.getElementById('anterior');
const botonSiguiente = document.getElementById('siguiente');

let slideActual = 0;

function mostrarSlide(indice) {

    slides.forEach(slide => {
        slide.classList.remove('activo');
    });

    slides[indice].classList.add('activo');
}

// Siguiente
botonSiguiente.addEventListener('click', function () {

    slideActual++;

    if (slideActual >= slides.length) {
        slideActual = 0;
    }

    mostrarSlide(slideActual);
});

// Anterior
botonAnterior.addEventListener('click', function () {

    slideActual--;

    if (slideActual < 0) {
        slideActual = slides.length - 1;
    }

    mostrarSlide(slideActual);
});

// Estado inicial
mostrarSlide(slideActual);
