<link href='plugins/fullcalendar/main.css' rel='stylesheet' />
<link rel="stylesheet" href="dist/css/pages/calendar.css">

<script src='plugins/fullcalendar/main.js'></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src='plugins/fullcalendar/locales/es.js'></script>

<!-- Calendar -->
<div class="row">
	<div class="col-md-12">
		<div class="sticky-top p-0">
			<div class="card card-primary">
				<div class="card-body p-0">
					<div id='calendar'></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal  agenda-->
<div class="modal fade" id="modal-calendar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Registro de agendas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-save-schedule" autocomplete="off">				
					<div class="row">
						<div class="form-group col-md-12">
							<label for="title">Titulo</label>
							<input type="text" id="title" class="form-control form-control-border" placeholder="Nueva agenda">
						</div>
					</div>			
					<div class="row">
						<div class="form-group col-md-12">
							<label for="specialty">Especialidades</label>
							<select id="specialty" class="custom-select form-control-border">
							</select>
						</div>
					</div>		
					<div class="row">
						<div class="col-12">
							<label for="date-start">Inicio</label>
						</div>
						<div class="form-group col-7">
							<input type="date" id="date-start" class="form-control form-control-border" min="2000-01-01" max="2040-12-31">
						</div>
						<div class="form-group col-5">
							<input type="time" id="time-start" class="form-control form-control-border">
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<label for="date-end">Finalización.</label>
						</div>
						<div class="form-group col-7">
							<input type="date" id="date-end" class="form-control form-control-border" min="2000-01-01" max="2040-12-31">
						</div>
						<div class="form-group col-5">
							<input type="time" id="time-end" class="form-control form-control-border">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="direction">Ubicación (Opcional)</label>
							<input type="text" id="direction" class="form-control form-control-border" placeholder="Direción: ejm Av. Calle. Mz">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="description">Descripción (Opcional)</label>
							<textarea id="description" cols="30" rows="3" class="form-control form-control-border rounded-0" placeholder=""></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" id="btn-update" class="btn btn-info">Actualizar</button>
				<button type="button" id="btn-save" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</div>
</div>

