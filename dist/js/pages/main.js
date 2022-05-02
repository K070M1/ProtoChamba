var idusuarioActivo = -1;
var serviciobuscado = "";
var iddepartamento = -1;
var wsize = "box-sm"; // tamaño de los card

/* ION SLIDER */
$('#range-money').ionRangeSlider({
  max: 5000,
  min: 1,
  from: 50,
  to: 1500,
  type: 'double',
  step: 1,
  prefix: '$',
  prettify: false,
  hasGrid: true
})

// Opción de ver más
$("#content-carousels").on('click', '.btn-more-content', function () {
  let idservicio = $(this).attr("data-more");

  // vaidar si existe el atributo
  if ($(this).is("[data-more]")) {
    // Comvertir a lista GRID
    $(this).html("Reducir");
    $("div[data-more='" + idservicio + "']").removeClass("p-0").html("Cargando datos GRID");
    getGridTarjetUser(idservicio, idservicio);
  }

});

// RFECOMENDADOS ir al perfil del usuario (CLICK IMAGEN)
$("#content-carousels").on('click', '.link-user', function () {
  let idusuario = $(this).attr('data-user');
  redirectProfile(idusuario);
});

// RFECOMENDADOS ir al perfil del usuario (CLICK NOMBRE)
$("#content-carousels").on('click', '.name-user', function () {
  let idusuario = $(this).attr('data-user');
  redirectProfile(idusuario);
});

// FILTRADOS ir al perfil del usuario (CLICK IMAGEN)
$("#content-data-filtered").on('click', '.link-user', function () {
  let idusuario = $(this).attr('data-user');
  redirectProfile(idusuario);
});

// FILTRADOS ir al perfil del usuario (CLICK NOIMBRE)
$("#content-data-filtered").on('click', '.name-user', function () {
  let idusuario = $(this).attr('data-user');
  redirectProfile(idusuario);
});

// Ecutar buscador
$("#btn-search-services").click(function () {
  let nombreservicio = $("#input-search-service").val();
  iddepartamento = $("#departments").val();

  serviciobuscado = nombreservicio;
  localStorage.setItem('serviciobuscado', serviciobuscado);

  // Listar provincias
  listProvinces(iddepartamento);

  if (nombreservicio == "" || iddepartamento == "" || iddepartamento == null) {
    sweetAlertWarning("Invalido", "Complete los datos");
  }
  else {
    // ocultar carouseles
    $("#content-carousels").addClass("d-none");
    // Mostrar contenedor de filtrados
    $("#container-filtered-services").removeClass("d-none");

    // Listar registros encontrados
    getServicesFiltered({
      op: 'specialtiesFilteredByServiceAndDepartment',
      nombreservicio: nombreservicio,
      iddepartamento: iddepartamento,
      wsize: "box-sm"
    });
  }
});

// MOSTRA - LIST
$("#btn-list").click(function () {
  let nombreservicio = $("#input-search-service").val();
  let iddepartamento = $("#departments").val();

  getServicesFiltered({
    op: 'specialtiesFilteredByServiceAndDepartment',
    nombreservicio: nombreservicio,
    iddepartamento: iddepartamento,
    wsize: "box-lg"
  });
});

// MOSTRA - GRID
$("#btn-grid").click(function () {
  let nombreservicio = $("#input-search-service").val();
  let iddepartamento = $("#departments").val();

  getServicesFiltered({
    op: 'specialtiesFilteredByServiceAndDepartment',
    nombreservicio: nombreservicio,
    iddepartamento: iddepartamento,
    wsize: "box-sm"
  });
});

// Filtrar por provincias
$("#provinces").change(function () {
  let idprovincia = $(this).val();

  // listar distritos
  listDistricts(idprovincia);

  getServicesFiltered({
    op: 'specialtiesFilteredByServiceAndProvince',
    nombreservicio: serviciobuscado,
    idprovincia: idprovincia,
    wsize: "box-lg"
  });
});

// filtrar por ditritos
$("#districts").change(function () {
  let iddistrito = $(this).val();

  getServicesFiltered({
    op: 'specialtiesFilteredByServiceAndDistrict',
    nombreservicio: serviciobuscado,
    iddistrito: iddistrito,
    wsize: "box-lg"
  });
});

// Filtrar por rango de monedas
$("#range-money").change(function () {
  let money = $(this).val();
  let arrMoney = money.split(';');

  getServicesFiltered({
    op: 'specialtiesFilteredByServiceAndFee',
    nombreservicio: serviciobuscado,
    iddepartamento: iddepartamento,
    tarifa1: arrMoney[0],
    tarifa2: arrMoney[1],
    wsize: "box-lg"
  });
});

// Abrir en el mapa
$("#btn-open-map").click(function () {
  alert("Abrir mapa");
  //redirect(serviciobuscado);
});

// Redireccionar al perfil
function redirectProfile(idusuario) {
  localStorage.setItem("idusuarioActivo", idusuario);
  window.location.href = "index.php?view=profile-view";
}

// Llenar de datos el control select de departamentos
function listDepartments() {
  $.ajax({
    url: 'controllers/ubigeo.controller.php',
    type: 'GET',
    data: 'op=getDepartments',
    success: function (result) {
      $("#departments").html(result);
    }
  });
}

// Listar provincias
function listProvinces(iddepartamento) {
  $.ajax({
    url: 'controllers/ubigeo.controller.php',
    type: 'GET',
    data: 'op=getProvinces&iddepartamento=' + iddepartamento,
    success: function (result) {
      if (result != "") {
        $("#provinces").html(result);
      }
    }
  });
}

// Listar distritos
function listDistricts(idprovincia) {
  $.ajax({
    url: 'controllers/ubigeo.controller.php',
    type: 'GET',
    data: 'op=getDistricts&idprovincia=' + idprovincia,
    success: function (result) {
      if (result != "") {
        $("#districts").html(result);
      }
    }
  });
}

// Listar recomendaciones de servicios
function serviceRecommendation() {
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=listCarousels',
    success: function (result) {
      $("#content-carousels").html(result);

      // Configuración del owl-carousel
      $('.owl-carousel').owlCarousel({
        loop: false,
        dots: false, // Leyenda de pagina
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        responsive: {
          0: {
            items: 1
          },
          350: {
            items: 1,
          },
          600: {
            items: 2
          },
          980: {
            items: 2
          },
          1100: {
            items: 3
          },
          1800: {
            items: 3
          }
        }
      })
    }
  });
}

// Listar contenidos grid (tarjet)
function getGridTarjetUser(idservicio, container) {
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=generateContentGrid&idservicio=' + idservicio,
    success: function (result) {
      if (result != "") {
        $("div[data-more='" + container + "']").html(result);
        //selector.html(result);
      }
    }
  });
}

// Listar servicios filtrados
function getServicesFiltered(dataSend) {
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: dataSend,
    success: function (result) {
      if (result != "") {
        $("#content-data-filtered").html(result);
      }
    }
  });
}

// Listar departamentos y recomendados
listDepartments();
serviceRecommendation();