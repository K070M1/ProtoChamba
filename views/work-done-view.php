
<!-- videojs -->
<link rel="stylesheet" href="plugins/video-js/video.min.css">
<link rel="stylesheet" href="dist/css/pages/style-video.css">
<!-- styles -->
<link rel="stylesheet" href="dist/css/pages/services.css" />
<link rel="stylesheet" href="dist/css/pages/service-qualification.css" />

<!-- SCRIPTS -->
<!-- video viewer -->
<script src="plugins/video-js/video.min.js"></script>
<!-- Demos -->
<script src="dist/js/pages/demo-service-qualification.js"></script>


<!-- Contenidos -->
<div class="container-services row">
  <!-- Recomendados -->
  <div class="content-filter-recommended col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <h4 class="title">Otros servicios secomendados</h4>
    <div class="container-cards">

      <div class="box card card-outline card-cyan">
        <div class="heading">
          <a href="#" class="profile-user">
            <img src="dist/img/avatar4.png" />
            <div class="hover">
              <h4>Perfil</h4>
            </div>
          </a>
          <!-- <span class="level">Intermedio</span> -->
        </div>
        <div class="user-data">
            <div class="califications">
                <div class="reactions">
                  <i class="fa fa-star active"></i>
                  <i class="fa fa-star active"></i>
                  <i class="fa fa-star active"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <!-- <span class="valoration">45.3K</span> -->
            </div>
            <a href="#" class="name">Alfonso Patricio Magallanes Salazar</a>
            <div class="services">
                <span>
                    Diseñador, Carpintero, Animador, Analista, otros.
                </span>
            </div>
            <!-- <span class="money text-muted">
                <i class="fa fa-solid fa-money"></i> 
                Entre: S/ 250.00 y S/ 450.00
            </span> -->
            
        </div>
        <div class="descripcion">
          <div class="info-user">
            
            <a href="#" class="card-text text-dark"
              ><i class="fa fa-regular fa-compass"></i> Ubicación del
              establecimiento</a
            >
            <a href="#" class="card-text text-dark">
                <i class="fa fa-regular fa-street-view"></i> 
                Dirección personal
            </a>
          </div>
        </div>
        <div class="social">
          <a href="#" class="btn-social"><i class="fa fab fa-facebook"></i></a>
          <a href="#" class="btn-social"><i class="fa fab fa-instagram"></i></a>
          <a href="#" class="btn-social"><i class="fa fab fa-twitter"></i></a>
          <a href="#" class="btn-social"><i class="fa fab fa-envelope"></i></a>
          <a href="#" class="btn-social"><i class="fa fab fa-whatsapp"></i></a>
          <a href="#" class="btn-social"><i class="fa fab fa-phone"></i></a>
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
              Agregar publicación
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
            <img src="dist/img/photo1.png"/>
            <img src="dist/img/photo2.png"/>
            <img src="dist/img/photo3.jpg"/>
            <img src="dist/img/photo4.jpg"/>
            <img src="dist/img/photo4.jpg"/>
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
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-report" class="report">Denunciar</a>
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
                <a href="javascript:void(0)" class="report">Denunciar</a>
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
                <a href="javascript:void(0)" class="report">Denunciar</a>
              </div>
            </div>
          </div>
  
          <div class="write-comment">
            <img src="dist/img/avatar5.png" alt="" />
            <div class="text-auto-height">
              <div class="text-input-auto" id="text-input-1" contenteditable="true" maxlength="10"> </div>
            </div>
            <button type="button" class="btn btn-primary" id="btn-send-1">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
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
                <a href="javascript:void(0)" class="report">Denunciar</a>
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
                <a href="javascript:void(0)" class="report">Denunciar</a>
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
                <a href="javascript:void(0)" class="report">Denunciar</a>
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

<!-- Modal -->
<div class="modal fade" id="modal-publication" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        Body
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>



