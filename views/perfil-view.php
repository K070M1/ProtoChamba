<!-- css perfil -->
<link rel="stylesheet" href="./dist/css/pages/perfil.css">
<link rel="stylesheet" href="./dist/css/pages/styleGaleria.css">

<!-- videojs -->
<link rel="stylesheet" href="plugins/video-js/video.min.css">

<!-- owl-Carousel -->
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.theme.default.min.css">

<!-- styles propios -->
<link rel="stylesheet" href="dist/css/pages/service-qualification.css" />
<link rel="stylesheet" href="dist/css/pages/style-video.css">
<link rel="stylesheet" href="dist/css/uploadFile.css">
<link rel="stylesheet" href="dist/css/carousel-owl.css">

<div class="container">

  <!--Contenido-->
  <section class="perfil-usuario align-items-end">
    <div class="contenedor-perfil">
      <div class="portada-perfil">

        <div class="sombra"></div>
        <div class="avatar-perfil">
          <img src="./dist/img/user1.jpg" alt="">
          <a href="#" class="cambiar-foto" id="idfoto">
              <i class="fas fa-camera"></i> 
              <span>Cambiar foto</span>
          </a>
        </div>

        <div class="btnfile" style="display: none;">
          <input type="file" id="fileFotografia" accept=".jpg" name="archivoImagen">
        </div>
        <div class="datos-perfil">
          <h4 class="titulo-usuario" id="nombreUsu">nombreUsuario</h4>
        </div>
        <div class="opcciones-perfil">
          <button type=""><i class="fas fa-camera"></i> Portada</button>
        </div>
      </div>
    </div>


    <div class="row">
      <!-- <div class="col-md-4">

          </div> -->
      <div class="col-md-7 col-sm-6 col-xs-6 justify-content-end">
        <!-- Seccion de segui... -->
        <div class="container1">
          <div>
            <h6>Sigues</h6>
            <h6>Seguidores</h6>
          </div>
          <div>
            <div class="amigoss">
              <table class="table-segui">
                <tbody id="conteosegui">
                  <!-- Cargado de forma dinamica -->
                </tbody>
              </table>
            </div>
            <div class="amigoss">
              <table class="table-seguid">
                <tbody id="conteoseguid">
                  <!-- Cargado de forma dinamica -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-3 col-sm-6 col-xs-6 ">
        <!-- Seccion de CALIFICACIONES -->
        <div class="container2">
          <div>
            <h6>Calificaciones</h6>
          </div>
          <div class="stars">

            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas  fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <div class="nivel">
            <h6>Excelente</h6>
          </div>
        </div>
        <!-- fin de seccion CALIFICACIONES -->
      </div>
      <div class="col-md-2 col-sm-12">
        <button class="btn btn-info" id="btnseguir">Seguir</button>
      </div>


    </div>


  </section>
  <!--====  End section  ====-->

</div>

