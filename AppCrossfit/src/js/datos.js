document.addEventListener('DOMContentLoaded', function() {
    iniciarAppCrossfit();
});

function iniciarAppCrossfit() {

    CambiarContenedor();
    //Marcar en blanco donde te encuentras
    marcarTabsActual ();

    consultaAPISuscripcion();

    consultaAPIListaReservas();

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
async function consultaAPISuscripcion() {

    try {
        
        const url = '/AppCrossfit/api/suscripcion';
        const resultado = await fetch(url);
        const cupones = await resultado.json();
        
        mostrarCupon(cupones);
        
    } catch (error) {
        
        console.log(error);
    }
}

function mostrarCupon(cupones) {
    
    const {creditos_utilizados, creditos_disponibles, fecha_finalizacion, fecha_suscripcion} = cupones;
    
    const p_utilizados = document.getElementById('valor-utilizados');
    p_utilizados.textContent += creditos_utilizados;

    const p_disponibles = document.getElementById('valor-disponibles');
    p_disponibles.textContent += creditos_disponibles;

    const p_periodo = document.getElementById('valor-periodo');
    p_periodo.textContent += fecha_suscripcion + " - " + fecha_finalizacion;

    const p_finalizacion = document.getElementById('valor-caducidad');
    p_finalizacion.textContent += fecha_finalizacion;
    
};

async function consultaAPIListaReservas() {

    try {
        
        const url = '/AppCrossfit/api/lista-reservas';
        const resultado = await fetch(url);
        const reservas = await resultado.json();
        
        mostrarListaReservas(reservas);
        
    } catch (error) {
        
        console.log(error);
    }
}

function mostrarListaReservas(reservas) {
    
    if(reservas.length == 0) {
        const sin_reserva = document.createElement('p');
        sin_reserva.innerHTML = "Actualmente no tiene Reservas";
        sin_reserva.className = 'p-sin-reserva';
        const lista_reservas = document.querySelector('#lista-reservas');
        if(lista_reservas) {
            lista_reservas.append(sin_reserva);
        }
    }

    let contador = 1;

    reservas.forEach(reserva => {
        const {id_clase, fecha_actividad, hora, tipo} = reserva;

        const divboton = document.createElement('div');
        divboton.className = 'boton-eliminar';

        // const form = document.createElement('form');
        // form.className = 'form-eliminar';
        // form.action = "/AppCrossfit/dashboard-misdatos";
        // form.method = "POST";

        const boton = document.createElement('input');
        boton.value = "X";
        boton.id = id_clase;
        boton.type = "submit";
        boton.className = fecha_actividad;
        boton.addEventListener('click', eliminarReserva);

        // form.append(boton);

        const fecha_reserva = document.createElement('p');
        let partes_fecha = fecha_actividad.split('-');
        fecha_reserva.innerHTML = "<span>Fecha Actividad: </span>" + partes_fecha[2] + '-' + partes_fecha[1] + '-' + partes_fecha[0];

        const hora_reserva = document.createElement('p');
        hora_reserva.innerHTML = "<span>Hora Actividad: </span>" + hora;

        const tipo_reserva = document.createElement('p');
        tipo_reserva.innerHTML = "<span>Tipo Actividad: </span>" + tipo;

        const titulo_reserva = document.createElement('h4');
        titulo_reserva.textContent = "Reserva " + contador;

        const reservaDiv = document.createElement('div');
        reservaDiv.className = 'texto-reservas';

        divboton.append(titulo_reserva);
        divboton.append(boton);

        // reservaDiv.append(titulo_reserva);
        reservaDiv.append(fecha_reserva);
        reservaDiv.append(hora_reserva);
        reservaDiv.append(tipo_reserva);
        
        
        const lista_reservas = document.querySelector('#lista-reservas');
        if(lista_reservas) {
            lista_reservas.append(divboton)
            lista_reservas.append(reservaDiv)
        }
        contador++;
    })
}

function eliminarReserva(e) {

    // Mostrar la pregunta de confirmación personalizada con SweetAlert2
    Swal.fire({
        title: '¿Desea cancelar la reserva?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            
            const boton = e.target;
            const id_clase = boton.id;
            const fecha_actividad = boton.classList.toString();

            const form = document.createElement('form');
            form.action = "/AppCrossfit/dashboard-misdatos";
            form.method = "POST";

            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = "id_clase";
            inputId.value = id_clase;

            const inputFecha = document.createElement('input');
            inputFecha.type = 'hidden';
            inputFecha.name = "fecha_actividad";
            inputFecha.value = fecha_actividad;

            form.appendChild(inputId);
            form.appendChild(inputFecha);

            document.body.appendChild(form); // Agrega el formulario al DOM
            console.log(form);
            form.submit(); // Envía el formulario

            document.body.removeChild(form);
        }
    });

}

// async function eliminarReserva() {
//     try {
//         const fecha_actividad = this.classList.toString();
//         const id_clase = this.id;

//         console.log(fecha_actividad);
//         console.log(id_clase);
        
//         const datos = { 
//             fecha: fecha_actividad,
//             id_clase: id_clase,
//         };

//         const url = '/AppCrossfit/api/lista-reservas';
//         const opciones = {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(datos)
//         };
        
//         const resultado = await fetch(url, opciones);
//         const reservas = await resultado.json();
        
//         mostrarListaReservas(reservas);
//     } catch (error) {
//         console.log(error);
//     }
// }

// Verificar periódicamente si el div existe y ejecutar la función cuando se cumpla la condición
var verificarDivInterval = setInterval(function() {
    var miDiv = document.getElementById("alert");
    if (miDiv) {
        clearInterval(verificarDivInterval);
        quitarAlerta();
    }
}, 1000);

// Funcion inactividad

// var inactivityTimeout = setTimeout(function() {
//     // Realizar una petición al servidor para cerrar la sesión
//     window.location.href = 'cerrar_sesion.php';
// }, 15 * 60 * 1000); // 15 minutos en milisegundos

// // Reiniciar el temporizador cada vez que haya una interacción del usuario
// document.addEventListener('mousemove', function() {
//     clearTimeout(inactivityTimeout);
//     inactivityTimeout = setTimeout(function() {
//         // Realizar una petición al servidor para cerrar la sesión
//         window.location.href = 'cerrar_sesion.php';
//     }, 15 * 60 * 1000); // 15 minutos en milisegundos
// });

