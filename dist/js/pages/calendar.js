// VARIABLE
var idactividad = -1;
var dateNow = splitDateAndTime(moment().format())[0];
var timeNow = splitDateAndTime(moment().format())[1];

// Configuraciones
var configHeaderToolbar = {
  left: 'prev,next today myCustomButton',
  center: 'title',
  right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
};

<<<<<<< HEAD
var configViews = {
  listDay: {
    buttonText: 'Agenda (dias)'
  },
  listWeek: {
    buttonText: 'Agenda'
=======
  var calendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: 'boostrap',
      timeZone: 'local',
      locale: 'es',
      height: 650,
      contentHeight: 650,
      //aspectRatio: 1.5,
      businessHours: false,
      timeFormat: 'H(:mm)',
      nowIndicator: true,
      initialView: 'dayGridMonth',
      firstDay: 1,
      //initialDate: '2022-03-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true,
      eventLimit: true, 
      selectable: true,
      selectHelper: false,
      droppable: true,
      resourceAreaHeaderContent: 'Rooms',
      selectMirror: false,
      customButtons: {
          myCustomButton: {
              text: 'Agregar evento',
              click: function() {
                  limpiarFormulario()
                  $("#modal-calendar").modal('show');
              }
          }
      },
      headerToolbar: {
          left: 'prev,next today myCustomButton',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      views: {
          listDay: { buttonText: 'Agenda (dias)' },
          listWeek: { buttonText: 'Agenda' }
      },
      //Fin Evento Click
      windowResize: function(arg) {
          //alert('The calendar has adjusted to a window resize. Current view: ' + arg.view.type);
          if(screen.width <= 990){
              calendar.initialView = 'timeGridDay';
          }
      },
      eventRender: function(event, element) {
          element
              .find(".fc-content")
              .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
              $el.popover({
                  title: event.title,
                  content: event.description,
                  trigger: 'hover',
                  placement: 'top',
                  container: 'body'
              });
      },
      eventDrop: function(info){
          //alert(info.event.title + " was dropped on " + info.event.start.toISOString());

          if (!confirm("Estas seguro de modificar la agenda?")) {
              info.revert();
          }
      },
      select: function(arg) {
          arg.jsEvent.preventDefault()
      },
      eventClick: function(info) {
          info.jsEvent.preventDefault()
      
          var data = {
              "id"                : info.event.id,
              "title"             : info.event.title,
              "backgroundColor"   : info.event.backgroundColor,
              "borderColor"       : info.event.borderColor,
              "textColor"         : info.event.textColor,
              "startStr"          : info.event.startStr,
              "endStr"            : info.event.endStr,
          }

          var fecha = splitDateAndTime(data.startStr)[0]
          var hora = splitDateAndTime(data.startStr)[1]
          var hStar = splitStartAndEnd(hora)[0]
          var hEnd = splitStartAndEnd(hora)[1]

          limpiarFormulario()

          $('#title').val(data.title)
          $('#direction').val()
          $('#date').val(fecha)
          $('#time').val(hStar)
          $('#description').val()
          $('#color').val(data.backgroundColor)

          $('#modal-calendar').modal('show')

          //console.log(data)
          /* console.log(info.event)
          console.log(data) */
          
          // change the border color just for fun
          info.el.style.backgroundColor = 'rgba(0,0,0,.06)';
          info.el.style.borderColor = 'rgba(0,0,0,.06)';
          info.el.style.textColor = 'black';


          /* if (confirm('Eliminar agenda?')) {
              arg.event.remove()
          } 
          */
      },
      dayMaxEventRows: false, // for all non-TimeGrid views
      eventSources: [{
          events: [
              {
                  id: 1,
                  title: 'Nuevo evento 2022',
                  start: new Date(y, m, 1),
                  backgroundColor: "#f56954", //red
                  borderColor: "#f56954" //red
              },
              {
              title: 'Click for Google',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://google.com/',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
              },
              {
              title: 'Click for Google',
              start: '2022-03-13',
              end: '2022-03-15',
              url: '',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
              }
          ],
          /* color: 'black',
          textColor: 'white', */

      }],
      
  });

  calendar.render();
  
  //console.log("La resolución de tu pantalla es: " + screen.width + " x " + screen.height) 
  

  // fUNCIONES
  function limpiarFormulario(){
      $('#form-save-schedule')[0].reset()
      $('#title').val('')
      $('#direction').val('')
      $('#date').val('')
      $('#time').val('')
      $('#description').val('')
      $('#color').val('')
>>>>>>> 7c31b0894e71dcb5b501c6721df8bab4a55c6a60
  }
};

