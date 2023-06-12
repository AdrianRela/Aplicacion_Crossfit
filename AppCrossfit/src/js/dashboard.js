var celdaSeleccionada = null;
var contSemanasPost = 7
var contSemanasAnt = 7;
let thId = "";

document.addEventListener('DOMContentLoaded', function() {
    
    iniciarAppCrossfit();
});

function iniciarAppCrossfit() {

    CambiarContenedor();
    //Marcar en blanco donde te encuentras
    marcarTabsActual ();

    consultaAPIHorarios();

    botonReserva();

    diaActual(CalculaInicioSemana());
    
    quitarAlerta();

    consultaAPIReservas(CalculaInicioSemana());
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
};

async function consultaAPIHorarios() {
    
    try {
        
        const url = '/AppCrossfit/api/horarios';
        const resultado = await fetch(url);
        const horarios = await resultado.json();
        
        mostrarHorarios(horarios);
        
    } catch (error) {
        
        console.log(error);
    }
};

function mostrarHorarios(horarios) {
    // Obtener la tabla existente por su ID
    var table = document.querySelector('#horarios');
    // Variable auxiliar para evitar la repetición de horas
    var horasInsertadas = [];
    // Recorrer los horarios y agregar las horas únicas a la lista
    for (var i = 0; i < horarios.length; i++) {
        var horario = horarios[i];

        if (!horasInsertadas.includes(horario.Hora)) {
            horasInsertadas.push(horario.Hora);
        }
    }
    // Ordenar las horas de forma ascendente
    horasInsertadas.sort();
    // Recorrer las horas ordenadas y crear las filas correspondientes en la tabla
    for (var i = 0; i < horasInsertadas.length; i++) {
        var hora = horasInsertadas[i];
        // Crear una nueva fila en la tabla
        var row = table.insertRow();
        // Crear una celda para la hora
        var hourCell = row.insertCell();
        hourCell.textContent = hora;
        // Recorrer los días y crear celdas correspondientes
        var dias = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO'];
        for (var j = 0; j < dias.length; j++) {
            var dia = dias[j];
            // Crear una celda para el día
            var dayCell = row.insertCell();
            // Buscar una clase que coincida con la hora y el día actual en el objeto de horarios
            var matchingClass = horarios.filter(function(item) {
                return item.Hora === hora && item.Dia.toUpperCase() == dia;
            });
            // Si se encuentra una clase, establecer el nombre en la celda correspondiente
            if (matchingClass.length > 0) {

                if(matchingClass.length > 1) {
                    
                    var div1 = document.createElement('div');
                    var div2 = document.createElement('div');

                    div1.textContent = matchingClass[0].nombre;
                    div1.className = matchingClass[0].nombre;
                    div1.id = "id-" + matchingClass[0].id_clase;
                    div2.textContent = matchingClass[1].nombre; 
                    div2.className = matchingClass[1].nombre;
                    div2.id = "id-" + matchingClass[1].id_clase;
                    div1.setAttribute("onclick", "seleccionarCelda(this)");
                    div2.setAttribute("onclick", "seleccionarCelda(this)");
                    dayCell.appendChild(div1);
                    dayCell.appendChild(div2);
                }
                else{
                    var div1 = document.createElement('div');
                    div1.className = matchingClass[0].nombre;
                    div1.textContent = matchingClass[0].nombre;
                    div1.id = "id-" + matchingClass[0].id_clase;
                    div1.setAttribute("onclick", "seleccionarCelda(this)");
                    dayCell.appendChild(div1);
                    dayCell.className = "unContenido";
                }
            }
        }
    }
}

