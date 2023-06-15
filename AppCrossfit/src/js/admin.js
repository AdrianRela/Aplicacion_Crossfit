var tablaSeleccionada = '';
var accionSeleccionada = '';

document.addEventListener('DOMContentLoaded', function() {
    iniciarAppCrossfit();
});

function iniciarAppCrossfit() {

    CambiarContenedor();
    //Marcar en blanco donde te encuentras
    quitarNavs();

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

function quitarNavs() {
    const navs = document.querySelector(".tabs");
    navs.style.display = "none";
    
}

function seleccionarTabla (tabla) {
    tablaSeleccionada = tabla;

    const opciones = document.querySelector(".columna1");
    opciones.style.display = "block";

    const datos = document.querySelector(".columna2");
    datos.style.display = "none";
}

function accionCRUD (accion) {

    const contenidoPrevio = document.getElementById('formulario-admin');
    
    while (contenidoPrevio.firstChild) {
        contenidoPrevio.firstChild.remove();
    }

    const contenidoPrevioInserta = document.querySelector('.form-admin-insertar');
    
    if(contenidoPrevioInserta) {
        contenidoPrevioInserta.remove();
    }
    

    accionSeleccionada = accion;

    const opciones = document.querySelector(".columna2");
    opciones.style.display = "block";

    
    if( accionSeleccionada == "consultar") {
        
        consultaAPIIDs (tablaSeleccionada);
    }
    if( accionSeleccionada == "borrar") {
        
        consultaAPIIDs (tablaSeleccionada);
    }
    if( accionSeleccionada == "actualizar") {
        
        consultaAPIIDs (tablaSeleccionada);
    }

    if( accionSeleccionada == "insertar") {
        
        consultaAPIIDs (tablaSeleccionada);
    }
}

function mostrarSelect (ids) {

    const selectElement = document.createElement('select');
    selectElement.id="select-admin";
    selectElement.name="IdConsulta";
    const option = document.createElement('option');
    option.text = "Seleccione Id";
    selectElement.appendChild(option);

    ids.forEach(id => {
        const primeraClave = Object.keys(id)[0];
        const valorId = id[primeraClave];
        if(valorId != "") {
            const option = document.createElement('option');
            option.value = valorId;
            option.text = valorId;
            selectElement.appendChild(option);
        }
        
    });

    // Agregar el elemento select al documento
    const form = document.getElementById('formulario-admin'); // Reemplaza 'container' con el ID de tu contenedor deseado
    form.appendChild(selectElement);

    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = "tabla";
    input.value = tablaSeleccionada;

    var input2 = document.createElement('input');
    input2.type = 'hidden';
    input2.name = "accion";
    input2.value = accionSeleccionada;

    form.append(input, input2);

    const boton = document.createElement('button');

    if(accionSeleccionada == "consultar"){
        boton.textContent = "Consultar";
    }
    else if(accionSeleccionada == "borrar"){
        boton.textContent = "Borrar";
    }
    else {
        boton.textContent = "Seleccionar";
    }

    boton.type = "Submit";
    boton.className = ("boton");
    form.appendChild(boton);
   
}

async function consultaAPIIDs(tablaSeleccionada) {
    
    try {
        
        const url = '/AppCrossfit/api/ids?tabla=' + tablaSeleccionada;
        const resultado = await fetch(url);
        const ids = await resultado.json();

        if(accionSeleccionada == "insertar") {
            mostrarFormInsertar(ids);
        }
        else {
            mostrarSelect(ids);
        }
        
    } catch (error) {
        
        console.log(error);
    }
};

function mostrarFormInsertar(ids) {
    
    const claves = Object.keys(ids[0]);
    // Crear el formulario
    const form = document.createElement('form');
    form.method = 'post';
    form.action = '/AppCrossfit/admin-insertar';
    form.className = 'form-admin-insertar';

    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = "tabla";
    input.value = tablaSeleccionada;
    form.appendChild(input);
    // Recorrer el array de datos
    claves.forEach((clave) => {
        // Crear el label
        const label = document.createElement('label');
        label.textContent = clave;

        // Crear el input
        const input = document.createElement('input');
        input.type = 'text';
        input.name = clave;

        // Agregar el label y el input al formulario
        form.appendChild(label);
        form.appendChild(input);
    });

    // Crear el botón de envío
    const boton = document.createElement('button');
    boton.type = 'submit';
    boton.className = 'boton';
    boton.textContent = 'Insertar';
    form.appendChild(boton);

    // Agregar el formulario al documento
    const div = document.querySelector('.derecha');
    div.appendChild(form);
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