/* FULL CALENDAR */
var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
  headerToolbar: configHeaderToolbar,
  views: configViews,
  themeSystem: 'boostrap',
  timeZone: 'local',
  locale: 'es',
  height: 650,
  contentHeight: 650,
  initialView: 'dayGridMonth', 	// Vista inicial
  firstDay: 1,									// Primer dia	
  nowIndicator: true, 					// Hora actual
  editable: true,								// permitir arrastrar elemento
  dayMaxEvents: true,						// Limitar eventos por dia
  selectable: true,							// Permite resaltar varios días o intervalos de tiempo haciendo clic y arrastrando
  buttonIcons: true,						// habilitar los botones de navegación
  weekNumbers: false,						// Numero de la semana
  dayMaxEventRows: false, 			// En la vista dayGrid , el número máximo de niveles de eventos apilados en un día determinado.
  customButtons: {
    myCustomButton: {
      text: 'Agendar',
      click: function () {
        resetFormActivity()
        $("#modal-calendar").modal('show')
      }
    }
  },
  windowResize: function (arg) {
    // Diferentes resoluciones de pantalla
    if (window.innerWidth <= 850) {
      calendar.changeView('timeGridDay');
    } else if (window.innerWidth > 850 && window.innerWidth <= 980) {
      calendar.changeView('dayGridWeek');
    }
    else {
      calendar.changeView('dayGridMonth');
    }
  },
  eventDrop: function (info) { 				// Arrastrar evento
    // Separar fecha y hora
    let id = info.event.id;
    let dateStart = splitDateAndTime(info.event.startStr)[0];
    let timeStart = splitDateAndTime(info.event.startStr)[1];
    let dateEnd = splitDateAndTime(info.event.endStr)[0];
    let timeEnd = splitDateAndTime(info.event.endStr)[1];

    sweetAlertConfirmQuestionSave('¿Estas seguro de actualizar la fecha del evento?').then((confirm) => {
      if (confirm.isConfirmed) {
        $.ajax({
          url: 'controllers/activity.controller.php',
          type: 'GET',
          data: 'op=getAnActivity&idactividad=' + id,
          success: function (result) {
            dataController = JSON.parse(result);
            dataController['fechainicio'] = dateStart;
            dataController['fechafin'] = dateEnd;
            dataController['horainicio'] = timeStart;
            dataController['horafin'] = timeEnd;

            updateActivity(dataController);		// Actualizar en la base de datos

          }
        });
      } else {
        info.revert();
      }
    });
  },
  select: function (selectionInfo) { 	// Clic en un dia del mes
    selectionInfo.jsEvent.preventDefault();
    resetFormActivity()

    $('#date-start').val(selectionInfo.startStr)
    $('#date-end').val(addDaysToDate(selectionInfo.endStr, -1))		// Restar 1 dia (agregado por fullcalednar)
    $("#modal-calendar").modal('show')
  },
  eventClick: function (info) { 			// clic sobre el evento
    info.jsEvent.preventDefault();

    $.ajax({
      url: 'controllers/activity.controller.php',
      type: 'GET',
      data: 'op=getAnActivity&idactividad=' + info.event.id,
      success: function (result) {
        if (result == "") {
          sweetAlertError("Error encontrado", "Por favor revise los datos");
        }
        else {
          dataController = JSON.parse(result);
          idactividad = dataController.idactividad;	// Obteniendo el id

          resetFormActivity();

          // Obtener la fecha en formato string
          var dateStart = moment(dataController.fechainicio + ' ' + dataController.horainicio).format('LLLL'); // Jueves, 15 de Septiembre de 2016 0:00
          var dateEnd = moment(dataController.fechafin + ' ' + dataController.horafin).format('LLLL'); // Jueves, 15 de Septiembre de 2016 0:00

          // Asignando datos al card
          $("#title-card").html(info.event.title);
          $("#descripction-card").html(dataController.descripcion);
          $("#direction-card").html(" Ubicación: (" + dataController.direccion + ")");
          $("#date-card").html(dateStart + " - " + dateEnd);

          // asignando datos al modal
          $('#title').val(dataController.titulo);
          $('#specialty').val(dataController.idespecialidad);
          $('#direction').val(dataController.direccion);
          $('#date-start').val(dataController.fechainicio);
          $('#date-end').val(dataController.fechafin);
          $('#time-start').val(dataController.horainicio);
          $('#time-end').val(dataController.horafin);
          $('#description').val(dataController.descripcion);

          // Mostrar card
          $('#card-preview-event').css('display', 'block');
          $("#card-preview-event").draggable(); // Arrastrable
        }
      }
    }); // Fin ajax
  },
  events: function (fetchInfo, successCallback, failureCallback) {
    var dataEvents = [];

    $.ajax({
      url: 'controllers/activity.controller.php',
      type: 'GET',
      data: 'op=activitiesFilterByUser',
      success: function (result) {
        
        if(result != ""){
          let dataController = JSON.parse(result);
  
          // Recorrer los datos
          dataController.forEach((value) => {
            let colorName = dateNow > value["fechafin"] ? 'bg-danger' : 'bg-info';
  
            dataEvents.push({
              id: value["idactividad"],
              title: value["titulo"],
              start: value["fechainicio"] + " " + value["horainicio"],
              end: value["fechafin"] + " " + value["horafin"],
              className: colorName
            });
  
          });
        }

        // cargar los eventos 
        successCallback(dataEvents);
      }
    });
  }
});

