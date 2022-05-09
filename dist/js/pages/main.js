var iddepartamento = -1;
var idprovincia = -1;
var iddistrito = -1;
var operation = "";
var serviciobuscado = "";
var arrayMoney = [];
var ordenado = 'N';
var wsize = "box-sm"; // tamaño de los card

/* ION SLIDER */
$('#range-money').ionRangeSlider({
  max: 15000,
  min: 1,
  from: 50,
  to: 8000,
  type: 'double',
  step: 1,
  prefix: '$',
  prettify: false,
  hasGrid: true
})

// Opción de ver más
$("#content-carousels").on('click', '.btn-more-content', function () {
  let containerCard = $(this).attr("data-more");
  let textButon = $(this).html();
  
  if(textButon == "Reducir"){
    serviceRecommendationCarousel();
    $(this).html("Ver más");
  }
  else{
    // validar si existe el atributo
    if ($(this).is("[data-more]")) {
      // Convertir a lista GRID
      $(this).html("Reducir");
      $("div[data-more='" + containerCard + "']").removeClass("p-0").html(getLoader());
      serviceRecommendationGrid(containerCard);
    }
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
  serviciobuscado = $("#input-search-service").val();
  iddepartamento = $("#departments-filter").val();

  if(iddepartamento == "" || iddepartamento == null){
    // Mostrar localidades para volver a filtrar
    $("#content-locations").removeClass("d-none");
    $("#content-locations #locations").collapse("show");
  } else {
    // Ocultar localidades
    $("#content-locations").addClass("d-none");
  }
  
  // Abrir collapse de tarifas
  $(".content-filter-tarifa #fee").collapse('show');

  // almacenar en variable del navegador
  localStorage.setItem('serviciobuscado', serviciobuscado);
  
  if (serviciobuscado == "") {
    sweetAlertWarning("Invalido", "Indique un servicio");
  }
  else {
    // ocultar carouseles
    $("#content-carousels").addClass("d-none");
    // Mostrar contenedor de filtrados
    $("#container-filtered-services").removeClass("d-none");
    // Mostrar animación   
    generateLoader($("#container-filtered-services")); 
    // Operación realizada
    operation = "specialtiesFilteredByServiceAndDepartment";
    
    // Enviar consulta al servidor
    totalSpecialtiesFound({
      op: 'totalSpecialtiesFound',
      nombreservicio: serviciobuscado,
      iddepartamento: iddepartamento
    });

    // Filtrar servicios
    getServicesFiltered({
      op            : 'specialtiesFilteredByServiceAndDepartment',
      nombreservicio: serviciobuscado,
      iddepartamento: iddepartamento,
      order         : ordenado,
      wsize         : wsize
    });    
  }
});

// Enter sobre la caja de servicios
$("#input-search-service").keyup(function(e){
  if(e.keyCode == 13){
    $("#btn-search-services").click();
  }
});

// MOSTRA - LIST
$("#btn-list").click(function () {
  wsize = "box-lg";

  // Filtrar servicios con la operación indicada anteriormente
  getServicesFiltered({
    op            : operation,
    nombreservicio: serviciobuscado,
    iddepartamento: iddepartamento,
    idprovincia   : idprovincia,
    iddistrito    : iddistrito,
    tarifa1       : arrayMoney[0],
    tarifa2       : arrayMoney[1],
    order         : ordenado,
    wsize         : wsize
  });
  
});

// MOSTRA - GRID
$("#btn-grid").click(function () {
  wsize = "box-sm";

  // Filtrar servicios con la operación indicada anteriormente
  getServicesFiltered({
    op            : operation,
    nombreservicio: serviciobuscado,
    iddepartamento: iddepartamento,
    idprovincia   : idprovincia,
    iddistrito    : iddistrito,
    tarifa1       : arrayMoney[0],
    tarifa2       : arrayMoney[1],
    order         : ordenado,
    wsize         : wsize
  });
});

// Filtrar por departamentos
$("#departments").change(function () {
  iddepartamento = $(this).val();
  // Operación realizada
  operation = "specialtiesFilteredByServiceAndDepartment";

  // listar distritos
  listProvinces(iddepartamento);

  getServicesFiltered({
    op            : operation,
    nombreservicio: serviciobuscado,
    iddepartamento: iddepartamento,
    order         : ordenado,
    wsize         : wsize
  });
});

// Filtrar por provincias
$("#provinces").change(function () {
  idprovincia = $(this).val();
  // Operación realizada
  operation = "specialtiesFilteredByServiceAndProvince";

  // listar distritos
  listDistricts(idprovincia);

  getServicesFiltered({
    op            : operation,
    nombreservicio: serviciobuscado,
    idprovincia   : idprovincia,
    order         : ordenado,
    wsize         : wsize
  });
});

// filtrar por ditritos
$("#districts").change(function () {
  iddistrito = $(this).val();
  // operación realizada 
  operation = "specialtiesFilteredByServiceAndDistrict";

  getServicesFiltered({
    op            : operation,
    nombreservicio: serviciobuscado,
    iddistrito    : iddistrito,
    order         : ordenado,
    wsize         : wsize
  });
});

// Filtrar por rango de monedas
$("#range-money").change(function () {
  let money = $(this).val();
  arrayMoney = money.split(';');
  // Operación realizada
  operation = "specialtiesFilteredByServiceAndFee";

  getServicesFiltered({
    op            : operation,
    nombreservicio: serviciobuscado,
    tarifa1       : arrayMoney[0],
    tarifa2       : arrayMoney[1],
    order         : ordenado,
    wsize         : wsize
  });
});

// Ordenar filtrado
$("#order-filtered").change(function(){
  ordenado = $(this).val();

  // Filtrar servicios con el orden establecido
  getServicesFiltered({
    op            : operation,
    nombreservicio: serviciobuscado,
    iddepartamento: iddepartamento,
    idprovincia   : idprovincia,
    iddistrito    : iddistrito,
    tarifa1       : arrayMoney[0],
    tarifa2       : arrayMoney[1],
    order         : ordenado,
    wsize         : wsize
  });
});

// Abrir en el mapa
$("#btn-open-map").click(function () {
  //alert("Abrir mapa");
  redirect(serviciobuscado);
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
      $("#departments-filter").html(result);
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
function serviceRecommendationCarousel() {
  // animación de carga
  $("#carousel-recommended").html(getLoader());

  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=listCarouselRecommendation',
    success: function (result) {

      $("#carousel-recommended").html(result);

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
          980: {
            items: 2
          },
          1300: {
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

// Listar contenidos en formato grid
function serviceRecommendationGrid(container) {
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=listGridRecommendation',
    success: function (result) {
      if (result != "") {
        $("div[data-more='" + container + "']").html(result);
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

// Total de servicios disponibles
function totalSpecialtiesAvailable(){
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=totalSpecialtiesAvailable',
    success: function(result){
      $("#total-services").html(result);
    }
  });
}

// Total de servicios encontrados al realizar una busqueda
function totalSpecialtiesFound(dataSend){
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: dataSend,
    success: function(result){
      $("div").remove(".container-loader"); // Remover animación

      if(result > 0){
        $("#total-services-found").html(result);
        $("#span-text-found").html("Servicios ofrecidos");
        $("#body-content-filtered").removeClass("d-none");
      } else {
        $("#span-text-found").html("No se ha encontrado servivicios ofrecidos con los filtros actuales");
        $("#total-services-found").html('');
        $("#body-content-filtered").addClass("d-none");
      }
    }
  });
}

// Listar departamentos y recomendados
listDepartments();
serviceRecommendationCarousel();
totalSpecialtiesAvailable();