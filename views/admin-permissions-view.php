<h4>Asignar permisos de administrador</h4>
<hr>

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-4">
    <div class="card direct-chat direct-chat-primary">
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
              <label for="typeuser">Por tipo</label>
              <select class="custom-select" id="typeuser">
                <option value="">Ambos</option>
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
    <div class="card">
      <div class="card-header ui-sortable-handle">
        <h3 class="card-title">Lista de usuarios</h3>
      </div>
      <div class="card-body table-responsive p-4">
        <table id="tbl-usuarios" class="table table-valign-middle">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Admin</th>
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

    // DECLARACIÓN DE VARIABLES
    var data = {op: 'searchUsersByNamesAndRole', rol: ''};

    // Listar todos los usuarios
    function loadUsersTable($data){

      // Enviando datos al controller usando ajax
      $.ajax({
        url: 'controller/user.controller.php',
        type: 'GET',
        data: $data,
        success: function(e){

          if(e != ''){
            // // Reiniciar dataTable
            $("#tbl-usuarios").DataTable().destroy();
  
            // Agregar datos en cuerpo de la tabla usuario
            $("#tbl-permissions-user").html(e);
  
            // Volver a generar el dataTable
            $("#tbl-usuarios").DataTable({
              paging: true,
              lengthChange: true,
              language: { url : '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'},
              searching: true,
              ordering: true,
              info: true,
              autoWidth: false,
              responsive: true
            });
          }
        }
      });
    }

    // Por tipo
    $("#typeuser").change(function(){
      var role = $(this).val();
      $("#input-search").val("").focus();


      data['rol'] = role;        
      loadUsersTable(data);
    });

    // Busqueda realizada por nombres o apellidos
    $("#input-search").keyup(function(e){
      var valueInput = $(this).val();
      
      if(valueInput == ''){
        buttonPrimary();
      }
      else{
        data = {
          op: 'searchUsersByNamesAndRole',
          rol: $("#typeuser").val(),
          search: valueInput
        };
        loadUsersTable(data);
        buttonDanger();
      }
    });

    // Limpiar texto de busqueda
    $("#btn-search").click(function(){
      buttonPrimary();
      $("#input-search").val('');
      $("#input-search").focus();

      data = {op: 'getUsers'};
      loadUsersTable(data);
    });

    // Boton rojo
    function buttonDanger(){
      $("#btn-search").removeClass('btn-primary').addClass('btn-danger');
      $("#btn-search i").removeClass("fa-search").addClass('fa-times');
    }

    //Botón azul
    function buttonPrimary(){
      $("#btn-search").removeClass('btn-danger').addClass('btn-primary');
      $("#btn-search i").removeClass("fa-times").addClass('fa-search');
    }

    // Ejecutar y listar todos los usuarios
    loadUsersTable(data);
  })
</script>