function seleccionarCelda(celda) {
    
    if (celda.classList.contains('seleccionada')) {
        celda.classList.remove('seleccionada');
        return;
    }
    
    if (celda.textContent !== "") {
        if (celdaSeleccionada) {
            celdaSeleccionada.classList.remove('seleccionada');
            
        }
        celdaSeleccionada = celda;
        celdaSeleccionada.classList.add('seleccionada');
        // Obtener el índice de columna al recorrer los elementos <td> hermanos
        // Obtener la celda padre <td>
        const td = celda.parentElement;
        const columna = Array.from(td.parentNode.children).indexOf(td);
        // Obtener la tabla a la que pertenece la celda
        const table = celda.closest('table');
        // Obtener el <th> correspondiente al índice de columna
        const thMasCercano = table.querySelector('tr:first-child th:nth-child(' + (columna + 1) + ')');
        if (thMasCercano) {
            thId = thMasCercano.id;
            // console.log('ID del <th> más cercano:', thId);
        } 
        else {
            // console.log('No se pudo encontrar el <th> correspondiente.');
        }
    } 
}

function enviarReservaClase () {
    // Obtener el formulario
    const form = document.querySelector('.boton-reservar');
    // // Asignar valores a campos ocultos
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = "id_clase";
    if(celdaSeleccionada == null) {
        input.value = "";
    }
    else{
        input.value = celdaSeleccionada.id;
    }
    var input2 = document.createElement('input');
    input2.type = 'hidden';
    input2.name = "fecha_actividad";
    input2.value = thId;
    form.append(input, input2);

    form.submit();
}

function botonReserva() {
    const botonReserva = document.getElementById('reserva');
    if(botonReserva) {
        botonReserva.addEventListener('click', function() {
            enviarReservaClase();
        });
    }
    
}

function diaActual(inicioSemana) {

    var fechaActual = new Date();

    var diaActual = fechaActual.getDate().toString().padStart(2, '0');
    var mesActual = (fechaActual.getMonth() + 1).toString().padStart(2, '0'); // Los meses en JavaScript son base 0, se suma 1
    var anioActual = fechaActual.getFullYear();

    var fechaFormateadaActual = diaActual + '/' + mesActual + '/' + anioActual;

    var opcionesFecha = { weekday: 'long' };
    // Obtener la tabla por su ID
    var tabla = document.getElementById('horarios');

    if(tabla) {

        // Obtener los elementos th de la tabla
        var elementosTH = tabla.querySelectorAll('th');
        // Recorrer los elementos th
        let contador = 0;
        
        elementosTH.forEach(function(elemento) {
            if(elementosTH[contador].textContent != "#") {

                var nombreDia = inicioSemana.toLocaleDateString(undefined, opcionesFecha).toLocaleLowerCase().toUpperCase();

                var dia = inicioSemana.getDate().toString().padStart(2, '0');
                var mes = (inicioSemana.getMonth() + 1).toString().padStart(2, '0'); // Los meses en JavaScript son base 0, se suma 1
                var anio = inicioSemana.getFullYear();

                // Formatear la fecha en "dd/mm/yyyy"
                var fechaFormateada = dia + '/' + mes + '/' + anio;
                elementosTH[contador].textContent = "";
                
                var div1 = document.createElement('div');
                var div2 = document.createElement('div');

                div1.textContent = nombreDia;
                div2.textContent = fechaFormateada
                
                elementosTH[contador].appendChild(div1);
                elementosTH[contador].appendChild(div2);

                elementosTH[contador].id = fechaFormateada;
                
                if (fechaFormateada == fechaFormateadaActual) {

                    elementosTH[contador].setAttribute("class", "diaActual");
                    
                }
                inicioSemana.setDate(inicioSemana.getDate() + 1);
            }
            contador++;
        });
    }
}

function CalculaInicioSemana() {
    
    var fechaActual = new Date();
    var diaSemana = fechaActual.getDay();
    // Restar días dependiendo del día de la semana actual
    if (diaSemana !== 1) {
        fechaActual.setDate(fechaActual.getDate() - (diaSemana - 1));
    }
    return fechaActual;
}