// Generar calendario
calendar.render();

// Cargar especialidades
function loadSpecialty() {
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=getSpecialtyByUser',
    success: function (result) {
      $("#specialty").html(result);
    }
  });
}

// Divide fecha y hora
function splitDateAndTime(dateTimeString) {
  const regularPhrase = /\s*T\s*/;
  return dateTimeString.split(regularPhrase);
}

// Divide hora y minuto
function spliHourAndMinute(dateTimeString) {
  const regularPhrase = /\s*:\s*/;
  return dateTimeString.split(regularPhrase);
}

// Limpiar formulario
function resetFormActivity() {
  $('#form-save-schedule')[0].reset()
  $('#title').focus()
  $("#date-start").val(dateNow)
  $("#date-end").val(dateNow)
  $("#time-start").val("00:00:00")
  $("#time-end").val("01:00:00")
  $('#btn-save').show() 		// ocultar botón guardar
  $('#btn-update').hide()		// Mostrar botón edición
}

// Validar campos obligatorios
function isEmptyFields() {
  return $('#title').val() == "" || $('#specialty').val() == "" || $('#date-start').val() == "" || $('#time-start').val() == "";
}

// Validar fechas no mayor al limite
function dateEndIsNotLess() {
  let dateStart = $("#date-start").val()
  let dateEnd = $("#date-end").val()

  return dateStart < dateEnd;
}

// Obtener datos del modal
function getDataModal() {
  var data = {
    titulo: $('#title').val().trim(),
    idespecialidad: $('#specialty').val(),
    fechainicio: $('#date-start').val(),
    fechafin: $('#date-end').val(),
    horainicio: $('#time-start').val(),
    horafin: $('#time-end').val(),
    direccion: $('#direction').val().trim(),
    descripcion: $('#description').val().trim()
  };

  return data;
}

