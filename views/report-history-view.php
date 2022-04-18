<div class="alert alert-dark" role="alert">
  <span >Banear usuarios de forma temporal</span>
</div>

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-4">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h5 class="card-title">Lista de usuarios</h5>        
      </div>
      <!-- /.card-header -->
      <!-- style="max-height: calc(100vh - 275px); overflow-y: auto;" -->
      <div class="card-body p-0" >
        <div class="input-group" style="width: 90%; margin: 1em auto 1em auto;">
          <input type="text" class="form-control" id="input-search-user">
          <div class="input-group-append">
            <span class="input-group-text bg-primary" id="btn-search"><i class="fas fa-search"></i></span>
          </div>
        </div>
        <table class="table projects">
          <tbody id="tbody-users">
            <!-- Cargado de forma asincrona -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h5 class="card-title">Historial de reportes</h5>
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
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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

<script>
  $(function () {

    // Array (enviar datos controller)
    var dataSendController = {
      op: 'searchUsersByNamesViewHistory',
      search: ''
    };

    //????????????????
    $("input[data-bootstrap-switch]").each(function () {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    
    // cargar usuarios
    function loadUsersTable(){
      $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: dataSendController,
        success: function(e){
          $("#tbody-users").html(e);
        }
      });
    }

    // cargar reportes
    function loadReportsTable(){
      $.ajax({
        url: 'controllers/report.controller.php',
        type: 'GET',
        data: 'op=getReports',
        success: function(e){

          // destruir datatable
          $('#tbl-reports').DataTable().destroy();
          //Cargar datos
          $("#tbody-reports").html(e);

          // Volver a genewrar datatable
          $('#tbl-reports').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            language: { url : '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'},
          });
        }
      });
    }

    // Banear usuario
    function banUser(idusuario){
      sweetAlertConfirmQuestionDelete("¿Estas seguro de banear al usuario?").then((confirm) => {
        if (confirm.isConfirmed){
          $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: 'op=banUser&idusuario=' + idusuario,
            success: function(result){
              // Actualizar datos
              loadUsersTable();
              sweetAlertSuccess("Realizado", "La cuenta a sido baneado");
            }
          });
        }
      }); 

    }

    // Reacrtivar usuario
    function reactivateUser(idusuario){
      sweetAlertConfirmQuestionSave("¿Estas seguro de reactivar al usuario?").then((confirm) => {
        if (confirm.isConfirmed){
          $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: 'op=reactivateUser&idusuario=' + idusuario,
            success: function(result){
              // Actualizar datos
              loadUsersTable();
              sweetAlertSuccess("Realizado", "La cuenta a sido restablecido");
            }
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
        dataSendController['search'] = valueSearch;
        loadUsersTable();
      }
    });

    // Botón buscar
    $("#btn-search").click(function(){
      $("#input-search-user").val('').focus();
      buttonPrimary();

      // Actualizando datos
      dataSendController['search'] = '';
      loadUsersTable();
    });

    // Evento on clic, para mostrar imagen
    $("#tbody-reports").on("click", ".btn-open-modal-report", function(){
      $("#img-report-preview").attr("src", "dist/img/" + $(this).attr("data-img"));
      $("#modalImageReport").modal('show');
    });

    // Evento on clic, para banear usuario desde la lista de usuarios
    $("#tbody-users").on("click", ".btn-ban-user", function(){
      let idusuario = $(this).attr("data-code");
      let estado = $(this).attr("data-condition");

      if(estado == 1)
        banUser(idusuario);
      
      else
        reactivateUser(idusuario);  

    });

    // Evento on clic, para banear usuario desde el historial de reporte
    $("#tbody-reports").on("click", ".btn-ban-user", function(){
      let idusuario = $(this).attr('data-code');
      banUser(idusuario);    
    });

    // Boton rojo
    function buttonDanger(){
      //$("#btn-search").removeClass('bg-primary').addClass('bg-danger');
      $("#btn-search i").removeClass('fa-search').addClass('fa-times');
    }

    //Botón azul
    function buttonPrimary(){
      //$("#btn-search").removeClass('bg-danger').addClass('bg-primary');
      $("#btn-search i").removeClass('fa-times').addClass('fa-search');
    }

    // ejecutar función
    loadUsersTable();
    loadReportsTable();
  })
</script>