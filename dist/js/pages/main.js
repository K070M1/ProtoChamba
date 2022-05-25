var iddepartamento = -1;
var idprovincia = -1;
var iddistrito = -1;
var operation = "";
var serviciobuscado = "";
var arrayMoney = [];
var order = 'N';  // N = Nombre, F = Fecha, S = Suelto, E = Estrellas
var wsize = "box-sm"; // tamaño de los card
var offsetTmp = 0;
var offset = 0;
var limit = 6;


// utilizado en el filtrado de servicios / especialidades
var dataSend = {
  nombreservicio: serviciobuscado,
  order         : order,
  wsize         : wsize,
  offset        : offset,
  limit         : limit
};

/* ION SLIDER - TANGO DE MONEDAS */
$('#range-money').ionRangeSlider({
  max: 15000,
  min: 1,
  from: 50,
  to: 8000,
  type: 'double',
  skin: 'round',
  step: 1,
  prefix: 'S/.',
  prettify: false,
  hasGrid: true
})

// Instancia del ionRangeSlider
var rangeMoney = $("#range-money").data("ionRangeSlider");

// Opción de ver más
$("#content-carousels").on('click', '.btn-more-content', function () {
  let typeservice = $(this).attr("data-more");
  let textButon = $(this).html();
  
  if(textButon == "Contraer"){
    $(this).html("Ver más");
    if(typeservice == "popular"){
      servicePopularCarousel();
    } else {
      serviceRecommendationCarousel();
    }
  }
  else{
    // validar si existe el atributo
    if ($(this).is("[data-more]")) {
      // Convertir a lista GRID
      $(this).html("Contraer");
      $("div[data-more='" + typeservice + "']").removeClass("p-0").html(getLoader());
      serviceRecommendationGrid(typeservice);
    }
  }
});

// RECOMENDADOS ir al perfil del usuario (CLICK IMAGEN)
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

// FILTRADOS ir al perfil del usuario (CLICK NOMBRE)
$("#content-data-filtered").on('click', '.name-user', function () {
  let idusuario = $(this).attr('data-user');
  redirectProfile(idusuario);
});

// Ejecutar buscador
$("#btn-search-services").click(function () {
  serviciobuscado = $("#input-search-service").val().trim();
  iddepartamento = $("#departments-filter").val();

  // Limpiar contenidos
  cleanContainerFiltered();

  // Mostrar o ocultar opciones de filtrados
  if(iddepartamento == "" || iddepartamento == null){
    // Mostrar localidades para volver a filtrar
    $("#content-locations").removeClass("d-none");
  } else {
    // Ocultar localidades
    $("#content-locations").addClass("d-none");
  }
  

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
    generateLoader("#container-filtered-services"); 
    // Operación realizada
    operation = "specialtiesFilteredByServiceAndDepartment";
    
    // Enviar consulta al servidor
    totalSpecialtiesFound({
      op: 'totalSpecialtiesFound',
      nombreservicio: serviciobuscado,
      iddepartamento: iddepartamento
    });

    // Actualizar array asociativo
    dataSend['op']             = operation;
    dataSend['nombreservicio'] = serviciobuscado;
    dataSend['iddepartamento'] = iddepartamento;
    dataSend['offset']         = offset;
    getServicesFiltered();
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

  // Limpiar contenidos
  cleanContainerFiltered();

  // Filtrar servicios con la operación indicada anteriormente
  dataSend['wsize'] = wsize; 
  dataSend['offset'] = offset; 
  getServicesFiltered();
  
});

// MOSTRA - GRID
$("#btn-grid").click(function () {
  wsize = "box-sm";

  // Limpiar contenidos
  cleanContainerFiltered();

  // Filtrar servicios con la operación indicada anteriormente
  dataSend['wsize'] = wsize;
  dataSend['offset'] = offset;
  getServicesFiltered();
});

// Filtrar por departamentos
$("#departments").change(function () {
  iddepartamento = $(this).val();

  // Limpiar contenidos
  cleanContainerFiltered();

  // Operación realizada
  operation = "specialtiesFilteredByServiceAndDepartment";

  // listar provincias
  listProvinces(iddepartamento);

  // Actualizar array asociativo
  dataSend['op']             = operation;
  dataSend['iddepartamento'] = iddepartamento;
  dataSend['nombreservicio'] = serviciobuscado;
  dataSend['offset']         = offset;
  getServicesFiltered();
});

// Filtrar por provincias
$("#provinces").change(function () {
  idprovincia = $(this).val();

  // Limpiar contenidos
  cleanContainerFiltered();

  // Operación realizada
  operation = "specialtiesFilteredByServiceAndProvince";

  // listar distritos
  listDistricts(idprovincia);

  // Actualizar array asociativo
  dataSend['op']          = operation;
  dataSend['idprovincia'] = idprovincia;
  dataSend['offset']      = offset;

  getServicesFiltered();
});

