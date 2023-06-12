let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

let suscripcion = {
    nombre: "",
    email: "",
    telefono: '',
    tarifa: []
};


document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    
    //Cambiar el contendor para el dashboard
    CambiarContenedor();
    //Muestra y Oculta las secciones
    mostrarSeccion();
    //Cambia la seccion cuando se presionen los tabs
    tabs();
    //Agrega o quita los botones del navegador
    botonesPaginador();
    //Funcionalidad a los botones del paginador
    paginaSiguiente();

    paginaAnterior();
    //Consulta API en backend
    consultaAPI();
    //Quitar alerta los 5 segundos
    quitarAlerta();
    //Enviar datos BD y PayPal
    botonCompra();
    //Muestra el Resumen final de tu tarifa y datos
    mostrarResumen();
}

function CambiarContenedor() {

    try {
        var contenedor = document.querySelector(".contenedor-app2");

        if (contenedor !== null) {
            contenedor.classList.remove("contenedor-app2");
            contenedor.classList.add("contenedor-app");
        }
    } catch (error) {
        console.error("Error al cambiar el contenedor:", error);
    }
    
};  

function mostrarSeccion() {

    //Ocultar la seccion con la clase mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    
    if(seccionAnterior) {
        
        seccionAnterior.classList.remove('mostrar');
    }
    //Seleccionar la seccion con el paso...
    const pasoSelect = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelect);
    
    if(seccion) {
        
        seccion.classList.add('mostrar');
    }
    //Quitar la clase actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }
    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    if (tab) {
        tab.classList.add('actual');
    }
    
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton=>{
        boton.addEventListener('click', function(e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPaginador();

           

        });

    });
};

function botonesPaginador() {

    const paginaAnterior = document.getElementById('anterior');
    const paginaSiguiente = document.getElementById('siguiente');
    
    if(paginaAnterior || paginaSiguiente) {

        if(paso === 1) {
            paginaAnterior.classList.add('ocultar');
            paginaSiguiente.classList.remove('ocultar');
            
            
        }
        else if (paso === 3) {
            paginaAnterior.classList.remove('ocultar');
            paginaSiguiente.classList.add('ocultar');
            mostrarResumen();
            
            
        }
        else {
            paginaAnterior.classList.remove('ocultar');
            paginaSiguiente.classList.remove('ocultar');
            
        }
    }
    mostrarSeccion();

   
    
}

function paginaAnterior() {
    const paginaAnterior = document.getElementById('anterior');
    if(paginaAnterior) {
        paginaAnterior.addEventListener('click', function(){
            
            if(paso <= pasoInicial) return;
            
            paso--;

            botonesPaginador();
        })
    }
}

function paginaSiguiente() {
    const paginaSiguiente = document.getElementById('siguiente');
    if(paginaSiguiente) {

        paginaSiguiente.addEventListener('click', function(){
            
            if(paso >= pasoFinal) return;
            
            paso++;

            botonesPaginador();
        })
    }
}

async function consultaAPI() {

    
    try {
        
        const url = '/AppCrossfit/api/servicios';
        const resultado = await fetch(url);
        const tarifas = await resultado.json();
        
        mostrarTarifas(tarifas);
        
    } catch (error) {
        
        console.log(error);
    }
}

function mostrarTarifas(tarifas) {

    tarifas.forEach(servicio => {
        const {id_bono, precio, nombre} = servicio;
        
        const nombreServicio = document.createElement('p');
        nombreServicio.classList.add('nombre-servicio')
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('p');
        precioServicio.classList.add('precio-servicio')
        precioServicio.textContent = `${precio} €`;

        const servicioDiv = document.createElement('div');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id_bono;
        servicioDiv.onclick = function () {
            seleccionarTarifa(servicio);
        }

        servicioDiv.append(nombreServicio);
        servicioDiv.append(precioServicio);
        

        tarifas = document.querySelector('#servicios');
        if(tarifas) {
            tarifas.append(servicioDiv)
        }
        
    })
}

function seleccionarTarifa(tarifa) {
    
    
    const { id_bono, nombre, precio} = tarifa;

    suscripcion.tarifa = [id_bono, nombre, precio];

    const divsTarifas = document.querySelectorAll('.servicio');
    divsTarifas.forEach(function(div) {
        div.classList.remove('seleccionado');
    });

    const divTarifa = document.querySelector(`[data-id-servicio="${id_bono}"]`);
    
    divTarifa.classList.add('seleccionado');

}

