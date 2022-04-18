<div class="alert alert-dark" role="alert">
  <span >Asignar o quitar permisos de administrador</span>
</div>

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-4">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h3 class="card-title">Filtros</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-4">
        <div class="row">
          <div class="col-md-12 mb-1">
            <div class="form-group">
              <label for="typeuser">Tipo de usuario</label>
              <select class="custom-select" id="typeuser">
                <option value="">Todos</option>
                <option value="A">Solo Administradores</option>
                <option value="U">Solo Usuarios</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="input-search">Buscar</label>
              <div class="input-group">
                <input type="text" class="form-control" id="input-search" maxlength="20" autocomplete="off">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" id="btn-search">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h3 class="card-title">Lista de usuarios</h3>
      </div>
      <div class="card-body table-responsive p-4">
        <table id="tbl-usuarios" class="table table-valign-middle">
          <thead>
            <tr>
              <th width='10%'>Foto</th>
              <th>Nombre</th>
              <th>Fecha registrado</th>
              <th width='10%'>Admin</th>
            </tr>
          </thead>
          <tbody id="tbl-permissions-user">
            <!-- cargados de forma asincrono -->
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

    // DECLARACIÓN DEL ARRAY ASOCIATIVO, QUE SERA ENVIADO AL CONTROLADOR
    var dataSendController = {
      op: 'searchUsersByNamesAndRole', 
      rol: '',
      search: ''
    };

    // Listar todos los usuarios
    function loadUsersTable(){

      // Enviando datos al controller usando ajax
      $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: dataSendController,
        success: function(result){
          if(result != ''){
            // // Reiniciar dataTable
            $("#tbl-usuarios").DataTable().destroy();
  
            // Agregar datos en cuerpo de la tabla usuario
            $("#tbl-permissions-user").html(result);
  
            // Volver a generar el dataTable
            $("#tbl-usuarios").DataTable({
              paging: true,
              lengthChange: true,
              language: { url : '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'},
              searching: false,
              ordering: true,
              info: true,
              autoWidth: false,
              responsive: true
            });
          }
        }
      });
    }

    // Filtrar por tipo de usuario
    $("#typeuser").change(function(){
      $("#input-search").val("").focus();

      dataSendController['rol'] = $(this).val();        
      loadUsersTable();
    });

    // Busqueda realizada por nombres o apellidos
    $("#input-search").keyup(function(e){
      var valueInput = $(this).val();
      
      if(valueInput == ''){
        buttonPrimary();
      }
      else{
        buttonDanger();
      }

      updateDataSendController();
      loadUsersTable();
    });

    // Limpiar texto de busqueda
    $("#btn-search").click(function(){
      buttonPrimary();
      $("#input-search").val('').focus();
      //$("#typeuser").prop("selectedIndex", 0).val();

      updateDataSendController();
      loadUsersTable();
    });

    // Boton rojo
    function buttonDanger(){
      //$("#btn-search").removeClass('btn-primary').addClass('btn-danger');
      $("#btn-search i").removeClass("fa-search").addClass('fa-times');
    }

    //Botón azul
    function buttonPrimary(){
      //$("#btn-search").removeClass('btn-danger').addClass('btn-primary');
      $("#btn-search i").removeClass("fa-times").addClass('fa-search');
    }

    // Evento on clic para cambiar de rol de usuario
    $("#tbl-permissions-user").on("click", ".switch-role", function(){
      let idusuario = $(this).attr("id");
      let role = $(this).prop("checked") ? 'A': 'U';

      sweetAlertConfirmQuestionSave('¿Estas seguro de cambiar el rol de usuario?').then((confirm) => {
        if (confirm.isConfirmed)
          changeUserRole(idusuario, role);              
        else  
          // Actualizar datos
          updateDataSendController();
          loadUsersTable();
      });
      
    });

    // Actualizar datos del array asociativo enviado al controler
    function updateDataSendController(){
      dataSendController['rol'] = $("#typeuser").val();   
      dataSendController['search'] = $("#input-search").val().trim(); 
    }

    // Cambiar rol de usuario
    function changeUserRole(idusuario, role){

      let dataSend = {
        op        : 'updateUserRole', 
        idusuario : idusuario,
        rol       : role
      };

      $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: dataSend,
        success: function(result){
          // Actualizar datos
          updateDataSendController();
          loadUsersTable();
        }
      });
    }

    // Ejecutar y listar todos los usuarios
    loadUsersTable();
  })
</script>