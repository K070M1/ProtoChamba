<link href='plugins/fullcalendar/main.css' rel='stylesheet' />
<link rel="stylesheet" href="dist/css/pages/calendar.css">

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
				<h5 class="modal-title text-bold">Registro de agendas</h5>
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


<script src='plugins/fullcalendar/main.js'></script>
<script src='plugins/fullcalendar/locales/es.js'></script>
<script src="dist/js/pages/calendar.js"></script>
