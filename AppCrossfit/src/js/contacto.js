document.addEventListener('DOMContentLoaded', function() {
    iniciarAppCrossfit();
});

function iniciarAppCrossfit() {

    CambiarContenedor();
    //Marcar en blanco donde te encuentras
    marcarTabsActual ();

};

function CambiarContenedor() {
    try {
        var contenedor = document.querySelector(".contenedor-app");

        if (contenedor !== null) {
            contenedor.classList.remove("contenedor-app");
            contenedor.classList.add("contenedor-app2");
        }
    } catch (error) {
        console.error("Error al cambiar el contenedor:", error);
    }
    
};

function marcarTabsActual () {
    // Obtener la URL actual
    const currentUrl = window.location.href;
    // Obtener todos los elementos <a> dentro del <nav>
    const navLinks = document.querySelectorAll(".tabs a");
    // Recorrer los enlaces y comparar con la URL actual
    for (let i = 0; i < navLinks.length; i++) {
        let link = navLinks[i];
        // Obtener el valor del atributo href
        let linkUrl = link.getAttribute("href");
        // Comparar con la URL actual
        if (currentUrl === linkUrl) {
            // Añadir la clase "actual" al elemento <a> correspondiente
            link.classList.add("actual");
        }
    }
}

function quitarAlerta() {

    const alerta = document.querySelector('.alerta');

    if(alerta) {
        //Para que desaparezca a los 5 segundos
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
    
}

// Verificar periódicamente si el div existe y ejecutar la función cuando se cumpla la condición
var verificarDivInterval = setInterval(function() {
    var miDiv = document.getElementById("alert");
    if (miDiv) {
        clearInterval(verificarDivInterval);
        quitarAlerta();
    }
}, 1000);
