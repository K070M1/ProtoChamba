<!-- Carousel -->
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.theme.default.min.css">
<link rel="stylesheet" href="dist/css/carousel-owl.css">
<link rel="stylesheet" href="dist/css/pages/main.css">

<div class="wrapper-main">

  <!-- HERO -->
  <div class="hero">
    <div class="title-cover-page">
      <h1 class="text-white text-center">Bienvenido a Q'tal Chamba</h1>
      <h5 class="text-white text-center" >Hoy tenemos <span id="total-services" class="text-bold">0</span> servicios disponibles para ti</h5>
    </div>

    <!-- Buscador de usuarios  -->
    <div id="content-filter-user">
      <div class="row">
        <!-- Filtro de servicio -->
        <div class="col-md-5">
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-solid fa-briefcase text-blue"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Buscar servicio" id="input-search-service" autocomplete="off">
          </div>
        </div>

        <div class="col-md-5">
          <!-- Filtro de ubicaciones -->
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-map-marker-alt text-danger"></i>
              </span>
            </div>
            <select class="custom-select" id="departments-filter">
              <!-- asincronos -->
            </select>
          </div>
        </div>

        <div class="col-md-2">
          <!-- Buscador -->
          <a class="btn btn-lg btn-primary" type="button" href="javascript:void(0)" id="btn-search-services">
            <span class="icon-search"><i class="fas fa-search"></i></span>
            <span class="text-sm-show">Buscar servicios</span>
          </a>
        </div>

      </div>
    </div>
  </div>
  <!-- //HERO -->

  <!-- SERVICES RECOMENDADOS -->
  <div class="container-services mt-4 " id="content-carousels">
    <!-- carouseles 1 -->
    <div class='card'>
      <div class='card-header'>
        <div class='row'>
          <div class='col-6 col-xs-6'>
            <h5 class='text-bold text-uppercase'>Más populares</h5>
          </div>
          <div class='col-6 col-xs-6 text-right'>
            <button type='button' class='btn btn-sm btn-dark btn-more-content' data-more='popular' > Ver más</button>
          </div>
        </div>
      </div>
      <div class='card-body  pt-2' data-more='popular' id="carousel-popular">
        <!-- carouseles  cargados de forma asincrono -->
      </div>
    </div>

    <!-- carouseles 2 -->
    <div class='card'>
      <div class='card-header'>
        <div class='row'>
          <div class='col-6 col-xs-6'>
            <h5 class='text-bold text-uppercase'>Recomendados </h5>
          </div>
          <div class='col-6 col-xs-6 text-right'>
            <button type='button' class='btn btn-sm btn-dark btn-more-content' data-more='recomendation' > Ver más</button>
          </div>
        </div>
      </div>
      <div class='card-body  pt-2' data-more='recomendation' id="carousel-recommended">
        <!-- carouseles  cargados de forma asincrono -->
      </div>
    </div>

  </div>
  <!-- /. SERVICES RECOMENDADOS -->

  <!-- FILTRADOS -->  
  <div class="container-filtered-services d-none mt-4" id="container-filtered-services">
    <!-- Texto - cantidad de coincidencias encontradas-->
    <div class="row" id="header-content-filtered">
      <div class="col-md-12">
        <div class="callout callout-info">
          <h5><i class="fas fa-laptop-house"></i> <span class="text-bold" id="total-services-found"></span> <span id="span-text-found">servicios ofrecidos</span></h5>
        </div>
      </div>
    </div>

    <!-- contenidos de las cajas de presentación-->
    <div class="row d-none" id="body-content-filtered">
      <!-- left filtros internos -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title text-bold">Filtros</h6>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body container-filter">

            <!-- filtro por tarifas -->
            <div class="content-filter-tarifa mb-3">
              <button type="button" class="btn btn-info btn-sm btn-block" data-toggle="collapse" data-target="#fee" >
                Rango de monedas
              </button>

              <div class="collapse" id="fee">
                <div class="card card-body">
                  <input id="range-money" type="text">
                  <div class="row mt-1">
                    <div class="col-6 form-group">
                      <input type="number" id="money1" class="form-control" value="50" placeholder="Min">
                    </div>
                    <div class="col-6 form-group">
                      <input type="number" id="money2" class="form-control" value="8000" placeholder="Max">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button class="btn btn-sm btn-block btn-primary" id="btn-filter-money">Filtrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /. filtro por tarifas -->

            <!-- localidades -->
            <div class="mb-3 d-none" id="content-locations">
              <button type="button" class="btn btn-info btn-sm btn-block" data-toggle="collapse" data-target="#locations" >Localidad</button>

              <div class="collapse" id="locations">
                <div class="card card-body">
                  <!-- Departamentos -->
                  <div class="form-group">
                    <label for="departments">Departamentos</label>
                    <select class="custom-select" id="departments">
                      <!-- asincronos -->
                    </select>
                  </div>

                  <!-- provincias -->
                  <div class="form-group">
                    <label for="provinces">Provincia</label>
                    <select class="custom-select" id="provinces">
                      <option value="">Provincias</option>
                    </select>
                  </div>
                  
                  <!-- distritos -->
                  <div class="form-group">
                    <label for="ditricts">Distrito</label>
                    <select class="custom-select" id="districts">
                      <option value="">Distritos</option>                    
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="container-img-map">
              <img src="dist/img/map.png" >
              <div>
                <a href="index.php?view=geolocalizacion-view" class="btn btn-sm btn-primary">Ver en el mapa</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>

      <!-- right contenido servicios -->
      <div class="col-md-8">
        <!-- Card quecontiene los box -->
        <div class="card">
          <div class="card-header ">
            <div class="row">
              <div class="col-6">
                <div class="row">
                  <label for="inputPassword" class="col-4 col-form-label">Ordenar:</label>
                  <div class="col-8">
                    <select class="custom-select" id="order-filtered">
                      <option value="N">Nombre</option>
                      <option value="F">Fecha</option>
                      <option value="S">Salario</option>
                      <option value="E">Estrellas</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6 text-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-dark" id="btn-grid"><i class="fas fa-th"></i></button>
                  <button type="button" class="btn btn-dark" id="btn-list"><i class="fas fa-list" ></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- contenido de los servicios -->
          <div class="card-body container-box">
            <div class="flex-box" id="content-data-filtered">
              <!-- Sin registro encontrado por default -->
            </div>     
            <!-- /.Corta sm -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /. FILTRADOS -->  
  
</div> <!-- Fin del weaper main  -->

<!-- owl carousel -->
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script>
<script src="dist/js/pages/main.js"></script>