// Agregar evento al calendario
function addEventCalendar() {
  // Solo se pérmite registrar si tiene datos el formulario
  if (isEmptyFields()) {
    sweetAlertWarning("Datos incorrectos", "Por favor complete los campos obligatorios");
  }
  else {
    // Confirmar
    sweetAlertConfirmQuestionSave("¿Estas seguro de registrar la agenda?").then((confirm) => {
      if (confirm.isConfirmed) {
        var dataModal = getDataModal()

        // Registrar en la base de datos
        registerActivity(dataModal)

        // Cerrar modal
        $('#modal-calendar').modal('hide')
      }
    });
  }
}

// Registrar actividad
function registerActivity(data) {

  let dataSend = {
    op: 'registerActivity',
    titulo: data.titulo,
    idespecialidad: data.idespecialidad,
    fechainicio: data.fechainicio,
    fechafin: data.fechafin,
    horainicio: data.horainicio,
    horafin: data.horafin,
    direccion: data.direccion,
    descripcion: data.descripcion
  }

  $.ajax({
    url: 'controllers/activity.controller.php',
    type: 'GET',
    data: dataSend,
    success: function (result) {
      if (result == "")
        calendar.refetchEvents()	// Actualizar eventos del calendario				
    }
  });
}

// Actualizar evento al calendario
function updateEventCalendar() {
  // Solo se pérmite actualizar si tiene datos el formulario
  if (isEmptyFields()) {
    sweetAlertWarning("Datos incorrectos", "Por favor complete los campos obligatorios");
  }
  else {
    // Confirmar
    sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar la agenda?").then((confirm) => {
      if (confirm.isConfirmed) {
        let dataModal = getDataModal() 					// Obtener datos del modal
        dataModal["idactividad"] = idactividad 	// Agregando el ID

        // Actualizar en la base de datos
        updateActivity(dataModal)

        // Resetear id global
        idactividad = -1

        // Cerrar modal
        $('#modal-calendar').modal('hide')
      }
    });
  }
}

// Actuaslizar actividad
function updateActivity(data) {
  let dataSend = {
    op: 'updateActivity',
    idactividad: data.idactividad,
    idespecialidad: data.idespecialidad,
    fechainicio: data.fechainicio,
    fechafin: data.fechafin,
    horainicio: data.horainicio,
    horafin: data.horafin,
    titulo: data.titulo,
    direccion: data.direccion,
    descripcion: data.descripcion
  }

  $.ajax({
    url: 'controllers/activity.controller.php',
    type: 'GET',
    data: dataSend,
    success: function (result) {
      if (result == "")
        calendar.refetchEvents()	// Actualizar eventos del calendario
    }
  });
}

// Actualizar evento al calendario
function deleteEventCalendar() {
  // Confirmar
  sweetAlertConfirmQuestionDelete("¿Estas seguro de eliminar la agenda?").then((confirm) => {
    if (confirm.isConfirmed) {
      // Eliminar en la base de datos
      deleteActivity(idactividad)

      // Resetear id global
      idactividad = -1

      // Cerrar modal
      $('#modal-calendar').modal('hide')
    }
  });
}

// Eliminar actividad
function deleteActivity(idactividad) {

  $.ajax({
    url: 'controllers/activity.controller.php',
    type: 'GET',
    data: 'op=deleteActivity&idactividad=' + idactividad,
    success: function (result) {
      if (result == "")
        calendar.refetchEvents()	// Actualizar eventos del calendario					
    }
  });
}

// Guargar evento
$('#btn-save').click(function () {
  addEventCalendar()
})

// Actualizar evento
$('#btn-update').click(function () {
  updateEventCalendar()
})

// Eliminar evento
$("#btn-delete-event").click(function () {
  deleteEventCalendar()
  $("#btn-close-card").click()
})

// Abrir modal para editar evento
$("#btn-edit-event").click(function () {
  $('#card-preview-event').css('display', 'none')
  $('#btn-save').hide() 		// ocultar botón guardar
  $('#btn-update').show()		// Mostrar botón edición
  $('#modal-calendar').modal('show');
});

// Cerrar card
$("#btn-close-card").click(function () {
  $('#card-preview-event').css('display', 'none');
})