// filtrar por ditritos
$("#districts").change(function () {
  iddistrito = $(this).val();

  // Limpiar contenidos
  cleanContainerFiltered();

  // operación realizada 
  operation = "specialtiesFilteredByServiceAndDistrict";

  // Actualizar array asociativo
  dataSend['op']         = operation;
  dataSend['iddistrito'] = iddistrito;
  dataSend['offset']     = offset;

  getServicesFiltered();
});

// Filtrar por rango de monedas
$("#range-money").change(function () {
  let money = $(this).val();
  arrayMoney = money.split(';');

  $("#money1").val(arrayMoney[0]);
  $("#money2").val(arrayMoney[1]);  
});

// Money start
$("#money1").keyup(function(){
  rangeMoney.update({from: $(this).val() });
});

// Money end
$("#money2").keyup(function(){
  rangeMoney.update({to: $(this).val()});
});

// Boton que ejecuta el filtrado de monedas
$("#btn-filter-money").click(function(){
  // Limpiar contenidos
  cleanContainerFiltered();

  // Operación realizada
  operation = "specialtiesFilteredByServiceAndFee";

  dataSend['op']      = operation;
  dataSend['tarifa1'] = $("#money1").val();
  dataSend['tarifa2'] = $("#money2").val();
  dataSend['offset']  = offset;
  
  getServicesFiltered();
});

// Ordenar filtrado
$("#order-filtered").change(function(){
  order = $(this).val();

  // Limpiar contenidos
  cleanContainerFiltered();

  // Filtrar servicios con el orden establecido
  dataSend['order']  = order;
  dataSend['offset'] = offset;
  getServicesFiltered();
});

// Llenar de datos el control select de departamentos
function listDepartmentsMain() {
  $.ajax({
    url: 'controllers/ubigeo.controller.php',
    type: 'GET',
    data: 'op=getDepartmentsMain',
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
      // texto del botón
      $("button[data-more='recomendation']").html("Ver más");
      $("#carousel-recommended").html(result);

      // Configuración del owl-carousel
      $('.owl-carousel').owlCarousel({
        loop: true,
        dots: false, // Leyenda de pagina
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,  // Navegación
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

// Listar servicios populares
function servicePopularCarousel() {
  // animación de carga
  $("#carousel-popular").html(getLoader());

  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=listCarouselPopular',
    success: function (result) {
      // texto del botón
      $("button[data-more='popular']").html("Ver más");
      $("#carousel-popular").html(result);

      // Configuración del owl-carousel
      $('.owl-carousel').owlCarousel({
        loop: true,
        dots: false, // Leyenda de pagina
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,  // Navegación
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
function serviceRecommendationGrid(typeservice) {
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=listGridRecommendation&typeservice=' + typeservice,
    success: function (result) {
      if (result != "") {
        $("div[data-more='" + typeservice + "']").html(result);
                
      }
    }
  });
}

// Limpiar contenidos filtrados
function cleanContentFiltered(){
  offset = 0;
  offsetTmp = 0;

  // Limpiar contenidos
  $("#content-data-filtered div").remove();
}

// Listar servicios filtrados
function getServicesFiltered() {
  // Mostrar animación de carga
  $("#content-data-filtered").append(getLoader());
  
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: dataSend,
    success: function (result) {
      // Quitar animación de carga
      $("#content-data-filtered div").remove(".container-loader");

      // Mostrar contenidos
      if (result != "" && result != "sin registros") { 
        $("#content-data-filtered").append(result);
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
        $("#span-text-found").html("No se ha encontrado servicios ofrecidos con los filtros actuales");
        $("#total-services-found").html('');
        $("#body-content-filtered").addClass("d-none");
      }
    }
  });
}

// Resetear contenido filtrados - agregados con append
function cleanContainerFiltered(){
  offset = 0;
  offsetTmp = 0;

  // Limpiar contenidos
  $("#content-data-filtered div").remove();
}

// Detectar scroll - al final del contenido
$(".container-box").scroll(function(){
  let result = isFinalContainer(".container-box");
  if(result){
    offsetTmp++;
    offset = offsetTmp * limit;
    dataSend['offset'] = offset;
    getServicesFiltered();
  }
});

// Listar departamentos y recomendados
listDepartmentsMain();
serviceRecommendationCarousel();
servicePopularCarousel();
totalSpecialtiesAvailable();
setInterval(servicePopularCarousel, 60000); // Ejecutar cada 1 Minuto
setInterval(serviceRecommendationCarousel, 120000); // Ejecutar cada 2 Minuto