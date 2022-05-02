// Array (enviar datos controller)
var dataSendController = {
  op: 'searchUsersByNamesViewHistory',
  search: ''
};

// cargar usuarios
function loadUsersTable() {
  $.ajax({
    url: 'controllers/user.controller.php',
    type: 'GET',
    data: dataSendController,
    success: function (e) {
      $("#tbody-users").html(e);
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
      $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=banUser&idusuario=' + idusuario,
        success: function (result) {
          // Actualizar datos
          loadUsersTable();
          sweetAlertSuccess("Realizado", "La cuenta a sido baneado");
        }
      });
    }
  });

}

// Reacrtivar usuario
function reactivateUser(idusuario) {
  sweetAlertConfirmQuestionSave("¿Estas seguro de reactivar al usuario?").then((confirm) => {
    if (confirm.isConfirmed) {
      $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=reactivateUser&idusuario=' + idusuario,
        success: function (result) {
          // Actualizar datos
          loadUsersTable();
          sweetAlertSuccess("Realizado", "La cuenta a sido restablecido");
        }
      });
    }
  });
}

// Buscar usuario
$("#input-search-user").keyup(function () {
  $("#btn-search i").removeClass("fa-search").addClass('fa-times');

  var valueSearch = $(this).val();
  //console.log(valuSearch);
  if (valueSearch == '') {
    buttonPrimary();
  }
  else {
    buttonDanger();
    // Actualizando datos
    dataSendController['search'] = valueSearch;
    loadUsersTable();
  }
});

// Botón buscar
$("#btn-search").click(function () {
  $("#input-search-user").val('').focus();
  buttonPrimary();

  // Actualizando datos
  dataSendController['search'] = '';
  loadUsersTable();
});

// Evento on clic, para mostrar imagen
$("#tbody-reports").on("click", ".btn-open-modal-report", function () {
  $("#img-report-preview").attr("src", "dist/img/" + $(this).attr("data-img"));
  $("#modalImageReport").modal('show');
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

// Boton rojo
function buttonDanger() {
  //$("#btn-search").removeClass('bg-primary').addClass('bg-danger');
  $("#btn-search i").removeClass('fa-search').addClass('fa-times');
}

//Botón azul
function buttonPrimary() {
  //$("#btn-search").removeClass('bg-danger').addClass('bg-primary');
  $("#btn-search i").removeClass('fa-times').addClass('fa-search');
}

// ejecutar función
loadUsersTable();
loadReportsTable();