// Sumar dias
function addDaysToDate(date, days) {
  var date = new Date(date + "T00:00:00"); 					// Fecha con Zona horaria estandar
  date.setDate(date.getDate() + days);							// Sumar dias

  let year = date.getFullYear(); 										// obtener año
  let month = date.getMonth() + 1; 									// Obtener mes y sumar 1, Aumneto 1 mes, ya que los meses inician desde "0" es decir que enero seria 0 y diciembre seria 11
  let day = date.getDate() 													// obtener dia

  month = month < 10 ? '0' + month : '' + month;		// formateo a mes para que sea de 2 dígitos.
  day = day < 10 ? "0" + day : '' + day; 						// formateo a dia para que sea de 2 dígitos "01", "05", "10", etc.

  return year + "-" + month + "-" + day;
}

// Sumar horas
function addHourTime(time, hours) {
  let hour = parseInt(spliHourAndMinute(time)[0]);	// Convertir a entero 
  let minute = spliHourAndMinute(time)[1];

  let valSign = Math.sign(hours); 	// Signo de la hora obtenida

  // 1 = Positivo, -1 = Negativo
  if (valSign == 1) {
    hour += Math.abs(hours);
  } else {
    hour -= Math.abs(hours);
  }

  if (hour == -1) {
    hour = 23;
    //minute = minute == 0? 59: minute--;
  }

  hour = hour == 24 && minute >= 0 ? 0 : hour;

  let hourStr = hour < 10 ? '0' + hour.toString() : '' + hour.toString();		// formateo a hora para que sea de 2 dígitos y de tipo string.
  let minuteStr = minute.toString();																				// formateo a string

  return hourStr + ":" + minuteStr;
}

// Obtener la fecha inicial y final
function getDatesModal() {
  let dateStartModal = $("#date-start").val()
  let dateEndModal = $("#date-end").val()
  let timeStartModal = $("#time-start").val()
  let timeEndModal = $("#time-end").val()

  let dates = {
    dateStart: dateStartModal,
    dateEnd: dateEndModal,
    timeStart: timeStartModal,
    timeEnd: timeEndModal,
    dateTimeStart: dateStartModal + " " + timeStartModal,
    dateTimeEnd: dateEndModal + " " + timeEndModal
  }

  return dates;
}

// Generar fecha limite
$("#date-start").change(function () {
  let dates = getDatesModal();

  // Actualizar fecha final
  if (dates.dateStart > dates.dateEnd) {
    $("#date-end").val(dates.dateStart)
  }
  else if (dates.dateStart == dates.dateEnd && dates.timeStart > dates.timeEnd) {
    $("#time-start").val("00:00:00")
    $("#time-end").val("01:00:00")
  }
})

// Generar fecha inicio
$("#date-end").change(function () {
  let dates = getDatesModal();

  // Actualizar fecha final
  if (dates.dateStart > dates.dateEnd) {
    $("#date-start").val(dates.dateEnd)
  }
  else if (dates.dateStart == dates.dateEnd && dates.timeStart > dates.timeEnd) {
    $("#time-start").val("00:00:00")
    $("#time-end").val("01:00:00")
  }
})

// Generar hora limite
$("#time-start").change(function () {
  let dates = getDatesModal();

  if (dates.dateStart == dates.dateEnd && $("#time-end").val() <= dates.timeStart)
    $("#time-end").val(addHourTime(dates.timeStart, 1))
})

// Generar hora inicio
$("#time-end").change(function () {
  let dates = getDatesModal();

  if (dates.dateStart == dates.dateEnd && dates.timeStart >= dates.timeEnd && dates.timeStart == "00:00:00") {
    $("#date-start").val(addDaysToDate(dates.dateStart, -1)) // restar 1 dia
    $("#time-start").val("18:00:00")												 // Hora por defecto
  } else if (dates.timeStart >= dates.timeEnd) {
    $("#time-start").val(addHourTime(dates.timeEnd, -1))
  }
})

// cargar especialidades de servicios
loadSpecialty();