<!-- === Inicio de nav === -->
<div class="contenedor-perfil">
  <nav style="margin-top: 3rem">
    <div class="nav nav-tabs justify-content-center text-danger" id="nav-tab" role="tablist">
      <a class="nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">General</a>
      <a class="nav-link" id="nav-informacion-tab" data-toggle="tab" href="#nav-informacion" role="tab" aria-controls="nav-informacion" aria-selected="false">Información</a>
      <a class="nav-link" id="nav-amigos-tab" data-toggle="tab" href="#nav-amigos" role="tab" aria-controls="nav-amigos" aria-selected="false">Amigos</a>
      <a class="nav-link" id="nav-configuracion-tab" data-toggle="tab" href="#nav-servicios" role="tab" aria-controls="nav-servicios" aria-selected="false">Servicios</a>
      <a class="nav-link" id="nav-galeria-tab" data-toggle="tab" href="#nav-galeria" role="tab" aria-controls="nav-galeria" aria-selected="false">Galeria</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <!-- General nav -->
    <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">

      <div class="contenedor-perfil">
        <div class="profile-info">
          <div class="info-col">
            <div class="profile-intro">
              <h3>Información:</h3>
              <hr>
              <ul>
                <li><i class="fas fa-scroll"></i>Electricista</li>
                <li><i class="fas fa-business-time"></i> Horario: 24/7</li>
                <li><i class="fas fa-hashtag"></i> Redes Sociales: <i class="fa-brands fa-facebook"></i><i class="fa-brands fa-whatsapp"></i></li>
                <li><i class="fas fa-map-marker-alt"></i>Establecimiento:</li>
                <li><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15523.146567111802!2d-76.14548722093855!3d-13.425529598205369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91101686897e15b7%3A0x471a0acba7a881d!2sChincha%20Alta%2011702!5e0!3m2!1ses!2spe!4v1648176214359!5m2!1ses!2spe" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></li>
              </ul>
            </div>
          </div>
          <div class="post-col">
            <div class="sdasd">
              <div class="profile-der">
                <h3>Descripción: </h3>
                <hr>
                <p>
                  Q' Tal Chamba empresa dedicada al desarrollo de proyectos y obras de ingeniería eléctrica así como el mantenimiento eléctrico de las diversas redes de distribución en el sur medio del país, en la región de Ica, parte de Huancavelica y Ayacucho; y actualmente parte de Grupo Energía Bogotá, nos encontramos en búsqueda de talento humano para el puesto de Técnico Electricista Las posiciones requeridas son para la sede: Ica


                <h6 style="font-weight: bold;">BENEFICIOS</h6>
                <ul>
                  <li>*Predisposición y buena actitud para el trabajo.</li>
                  <li>*Trabajo en equipo.</li>
                  <li>*Proactividad</li>
                  <li>*Integridad</li>
                </ul>

                <h6 style="font-weight: bold;">DATOS INFO</h6>
                <ul>
                  <li>*Registro en planilla desde el primer día + beneficios que por ley corresponden.</li>
                  <li>*Seguro vida ley.</li>
                  <li>*Capacitaciones.</li>
                  <li>*Oportunidad de línea de Carrera.</li>
                </ul>

                <h6 style="font-weight: bold;">COMPETENCIA</h6>
                <ul>
                  <li>*Educación mínima: Técnico</li>
                  <li>*2 años de experiencia</li>
                  <li>*Edad: A partir de 23 años</li>
                  <li>*Residir en Ica.</li>
                  <li>*Personas con discapacidad: Sí</li>
                </ul>

                <h6 style="font-weight: bold;">REQUISITOS:</h6>
                <ul>
                  <li>*Egresado/Titulado de carrera técnica en electricidad.</li>
                  <li>*Contar un 1 o 2 años como mínimo de experiencia en puesto similares y del rubro.</li>
                  <li>*Experiencia en terminación y subterráneos, control de calidad entre otros.</li>
                  <li>*Residir en Ica.</li>
                  <li>*Licencia de manejo de AI /AIIB.</li>
                </ul>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- fin general nav -->

    <!--Información nav-->
    <div class="tab-pane fade " id="nav-informacion" role="tabpanel" aria-labelledby="nav-informacion-tab" style="margin-top: 2em;">
      <div class="row">
        <div class="col-3">
          <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Información General</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Informacion de contacto</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">otros enlaces</a>
          </div>
        </div>
        <div class="col-9">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <ul>

                <p>
                  <button id="btnC" class="btn btn-outline-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-plus-circle" style="color: rgb(190, 190, 190);">
                    </i>Agregar Servicio
                  </button>
                </p>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <label for="">Nombre del Servicio:</label>
                    <input type="text" class="form-control">
                    <label for="">Horario de Atención:</label>
                    <input type="date" class="form-control">
                    <label for="">Redes Sociales</label>
                    <input type="text" class="form-control">
                    <label for="">Establecimiento:</label>
                    <input type="text" class="form-control">
                    <div class="btn" style="margin-left: 28rem;">
                      <button type="button" class="btn btn-outline-info" style="margin-top: 1em;">Agregar</button>
                      <button type="button" class="btn btn-outline-danger" style="margin-top: 1em;">Cancelar</button>
                    </div>
                  </div>
                </div>

                <table class="table empresas">
                  <tbody id="empresas">
                    <!-- Cargado de forma dinamica -->
                  </tbody>
                </table>
              </ul>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
             
              <table class="table personas">
                <tbody id="personas">
                  <!-- Cargado de forma dinamica -->
                </tbody>
              </table>

         
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <h6><i class="fas fa-plus-circle"></i> Agregar red social</h6>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Fin Información-->

    <!-- Amigos nav -->
    <div class="tab-pane fade" id="nav-amigos" role="tabpanel" aria-labelledby="nav-amigos-tab" style="margin-left: auto;">

      <ul class="justify-content-center nav nav-pills mb-3" id="pills-tab" role="tablist" style=" margin-top: 1.5em;">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Seguidores</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Seguidos</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        
          <table class="table seguidores">
            <tbody id="seguidores">
              <!-- Cargado de forma dinamica -->
            </tbody>
          </table>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          
          <table class="table seguidos">
            <tbody id="seguidos">
              <!-- Cargado de dinamica -->
            </tbody>
          </table>

        </div>
      </div>

    </div>
    <!-- fin Amigos nav -->

    <!-- configuración nav -->
    <div class="tab-pane fade" id="nav-servicios" role="tabpanel" aria-labelledby="nav-servicios-tab">
      <!-- Contenidos -->
      <div class="container-services row mt-4">
        <!-- Recomendados -->
        <!-- /. recomendados -->

        <!-- Publicaciones de servicios -->
        <div class="content-service col-md-12">

          <!-- Agregar publicación -->
          <div class="content-haeder">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h4>Publicación de trabajos</h4>
              </div>
              <div class="card-body">
                <div class="user-block-publication">
                  <img class="img-circle" src="dist/img/user1-128x128.jpg" alt="User Image">
                  <button type="button" class="btn btn-publication btn-primary" data-toggle="modal" data-target="#modal-publication">
                    Crear publicación
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Contenido de las publicaciones -->
          <div class="content-data-publication">
            <!-- Servicio 1 -->
            <div class="target-service card">
              <div class="target-header card-header">
                <div class="user-block">
                  <img class="img-circle" src="dist/img/user1-128x128.jpg" alt="User Image">
                  <span class="username"><a href="#">Nombre del usuario.</a></span>
                  <span class="description">Fecha de la publicación - 7:30 PM Ayer</span>
                </div>
                <div class="user-block-right">
                  <span class="text-black btn-show-config">
                    <i class="fas fa-ellipsis-h"></i>
                  </span>
                  <ul class="list-public-config bg-secondary">
                    <li class="item-public-config">
                      <a href="javascript:void(0)">
                        <i class="fas fa-pen"></i>
                        <span>Editar publicación</span>
                      </a>
                    </li>
                    <li class="item-public-config">
                      <a href="javascript:void(0)">
                        <i class="fas fa-ban"></i>
                        <span>Eliminar publicación</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="target-header card-body">
                <h4 class="job-title">Construcción de vivienda - 4 pisos, 6 habitaciones</h4>

                <!-- Contenido de las calificaciones realizadas -->
                <div class="content-califications">
                  <span class="text-muted">Calificación:</span>
                  <div class="califications">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                  <span class="text-muted">(85 reacciones)</span>
                </div>
                <!-- /. Contenido de las calificaciones realizadas -->
              </div>
              <div class="target-body card-body">
                <!-- Descripción de la publicación -->
                <p class="text-service">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, eum
                  at architecto, ea omnis neque repudiandae provident ratione enim
                  libero corrupti fugit, dolore facilis laborum voluptatem maxime
                  numquam corporis. Excepturi quidem consequatur earum, ipsam cum
                  voluptatibus quam voluptatum nobis modi adipisci ab consectetur
                  accusantium minus, ex eaque culpa quia porro.
                </p>
                <!-- /. Descripción de la publicación -->

                <!-- Contenido de las galerias -->
                <div class="content-galeria">
                  <img src="dist/img/photo1.png" />
                  <img src="dist/img/photo2.png" />
                  <img src="dist/img/photo3.jpg" />
                  <img src="dist/img/photo4.jpg" />
                  <img src="dist/img/photo4.jpg" />
                </div>
                <!-- /. Contenido de las galerias -->
              </div>
              <div class="target-footer card-footer">

                <!-- menu (comentarios, calificaciones) -->
                <div class="option-menu">
                  <ul>
                    <li class="open-comments"><a href="javascript:void(0)"><span>25</span> Comentarios</a></li>
                    <li class="qualify">
                      <a href="javascript:void(0)">Reacciones</a>
                      <!-- Reacciones -->
                      <div class="content-reactions-qualify">
                        <div class="reactions">
                          <span data-code="1"><i class="fa fa-star"></i></span>
                          <span data-code="2"><i class="fa fa-star"></i></span>
                          <span data-code="3"><i class="fa fa-star"></i></span>
                          <span data-code="4"><i class="fa fa-star"></i></span>
                          <span data-code="5"><i class="fa fa-star"></i></span>
                        </div>

                        <span class="number-points">0 punto</span>
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- /. menu (comentarios, calificaciones) -->

                <!-- Contenido de los comentarios -->
                <div class="content-comments collapse">
                  <!-- Comentario 1 -->
                  <div class="box-comment">
                    <img src="dist/img/avatar2.png" alt="" />

                    <div class="box-content-commented">
                      <div class="name-user">
                        <span>Nombre del usuario</span>
                        <small class="fecha text-muted">12-05-2022 04:45 PM</small>
                      </div>
                      <p class="comment-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quia illum mollitia dolores sit vero sint minima incidunt,
                        fugiat quos ullam.
                      </p>
                      <a href="javascript:void(0)" class="text-primary edit-comment">Editar</a>
                      <a href="javascript:void(0)" class="text-info cancel-edit-comment d-none">Cancelar</a>
                      <a href="javascript:void(0)" class="text-danger delete-comment">Eliminar</a>
                    </div>
                  </div>

                  <!-- Comentario 2 -->
                  <div class="box-comment">
                    <img src="dist/img/avatar2.png" alt="" />

                    <div class="box-content-commented">
                      <div class="name-user">
                        <span>Nombre del usuario</span>
                        <small class="fecha">12-05-2022 04:45 PM</small>
                      </div>
                      <p class="comment-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quia illum mollitia dolores sit vero sint minima incidunt,
                        fugiat quos ullam. Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Quia illum mollitia dolores sit vero sint
                        minima incidunt, fugiat quos ullam.
                      </p>
                      <a href="javascript:void(0)" class="text-danger  report-comment">Denunciar</a>
                    </div>
                  </div>

                  <!-- Comentario 3 -->
                  <div class="box-comment">
                    <img src="dist/img/avatar2.png" alt="" />

                    <div class="box-content-commented">
                      <div class="name-user">
                        <span>Nombre del usuario</span>
                        <small class="fecha">12-05-2022 04:45 PM</small>
                      </div>
                      <p class="comment-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quia illum mollitia dolores sit vero sint minima incidunt,
                        fugiat quos ullam. Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Quia illum mollitia dolores sit vero sint
                        minima incidunt, fugiat quos ullam.
                      </p>
                      <a href="javascript:void(0)" class="text-danger  report-comment">Denunciar</a>
                    </div>
                  </div>
                </div>
                <!-- /. Contenido de los comentarios -->

                <!-- Escribir comentario -->
                <div class="write-comment">
                  <img src="dist/img/avatar5.png" alt="" />
                  <div class="text-auto-height">
                    <div class="text-input-auto contenteditable write-text-comment" contenteditable="true" maxlength="250"> </div>
                  </div>
                  <button type="button" class="btn btn-primary btn-send">
                    <i class="fas fa-paper-plane"></i>
                  </button>
                </div>
                <!-- /. Escribir comentario -->
              </div>
            </div>

            <!-- Servicio 2 -->
            <div class="target-service card">
              <div class="target-header card-header ">
                <div class="user-block">
                  <img class="img-circle" src="dist/img/user1-128x128.jpg" alt="User Image">
                  <span class="username"><a href="#">Nombre del usuario.</a></span>
                  <span class="description">Fecha de la publicación - 7:30 PM Ayer</span>
                </div>
                <div class="user-block-right">
                  <span class="text-black btn-show-config">
                    <i class="fas fa-ellipsis-h"></i>
                  </span>
                  <ul class="list-public-config bg-secondary">
                    <li class="item-public-config">
                      <a href="javascript:void(0)">
                        <i class="fas fa-pen"></i>
                        <span>Editar publicación</span>
                      </a>
                    </li>
                    <li class="item-public-config">
                      <a href="javascript:void(0)">
                        <i class="fas fa-ban"></i>
                        <span>Eliminar publicación</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="target-header card-body">
                <h4 class="job-title">Construcción de vivienda - 4 pisos, 6 habitaciones</h4>

                <div class="content-califications">
                  <span class="text-muted">Calificación:</span>
                  <div class="califications">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                  <span class="text-muted">(85 reacciones)</span>
                </div>
              </div>
              <div class="target-body card-body">
                <p class="text-service">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, eum
                  at architecto, ea omnis neque repudiandae provident ratione enim
                  libero corrupti fugit, dolore facilis laborum voluptatem maxime
                  numquam corporis. Excepturi quidem consequatur earum, ipsam cum
                  voluptatibus quam voluptatum nobis modi adipisci ab consectetur
                  accusantium minus, ex eaque culpa quia porro.
                </p>
                <div class="content-galeria">
                  <video class="fm-video video-js vjs-16-9 vjs-big-play-centered" data-setup="{}" controls id="fm-video">
                    <source src="dist/video/demo-player.mp4" type="video/mp4">
                  </video>
                </div>
              </div>
              <div class="target-footer card-footer">
                <div class="option-menu">
                  <ul>
                    <li class="open-comments"><a href="javascript:void(0)"><span>25</span> Comentarios</a></li>
                    <li class="qualify">
                      <a href="javascript:void(0)">Reacciones</a>
                      <!-- Reacciones -->
                      <div class="content-reactions-qualify">
                        <div class="reactions">
                          <span data-code="1"><i class="fa fa-star"></i></span>
                          <span data-code="2"><i class="fa fa-star"></i></span>
                          <span data-code="3"><i class="fa fa-star"></i></span>
                          <span data-code="4"><i class="fa fa-star"></i></span>
                          <span data-code="5"><i class="fa fa-star"></i></span>
                        </div>

                        <span class="number-points">5 puntos</span>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="content-comments collapse">
                  <!-- Comentario 1 -->
                  <div class="box-comment">
                    <img src="dist/img/avatar2.png" alt="" />

                    <div class="box-content-commented">
                      <div class="name-user">
                        <span>Nombre del usuario</span>
                        <small class="fecha text-muted">12-05-2022 04:45 PM</small>
                      </div>
                      <p class="comment-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quia illum mollitia dolores sit vero sint minima incidunt,
                        fugiat quos ullam.
                      </p>
                      <a href="javascript:void(0)" class="text-danger  report-comment">Denunciar</a>
                    </div>
                  </div>

                  <!-- Comentario 2 -->
                  <div class="box-comment">
                    <img src="dist/img/avatar2.png" alt="" />

                    <div class="box-content-commented">
                      <div class="name-user">
                        <span>Nombre del usuario</span>
                        <small class="fecha">12-05-2022 04:45 PM</small>
                      </div>
                      <p class="comment-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quia illum mollitia dolores sit vero sint minima incidunt,
                        fugiat quos ullam. Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Quia illum mollitia dolores sit vero sint
                        minima incidunt, fugiat quos ullam.
                      </p>
                      <a href="javascript:void(0)" class="text-danger  report-comment">Denunciar</a>
                    </div>
                  </div>

                  <!-- Comentario 3 -->
                  <div class="box-comment">
                    <img src="dist/img/avatar2.png" alt="" />

                    <div class="box-content-commented">
                      <div class="name-user">
                        <span>Nombre del usuario</span>
                        <small class="fecha">12-05-2022 04:45 PM</small>
                      </div>
                      <p class="comment-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quia illum mollitia dolores sit vero sint minima incidunt,
                        fugiat quos ullam. Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Quia illum mollitia dolores sit vero sint
                        minima incidunt, fugiat quos ullam.
                      </p>
                      <a href="javascript:void(0)" class="text-danger  report-comment">Denunciar</a>
                    </div>
                  </div>
                </div>

                <div class="write-comment">
                  <img src="dist/img/avatar5.png" alt="" />
                  <div class="text-auto-height">
                    <div class="text-input-auto contenteditable write-text-comment" contenteditable="true" maxlength="250"> </div>
                  </div>
                  <button type="button" class="btn btn-primary btn-send">
                    <i class="fas fa-paper-plane"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- fin configuración nav -->

    <!-- Galeria nav -->
    <div class="tab-pane fade" id="nav-galeria" role="tabpanel" aria-labelledby="nav-galeria-tab">
      <!--Nav de fotos y albumes-->
      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist" style=" margin-top: 1.5em;">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-foto" role="tab" aria-controls="pills-home" aria-selected="true">Fotos</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-album" role="tab" aria-controls="pills-profile" aria-selected="false">Albumnes</a>
        </li>
      </ul>
      <!--./Nav de fotos y albumes-->

      <div class="tab-content" id="pills-tabContent">
        <!--Fotos-->
        <div class="tab-pane fade show active" id="pills-foto" role="tabpanel">
          <div class="row">
            <div class="col-md-3 user-cd-img">
              <div class="image-container ">
                <figure>
                  <img src="./dist/img/photo1.png">
                  <figcaption>
                    <ul>
                      <li>
                        <i class="fas fa-pen-square"></i>
                      </li>
                      <li>
                        <i class="fas fa-trash-alt"></i>
                      </li>
                      <li>
                        <i class="fas fa-eye"></i>
                      </li>
                    </ul>
                  </figcaption>
                </figure>
              </div>
            </div>
            <div class="col-md-3 user-cd-img">
              <div class="image-container ">
                <figure>
                  <img src="./dist/img/photo1.png">
                  <figcaption>
                    <ul>
                      <li>
                        <i class="fas fa-pen-square"></i>
                      </li>
                      <li>
                        <i class="fas fa-trash-alt"></i>
                      </li>
                      <li>
                        <i class="fas fa-eye"></i>
                      </li>
                    </ul>
                  </figcaption>
                </figure>
              </div>
            </div>
            <div class="col-md-3 user-cd-img">
              <div class="image-container ">
                <figure>
                  <img src="./dist/img/photo1.png">
                  <figcaption>
                    <ul>
                      <li>
                        <i class="fas fa-pen-square"></i>
                      </li>
                      <li>
                        <i class="fas fa-trash-alt"></i>
                      </li>
                      <li>
                        <i class="fas fa-eye"></i>
                      </li>
                    </ul>
                  </figcaption>
                </figure>
              </div>
            </div>
            <div class="col-md-3 user-cd-img">
              <div class="image-container">
                <figure>
                  <img src="./dist/img/photo1.png">
                  <figcaption>
                    <ul>
                      <li>
                        <i class="fas fa-pen-square"></i>
                      </li>
                      <li>
                        <i class="fas fa-trash-alt"></i>
                      </li>
                      <li>
                        <i class="fas fa-eye"></i>
                      </li>
                    </ul>
                  </figcaption>
                </figure>
              </div>
            </div>
            <div class="col-md-3">
              <div class="add-img-cd" title="Subir una imágen a mi galería">
                <i class="fas fa-camera"></i>

              </div>
            </div>
          </div>
        </div>
        <!--./Fotos-->

        <!--Albumes-->
        <div class="tab-pane fade" id="pills-album" role="tabpanel">
          <div class="row">
            <div class="col-md-3 user-cd-img user-cd-albm">
              <div class="image-container ">
                <figure>
                  <img src="./dist/img/photo1.png">
                  <h4>Soldador</h4>
                  <figcaption>
                    <ul>
                      <li>
                        <i class="fas fa-pen"></i>
                      </li>
                      <li>
                        <i class="fas fa-trash"></i>
                      </li>
                      <li>
                        <i class="fas fa-folder-open"></i>
                      </li>
                    </ul>
                  </figcaption>
                </figure>
              </div>
            </div>
            <div class="col-md-3 user-cd-img user-cd-albm">
              <div class="image-container ">
                <figure>
                  <img src="./dist/img/photo1.png">
                  <h4>Mi perfil</h4>
                  <figcaption>
                    <ul>
                      <li>
                        <i class="fas fa-pen"></i>
                      </li>
                      <li>
                        <i class="fas fa-trash"></i>
                      </li>
                      <li>
                        <i class="fas fa-folder-open" data-toggle="collapse" data-target="#img-album"></i>
                      </li>
                    </ul>
                  </figcaption>
                </figure>
              </div>
            </div>
            <div class="col-md-3">
              <div class="add-album-cd" title="Crear nuevo album">
                <i class="fas fa-plus"></i>
              </div>
            </div>
          </div>
          <!---Collapse de fotos en los albumes-->
          <div class="collapse" id="img-album">
            <h2>Mi Perfil</h2>
            <div class="row">
              <div class="col-md-3 user-cd-img">
                <div class="image-container ">
                  <figure>
                    <img src="./dist/img/photo1.png">
                    <figcaption>
                      <ul>
                        <li>
                          <i class="fa-solid fa-pen-to-square"></i>
                        </li>
                        <li>
                          <i class="fa-solid fa-trash-can"></i>
                        </li>
                        <li>
                          <i class="fa-solid fa-eye"></i>
                        </li>
                      </ul>
                    </figcaption>
                  </figure>
                </div>
              </div>
            </div>
          </div>
          <!---./Collapse de fotos en los albumes-->
        </div>
        <!--./Albumes-->
      </div>

    </div>
    <!-- fin galeria nav -->

  </div>
