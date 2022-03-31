
<link href='plugins/fullcalendar/main.css' rel='stylesheet' />
<link rel="stylesheet" href="dist/css/pages/calendar.css">

<script src='plugins/fullcalendar/main.js'></script>
<script src='plugins/fullcalendar/locales/es.js'></script>
<script src="dist/js/pages/calendar.js"></script>


<!-- Calendar -->
<div class="container mt-4">
    <!-- Modal -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm d-none" data-toggle="modal" data-target="#modal-calendar">
        Agregar
    </button>
    
    <!-- Modal  agenda-->
    <div class="modal fade" id="modal-calendar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form id="form-save-schedule">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Titulo</label>
                                <input type="text" id="title" class="form-control" placeholder="Titulo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="direction">Dirección.</label>
                                <input type="text" id="direction" class="form-control" placeholder="Direción: ejm Av. Calle. Mz">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="date">Fecha.</label>
                                <input type="date" id="date" class="form-control" min="2000-01-01" max="2040-12-31">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="time">Hora</label>
                                <input type="time" id="time" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="description">Descripción</label>
                                <textarea id="description" cols="30" rows="3" class="form-control" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="color">Color</label>
                                <input type="color" id="color" value="#151500" class="form-control" style="height: 36px;"></input>
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
</div>



