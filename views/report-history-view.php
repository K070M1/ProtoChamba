<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header ui-sortable-handle">
        <h3 class=" mb-2">Lista de usuarios</h3>
        <div class="input-group">
          <input type="text" class="form-control">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- style="max-height: calc(100vh - 275px); overflow-y: auto;" -->
      <div class="card-body p-0" >
        <table class="table projects">
          <tbody id="tbody-users">
            <!-- Cargado de forma asincrona -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header ui-sortable-handle">
        <h3 class="card-titl">Historial de reportes</h3>
        <!-- <div class="card-tools">
          <div class="input-group">
            <input type="text" class="form-control">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
          </div>
          style="max-height: calc(100vh - 240px); overflow-y: auto; "
        </div> -->
      </div>
      <div class="card-body table-responsive" >
        <table id="tbl-reports" class="table table-valign-middle" style="margin-top: 0px !important;">
          <thead>
            <tr>
              <th>Para</th>
              <th>Motivó</th>
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

<script>
    $(function () {
      $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })
      
      // cargar usuarios
      function loadUsersTable(){
        $.ajax({
          url: 'controller/user.controller.php',
          type: 'GET',
          data: 'op=listUsers',
          success: function(e){
            $("#tbody-users").html(e);
          }
        });
      }

      // cargar reportes
      function loadReportsTable(){
        $.ajax({
          url: 'controller/report.controller.php',
          type: 'GET',
          data: 'op=getReports',
          success: function(e){

            // destruir datatable
            $('#tbl-reports').DataTable().destroy();
            //Cargar datos
            $("#tbody-reports").html(e);

            // Volver a genewrar datatable
            $('#tbl-reports').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
              "language": { url : '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'},
            });
          }
        });
      }

      // ejecutar función
      loadUsersTable();
      loadReportsTable();
    })
  </script>