function quitarAlerta() {

      // Obtener todos los elementos con la clase "alerta"
  const divsAlerta = document.querySelectorAll('.alerta');

  // Verificar si existen elementos con la clase "alerta"
  if (divsAlerta.length > 0) {
    // Para que desaparezcan a los 5 segundos
    setTimeout(() => {
      divsAlerta.forEach(function(alerta) {
        alerta.remove();
      });
    }, 5000);
  }
    
}



function envioDatosCompra () {
    
    // Obtener el formulario
    const form = document.querySelector('#formularioPayPal');
    
    // Asignar valores a campos ocultos
    for (var key in suscripcion) {
        if (suscripcion.hasOwnProperty(key)) {
          var input = document.createElement('input');
          input.type = 'hidden';
          input.name = key;
          input.value = suscripcion[key];
          form.appendChild(input);
        }
      }
    
    form.submit();
    
}

function botonCompra() {
    const botonCompra = document.getElementById('compra');
    if(botonCompra) {
        botonCompra.addEventListener('click', function() {
            envioDatosCompra();
        });
    }
    
}

function mostrarResumen() {
    const resumen = document.querySelector(".contenido-resumen");
    
    if(resumen) {

        if (document.querySelector('#telefono')){

            const tel = document.querySelector('#telefono').value;
            const nom = document.querySelector('#nombre').value;
            const correo = document.querySelector('#email').value;
            suscripcion.telefono = tel
            suscripcion.nombre = nom
            suscripcion.email = correo
            if(Object.values(suscripcion).includes("") || suscripcion.tarifa.length == 0) {
                
                const div = document.querySelector('.compra');
                if(div) {
                    div.style.display = "none";
                }
                if (Object.values(suscripcion).includes("") && suscripcion.tarifa.length != 0) {
                    mostrarAlerta("Introduzca su teléfono para realizar la compra", 'error', '.contenido-resumen', false);
                }
                else if (Object.values(suscripcion).includes("") && suscripcion.tarifa.length == 0) {
                    mostrarAlerta("Seleccione tarifa e introduca su teléfono", 'error', '.contenido-resumen', false);
                }
                else {
                    mostrarAlerta("Seleccione una tarifa para realizar la compra", 'error', '.contenido-resumen', false);
                }
                return;
            }

            const patron = /^[67]\d{8}$/;
            if(!patron.test(suscripcion.telefono)) {
                mostrarAlerta("Debe tener 9 digitos y comenzar por 6, 7 o 9", 'error', '.contenido-resumen', false);
                return;
            }
            
            const div = document.querySelector('.compra');
            if(div) {
                div.style.display = "flex";
            }

            const divInfo = document.querySelector(".info-resumen");
            if(divInfo) {
                divInfo.remove();
            }

            // resumen.innerHTML ="";
            mostrarAlerta("Datos completados, puede realizar la compra", 'exito', '.contenido-resumen');

            const divInfo2 = document.createElement('div');
            divInfo2.className = "info-resumen";

            const nombre = document.createElement('p');
            nombre.innerHTML = `<span>Nombre: </span>${suscripcion.nombre}`;

            const email = document.createElement('p');
            email.innerHTML = `<span>Email: </span>${suscripcion.email}`;

            const telefono = document.createElement('p');
            telefono.innerHTML = `<span>Teléfono: </span>${suscripcion.telefono}`;

            const bono = document.createElement('p');
            bono.innerHTML = `<span>Tarifa: </span>${suscripcion.tarifa[1]}`;

            const precio = document.createElement('p');
            precio.innerHTML = `<span>Precio: </span>${suscripcion.tarifa[2]} €`;

            divInfo2.append(nombre, email, telefono, bono, precio);
            resumen.appendChild(divInfo2);
        }   
        
    }
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
    
    const alertaPrevia = document.querySelector('.alerta');
    
    if(alertaPrevia && paso == 3) {
        
        alertaPrevia.remove();
    };

    const DivPrevio = document.querySelector('.info-resumen');
    if(DivPrevio) {
        DivPrevio.remove();
    }

    const alerta = document.createElement('div');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const lugar = document.querySelector(elemento);
    lugar.appendChild(alerta);

    if(desaparece) {

        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
}
