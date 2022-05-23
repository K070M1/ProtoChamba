// Array asociativo (enviar datos controller)
var offset = 0;
var offsetTmp = 0;
var limit = 16;

var dataSendController = {
  op: 'searchUsersByNamesViewHistory',
  search: '',
  offset: offset,
  limit : limit 
};

// cargar usuarios
function loadUsersTable() {
  $("#tbody-users").append(getLoader());

  $.ajax({
    url: 'controllers/user.controller.php',
    type: 'GET',
    data: dataSendController,
    success: function (result) {
      // Quitar animación de carga
      $("#tbody-users div").remove(".container-loader");

      if(result != "" && result != "sin registros"){
        $("#tbody-users").append(result);
      }
    }
  });
}

// cargar reportes
function loadReportsTable() {
  $.ajax({
    url: 'controllers/report.controller.php',
    type: 'GET',
    data: 'op=getReports',
    success: function (result) {

      // destruir datatable
      $('#tbl-reports').DataTable().destroy();
      //Cargar datos
      $("#tbody-reports").html(result);

      // Volver a genewrar datatable
      $('#tbl-reports').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        language: { url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json' },
      });
    }
  });
}

// Banear usuario
function banUser(idusuario) {
  sweetAlertConfirmQuestionDelete("¿Estas seguro de banear al usuario?").then((confirm) => {
    if (confirm.isConfirmed) {
      $("#modalLoader").modal("show");
      $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=banUser&idusuario=' + idusuario,
        success: function (result) {
          // Actualizar datos
          $("#modalLoader").modal("hide");
          cleanContentUsersTable();
          dataSendController['offset'] = offset;
          loadUsersTable();
          sweetAlertSuccess("Realizado", "La cuenta a sido baneado");
        }
      });
    }
  });

}

// Reactivar usuario
function reactivateUser(idusuario) {
  sweetAlertConfirmQuestionSave("¿Estas seguro de reactivar al usuario?").then((confirm) => {
    if (confirm.isConfirmed) {
      $("#modalLoader").modal("show");
      $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=reactivateUser&idusuario=' + idusuario,
        success: function (result) {
          // Actualizar datos
          $("#modalLoader").modal("hide");
          cleanContentUsersTable();
          dataSendController['offset'] = offset;
          loadUsersTable();
          sweetAlertSuccess("Realizado", "La cuenta a sido restablecido");
        }
      });
    }
  });
}

// Buscador de usuario 
$("#input-search-user").keyup(function () {
  $("#btn-search i").removeClass("fa-search").addClass('fa-times');
  var valueSearch = $(this).val();

  //console.log(valuSearch);
  if (valueSearch == '') {
    $("#btn-search i").removeClass('fa-times').addClass("fa-search");
    dataSendController['search'] = '';
  } else {
    dataSendController['search'] = valueSearch;
  }

  // Limpiar contenido
  cleanContentUsersTable();
  dataSendController['offset'] = offset;
  loadUsersTable();
});

// Botón buscar
$("#btn-search").click(function () {
  $("#input-search-user").val('').focus();
  $("#btn-search i").removeClass('fa-times').addClass("fa-search");

  // Actualizando datos
  cleanContentUsersTable();
  dataSendController['search'] = '';
  dataSendController['offset'] = offset;
  loadUsersTable();
});

// Evento on clic, para mostrar imagen del reporte
$("#tbody-reports").on("click", ".btn-open-modal-report", function () {
  let imagen = $(this).attr("data-img");

  if(imagen == ""){
    sweetAlertInformation("No existe imagen por mostrar", "");
  } else {
    $("#img-report-preview").attr("src", "dist/img/user/" + imagen);
    $("#modalImageReport").modal('show');
  }
});

// Evento on clic, para banear usuario desde la lista de usuarios
$("#tbody-users").on("click", ".btn-ban-user", function () {
  let idusuario = $(this).attr("data-code");
  let estado = $(this).attr("data-condition");

  if (estado == 1)
    banUser(idusuario);
  else
    reactivateUser(idusuario);
});

// Evento on clic, para banear usuario desde el historial de reporte
$("#tbody-reports").on("click", ".btn-ban-user", function () {
  let idusuario = $(this).attr('data-code');
  banUser(idusuario);
});

// Detectar scroll al final de la ventana
$("#scrollReportingUser").scroll(function(){
  if(isFinalContainer($(this))){
    offsetTmp++;
    offset = offsetTmp * limit;
    dataSendController['offset'] = offset;
    loadUsersTable();
  }
});

function cleanContentUsersTable(){
  offset = 0;
  offsetTmp = 0;
  // Limpiar contenido
  $("#tbody-users tr").remove();
}

// ejecutar funciones al cargar 
loadUsersTable();
loadReportsTable();