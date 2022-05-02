<!-- Carousel -->
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.theme.default.min.css">
<link rel="stylesheet" href="dist/css/carousel-owl.css">
<link rel="stylesheet" href="dist/css/pages/main.css">

<!-- owl carousel -->
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script>
<!-- <script src="dist/js/config.owl.carousel.js"></script> -->

<div class="wrapper-main">

  <!-- HERO -->
  <div class="hero">
    <div class="title-cover-page">
      <h1 class="text-white text-center">Bienvenido a Q'tal Chamba</h1>
      <h5 class="text-white text-center">Hoy tenemos 150 servicios disponibles para ti</h5>
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
            <input type="text" class="form-control" placeholder="Escribe el servicio" id="input-search-service" autocomplete="off">
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
            <select class="custom-select" id="departments">
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
  </div><!-- //HERO -->


  <!-- SERVICES RECOMENDADOS -->
  <div class="container-services mt-4 " id="content-carousels">
    <!-- Secciòn de carouseles -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-6 col-xs-6">
            <h5 class="text-bold">Albañiles</h5>
          </div>
          <div class="col-6 col-xs-6 text-right">
            <button type="button" class="btn btn-sm btn-dark btn-more-content" data-more="contenido"> Ver Más</button>
          </div>
        </div>
      </div>
      <div class="card-body  pt-2" data-more="contenido">
        <div class="owl-carousel carousel-1">
          <!-- caja 1 -->
          <div class="box box-sm outline-dark-salmon">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>

                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>

                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>

                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
          <!-- caja 1 -->
          <div class="box box-sm outline-dark-salmon">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>

                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>

                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>

                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
          <!-- caja 1 -->
          <div class="box box-sm outline-dark-salmon">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>

                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>

                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>

                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
          <!-- caja 1 -->
          <div class="box box-sm outline-dark-salmon">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>

                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>

                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>

                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
         
        </div>
      </div>
    </div>
  </div><!-- Fin de la seccion servicios -->

  <!-- FILTRADOS -->  
  <div class="container-filtered-services d-none mt-4" id="container-filtered-services">
    <!-- Texto - cantidad de coincidencias encontradas-->
    <div class="row">
      <div class="col-md-12">
        <div class="callout callout-info">
          <h5><i class="fab fa-servicestack"></i> Coincidencias encontrado <span class="text-bold">150</span> servicios</h5>
        </div>
      </div>
    </div>

    <!-- contenidos de las cajas de presentación-->
    <div class="row">
      <!-- left filtros internos -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title text-bold">Filtros</h6>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body container-filter">

            <!-- Filtro por estrellas -->
            <div class="content-filter-start mb-3">
              <button class="btn btn-info btn-sm btn-block" type="button" data-toggle="collapse" data-target="#stars">
                Filtro por Estrellas
              </button>
              
              <div class="collapse" id="stars">
                <div class="card card-body">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      1 estrellas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      2 estrellas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      3 estrellas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      4 estrellas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      5 estrellas
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.Filtro por estrellas -->

            <!-- filtro por tarifas -->
            <div class="content-filter-tarifa mb-3">
              <button type="button" class="btn btn-info btn-sm btn-block" data-toggle="collapse" data-target="#fee" >
                Rango de monedas
              </button>

              <div class="collapse" id="fee">
                <div class="card card-body">
                  <input id="range-money" type="text">
                </div>
              </div>
            </div>
            <!-- /. filtro por tarifas -->

            <!-- localidades -->
            <div class="mb-3">
              <button type="button" class="btn btn-info btn-sm btn-block" data-toggle="collapse" data-target="#locations" >Localidad</button>

              <div class="collapse" id="locations">
                <div class="card card-body">
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
                <a href="index.php?view=geolocalizacion-view" id="btn-open-map" class="btn btn-sm btn-primary">Ver en el mapa</a>
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
                  <label for="inputPassword" class="col-4 col-form-label">Ordenar por:</label>
                  <div class="col-8">
                    <select class="form-control" name="" id="">
                      <option value="">Relevantes</option>
                      <option value="">Recientes</option>
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

              <!-- Cajas lg -->
              <div class="box box-body outline-crimson">
                <div class="row">
                  <div class="col-left">
                    <!-- Imagen -->
                    <div class="content-img">
                      <a href="javascript:void(0)" class="link-user">
                        <img class="img-user" src="dist/img/user/202204220110301.jpg">
                      </a>
                    </div>
                  </div>

                  <div class="col-right">
                    <!-- nombre -->
                    <div class="row margin-0 content-name-user">
                      <div class='box-left'>
                        <a href="#" class="name-user">
                          <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                        </a>
                        <div class='contacts'>
                          <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                          <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                        </div>
                      </div>
                      <div class='box-right'>
                        <div class='icons-score'>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                        </div>
                      </div>
                    </div>
                    <hr>

                    <!-- Descripción -->
                    <div class="row margin-0 content-service">
                      <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                      <span class="fee"> S/. 452</span>
                      <p class="description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                      </p>
                    </div>

                    <!-- Redes soaciles y ubicación -->
                    <div class="row margin-0 content-social-location ">
                      <!-- ubicación -->
                      <div class="box-left">
                        <a href='#' class="location"><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                      </div>

                      <!-- redes sociales -->
                      <div class='social-media box-right'>
                        <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                        <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                        <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                      </div>
                    </div>
                  </div>
                  <!-- ./ col-md-8 -->
                </div>
              </div>
              <!-- Cajas lg -->
              <div class="box box-body outline-crimson">
                <div class="row">
                  <div class="col-left">
                    <!-- Imagen -->
                    <div class="content-img">
                      <a href="javascript:void(0)" class="link-user">
                        <img class="img-user" src="dist/img/user/202204220110301.jpg">
                      </a>
                    </div>
                  </div>

                  <div class="col-right">
                    <!-- nombre -->
                    <div class="row margin-0 content-name-user">
                      <div class='box-left'>
                        <a href="#" class="name-user">
                          <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                        </a>
                        <div class='contacts'>
                          <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                          <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                        </div>
                      </div>
                      <div class='box-right'>
                        <div class='icons-score'>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                        </div>
                      </div>
                    </div>
                    <hr>

                    <!-- Descripción -->
                    <div class="row margin-0 content-service">
                      <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                      <span class="fee"> S/. 452</span>
                      <p class="description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                      </p>
                    </div>

                    <!-- Redes soaciles y ubicación -->
                    <div class="row margin-0 content-social-location ">
                      <!-- ubicación -->
                      <div class="box-left">
                        <a href='#' class="location"><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                      </div>

                      <!-- redes sociales -->
                      <div class='social-media box-right'>
                        <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                        <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                        <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                      </div>
                    </div>
                  </div>
                  <!-- ./ col-md-8 -->
                </div>
              </div>              
              <!-- /. box-body -->              
              
              <!-- Corta sm -->
              <div class="box box-sm box-body outline-crimson">
                <div class="row">
                  <div class="col-left">
                    <!-- Imagen -->
                    <div class="content-img">
                      <a href="javascript:void(0)" class="link-user">
                        <img class="img-user" src="dist/img/user/202204220110301.jpg">
                      </a>
                    </div>
                  </div>

                  <div class="col-right">
                    <!-- nombre -->
                    <div class="row margin-0 content-name-user">
                      <div class='box-left'>
                        <a href="#" class="name-user">
                          <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                        </a>
                        <div class='contacts'>
                          <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                          <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                        </div>
                      </div>
                      <div class='box-right'>
                        <div class='icons-score'>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                        </div>
                      </div>
                    </div>
                    <hr>

                    <!-- Descripción -->
                    <div class="row margin-0 content-service">
                      <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                      <span class="fee"> S/. 452</span>
                      <p class="description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                      </p>
                    </div>

                    <!-- Redes soaciles y ubicación -->
                    <div class="row margin-0 content-social-location ">
                      <!-- ubicación -->
                      <div class="box-left">
                        <a href='#' class="location"><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                      </div>

                      <!-- redes sociales -->
                      <div class='social-media box-right'>
                        <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                        <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                        <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                      </div>
                    </div>
                  </div>
                  <!-- ./ col-md-8 -->
                </div>
              </div>
              <div class="box box-sm box-body outline-crimson">
                <div class="row">
                  <div class="col-left">
                    <!-- Imagen -->
                    <div class="content-img">
                      <a href="javascript:void(0)" class="link-user">
                        <img class="img-user" src="dist/img/user/202204220110301.jpg">
                      </a>
                    </div>
                  </div>

                  <div class="col-right">
                    <!-- nombre -->
                    <div class="row margin-0 content-name-user">
                      <div class='box-left'>
                        <a href="#" class="name-user">
                          <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                        </a>
                        <div class='contacts'>
                          <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                          <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                        </div>
                      </div>
                      <div class='box-right'>
                        <div class='icons-score'>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star active'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                          <i class='fas fa-star'></i>
                        </div>
                      </div>
                    </div>
                    <hr>

                    <!-- Descripción -->
                    <div class="row margin-0 content-service">
                      <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                      <span class="fee"> S/. 452</span>
                      <p class="description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                      </p>
                    </div>

                    <!-- Redes soaciles y ubicación -->
                    <div class="row margin-0 content-social-location ">
                      <!-- ubicación -->
                      <div class="box-left">
                        <a href='#' class="location"><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                      </div>

                      <!-- redes sociales -->
                      <div class='social-media box-right'>
                        <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                        <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                        <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                      </div>
                    </div>
                  </div>
                  <!-- ./ col-md-8 -->
                </div>
              </div>
        
            </div>     
            <!-- /.Corta sm -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /. Filtrados -->  


  <!-- CONTENIDO GRID -->
  <div class="card d-none">
    <div class="card-header">
      <h5>GRID</h5>
    </div>
    <div class="card-body container-grid">
      <!-- cajas-->
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="box box-sm outline-deepSkyBlue">
            <!-- Cuerpo -->
            <div class="box-body">
              <div class="row">
                <div class="col-left">
                  <!-- Imagen -->
                  <div class="content-img">
                    <a href="javascript:void(0)" class="link-user">
                      <img class="img-user" src="dist/img/user/202204220110301.jpg">
                    </a>
                  </div>
                </div>
  
                <div class="col-right">
                  <!-- nombre -->
                  <div class="row margin-0 content-name-user">
                    <div class='box-left'>
                      <a href="#" class="name-user">
                        <span class="single-line">Javier Eduardo Carrillos Gonzales</span>
                      </a>
                      <div class='contacts'>
                        <a href='#' class="btn btn-sm btn-success"><i class="fas fa-phone-alt"></i> <span>Llamar</span> </a>
                        <a href='#' class="btn btn-sm btn-info"><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                      </div>
                    </div>
                    <div class='box-right'>
                      <div class='icons-score'>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star active'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                      </div>
                    </div>
                  </div>
                  <hr>
  
                  <!-- Descripción -->
                  <div class="row margin-0 content-service">
                    <span class="name-service"><i class="fab fa-accusoft"></i> Servicio</span>
                    <p class="description">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum deleniti porro nisi rerum doloremque? Atque exercitationem beatae ratione voluptate.
                    </p>
                  </div>
  
                  <!-- Redes soaciles y ubicación -->
                  <div class="row margin-0 content-social-location ">
                    <!-- ubicación -->
                    <div class="location box-left">
                      <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                    </div>
  
                    <!-- redes sociales -->
                    <div class='social-media box-right'>
                      <a href='#'><i class='icon-facebook fab fa-facebook-f'></i></a>
                      <a href='#'><i class='icon-instagram fab fa-instagram'></i></a>
                      <a href='#'><i class='icon-whatsapp fab fa-whatsapp'></i></a>
                    </div>
                  </div>
                </div>
                <!-- ./ col-md-8 -->
              </div>
            </div> <!-- /. box-body -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /. CONTENIDO GRID  -->
  
</div> <!-- Fin del weaper main  -->
<script src="dist/js/pages/main.js"></script>