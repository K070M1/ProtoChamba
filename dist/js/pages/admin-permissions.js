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