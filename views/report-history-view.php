<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header ui-sortable-handle">
        <h3 class=" mb-2">Lista de usuarios</h3>
        <div class="input-group">
          <input type="text" class="form-control" id="input-search-user">
          <div class="input-group-append">
            <span class="input-group-text bg-primary" id="btn-search"><i class="fas fa-search"></i></span>
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

      // Array declarado
      var data = {op: 'listUsers'};

      $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })
      
      // cargar usuarios
      function loadUsersTable($data){
        $.ajax({
          url: 'controller/user.controller.php',
          type: 'GET',
          data: $data,
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

      // Buscar usuario
      $("#input-search-user").keyup(function(){
        $("#btn-search i").removeClass("fa-search").addClass('fa-times');

        var valueSearch = $(this).val();
        //console.log(valuSearch);
        if(valueSearch == ''){
          buttonPrimary();
        }
        else{
          buttonDanger();
          // Actualizando datos
          data = {
            op: 'searchUsersByNamesHistory',
            search: valueSearch
          };

          // Volviendo a ejecutar la función
          loadUsersTable(data);
        }
      });

      // Botón buscar
      $("#btn-search").click(function(){
        $("#input-search-user").val('').focus();
        buttonPrimary();
        // Actualizando datos
        data = {op: 'listUsers'};

        // Volviendo a ejecutar la función
        loadUsersTable(data);
      });

      // Boton rojo
      function buttonDanger(){
        $("#btn-search").removeClass('bg-primary').addClass('bg-danger');
        $("#btn-search i").removeClass('fa-search').addClass('fa-times');
      }

      //Botón azul
      function buttonPrimary(){
        $("#btn-search").removeClass('bg-danger').addClass('bg-primary');
        $("#btn-search i").removeClass('fa-times').addClass('fa-search');
      }

      // ejecutar función
      loadUsersTable(data);
      loadReportsTable();
    })
  </script>