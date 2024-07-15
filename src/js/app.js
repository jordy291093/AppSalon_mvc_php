let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
const cita = {
  id: '',  // Para el usuraio
  nombre: '',
  fecha: '',
  hora: '',
  servicios: []
}

document.addEventListener('DOMContentLoaded', function(){
  iniciarApp();
  // password();
});

function iniciarApp() {
  mostrarSeccion(); // Mostrar la seccion paso 1
  tabs(); // Cambia la seccion cuando se presionen los tabs
  btnPaginador(); // Agrega o quita los potones del paginador
  pagSiguiente();
  paginaAnterior();

  consultarAPI(); // API.- 4  Consulta la API en el backend de PHP

  idCliente();
  nombreCliente(); // Añadir nombre del cliente a la cita
  fechaCliente(); // Añadir fecha del cliente a la cita
  horaCliente(); // Añadir hora del cliente a la cita

  mostrarResumen(); // Mostrar el resumen de la cita

}

function mostrarSeccion() {
  // Ocultar la seccion que tenga la clase de mostrar
  const seccionAnterior = document.querySelector('.mostrar');
  if(seccionAnterior) {
    seccionAnterior.classList.remove('mostrar');
  }

  // Seleccionar la seccion con el paso..
  const seccion = document.querySelector(`#paso-${paso}`);
  seccion.classList.add('mostrar');

  // Ocultar el boton actual
  const tabAnterior = document.querySelector('.actual');
  if(tabAnterior) {
    tabAnterior.classList.remove('actual');
  }

  // Resalta el boton actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add('actual');
}

function tabs() {
  const botones = document.querySelectorAll('.tabs button');
  botones.forEach(boton => {
    boton.addEventListener('click', function(e) {
      // console.log(e);
      paso = parseInt(e.target.dataset.paso);
      mostrarSeccion();
      btnPaginador();
    });
  });
}

function btnPaginador() {
  const paginaAnt = document.querySelector('#anterior');
  const paginaSig = document.querySelector('#siguiente');

  if(paso === 1) {
    paginaAnt.classList.add('ocultar');
    paginaSig.classList.remove('ocultar');
  } else if(paso === 3) {
    paginaAnt.classList.remove('ocultar');
    paginaSig.classList.add('ocultar');

    mostrarResumen();
  } else {
    paginaAnt.classList.remove('ocultar');
    paginaSig.classList.remove('ocultar');
  }

  mostrarSeccion();
}

function paginaAnterior(){
  const paginaAnt = document.querySelector('#anterior');
  paginaAnt.addEventListener('click', function(){
    if(paso <= pasoInicial) return;

    paso--;
    btnPaginador();
  });
}

function pagSiguiente(){
  const paginaSig = document.querySelector('#siguiente');
  paginaSig.addEventListener('click', function(){
    if(paso >= pasoFinal) return;

    paso++;
    btnPaginador();
  });
}

async function consultarAPI() { // API.- 4
  try {
    const url = `${location.origin}/api/servicios`;
    const resultado = await fetch(url);
    const servicios = await resultado.json();
    mostrarServicios(servicios);

  } catch (error) {
    console.log(error);
  }
}

function mostrarServicios(servicios) { // API.- 5
  servicios.forEach(servicio => {
    const {id, nombre, precio} = servicio;

    const nombreServicio = document.createElement('P');
    nombreServicio.classList.add('nombre-servicio');
    nombreServicio.textContent = nombre;

    const precioServicio = document.createElement('P');
    precioServicio.classList.add('precio-servicio');
    precioServicio.textContent = `$${precio}`;

    // cuando de clic al servicio
    const servicioDiv = document.createElement('DIV');
    servicioDiv.classList.add('servicio');
    servicioDiv.dataset.idServicio = id;
    servicioDiv.onclick = function() {
      seleccionarServicio(servicio);
    }

    // Unir al div
    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);

    document.querySelector('#servicios').appendChild(servicioDiv);
  });
}

function seleccionarServicio(servicio) {
  const {id} = servicio;
  const {servicios} = cita;

  // Identificar el elemento que se le da click
  const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

  // Comprobar si un servicio y fue agregado
  if(servicios.some(agregado => agregado.id === id)) {
    // Eliminar
    cita.servicios = servicios.filter(agregado => agregado.id !== id);
    divServicio.classList.remove('seleccionado');
  } else {
    // Agregar
    cita.servicios = [...servicios, servicio]; // ... = copiar
    divServicio.classList.add('seleccionado');
  }

  // console.log(cita);
}

function idCliente() {
  cita.id = document.querySelector('#id').value;
}

function nombreCliente() {
  cita.nombre = document.querySelector('#nombre').value;
}

