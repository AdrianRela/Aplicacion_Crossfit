document.addEventListener('DOMContentLoaded', function() {
    iniciarAppCrossfit();
});

function iniciarAppCrossfit() {

    CambiarContenedor();
    //Marcar en blanco donde te encuentras
    marcarTabsActual ();

    consultarAPIResultados();

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

async function consultarAPIResultados() {
    try {
        
        const url = '/AppCrossfit/api/resultados';
        const resultado = await fetch(url);
        const resultados = await resultado.json();
        
        mostrarResultados(resultados);
        
    } catch (error) {
        
        console.log(error);
    }
}

function mostrarResultados(resultados) {
    
    let opcionesAbiertas = null;
    let primerTdAbierto = null;
    
    resultados.forEach(elementores => {
        const {id_resultado, nombre, resultado, fecha, RM, opciones, id_ejercicio} = elementores;
        let arrayElementos =[nombre, resultado, fecha, RM, opciones];
        
        const tr = document.createElement('tr');
        let primerTd;
        for(let i = 0; i < arrayElementos.length; i++){
            
            
            const td = document.createElement('td');
            if(arrayElementos[i] == ""){
                
                // Crear el botón
                var boton = document.createElement('button');
                boton.id = 'opciones-btn';
                var icono = document.createElement('i');
                icono.classList.add('fas', 'fa-cog');
                boton.appendChild(icono);

                // Crear el contenedor de opciones
                var opcionesContainer = document.createElement('div');
                opcionesContainer.id = 'opciones-container';
                opcionesContainer.style.display = 'none';
    
                // Crear las opciones
                var borrarRegistroLink = document.createElement('a');
                borrarRegistroLink.href = '#';
                borrarRegistroLink.id = 'borrar-registro';
                borrarRegistroLink.className = id_resultado;
                borrarRegistroLink.textContent = 'Borrar registro';

                var insertarLink = document.createElement('a');
                insertarLink.href = '#';
                insertarLink.id = nombre;
                insertarLink.className = id_ejercicio;
                insertarLink.textContent = 'Insertar';

                var borrarTodoLink = document.createElement('a');
                borrarTodoLink.href = '#';
                borrarTodoLink.id = 'borrar-todo';
                borrarTodoLink.className = id_ejercicio;
                borrarTodoLink.textContent = 'Borrar Todo';

                // Agregar las opciones a la lista
                opcionesContainer.appendChild(borrarRegistroLink);
                opcionesContainer.appendChild(insertarLink);
                opcionesContainer.appendChild(borrarTodoLink);

                // Agregar la lista al contenedor
                td.appendChild(boton);
                td.appendChild(opcionesContainer);
                
                // Mostrar/ocultar opciones al hacer clic en el botón
                boton.addEventListener('click', function() {
                    if (opcionesContainer.style.display === 'none') {
                        // Cerrar el div de opciones abierto anteriormente
                        if (opcionesAbiertas !== null && primerTdAbierto !== null) {
                            opcionesAbiertas.style.display = 'none';
                            primerTdAbierto.style.fontWeight = 'normal';
                        }
                        opcionesContainer.style.display = 'grid';
                        primerTd.style.fontWeight = 'bold';
                        opcionesAbiertas = opcionesContainer;
                        primerTdAbierto = primerTd;
                    } 
                    else {
                        opcionesContainer.style.display = 'none';
                        primerTd.style.fontWeight = 'normal';
                        opcionesAbiertas = null;
                        primerTdAbierto = null;
                    }
                
                });

                // Manejar eventos de clic en las opciones
                borrarRegistroLink.addEventListener('click', borrarunResgistro);

                insertarLink.addEventListener('click', insertarResultado);

                borrarTodoLink.addEventListener('click', borrarTodoResultado);
            }
            else{
                // const td = document.createElement('td');
                td.textContent = arrayElementos[i];
                if (i === 0) {
                    primerTd = td
                }
            }
                tr.appendChild(td);
        }
        
        tabla = document.querySelector('.table');
        if(tabla) {
            tabla.append(tr)
        }
        
    })
};


// Verificar periódicamente si el div existe y ejecutar la función cuando se cumpla la condición
var verificarDivInterval = setInterval(function() {
    var miDiv = document.getElementById("alert");
    if (miDiv) {
        clearInterval(verificarDivInterval);
        quitarAlerta();
    }
}, 1000);

function borrarunResgistro(e) {
    // Mostrar la pregunta de confirmación personalizada con SweetAlert2
    Swal.fire({
        title: '¿Desea borrar este registro?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            
            const boton = e.target;
            const id_resultado = boton.classList.toString();

            const form = document.createElement('form');
            form.action = "/AppCrossfit/dashboard-resultados";
            form.method = "POST";

            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = "id_resultado";
            inputId.value = id_resultado;

            form.appendChild(inputId);
            
            document.body.appendChild(form); // Agrega el formulario al DOM

            form.submit(); // Envía el formulario

            document.body.removeChild(form);
        }
    });
}
function insertarResultado(e) {

    const formInsertar = document.getElementById('form-insertar');

    const computedStyle = window.getComputedStyle(formInsertar);
    const displayValue = computedStyle.getPropertyValue('display');
    
    if (displayValue !== 'none') {
        formInsertar.style.display = 'none';
        return;
    }
    formInsertar.style.display = 'block';
    const boton = e.target;
    const id_ejercicio = boton.classList.toString();

    const titulo = document.querySelector('.h2-resultado');
    titulo.textContent = "Nuevo Resultado " + boton.id;


    const form = document.querySelector('.formulario-resultado');

    const inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = "id_ejercicio";
    inputId.value = id_ejercicio;

    form.appendChild(inputId);

}
function borrarTodoResultado(e) {
    // Mostrar la pregunta de confirmación personalizada con SweetAlert2
    Swal.fire({
        title: '¿Desea borrar todos los registro?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            
            const boton = e.target;
            const id_ejercicio = boton.classList.toString();

            const form = document.createElement('form');
            form.action = "/AppCrossfit/dashboard-resultados";
            form.method = "POST";

            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = "id_ejercicio";
            inputId.value = id_ejercicio;

            form.appendChild(inputId);
            
            document.body.appendChild(form); // Agrega el formulario al DOM

            form.submit(); // Envía el formulario

            document.body.removeChild(form);
        }
    });
}