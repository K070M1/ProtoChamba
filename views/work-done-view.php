<!-- videojs -->
<link rel="stylesheet" href="plugins/video-js/video.min.css">
<link rel="stylesheet" href="dist/css/pages/style-video.css">
<!-- styles -->
<link rel="stylesheet" href="dist/css/pages/service-qualification.css" />
<link rel="stylesheet" href="dist/css/uploadFile.css">

<!-- SCRIPTS -->
<!-- video viewer -->
<script src="plugins/video-js/video.min.js"></script>
<!-- Demos -->
<script src="dist/js/pages/demo-service-qualification.js"></script>
<script src="dist/js/uploadFile.js"></script>

<!-- Contenidos -->
<div class="container-services row">
  <!-- Recomendados -->
  <div class="content-filter-recommended col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="container-cards">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a href="#" class="profile-user">
            <img class="imng-circle" src="dist/img/avatar4.png" />
          </a>
          <!-- <span class="level">Intermedio</span> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Publicaciones de servicios -->
  <div class="content-service col-lg-8 col-md-12 col-sm-12 col-xs-12 col-auto">

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
                  <i class="fas fa-eye-slash"></i>
                  <span>Ocultar publicación</span>
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
            <img src="dist/img/photo1.png"/>
            <img src="dist/img/photo2.png"/>
            <img src="dist/img/photo3.jpg"/>
            <img src="dist/img/photo4.jpg"/>
            <img src="dist/img/photo4.jpg"/>
          </div>
          <!-- /. Contenido de las galerias -->
        </div>
        <div class="target-footer card-footer">

          <!-- menu (comentarios, calificaciones) -->
          <div class="option-menu">
            <ul>
              <li id="btn-collapse1"><a href="#comentario1" data-toggle="collapse" role="button" aria-expanded="false"><span>25</span> Comentarios</a></li>
              <li class="qualify">
                <a href="javascript:void(0)">Reacciones</a>
                <!-- Reacciones -->
                <div class="reacciones" id="reacciones">
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
          <!-- /. menu (comentarios, calificaciones) -->
  
          <!-- Contenido de los comentarios -->
          <div class="content-comments collapse" id="comentario1">
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
              <div class="text-input-auto" id="text-input-1" contenteditable="true" maxlength="10"> </div>
            </div>
            <button type="button" class="btn btn-primary" id="btn-send-1">
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
                  <i class="fas fa-eye-slash"></i>
                  <span>Ocultar publicación</span>
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
              <li id="btn-collapse1"><a href="#comentario1" data-toggle="collapse" role="button" aria-expanded="false"><span>25</span> Comentarios</a></li>
              <li class="qualify">
                <a href="javascript:void(0)">Reacciones</a>
                <!-- Reacciones -->
                <div class="reacciones" id="reacciones">
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
  
          <div class="content-comments collapse" id="comentario1">
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
              <div class="text-input-auto" id="text-input-1" contenteditable="true" maxlength="10" placeholder="Escribe un comentario"> </div>
            </div>
            <button type="button" class="btn btn-primary" id="btn-send-1">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
          <!-- Images -->
          <div class="container-images">
            <section id="images">
              <form id="form-upload-file">
                <!-- Agregar capa nueva aquí -->
                <div  id="add-photo-container">
                  <div class="add-new-photo first" id="add-photo">
                    <span><i class="fas fa-camera"></i></span>
                  </div>
                  <input type="file" hidden multiple id="add-new-photo" >
                </div>
              </form> 
            </section>
          </div>
          <!-- /. Images -->
          <div class="form-group">
            <div class="btn-group">
              <button type="button" id="btn-load-image" class="btn btn-success">Subir imagen</button>
              <button type="button" class="btn btn-info">Subir video</button>
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

<script>
  $(document).ready(function(){

    // Mostrar el menu de ellipsis por cada trabajo publicado
    $(".btn-show-config").click(function(){
      //$(".btn-show-config").next("ul.list-public-config").hide();
      $(this).next("ul.list-public-config").toggle();

    });

    // Convierte la etiqueta P en una sección editable 
    $('.edit-comment').click(function(){
      var isEditable = $(this).prev('p.comment-text').attr('contenteditable', true);

      // habilitar botones
      $(this).next('.cancel-edit-comment').removeClass('d-none');
      $(this).next('.cancel-edit-comment').next('.delete-comment').addClass('d-none');
      $(this).html('Actualizar');
    });

    // Cancela la edición del comentario
    $('.cancel-edit-comment').click(function(){
      $(this).prevAll('p.comment-text').attr('contenteditable', false);
      //$(this).prev('p.comment-text').removeAttr('contenteditable');

      // habilitar botones
      $(this).next('.delete-comment').removeClass('d-none');
      $(this).addClass('d-none');
      $(this).prev('.edit-comment').html('Editar');
    });

   
    // Cargar imagenes
    // Abrir el inspector de archivos
    $(document).on("click", "#add-photo", function(){
        $("#add-new-photo").click();
    });

    $(document).on("click", "#btn-load-image", function(){
      console.log('hello');
        $("#add-new-photo").click();
    });
    // -> Abrir el inspector de archivos

    // Cachamos el evento change
    $(document).on("change", "#add-new-photo", function () {
    
        //console.log(this.files);
        var files = this.files;
        var element;
        var supportedImages = ["image/jpeg", "image/jpg", "image/png", "image/gif", "video/mp4"];
        var isNoValidate = false;

        for (var i = 0; i < files.length; i++) {
            element = files[i];
            
            if (supportedImages.indexOf(element.type) != -1) {
                
                if(element.type == "video/mp4"){
                    createPreviewVideo(element, i.toString());
                }else{
                    createPreviewImages(element);
                }
            }
            else {
              isNoValidate = true;
            }
        }
    });
    
    // Eliminar previsualizaciones
    $(document).on("click", "#images .image-container", function(e){
        $(this).parent().remove();
    });
  });
</script>