function fechaCliente() {
  const inputFecha = document.querySelector('#fecha');
  inputFecha.addEventListener('input', function(e) {

    const dia = new Date(e.target.value).getUTCDay(); // Seleccionar el dia que no esta abierto
    if ([6, 0].includes(dia)) {
      e.target.value = '';

      mostrarAlerta('Sabádos y Domingos no abrimos, favor de elegir una fecha de Lunes a Viernes', 'error', '.formulario');

    } else {
      cita.fecha = e.target.value;
    }

  });
}

function horaCliente() {
  const inputHora = document.querySelector('#hora');
  inputHora.addEventListener('input', function(e) {
    const horaCita = e.target.value;
    const hora = horaCita.split(":")[0];

    if (hora < 10 || hora > 18) {
      e.target.value = '';

      mostrarAlerta('Fuera de horario, favor de seleccionar entre un horario de 10am a 6pm.', 'error', '.formulario');
    } else {
      cita.hora = e.target.value;
    }
  });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
  // Previene que genere mas de una alerta
  const alertaPrevia = document.querySelector('.alerta');
  if (alertaPrevia) {
    alertaPrevia.remove();
  }

  const alerta = document.createElement('DIV');
  alerta.textContent = mensaje;
  alerta.classList.add('alerta');
  alerta.classList.add(tipo);

  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);

  if (desaparece) {
    setTimeout(() => {
      alerta.remove();
    }, 4000);
  }
}

function mostrarResumen() {
  const resumen = document.querySelector('.contenido-resumen');

  // Limpiar el contenido de resumen
  while (resumen.firstChild) {
    resumen.removeChild(resumen.firstChild);
  }

  if (Object.values(cita).includes('') || cita.servicios.length === 0) {
    mostrarAlerta('Falta seleccionar fecha/hora ó servicios', 'error', '.contenido-resumen', false)

    return;
  }

  // Heading para cita resumen
  const headingCita = document.createElement('H2');
  headingCita.textContent = 'Resumen de tu cita:';
  resumen.appendChild(headingCita);

  // Despues de que esta bien llenado
  const {nombre, fecha, hora, servicios} = cita;

  const resumenNombre = document.createElement('P');
  resumenNombre.innerHTML = `<span>Nombre: </span> <br>${nombre}`;

  // Formatear la fecha
  const fechaObj = new Date(fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2;
  const year = fechaObj.getFullYear();

  const fechaUTC = new Date(Date.UTC(year, mes, dia));

  const opcion = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
  const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opcion);

  const resumenFecha = document.createElement('P');
  resumenFecha.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`;

  const resumenHora = document.createElement('P');
  resumenHora.innerHTML = `<span>Hora: </span> ${hora}`;
  
  resumen.appendChild(resumenNombre);
  resumen.appendChild(resumenFecha);
  resumen.appendChild(resumenHora);

  // Heading para servicio resumen
  const headingServicio = document.createElement('H2');
  headingServicio.textContent = 'Resumen de tu servicio:';
  resumen.appendChild(headingServicio);

  servicios.forEach(servicio => {
    const {id, nombre, precio} = servicio;

    const resumenServicio = document.createElement('DIV');
    resumenServicio.classList.add('contenedor-servicio');
    
    const textoServicio = document.createElement('P');
    textoServicio.textContent = servicio.nombre;
    
    const precioServicio = document.createElement('P');
    precioServicio.innerHTML = `<span>Precio: </span> $${precio}`;

    resumenServicio.appendChild(textoServicio);
    resumenServicio.appendChild(precioServicio);

    resumen.appendChild(resumenServicio);
  });

  // Boton para crear una cita
  const btnReservar = document.createElement('BUTTON');
  btnReservar.classList.add('boton', 'btn-azul');
  btnReservar.textContent = 'Reservar Cita';
  btnReservar.onclick = reservarCita;

  resumen.appendChild(btnReservar);
}

 async function reservarCita () {
  const {nombre, fecha, hora, servicios, id} = cita;

  const idServicios = servicios.map(servicio => servicio.id);
  // console.log(idServicios);

  const datos = new FormData(); // Fetch (Ajax).- 3
  datos.append('usuarios_id', id);
  datos.append('nombre', nombre);
  datos.append('fecha', fecha);
  datos.append('hora', hora);
  datos.append('servicios', idServicios);

  // console.log([...datos]);

  try {
    // Peticion hacia la api
    const url = `${location.origin}/api/citas`;
    const respuesta = await fetch(url, {
      method: 'POST',
      body: datos
    });

    const resultado = await respuesta.json();
    console.log(resultado.resultado);

    if(resultado.resultado) {
      Swal.fire({           // API de alertas
        icon: "success",
        title: "Cita creada",
        text: "Cita agendada exitosamente!",
        button: "OK"
      }).then(() => {
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      })
    }
  } catch (error) {
    Swal.fire({           // API de alertas
      icon: "error",
      title: "Error",
      text: "Hubo un error al guardar la cita",
      button: "OK"
    }).then(() => {
      setTimeout(() => {
        window.location.reload();
      }, 2000);
    })
  }
}