</div>
<!-- === fin nav === -->


<!--Modales -->
  <!--Modal de Añadir imagenes-->
  <div class="modal fade" id="md-add-img" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar a mi galería</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group row">
              <div class="col-lg-2 align-self-center">
                <label class="form-label">Album:</label>
              </div>
              <div class="col-lg-5">
                <select class="form-control" id="">
                  <option value="">Ninguno</option>
                </select>
              </div>
              <div class="form-group col-sm-5 text-right">
                <input type="file" multiple id="add-new-photo" name="images[]">
                <button type="button" class="btn btn-outline-secondary form-button" id="btn-up-cnt-img">Subir imágenes</button>
              </div>
            </div>
          </form>
          <h7>Tus capturas o imágenes:</h7>
          <div class="img-cnt-add">
            <div class="row img-container-upt">

              <!--Solo para referencia-->
              <div class="img-upd-container"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cnl-img">Cancelar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de Añadir imagenes-->

  <!--Modal de ver la imagen-->
  <div class="modal fade" id="modal-view-img" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Título de la imagen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="md-contain-img">
            <img src="./dist/img/photo1.png" alt="">
          </div>
        </div>
        <div class="md-footer">
          <form class="row">
            <div class="col-md-2 text-right">
              <label>Album:</label>
            </div>
            <div class="btn-group col-md-6">
              <select id="slc-album-md" class="form-control view-only-img">
                <option value="">Ninguno</option>
              </select>
              <button type="button" class="btn btn-outline-secondary btn-cmb-alb">Cambiar</button>
            </div>

            <div class="col-md-4 text-right">
              <h7 class="font-weight-bold">28/03/2022</h7>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de ver la imagen-->

  <!--Modal de añadir album-->
  <div class="modal fade" id="md-album-cd-img" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear nuevo álbum</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
            <label for="">Nombre del álbum:</label>
            <input type="text" class="form-control">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Añadir</button>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de añadir album-->

  <!-- Modal PUBLICACIÓN DE TRABAJOS-->
  <div class="modal fade" id="modal-publication" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear una nueva publicación de trabajo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <form autocomplete="off">
            <div class="form-group">
              <label for="titulo">Titulo:</label>
              <input type="text" id="titulo" class="form-control form-control-border">
            </div>
            <div class="form-group">
              <label for="descripcion" class="col-form-label">Descripción:</label>
              <textarea class="form-control form-control-border rounded-0" id="descripcion"></textarea>
            </div>

            <!-- Contenido de Images previas -->
            <div class="container-images" id="container-images" >
              <!-- Aquì se cargan las imagenes previas -->
              <!-- Icono agregar imagen -->
              <div  id="content-load-file">
                <div class="add-new-photo" id="add-file" title="Seleccionar imagen">
                  <span><i class="fas fa-camera"></i></span>
                </div>
              </div>
              <!-- /. Icono agregar imagen -->
            </div>
            <!-- /. Contenido de Images previas -->

            <!-- Contenido del video vista previa -->
            <div class="container-video" id="container-video">
              <div class="row">
                <div class="col-12">
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 10%;" aria-valuemin="0" aria-valuemax="100">0%</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span id="label-video-size">0 MB</span>
                  <span id="label-video-maxsize">0 MB</span>
                </div>
                <div class="col-md-12 text-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary" id="btn-add-video">Seleccionar video</button>
                    <button type="button" class="btn btn-danger" id="btn-delete-video">Eliminar</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <video controls id="video-tag">
                    <source id="video-source" src="">
                  </video>
                </div>
              </div>
            </div>
            <!-- /. Contenido del video vista previa -->

            <!-- Formulario contiene los inputs (imagen / video)-->
            <form id="form-upload-file">
              <input type="file" id="input-new-image" accept="image/*" max="5" multiple hidden/>
              <input type="file" id="input-new-video" accept="video/*" size="150" hidden/>
            </form> 
            <!-- /. Formulario de etiquetas inputs -->

            <div class="form-group">
              <div class="btn-group">
                <button type="button" id="btn-image" class="btn btn-success" >Imagenes</button>
                <button type="button" id="btn-video" class="btn btn-info" >Video</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Publicar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /. Modal PUBLICACIÓN DE TRABAJOS-->

  <!-- Modal REPORTAR-->
  <div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="Modal reporte" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Denunciar usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <form id="form-report">
            <div class="form-group">
              <label for="motivo">Motivo:</label>
              <select class="custom-select  rounded-0" id="motivo">
                <option selected>Selecione</option>
                <option value="">Agresión</option>
                <option value="">Insulto</option>
                <option value="">Otros</option>
              </select>
            </div>
            <div class="form-group">
              <label for="comentario" class="col-form-label">Comentario:</label>
              <textarea class="form-control rounded-0" id="comentario"></textarea>
            </div>
          </form>
          <form id="formulario-image">
              <div class="form-group">
                  <label for="imagenportada">Imagén o captura (Opcional)</label>        
                  <input type="file" hidden class="custom-file-input form-control" accept=".jpg, .jpeg, .png" id="input-img-portada" lang="es">
                  <div class="container-image d-none">
                      <img src="dist/img/photo3.jpg" id="preview-image" class="image-responsive">
                  </div>
                  <button type="button" id="btn-subir-imagen" class="btn btn-flat btn-block btn-primary">
                      <i class="fa fas fa-camera-retro"></i> <span>Subir imagen</span>
                  </button>
              </div>                        
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-secondary" data-dismiss="modal">Cancelar proceso</button>
          <button type="button" class="btn btn-flat btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal REPORTAR-->
<!-- ZONA DE SCRIPTS -->
<!-- Perfil -->
<script src="./dist/js/pages/perfil.js"></script>
<script src="dist/js/pages/galeria.js"></script>

<!-- video js -->
<script src="plugins/video-js/video.min.js"></script>

<!-- owl carousel -->
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script>

<!-- scripts propios -->
<script src="dist/js/pages/demo-service-qualification.js"></script>
<script src="dist/js/uploadFile.js"></script>
<script src="dist/js/config.owl.carousel.js"></script>