function siguienteSemana() {

    let fechanueva = CalculaInicioSemana();
    fechanueva.setDate(fechanueva.getDate() + contSemanasPost);
    let copiaFechaNueva = new Date(fechanueva.getTime());
    diaActual(copiaFechaNueva);
    consultaAPIReservas(fechanueva);
    console.log("entra");
    
    contSemanasPost += 7;
    contSemanasAnt -= 7;
    if (contSemanasPost == 14) {
        let clase = document.querySelector(".diaActual");
        clase.classList.remove("diaActual");
    }
    borrarSeleccion();
}

function anteriorSemana() {
    
    let fechanueva = CalculaInicioSemana();
    fechanueva.setDate(fechanueva.getDate() - contSemanasAnt);
    let copiaFechaNueva = new Date(fechanueva.getTime());
    diaActual(copiaFechaNueva);
    consultaAPIReservas(fechanueva);
    contSemanasAnt += 7;
    contSemanasPost -=7;
    if (contSemanasAnt == 14) {
        let clase = document.querySelector(".diaActual");
        clase.classList.remove("diaActual");
    }
    borrarSeleccion();
}

async function consultaAPIReservas(fechanueva) {
    
    try {
        
        const url = '/AppCrossfit/api/reservas';
        const resultado = await fetch(url);
        const reservas = await resultado.json();

        mostrarReservas(reservas, fechanueva)
        .then(function(contador) {
            
            actualizarContadores(contador);
        })
        .catch(function(error) {
            // Manejar el error si hay un problema al mostrar las reservas
            console.error('Error en mostrarReservas:', error);
        });
        
    } catch (error) {
        
        console.log(error);
    }
};


function mostrarReservas(reservas, fechaInicioSemana) {

    return new Promise(function(resolve, reject) {

        var contador = {};
        var fechaFinSemana = new Date(fechaInicioSemana);
        fechaFinSemana.setDate(fechaFinSemana.getDate() + 6);
        fechaFinSemana.setHours(0, 0, 0, 0);
        fechaInicioSemana.setHours(0, 0, 0, 0);
        
        // Crear un objeto contador para cada ID inicializado en 0
        for (var i = 0; i < reservas.length; i++) {
            var reserva = reservas[i];
            var id_clase = reserva.id_clase;
            contador[id_clase] = 0;
        }
    
        // Recorrer los objetos y contar las reservas por ID y día de la semana
        for (var i = 0; i < reservas.length; i++) {
            var reserva = reservas[i];
            var id_clase = reserva.id_clase;
            var fechaActividad = new Date(reserva.fecha_actividad);
            fechaActividad.setHours(0, 0, 0, 0);
            // Verificar si la fecha de actividad está dentro de la semana
            if (fechaActividad <= fechaFinSemana && fechaActividad >= fechaInicioSemana) {
                contador[id_clase]++;
            }
        }
        setTimeout(function() {
            // Una vez que hayas cargado todo en el DOM, resuelve la promesa con el contador
            resolve(contador);
        }, 2000); // Ejemplo de tiempo de espera simulado de 2 segundos
    });
}
  
function actualizarContadores(contador) {

    for (let idClase in contador) {
        
        const div = document.querySelector('#id-' + idClase);
        let valor = div.textContent;
        if(contador[idClase] > 0) {
            div.textContent = valor + " " + contador[idClase] + '/15';
        }
        else{
            div.textContent = div.className;
        }
    }
}

function borrarSeleccion() {
    // Obtener la tabla existente por su ID
    var table = document.querySelector('#horarios');
    // Obtener todos los divs dentro de las celdas de la tabla
    var divs = table.querySelectorAll('td div');
    // Recorrer todos los divs y eliminar la clase "seleccionada" si está presente
    divs.forEach(function(div) {
        if (div.classList.contains('seleccionada')) {
            div.classList.remove('seleccionada');
        }
    });
    thId = "";
    celdaSeleccionada = null;
}

function quitarAlerta() {
    //Previene generar mas de una alerta
    const alerta = document.querySelector('.alerta');

    if(alerta) {
        //Para que desaparezca a los 5 segundos
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}