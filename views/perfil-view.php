<!-- css perfil -->
<link rel="stylesheet" href="./dist/css/pages/perfil.css">
<link rel="stylesheet" href="./dist/css/pages/styleGaleria.css">

<!-- videojs -->
<link rel="stylesheet" href="plugins/video-js/video.min.css">

<!-- styles propios -->
<link rel="stylesheet" href="dist/css/pages/service-qualification.css" />
<link rel="stylesheet" href="dist/css/pages/style-video.css">
<link rel="stylesheet" href="dist/css/uploadFile.css">

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
      <a class="nav-link" id="nav-galeria-tab" data-toggle="tab" href="#nav-galeria" role="tab" aria-controls="nav-galeria" aria-selected="false">Galeria</a>
      <a class="nav-link" id="nav-amigos-tab" data-toggle="tab" href="#nav-amigos" role="tab" aria-controls="nav-amigos" aria-selected="false">Amigos</a>
      <a class="nav-link" id="nav-configuracion-tab" data-toggle="tab" href="#nav-servicios" role="tab" aria-controls="nav-servicios" aria-selected="false">Servicios</a>
      <a class="nav-link" id="nav-forum-tab" data-toggle="tab" href="#nav-forum" role="tab"  aria-selected="false">Foro</a>
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

    <!-- Trabajos publicados nav -->
    <div class="tab-pane fade" id="nav-servicios" role="tabpanel" aria-labelledby="nav-servicios-tab">
      <!-- Contenidos -->
      <div class="container-services row mt-4">

        <!-- Agregar publicación -->
        <div class="content-header col-md-12">
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

        <!-- Publicaciones de servicios -->
        <div class="content-service col-md-12">

          <!-- Contenido de las publicaciones -->
          <div class="content-data-publication" id="data-publication-works">

          </div>
        </div>
      </div>
    </div>
    <!-- /. Trabajos publicados nav -->

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
          <div class="row" id="load-Gallery">
            
            
          </div>
        </div>
        <!--./Fotos-->

        <!--Albumes-->
        <div class="tab-pane fade" id="pills-album" role="tabpanel">
          <div class="row" id="load-album">
            
            
          </div>
          <!---Collapse de fotos en los albumes-->
          <div class="collapse" id="img-album-open-collap">
            <h2 id="tittle-collapse"></h2>
            <div class="row" id="content-collapse-albm">
              
            </div>
          </div>
          <!---./Collapse de fotos en los albumes-->
        </div>
        <!--./Albumes-->
      </div>

    </div>
    <!-- fin galeria nav -->

    <!-- Foro de consultas -->
    <div class="tab-pane fade" id="nav-forum" role="tabpanel">
      <div class="row mt-4">
        <div class="content-header col-md-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h4>Foro de consultas</h4>
            </div>
            <div class="card-body p-2 pt-3" >
              <!-- Escribir comentario -->
              <div class="write-comment">
                <img src="dist/img/avatar5.png" style="align-self:flex-start" />
                <div class="text-auto-height">
                  <div class="text-input-auto contenteditable write-text-comment" contenteditable="true" maxlength="250"> </div>
                </div>
                <button type="button" class="btn btn-primary btn-send" style="align-self:flex-start" >
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
              <!-- /. Escribir comentario -->
            </div>
          </div>
        </div>

        <!-- /.mensajes -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="content-comments" style="max-height: 450px;">
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
                      <small class="fecha text-muted">12-05-2022 04:45 PM</small>
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
                      <small class="fecha text-muted">12-05-2022 04:45 PM</small>
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
            </div>
          </div>
        </div>
      </div>
    </div>
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
                <select class="form-control" id="alb-add-gal">

                </select>
              </div>
              <div class="form-group col-sm-5 text-right">
                <input type="file" multiple id="add-new-photo" accept=".jpg, .gif, .png" name="archivo[]">
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
          <button type="button" class="btn btn-primary" id="btn-add-gal-md">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de Añadir imagenes-->

  <!--Modal de ver la imagen-->
  <div class="modal fade" id="modal-view-img" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id="loadGalleryModal">
        
      </div>
    </div>
  </div>
  <!--./Modal de ver la imagen-->

  <!--Modal de añadir album-->
  <div class="modal fade" id="md-album-cd-img" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="t-md-albm">Crear nuevo álbum</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
            <label for="">Nombre del álbum:</label>
            <input type="text" class="form-control" id="nmb-album-add">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="añadir-albm">Añadir</button>
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
          <form autocomplete="off" id="form-publication">
            <div class="form-group">
              <label for="especialidad">Especialidad:</label>
              <select class="custom-select rounded-0 form-control-border" id="especialidad">
                  <!-- datos dinamicos -->
              </select>
            </div>
            <div class="form-group">
              <label for="titulo">Titulo:</label>
              <input type="text" id="titulo" class="form-control form-control-border">
            </div>
            <div class="form-group">
              <label for="descripcion" class="col-form-label">Descripción:</label>
              <textarea class="form-control form-control-border rounded-0" id="descripcion"></textarea>
            </div>

            <!-- opciones para cargar archivos -->
            <div class="row">
              <div class="col-6">
                <div class="btn-group" role="group">
                  <button id="btn-options-files" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" >
                    Tipo de archivo
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btn-options-files">
                    <a href="javascript:void(0)" class="dropdown-item" id="btn-image" >Imagenes</a>
                    <a href="javascript:void(0)" class="dropdown-item" id="btn-video" >Video</a>
                  </div>
                </div>
                <div class="badge badge-success text-nowrap text-uppercase" id="title-options">Imagenes</div>
              </div>
              <div class="col-6 text-right">
                <button type="button" class="btn btn-sm btn-primary" id="btn-add-file"><i class="fas fa-folder-open"></i> <span>Cargar imagenes</span></button>
                <button type="button" class="btn btn-sm btn-danger d-none" id="btn-delete-files"><i class="fas fa-trash-alt"></i> Eliminar archivos</button>
              </div>
            </div>

            <!-- Contenido de Images previas -->
            <div class="row" id="container-images" >
              <!-- Aquì se cargan las imagenes previas -->
            </div>

            <!-- Contenido del video vista previa -->
            <div id="container-video">
              <!-- progressbar -->
              <div class="row">
                <div class="col-sm-8">
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100">0%</div>
                  </div>
                </div>
                <div class="col-sm-4 text-right">
                  <span>Peso del video: </span>
                  <span id="label-video-size">0 MB</span>
                </div>
              </div>

              <!-- Previsualizador de video -->
              <div class="row">
                <div class="col-md-12">
                  <video controls id="video-tag">
                    <source id="video-source" src="">
                  </video>
                </div>
              </div>
            </div>
            <!-- /. Contenido del video vista previa -->
          </form>

          <!-- Formulario contiene los inputs (imagen / video)-->
          <form id="form-upload-file">
            <input type="file" id="input-new-image" accept="image/*" max="5" multiple hidden/>
            <input type="file" id="input-new-video" accept="video/*" size="150" hidden/>
          </form> 
          <!-- /. Formulario de etiquetas inputs -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn-add-publication">Publicar</button>
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
<script src="dist/js/pages/perfil.js"></script>
<script src="dist/js/pages/galeria.js"></script>

<!-- video js -->
<script src="plugins/video-js/video.min.js"></script>

<!-- scripts propios -->
<script src="dist/js/pages/demo-service-qualification.js"></script>
<script src="dist/js/uploadFile.js"></script>