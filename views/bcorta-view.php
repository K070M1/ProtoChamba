<link rel="stylesheet" href="dist/css/pages/bcorta.css">


<!-- HERO -->
<div class="hero align-items-center" style="height: 50vh;" id="home">
  <div class="titulos mt-0">
    <h1 class=" text-center display-3 text-white mt-0 ">Bienvenido a Q'tal Chamba</h1>
    <h5 class="text-white text-center">Hoy tenemos 150 servicios disponibles para ti</h5>
  </div>
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Ingrese el Servicio" aria-label="Recipient's username with two button addons"><br>
    <i class="fas fa-briefcase" id="iconowork"></i>
    <input type="text" class="form-control" placeholder="Ingrese la ubicacion" aria-label="Recipient's username with two button addons"><br>
    <i class="fas fa-map-marker-alt" id="iconolocation"></i>
    <a href="#" class="btn btn-outline-light">Buscar Servicios</a>
  </div>

</div><!-- //HERO -->

<!-- SERVICES -->
<div class="servicios">
  <div class="recomendados">
    <div class="row">
      <div class="col-md-6">
        <h3 class="text-center" style="margin-right: 43%;">Coincidencias Encontradas</h3>
      </div>
      <div class="col-md-2">
        <h4 class="text-center" style="margin-left: 40%;">Ordenar por :</h4>
      </div>
      <div class="col-md-2">
        <select class="form-control" id="exampleFormControlSelect1">
          <option selected>Seleccione</option>
          <option>Electiricistas</option>
          <option>Mecanicos</option>
          <option>Gasfitero</option>
        </select>
      </div>

    </div>
  </div>


  <div class="row">
    <div class="col-md-4">
      <div class="card-filtro">
        <h5 class="card-header text-center">Filtrar</h5>
        <div class="card-body">
          <div class="row">

            <div class="col-6">
              <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Nivel de Estrellas</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Tarifas</a>
              </div>
            </div>

            <div class="col-6">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      1 estrella
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                      2 estrellas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                      3 estrellas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                      4 estrellas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                      5 estrellas
                    </label>
                  </div>
                </div><!-- Fin del tabab-1 -->

                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                      50-86
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                      50-86
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                      50-86
                    </label>
                  </div>
                </div><!-- Fin del tab-2 -->
              </div>

            </div><!-- FIN DEK ROW -->
          </div><!-- fin del card-body -->
        </div><!-- Fin del card -->
      </div><!-- Fin del col-md-4 -->

    </div><!-- Fin del row 4 -->

    <div class="col-md 8">
      <div class="caja">

        <ul class="nav nav-pills" style="margin-left:80%;" id="pills-tab" role="tablist">

          <li class="nav-item " role="presentation">
            <a class="nav-link active " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-th" id="icono-grid"></i></a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-list" id="icono-lista"></i></a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="content-flex">
              <div class="card">
                <div class="card-header">
                  <div class="box-left">
                    <img src="dist/img/avatar2.png">
                  </div>
                  <!-- /. box left -->
                  <div class="box-right">
                    <div class="icons">
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>
                    <!-- /. icons -->
                    <div class="name-user">


                    </div>
                  </div>
                  <!-- /.box right -->
                </div>
                <div class="card-body">
                  <div class="contacts">
                    <a href="#"><i class="fas fa-solid fa-envelope"></i> <span>Correo electronico</span></a>
                    <a href="#"><i class="fas fa-solid fa-phone"></i> <span>Comunicarse</span></a>
                    <a href="#"><i class="fas fa-map-marker-alt"></i> <span>Ubicación</span></a>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="social-media">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <div class="box-left">
                    <img src="dist/img/avatar2.png">
                  </div>
                  <!-- /. box left -->
                  <div class="box-right">
                    <div class="icons">
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>
                    <!-- /. icons -->
                    <div class="name-user">


                    </div>
                  </div>
                  <!-- /.box right -->
                </div>
                <div class="card-body">
                  <div class="contacts">
                    <a href="#"><i class="fas fa-solid fa-envelope"></i> <span>Correo electronico</span></a>
                    <a href="#"><i class="fas fa-solid fa-phone"></i> <span>Comunicarse</span></a>
                    <a href="#"><i class="fas fa-map-marker-alt"></i> <span>Ubicación</span></a>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="social-media">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-flex">



            </div>
            <div class="content-flex">

            </div>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="card-blarga">
              <div class="row">
                <div class="col-md-4" style="background-color: black;">

                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <div class="iconos">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="far fa-star"></i>
                      <i class="far fa-star"></i>
                    </div>
                    <div class="info-servicios">
                      <h4 class="text-white">Jesus Peve Andazabal</h4>
                      <h6 class="text-white">Carpintero - Gasfitero</h6>
                      <h6 class="text-white">Tarifa estimada : s/250.00</h6>
                      <hr style="background-color:white;">
                      <h6 class="text-white">Establecimiento : Ubicado en Av. Lt 250</h6>
                      <div class="redes-sociales">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-whatsapp"></i>
                      </div>
                    </div><!-- Fin del info-srvicios -->
                  </div><!-- fin del card-body -->
                </div><!-- Fin del col--md-8 -->
              </div><!-- fin del row -->
            </div><!-- Fin del card -->

            <div class="card-blarga">
              <div class="row">
                <div class="col-md-4" style="background-color: black;">

                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <div class="iconos">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="far fa-star"></i>
                      <i class="far fa-star"></i>
                    </div>
                    <div class="info-servicios">
                      <h4 class="text-white">Jesus Peve Andazabal</h4>
                      <h6 class="text-white">Carpintero - Gasfitero</h6>
                      <h6 class="text-white">Tarifa estimada : s/250.00</h6>
                      <hr style="background-color:white;">
                      <h6 class="text-white">Establecimiento : Ubicado en Av. Lt 250</h6>
                      <div class="redes-sociales">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-whatsapp"></i>
                      </div>
                    </div><!-- Fin del info-srvicios -->
                  </div><!-- fin del card-body -->
                </div><!-- Fin del col--md-8 -->
              </div><!-- fin del row -->
            </div><!-- Fin del card -->

            <div class="card-blarga">
              <div class="row">
                <div class="col-md-4" style="background-color: black;">

                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <div class="iconos">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="far fa-star"></i>
                      <i class="far fa-star"></i>
                    </div>
                    <div class="info-servicios">
                      <h4 class="text-white">Jesus Peve Andazabal</h4>
                      <h6 class="text-white">Carpintero - Gasfitero</h6>
                      <h6 class="text-white">Tarifa estimada : s/250.00</h6>
                      <hr style="background-color:white;">
                      <h6 class="text-white">Establecimiento : Ubicado en Av. Lt 250</h6>
                      <div class="redes-sociales">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-whatsapp"></i>
                      </div>
                    </div><!-- Fin del info-srvicios -->
                  </div><!-- fin del card-body -->
                </div><!-- Fin del col--md-8 -->
              </div><!-- fin del row -->
            </div><!-- Fin del card -->
          </div>
        </div>
      </div> <!-- Fin de la caja que contiene los cards -->
    </div><!-- Fin del col-md-8 -->
  </div> <!-- fin del row principal -->


</div><!-- Fin de la seccion servivcios -->