<!-- Card para previsualizar contenido del evento selecconado -->
<div class="card card-primary card-outline" id="card-preview-event" style="position: absolute; top: 40%; left: 35%; z-index: 1045; width: 400px; display:none; cursor: move;">
	<div class="card-body pb-0">
		<div class="row mb-2">
			<div class="col-12">
				<h5 class="card-title text-muted">Mi Agenda</h5>
				<button type="button" id="btn-close-card" class="close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<h4 id="title-card">Titulo</h4>
		<p>
			<span id="descripction-card" style="font-size: 17px;"></span> <br>
			<a href="#" class="text-dark"><i class="fas fa-map-marker-alt text-danger"></i> <span class="font-italic" id="direction-card"></span></a> <br>
			<i class="fas fa-calendar-alt text-muted"></i> <span class="text-muted" id="date-card"></span>
		</p>

		<div class="form-group">
			<button type="button" id="btn-delete-event" class="btn btn-outline-danger btn-sm">Eliminar</button>
			<button type="button" id="btn-edit-event" class="btn btn-outline-info btn-sm">Editar</button>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

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

		var configViews = {
			listDay: {
				buttonText: 'Agenda (dias)'
			},
			listWeek: {
				buttonText: 'Agenda'
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
					click: function() {
						resetFormActivity()
						$("#modal-calendar").modal('show')
					}
				}
			},			
			windowResize: function(arg) {
				// Diferentes resoluciones de pantalla
				if(window.innerWidth <= 850){
					calendar.changeView('timeGridDay');
				}	else if(window.innerWidth > 850 && window.innerWidth <= 980){
					calendar.changeView('dayGridWeek');
				}
				else{
					calendar.changeView('dayGridMonth');
				}				
			},
			eventDrop: function(info) { 				// Arrastrar evento
				// Separar fecha y hora
				let id = info.event.id;
				let dateStart = splitDateAndTime(info.event.startStr)[0];
				let timeStart = splitDateAndTime(info.event.startStr)[1];
				let dateEnd = splitDateAndTime(info.event.endStr)[0];
				let timeEnd = splitDateAndTime(info.event.endStr)[1];

				sweetAlertConfirmQuestionSave('¿Estas seguro de actualizar la fecha del evento?').then((confirm) => {
					if (confirm.isConfirmed){
						$.ajax({
							url: 'controllers/activity.controller.php',
							type: 'GET',
							data: 'op=getAnActivity&idactividad=' + id,
							success: function(result){
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
			select: function(selectionInfo ) { 	// Clic en un dia del mes
				selectionInfo.jsEvent.preventDefault(); 
				resetFormActivity()
				
				$('#date-start').val(selectionInfo.startStr)
				$('#date-end').val(addDaysToDate(selectionInfo.endStr, -1))		// Restar 1 dia (agregado por fullcalednar)
				$("#modal-calendar").modal('show')
			},
			eventClick: function(info) { 				// clic sobre el evento
				info.jsEvent.preventDefault();
				
				$.ajax({
					url: 'controllers/activity.controller.php',
					type: 'GET',
					data: 'op=getAnActivity&idactividad=' + info.event.id,
					success: function(result){
						if(result == ""){
							sweetAlertError("Error encontrado", "Por favor revise los datos");
						}
						else{
							dataController = JSON.parse(result);
							idactividad = dataController.idactividad;	// Obteniendo el id

							resetFormActivity();

							// Obtener la fecha en formato string
							var dateStart = moment(dataController.fechainicio + ' ' + dataController.horainicio).format('LLLL') // Jueves, 15 de Septiembre de 2016 0:00
							var dateEnd = moment(dataController.fechafin + ' ' + dataController.horafin).format('LLLL') // Jueves, 15 de Septiembre de 2016 0:00

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
			events: function (fetchInfo, successCallback, failureCallback ){
				var dataEvents = [];				

				$.ajax({
					url: 'controllers/activity.controller.php',
					type: 'GET',
					data: 'op=activitiesFilterByUser',
					success: function(result){
						let dataController = JSON.parse(result);

						// Recorrer los datos
						dataController.forEach((value) => {
							let colorName = dateNow > value["fechafin"]? 'bg-danger': 'bg-info';

							dataEvents.push({
								id				:	value["idactividad"],
								title			: value["titulo"],
								start			: value["fechainicio"] + " " + value["horainicio"],
								end				: value["fechafin"] + " " + value["horafin"],
								className	: colorName	
							});

						});
						// 
						successCallback(dataEvents);
					}
				});
			}
		});

		// Generar calendario
		calendar.render();
		
		// Cargar especialidades
		function loadSpecialty(){
			$.ajax({
				url: 'controllers/specialty.controller.php',
				type: 'GET',
				data:'op=getSpecialtyByUser',
				success: function(result){
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
		function isEmptyFields(){
			return $('#title').val() == "" || $('#specialty').val() == "" || $('#date-start').val() == "" || $('#time-start').val() == "";
		}

		// Validar fechas no mayor al limite
		function dateEndIsNotLess(){
			let dateStart = $("#date-start").val()
			let dateEnd = $("#date-end").val()

			return dateStart < dateEnd;
		}

		// Obtener datos del modal
		function getDataModal() {
			var data = {
				titulo						: $('#title').val().trim(),
				idespecialidad		: $('#specialty').val(),
				fechainicio				: $('#date-start').val(),
				fechafin					: $('#date-end').val(),
				horainicio				: $('#time-start').val(),
				horafin						: $('#time-end').val(),
				direccion					: $('#direction').val().trim(),
				descripcion				: $('#description').val().trim()	
			};

			return data;
		}

		// Agregar evento al calendario
		function addEventCalendar() {
			// Solo se pérmite registrar si tiene datos el formulario
			if(isEmptyFields()){
				sweetAlertWarning("Datos incorrectos", "Por favor complete los campos obligatorios");
			}
			else{
				// Confirmar
				sweetAlertConfirmQuestionSave("¿Estas seguro de registrar la agenda?").then((confirm) => {
					if(confirm.isConfirmed){
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
		function registerActivity(data){

			let dataSend = {
				op							: 'registerActivity',
				titulo					: data.titulo,
				idespecialidad	: data.idespecialidad,
				fechainicio			: data.fechainicio,
				fechafin				: data.fechafin,
				horainicio			: data.horainicio,
				horafin					: data.horafin,
				direccion				: data.direccion,
				descripcion			: data.descripcion
			}

			$.ajax({
				url	: 'controllers/activity.controller.php',
				type: 'GET',
				data: dataSend,
				success: function(result){
					if(result == "")						
						calendar.refetchEvents()	// Actualizar eventos del calendario				
				}
			});
		}

		// Actualizar evento al calendario
		function updateEventCalendar() {
			// Solo se pérmite actualizar si tiene datos el formulario
			if(isEmptyFields()){
				sweetAlertWarning("Datos incorrectos", "Por favor complete los campos obligatorios");
			}
			else{
				// Confirmar
				sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar la agenda?").then((confirm) => {
					if(confirm.isConfirmed){
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
		function updateActivity(data){
			let dataSend = {
				op							: 'updateActivity',
				idactividad			: data.idactividad,
				idespecialidad	: data.idespecialidad,
				fechainicio			: data.fechainicio,
				fechafin				: data.fechafin,
				horainicio			: data.horainicio,
				horafin					: data.horafin,
				titulo					: data.titulo,
				direccion				: data.direccion,
				descripcion			: data.descripcion
			}

			$.ajax({
				url: 'controllers/activity.controller.php',
				type: 'GET',
				data: dataSend,
				success: function(result){
					if(result == "")						
						calendar.refetchEvents()	// Actualizar eventos del calendario
				}
			});
		}

		// Actualizar evento al calendario
		function deleteEventCalendar() {
			// Confirmar
			sweetAlertConfirmQuestionDelete("¿Estas seguro de eliminar la agenda?").then((confirm) => {
				if(confirm.isConfirmed){
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
		function deleteActivity(idactividad){

			$.ajax({
				url: 'controllers/activity.controller.php',
				type: 'GET',
				data: 'op=deleteActivity&idactividad=' + idactividad,
				success: function(result){
					if(result == "")
						calendar.refetchEvents()	// Actualizar eventos del calendario					
				}
			});
		}

		// Guargar evento
		$('#btn-save').click(function() {
			addEventCalendar()
		})

		// Actualizar evento
		$('#btn-update').click(function() {
			updateEventCalendar()
		})

		// Eliminar evento
		$("#btn-delete-event").click(function(){
			deleteEventCalendar()
			$("#btn-close-card").click()
		})

		// Abrir modal para editar evento
		$("#btn-edit-event").click(function(){
			$('#card-preview-event').css('display', 'none')
			$('#btn-save').hide() 		// ocultar botón guardar
			$('#btn-update').show()		// Mostrar botón edición
			$('#modal-calendar').modal('show');
		});

		// Cerrar card
		$("#btn-close-card").click(function(){
			$('#card-preview-event').css('display', 'none');
		})

		// Sumar dias
		function addDaysToDate(date, days){
			var date = new Date(date +"T00:00:00"); 					// Fecha con Zona horaria estandar
			date.setDate(date.getDate() + days);							// Sumar dias

			let year = date.getFullYear(); 										// obtener año
			let month = date.getMonth() + 1; 									// Obtener mes y sumar 1, Aumneto 1 mes, ya que los meses inician desde "0" es decir que enero seria 0 y diciembre seria 11
			let day = date.getDate() 													// obtener dia

			month = month < 10 ? '0' + month: '' + month;			// formato a mes para que sea de 2 dígitos, etc.
			day = day < 10 ? "0" + day: '' + day; 						// formato a dia para que sea de 2 dígitos "01", "05", "10", etc.

			return year + "-" + month + "-" + day;
		}

		// Sumar horas
		function addHourTime(time, hours){
			let hour = parseInt(spliHourAndMinute(time)[0]);	// Convertir a entero 
			let minute = spliHourAndMinute(time)[1];

			let valSign = Math.sign(hours); 	// Signo de la hora obtenida

			// 1 = Positivo, -1 = Negativo
			if (valSign == 1){		
				hour += Math.abs(hours);
			} else {
				hour -= Math.abs(hours);
			}
			
			if (hour == -1){
				hour = 23;
				//minute = minute == 0? 59: minute--;
			}

			hour = hour == 24 && minute >= 0 ? 0: hour;

			let hourStr = hour < 10 ? '0' + hour.toString(): '' + hour.toString();		// formato a hora para que sea de 2 dígitos, etc.
			let minuteStr = minute.toString();																					// formato a string

			return hourStr + ":" + minuteStr; 
		}

		// Obtener la fecha inicial y final
		function getDatesModal(){
			let dateStartModal = $("#date-start").val()
			let dateEndModal = $("#date-end").val()
			let timeStartModal = $("#time-start").val()
			let timeEndModal = $("#time-end").val()

			let dates = {
				dateStart 		: dateStartModal,
				dateEnd 			: dateEndModal,
				timeStart 		: timeStartModal,
				timeEnd 			: timeEndModal,
				dateTimeStart : dateStartModal + " " + timeStartModal,
				dateTimeEnd 	: dateEndModal + " " + timeEndModal
			}
			
			return dates;
		}

		// Generar fecha limite
		$("#date-start").change(function(){
			let dates = getDatesModal();

			// Actualizar fecha final
			if(dates.dateStart > dates.dateEnd){
				$("#date-end").val(dates.dateStart)
			}
			else if(dates.dateStart == dates.dateEnd && dates.timeStart > dates.timeEnd){
				$("#time-start").val("00:00:00")
				$("#time-end").val("01:00:00")
			}
		})

		// Generar fecha inicio
		$("#date-end").change(function(){
			let dates = getDatesModal();

			// Actualizar fecha final
			if(dates.dateStart > dates.dateEnd){
				$("#date-start").val(dates.dateEnd)
			}
			else if(dates.dateStart == dates.dateEnd && dates.timeStart > dates.timeEnd){
				$("#time-start").val("00:00:00")
				$("#time-end").val("01:00:00")
			}			
		})

		// Generar hora limite
		$("#time-start").change(function(){
			let dates = getDatesModal();

			if(dates.dateStart == dates.dateEnd && $("#time-end").val() <= dates.timeStart)
				$("#time-end").val(addHourTime(dates.timeStart, 1))
		})

		// Generar hora inicio
		$("#time-end").change(function(){
			let dates = getDatesModal();

			if(dates.dateStart == dates.dateEnd && dates.timeStart >= dates.timeEnd && dates.timeStart == "00:00:00"){
				$("#date-start").val(addDaysToDate(dates.dateStart, -1)) // restar 1 dia
				$("#time-start").val("18:00:00")												 // Hora por defecto
			} else if(dates.timeStart >= dates.timeEnd){
				$("#time-start").val(addHourTime(dates.timeEnd, -1))
			}	
		})

		// cargar especialidades de servicios
		loadSpecialty();
	});
</script>