<div class="callout callout-info">
  <h5><i class="fas fa-user-alt-slash"></i> Banear usuarios de forma temporal</h5>
</div>

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-4">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h5 class="card-title text-uppercase">Lista de usuarios</h5>  
        
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- style="max-height: calc(100vh - 275px); overflow-y: auto;" -->
      <div class="card-body p-0">
        <div class="input-group" style="width: 90%; margin: 1em auto 1em auto;">
          <input type="text" class="form-control" id="input-search-user">
          <div class="input-group-append">
            <span class="input-group-text bg-primary" id="btn-search"><i class="fas fa-search"></i></span>
          </div>
        </div>
        <div style="max-height: calc(100vh - 285px); overflow-y: auto;" onscroll="scrollReportingData()" id="scrollReportingUser" >
          <table class="table projects" >
            <tbody id="tbody-users">
              <!-- Cargado de forma asincrona -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h5 class="card-title text-uppercase">Historial de reportes</h5>
      </div>
      <div class="card-body table-responsive" >
        <table id="tbl-reports" class="table table-valign-middle" style="margin-top: 0px !important;">
          <thead>
            <tr>
              <th>Usuario reportado</th>
              <th>Motivo</th>
              <th>Descripción</th>
              <th>Fecha</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody id="tbody-reports">
            <!-- -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal visor de imagen -->
<div class="modal fade" id="modalImageReport" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Archivo adjunto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">        
        <img src="" alt="imagen" id="img-report-preview" style="width: 100%; height: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar modal</button>
      </div>
    </div>
  </div>
</div>

<script src="dist/js/pages/report-history.js"></script>

<!--Carga con scroll-->
<script src="dist/js/ChangeScroll.js"></script>