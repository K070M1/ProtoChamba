/* Full calendar */
document.addEventListener('DOMContentLoaded', function() {

  /* FULL CALENDAR */
  var calendarEl = document.getElementById('calendar');
  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

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
              console.log("Hola")
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
  }

  function getDataModal(){
      let title = $('#title').val()
      let direction = $('#direction').val()
      let date = $('#date').val()
      let time = $('#time').val()
      let description = $('#description').val()
      let color = $('#color').val()

      var  data = {
          "title"       : title,
          "direction"   : direction,
          "date"        : date,
          "time"        : time,
          "description" : description,
          "color"       : color
      }

      return data
  }

  function splitYearMonthDay(dateString){
      const regularPhrase = /\s*-\s*/;
      var data = dateString.split(regularPhrase);
      return data
  }
  
  function splitDateAndTime(dateTimeString){
      const regularPhrase = /\s*T\s*/;
      var data = dateTimeString.split(regularPhrase);
      return data
  }

  function splitHourAndMinute(timeString){
      const regularPhrase = /\s*:\s*/;
      var data = timeString.split(regularPhrase);
      return data
  }
  
  function splitStartAndEnd(timesString){
      const regularPhrase = /\s*-\s*/;
      var data = timesString.split(regularPhrase);
      return data
  }
  
  function addEventCalendar(){

      var dataModal = getDataModal()       

      calendar.addEvent({
          //id:
          title: dataModal.title,
          start: dataModal.date.concat(' ', dataModal.time),
          backgroundColor: dataModal.color,
          borderColor: dataModal.color,
          url: "https://www.google.com"
      })

      $('#modal-calendar').modal('hide')
  }
  
  $('#btn-save').click(function(){
      //console.log(splitHourAndMinute("15:85"))
      addEventCalendar()
  })
});