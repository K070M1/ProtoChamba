<link rel="stylesheet" href="./dist/css/pages/geos.css">
<script src="https://kit.fontawesome.com/9db627a8a9.js" crossorigin="anonymous"></script>

<div class="row">
  <div class="col-md-4 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Lista de establecimientos</h5>
      </div>

      <div class="card-body" style="max-height: calc(100vh - 200px); overflow-y: auto; ">
        <form id="search-servicio" class="input-group mb-3">
          <input id="servicio-buscado" type="text" class="form-control" placeholder="Ingrese un servicio">
          <span class="input-group-append">
            <button type="submit" class="btn btn-info fas fa-search"></button>
          </span>
        </form>
        <div id="lista-establecimientos">
          <div class="info-box mt-1 mb-0" id="{idestablecimiento}">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">{establecimiento} ({nombreservicio})</span>
              <small>{apellidos}, {nombres}</small>
              <small>Horario: {horarioatencion}</small>
              <button class="btn btn-sm btn-primary">
                <i class="fa fa-route"></i>
                Ver ruta <span id="distancia"></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Mapa</h5>
      </div>

      <div class="card-body p-0">
        <div id="primary-map" style="width: 100%; height: calc(100vh - 200px);"></div>
      </div>
    </div>
  </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyBhbKb3BeyxJ-BBV9bsv0nA61dVbpA6E&callback=startMap"></script>
<script>

  $('#search-servicio').submit(function(e) {
    e.preventDefault();
    startMap();
  })

  var template = String($('#lista-establecimientos').html());
  var establecimientosInfo = [];

  // Convierte grados a radianes
  function deg2rad(deg) {
    return deg * (Math.PI / 180)
  }

  // función para calcular la distancia entre dos puntos
  function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    console.log(lat1, lon1, lat2, lon2);
    var R = 6371; // Radio de la tierra en km
    var dLat = deg2rad(lat2 - lat1); // Grados a radianes
    var dLon = deg2rad(lon2 - lon1);
    var a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
      Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    if (d >= 1) {
      return '(' + (Math.round(d * 100) / 100) + " km)";
    } else if (d < 1) {
      return '(' + Math.round(d * 1000) + " m)";
    } else {
      return '';
    };
  }

  function startMap() {
    let miubicacion = {};
    var nombreservicio = $('#servicio-buscado').val();
    $.ajax({
      url: 'controllers/establishment.controller.php',
      type: 'GET',
      dataType: 'JSON',
      data: {
        'op': 'getEstablishmentByService',
        'nombreservicio': nombreservicio
      },
      success: establecimientos => {
        $('#lista-establecimientos').empty();
        establecimientosInfo = [];
        establecimientos.forEach(establecimiento => {
          let establecimientoInfo = {
            id: establecimiento.idestablecimiento,
            posicion: {
              lat: parseFloat(establecimiento.latitud),
              lng: parseFloat(establecimiento.longitud)
            },
            nombre: establecimiento.establecimiento
          };
          establecimientosInfo.push(establecimientoInfo);

          // MOSTRAR ESTABLECIMIENTOS
          var e_template = template;
          for (key in establecimiento) {
            e_template = e_template.replaceAll('{' + key + '}', establecimiento[key]);
          }
          $('#lista-establecimientos').append(e_template)
        });
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(miPosicion => {
            miubicacion = {
              lat: miPosicion.coords.latitude,
              lng: miPosicion.coords.longitude
            }
            drawMap(miubicacion);
          })
        }
      }
    })
  }

  function drawMap(obj) {
    let div = document.getElementById('primary-map');
    let mapa = new google.maps.Map(div, {
      center: obj,
      zoom: 13
    });
    let marcadorUsuario = new google.maps.Marker({
      position: obj,
      title: 'Tu ubicación',
      map: mapa
    })

    let marcadores = establecimientosInfo.map(lugar => {
      $(`#${lugar.id} #distancia`).text(getDistanceFromLatLonInKm(obj.lat, obj.lng, lugar.posicion.lat, lugar.posicion.lng));
      return new google.maps.Marker({
        position: lugar.posicion,
        title: lugar.nombre,
        map: mapa
      })
    })
  }
</script>