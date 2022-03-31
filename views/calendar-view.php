
<link href='plugins/fullcalendar/main.css' rel='stylesheet' />
<link rel="stylesheet" href="dist/css/pages/calendar.css">

<script src='plugins/fullcalendar/main.js'></script>
<script src='plugins/fullcalendar/locales/es.js'></script>
<script src="dist/js/pages/calendar.js"></script>

<!-- Modal  agenda-->
<div class="modal fade" id="modal-calendar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar una actividad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="form-save-schedule">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="title">Titulo</label>
                            <input type="text" id="title" class="form-control form-control-border" placeholder="Titulo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="direction">Dirección.</label>
                            <input type="text" id="direction" class="form-control form-control-border" placeholder="Direción: ejm Av. Calle. Mz">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="date">Fecha.</label>
                            <input type="date" id="date" class="form-control form-control-border" min="2000-01-01" max="2040-12-31">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="time">Hora</label>
                            <input type="time" id="time" class="form-control form-control-border">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="description">Descripción</label>
                            <textarea id="description" cols="30" rows="3" class="form-control rounded-0" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="color">Color</label>
                            <input type="color" id="color" value="#151500" class="form-control rounded-0" style="height: 36px;"></input>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn-save" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Calendar -->
<div id='calendar'></div>


<script>
    $(document).ready(function (){
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
            height: 680,
            contentHeight: 680,
            /* aspectRatio: 1.5,
            businessHours: false, */
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
                        id: 2,
                        title: 'Click for Google 1',
                        start: new Date(y, m, 11),
                        //end: '2022-03-14',
                        url: 'http://google.com/',
                        backgroundColor: "#3c8dbc", //Primary (light-blue)
                        borderColor: "#3c8dbc" //Primary (light-blue)
                    },
                    {
                        id: 3,
                        title: 'Click for Google',
                        start: new Date(y, m, 21),
                        //end: '2022-03-13',
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
</script>

