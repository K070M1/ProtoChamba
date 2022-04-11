<link rel="stylesheet" href="./dist/css/pages/geos.css">
<script src="https://kit.fontawesome.com/9db627a8a9.js" crossorigin="anonymous"></script>    

<div class="geo">
  <!-- <h2>UBICACIÓN DE ESTABLECIMIENTOS CERCANOS</h2> -->

  <div class="geo-info">

    <div class="info-col">
      <div class="txt">
        <h3>Establecimientos:</h3>
      </div>
      <div class="geo-intro" id="lista-establecimientos">
        <div class="card-geo" id="{establecimiento.idestablecimiento}">
          <div class="info-info">

            <div class="iman">
              <img src="dist/img/house.png" alt=""> 
            </div>
            <div class="info">
              <div class="linea1">
                <div>
                  <h5>25 comen</h5>
                </div>
                <div class="star">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-regular fa-star"></i>  
                </div>
              </div>
              <h3>{establecimiento.establecimiento}</h3>
              <h5>Electricista<button class="btn  btn-outline-info">Ver</button></h5>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="post-col">
        <div class="geo-der">
          <h3>Mapa: </h3>
          <hr>
          <div id="primary-map" style="width: 100%; height: 480px"></div>

          <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15523.146567111802!2d-76.14548722093855!3d-13.425529598205369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91101686897e15b7%3A0x471a0acba7a881d!2sChincha%20Alta%2011702!5e0!3m2!1ses!2spe!4v1648176214359!5m2!1ses!2spe" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->

        </div>
      
    </div>
  </div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyBhbKb3BeyxJ-BBV9bsv0nA61dVbpA6E&callback=startMap"></script>
<script>
  var establecimientosInfo = [];
  function startMap() {
   $.ajax({
     url: 'controller/Establishment.controller.php',
     type: 'GET',
     dataType: 'JSON',
     data: {
       'op': 'getEstablishments'
     },
     success: establecimientos => {
      var template = String($('#lista-establecimientos').html());
      $('#lista-establecimientos').empty();
      establecimientos.forEach(establecimiento => {
        let establecimientoInfo = {
          posicion: {
            lat: parseFloat(establecimiento.latitud),
            lng: parseFloat(establecimiento.longitud)
          },
          nombre: establecimiento.establecimiento
        };
        establecimientosInfo.push(establecimientoInfo);

        // MOSTRAR ESTABLECIMIENTOS
        $('#lista-establecimientos').append(template
          .replaceAll('{establecimiento.idestablecimiento}', establecimiento.idestablecimiento)
          .replaceAll('{establecimiento.establecimiento}', establecimiento.establecimiento)
        )
      });
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(miPosicion => {
          let ubicacion = {
            lat: miPosicion.coords.latitude,
            lng: miPosicion.coords.longitude
          }
          drawMap(ubicacion);
        })
      }
      console.log(establecimientosInfo)
   }})
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
      return new google.maps.Marker({
        position: lugar.posicion,
        title: lugar.nombre,
        map: mapa
      })
    })
  }
</script>