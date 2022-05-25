<?php 
session_start();

if(isset($_SESSION["login"])){
  $imagenusuario = $_SESSION['imagenusuario'];
}else{
  $imagenusuario = 'default_profile_avatar.svg';
}
?>
<!-- css perfil -->
<link rel="stylesheet" href="./dist/css/pages/styleGaleria.css">

<!-- videojs -->
<link rel="stylesheet" href="plugins/video-js/video.min.css">

<!-- styles propios -->
<link rel="stylesheet" href="dist/css/pages/publication-services.css" />
<link rel="stylesheet" href="dist/css/pages/style-video.css">
<link rel="stylesheet" href="dist/css/uploadFile.css">
<link rel="stylesheet" href="dist/css/pages/profile.css">

<!--Contenido-->
<section class="perfil-usuario align-items-end">
  <div class="contenedor-perfil">
    <!--Portada-->
    <div class="portada-perfil" id="visual">
      <img src="" id="refer-port-img" data-img-por=''>

      <!--Perfil-->
      <div class="avatar-perfil" id="preview">
        <img src="" id="refer-perf-img" data-img-per=''>
        <a href="#" class="cambiar-foto" id="idfotoPerf">
          <i class="fas fa-camera"></i>
        </a>
      </div>

      <div class="opcciones-perfil">
        <a href="#" class="cambiar-Portada" id="idfotoPrt">
          <button type="" id="btn-Por"><i class="fas fa-camera"></i></button>
        </a>
      </div>

      <!-- FOTO PERFIL -->
      <div class="btnfile" style="display: none;">
        <input type="file" id="filePerfil" accept=".jpg, .png, .gif" name="archivoPerfil">
      </div>
      <!-- FOTO PORTADA -->
      <div class="btnPortada" style="display: none;">
        <input type="file" id="filePortada" accept=".jpg, .png, .gif" name="archivoPortada">
      </div>
    </div>

    <div class="data-user">
      <div class="datos-perfil">
        <h1 class="titulo-usuario" id="nombreUsu"></h1>
        <button class="btn btn-sm btn-info" id="btnseguir">Seguir</button>
      </div>

      <div class="content-foll-qual">
        <!-- Seccion de segui... -->
        <div class="container1">
          <div>
            <h5>Seguidores</h5>
            <span id="conteosegui"></span>
          </div>
          <div>
            <h5>Seguidos</h5>
            <span id="conteoseguid"></span>
          </div>
        </div>
        <!-- Seccion de CALIFICACIONES -->
        <div class="container2" >
          <div id="content-starts">
            <!-- asincrono -->

          </div>
          <div class="nivel">
            <h5 class="text-level estandar" id="text-level-user">Estandar</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!--====  End section  ====-->

<!-- === Inicio de nav === -->
<div class="contenedor-perfil">
  <nav style="margin-top: 2rem">
    <div class="nav nav-tabs justify-content-center text-danger" id="nav-tab" role="tablist">
      <a class="nav-link link-nav-profile active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">General</a>
      <a class="nav-link link-nav-profile" id="nav-informacion-tab" data-toggle="tab" href="#nav-informacion" role="tab" aria-controls="nav-informacion" aria-selected="false">Información</a>
      <a class="nav-link link-nav-profile" id="nav-galeria-tab" data-toggle="tab" href="#nav-galeria" role="tab" aria-controls="nav-galeria" aria-selected="false">Galeria</a>
      <a class="nav-link link-nav-profile" id="nav-amigos-tab" data-toggle="tab" href="#nav-amigos" role="tab" aria-controls="nav-amigos" aria-selected="false">Amigos</a>
      <a class="nav-link link-nav-profile" id="nav-configuracion-tab" data-toggle="tab" href="#nav-servicios" role="tab" aria-controls="nav-servicios" aria-selected="false">Servicios</a>
      <a class="nav-link link-nav-profile" id="nav-forum-tab" data-toggle="tab" href="#nav-forum" role="tab" aria-selected="false">Foro</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <!-- General nav -->
    <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">

      <div class="contenedor-perfil">
        <div class="profile-info">
          <div class="info-col" >
            <div class="card">
              <div class="card-header">
                <h5 class="text-bold text-uppercase text-center">Información</h5>
              </div>
              <div class="card-body">
                <div id="info-empresa">
                  <!-- Dinamico -->
                </div>
              </div>

            </div>
          </div>
          <div class="post-col">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-9">
                    <h5 class="text-bold text-uppercase text-center">Biografía</h5>
                  </div>
                  <div class="col-3 text-right">
                    <a href="javascript:void(0)" id="btn-cancel-edit-description" class="btn btn-sm btn-outline-secondary  d-none"><i class='fas fa-times'></i></a>
                    <a href="javascript:void(0)" id="btn-edit-description" class="btn btn-sm btn-outline-info "><i class='fas fa-edit'></i></a>
                    <a href="javascript:void(0)" id="btn-update-description" class="btn btn-sm btn-outline-info d-none"><i class="far fa-save"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="text-descripcion">
                  <!-- DINAMICO -->
                </div>
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
        <div class="col-md-3">
          <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Información General</a>
            <a class="nav-link" id="v-pills-esp-tab" data-toggle="pill" href="#v-pills-esp" role="tab" aria-controls="v-pills-esp" aria-selected="false">Especialidades</a>
            <a class="nav-link" id="v-pills-est-tab" data-toggle="pill" href="#v-pills-est" role="tab" aria-controls="v-pills-est" aria-selected="false">Establecimientos</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Enlaces</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content" id="v-pills-tabContent">
            <!-- Información -->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          
              <!-- Datos personales -->
              <div class="card" >
                <div class="card-header">
                  <div class="row">
                    <div class="col-10 text-center">
                      <h5 class="text-bold text-uppercase">Datos Personales</h5>
                    </div>
                    <div class="col-2  text-right">
                      <button id="btnP" class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#containerDatePerson" >
                        <i class='fas fa-edit'></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="containerDatePerson">
                  <div class="card-body " >
                    <form autocomplete="off">
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <label for="">Nombres:</label>
                          <input type="text" class="form-control form-control-border" id="nombres">
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="">Apellidos:</label>
                          <input type="text" class="form-control form-control-border" id="apellidos">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <label for="fechanaci">Fecha Nacimiento:</label>
                          <input type="date" class="form-control form-control-border" id="fechanaci">
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="">Teléfono:</label>
                          <input type="tel" class="form-control form-control-border" id="telefono" maxlength="11">
                        </div>
                      </div>  
                      <div class="row">
                        <div class="col-sm-12">
                          <label>Dirección:</label>
                          <div class="row">
                            <div class="col-sm-2 form-group">
                              <Select class="custom-select form-control-border" id="inTipoC">
                                <option value="AV">AV</option>
                                <option value="CA">CA</option>
                                <option value="JR">JR</option>
                                <option value="PJ">PJ</option>
                                <option value="UR">UR</option>
                                <option value="LT">LT</option>
                              </Select>
                            </div>
                            <div class="col-sm-6 form-group">
                              <input type="text" placeholder="Nombre de calle" class="form-control form-control-border" id="inNCalle">
                            </div>
                            <div class="col-sm-2 form-group">
                              <input type="number" class="form-control form-control-border" placeholder="N°" id="inNC" maxlength="5">
                            </div>
                            <div class="col-sm-2 form-group">
                              <input type="number" class="form-control form-control-border" placeholder="Piso" id="inPiso" maxlength="5">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 form-group">
                          <label for="horarioatencion">Horario de atención:</label>
                          <input type="text" id="horarioatencion" class="form-control form-control-border">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 form-group text-right" >
                          <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="collapse" data-target="#containerDatePerson">Cancelar</button>
                          <button type="button" class="btn btn-sm btn-outline-info"  id="actualizarPer">Actualizar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>     
              
              <!-- Datos privilegiados -->
              <div class="card " id="card-data-privileged">
                <div class="card-header">
                  <div class="row">
                    <div class="col-10 text-center">
                      <h5 class="text-bold text-uppercase">Información privada</h5>
                    </div>
                    <div class="col-2  text-right">
                      <button id="btnEditPrivilegedData" class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#contentainerCredentials" >
                        <i class='fas fa-edit'></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="contentainerCredentials">
                  <div class="card-body " >
                    <div class="row">
                      <div class="col-md-4 form-group">
                        <button type="button" id="btn-edit-email" class="btn btn-md btn-block btn-success">Actualizar correo</button>
                      </div>
                      <div class="col-md-4 form-group">
                        <button type="button" id="btn-edit-password" class="btn btn-md btn-block btn-primary">Actualizar contraseña</button>
                      </div>
                      <div class="col-md-4 form-group">
                        <button type="button" id="btn-delete-account" class="btn btn-md btn-block btn-danger">Eliminar cuenta</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Datos dinamicos -->
              <div class="card card-body">
                <table class="table personas">
                  <tbody id="personas">
                    <!-- Cargado de forma dinamica -->
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Especialidad -->
            <div class="tab-pane fade" id="v-pills-esp" role="tabpanel" aria-labelledby="v-pills-esp-tab">
              <div class="card " >
                <div class="card-header">
                  <div class="row">
                    <div class="col-10 text-center">
                      <h5 class="text-bold text-uppercase">Especialidades</h5>
                    </div>
                    <div class="col-2  text-right">
                      <button id="btnsd" class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseEspecialidad" >
                        <i class="fas fa-plus-circle"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="collapseEspecialidad">
                  <div class="card-body">
                    <form autocomplete="off" id="form-add-esp">
                      <div class="row">
                        <div class="col-md-12 form-group">
                          <label for="services">Servicio:</label>
                          <select id="services" class="custom-select form-control-border">
                            <!-- Dinamicos -->
                          </select>
                        </div>
                      </div>                    
                      <div class="row">
                        <div class="col-md-9 form-group">
                          <label for="descripcionEsp">Descripcion:</label>
                          <input type="text" class="form-control form-control-border" id="descripcionEsp">
                        </div>
                        <div class="col-md-3 form-group">
                          <label for="tarifa">Precio:</label>
                          <input type="number" class="form-control form-control-border" id="tarifa">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 form-group text-right">
                          <button type="button" class="btn btn-sm btn-outline-secondary btn-cancel" data-toggle="collapse" data-target="#collapseEspecialidad">Cancelar</button>
                          <button type="button" class="btn btn-sm btn-outline-primary" id="agregarEsp">Agregar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- datos dinamicos -->
              <div id="especiality"></div>
            </div>

            <!-- Establecimiento -->
            <div class="tab-pane fade" id="v-pills-est" role="tabpanel" aria-labelledby="v-pills-est-tab">
              <div class="card ">
                <div class="card-header">
                  <div class="row">
                    <div class="col-10 text-center">
                      <h5 class="text-bold text-uppercase">Establecimientos</h5>
                    </div>
                    <div class="col-2  text-right">
                      <button id="btnEst" class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#content-establecimiento" >
                        <i class="fas fa-plus-circle"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="collapse " id="content-establecimiento">
                  <div class="card-body">
                    <form autocomplete="off" id="form-establecimiento">
                      <div class="row">
                        <div class="col-md-9 form-group">
                          <label for="establecimiento">Establecimiento</label>
                          <input type="text" class="form-control form-control-border" id="establecimiento">
                        </div>    
                        <div class="col-md-3 form-group">
                          <label for="ruc">ruc</label>
                          <input type="text" class="form-control form-control-border" id="ruc" maxlength="11">
                        </div>                        
                      </div>
                      <div class="row">
                        <div class="col-md-4 form-group">
                          <label for="estDepartamento">Departamento</label>
                          <select  class="custom-select form-control-border" id="estDepartamento">
                          </select>
                        </div>
                        <div class="col-md-4 form-group">
                          <label for="estProvincia">Provincia</label>
                          <select  class="custom-select form-control-border" id="estProvincia">
  
                          </select>
                        </div>
                        <div class="col-md-4 form-group">
                          <label for="estDistrito">Distrito</label>
                          <select  class="custom-select form-control-border" id="estDistrito">
    
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 form-group">
                          <label for="ubicacion">Ubicación:</label>
                          <div class="row">
                            <div class="col-sm-3 form-group">
                              <Select class="custom-select form-control-border" id="estTipoC">
                                <option value="AV">AV</option>
                                <option value="CA">CA</option>
                                <option value="JR">JR</option>
                                <option value="PJ">PJ</option>
                                <option value="UR">UR</option>
                                <option value="LT">LT</option>
                              </Select>
                            </div>
                            <div class="col-sm-7 form-group">
                              <input type="text" placeholder="Nombre de calle" class="form-control form-control-border" id="estNomCalle">
                            </div>
                            <div class="col-sm-2 form-group">
                              <input type="number" class="form-control form-control-border" placeholder="N°" id="estNC" maxlength="5">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 form-group">
                          <label for="estReferencia">Referencia</label>
                          <input type="text" class="form-control form-control-border" id="estReferencia">
                        </div>  
                      </div>
                      <div class="row">
                        <div class="col-sm-6 form-group">
                          <label for="estLatitud">Latitud</label>
                          <input type="number" class="form-control form-control-border" id="estLatitud" maxlength="7">
                        </div>
                        <div class="col-sm-6 form-group">
                          <label for="estLongitud">Longitud</label>
                          <input type="number" class="form-control form-control-border" id="estLongitud" maxlength="7">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 form-group text-right">
                          <button type="button" class="btn btn-sm btn-outline-secondary btn-cancel" data-toggle="collapse" data-target="#content-establecimiento" aria-expanded="false" >Cancelar</button>
                          <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-est">Agregar</button>
                        </div>                   
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div id="empresas">

              </div>
            </div>

            <!-- Redes sociales -->
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-10 text-center">
                      <h5 class="text-bold text-uppercase">Redes Sociales</h5>
                    </div>
                    <div class="col-2  text-right">
                      <button id="btnrs" class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseRed" aria-expanded="false" aria-controls="collapseRed">
                        <i class="fas fa-plus-circle"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="collapseRed">
                  <div class="card-body" >
                    <form autocomplete="off" id="formred">
                      <div class="row" >
                        <div class="col-md-12 form-group">
                          <label>Nombre de red social:</label>
                          <!-- <input type="text" class="form-control form-control-border" id="nombrered"> -->
                          <Select class="custom-select form-control-border" id="nombrered">
                            <option value='' disabled selected hidden>Seleccione:</option>
                            <option value="I">Instagram</option>
                            <option value="F">Facebook</option>
                            <option value="W">WhatsApp</option>
                            <option value="T">Twitter</option>
                            <option value="K">Tik Tok</option>
                            <option value="Y">You Tube</option>
                          </Select>
                        </div>
                        <div class="col-md-12 form-group">
                          <label for="">Vinculo de red social:</label>
                          <input type="text" class="form-control form-control-border" id="vinculo">
                        </div>
                        <div class="col-md-12 form-group text-right" >
                          <button type="button" class="btn btn-sm btn-outline-secondary btn-cancel" data-toggle="collapse" data-target="#collapseRed">Cancelar</button>
                          <button type="button" class="btn btn-sm btn-outline-primary" id="agregarred" >Agregar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Datos dinamicos -->
              <div class="card card-body">
                <table class="table redsocial">
                  <tbody id="redsocial">
                    <!-- Cargado de forma dinamica -->  
                  </tbody>
                </table>                
              </div>
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
      <div class="row mt-2 container-services">

        <!-- Agregar publicación -->
        <div class="content-header col-12" id="container-add-publication">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h5 class="text-bold text-uppercase">Publicación de trabajos</h5>
            </div>
            <div class="card-body">
              <div class="user-block-publication">
                <img class="img-circle" src="dist/img/user/<?php echo $imagenusuario ?>" >
                <button type="button" class="btn btn-publication btn-primary" data-toggle="modal" data-target="#modal-publication">
                  Crear publicación
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Publicaciones de servicios -->
        <div class="content-service col-12">

          <!-- Contenido de las publicaciones -->
          <div class="content-data-publication" id="data-publication-works">
            <!-- sin publicaciones por defecto -->
            <div class="card card-body mt-2 none-register">
              <h5>Sin publicaciones</h5>
            </div>
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
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-album" role="tab" aria-controls="pills-profile" aria-selected="false">Albumes</a>
        </li>
      </ul>
      <!--./Nav de fotos y albumes-->

      <div class="tab-content" id="pills-tabContent">
        <!--Fotos-->
        <div class="tab-pane fade show active" id="pills-foto" role="tabpanel">
          <div class="row" id="load-Gallery">

          </div>
        </div>
        <hr>
        <!--./Fotos-->

        <!--Albumes-->
        <div class="tab-pane fade" id="pills-album" role="tabpanel">
          <div class="row" id="load-album">

          </div>
          <hr>
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
      <div class="row mt-2 content-forum">
        <div class="content-header col-md-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h5 class="text-bold text-uppercase">Foro de consultas</h5>
            </div>
            <div class="card-body p-2 pt-3">
              <!-- Escribir comentario -->
              <div class="write-comment">
                <img src="dist/img/user/<?php echo $imagenusuario ?>" style="align-self:flex-start"/>
                <div class="text-auto-height">
                  <div class="text-input-auto contenteditable write-text-comment" id="forum-post-answers" contenteditable="true" maxlength="250"> </div>
                </div>
                <button type="button" class="btn btn-primary btn-send" style="align-self:flex-start">
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
              <div class="content-comments" style="max-height: 450px;" id="content-data-forum" >
                <!-- dinamicos -->
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
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
            <div class="col-sm-2 align-self-center">
              <label class="form-label">Album:</label>
            </div>
            <div class="col-sm-5">
              <select class="form-control" id="alb-add-gal">

              </select>
            </div>
            <div class="form-group col-sm-5 text-right">
              <input type="file" multiple id="add-new-photo" accept=".jpg, .gif, .png" name="archivo[]">
              <button type="button" class="btn btn-outline-secondary form-button" id="btn-up-cnt-img">Subir imágenes</button>
            </div>
          </div>
        </form>
        <h5>Tus capturas o imágenes:</h5>
        <div class="img-cnt-add">
          <div class="row img-container-upt">

           
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
  <div class="modal-dialog modal-dialog-centered" role="document">
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
        <form autocomplete="off">
          <label for="">Nombre del álbum:</label>
          <input type="text" class="form-control" id="nmb-album-add">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="add-albm">Añadir</button>
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
        <h5 class="modal-title text-bold text-uppercase" id="title-modal-publication">Crear publicación</h5>
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
                <button id="btn-options-files" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown">
                  Tipo de archivo
                </button>
                <div class="dropdown-menu" aria-labelledby="btn-options-files">
                  <a href="javascript:void(0)" class="dropdown-item" id="btn-image">Imagenes</a>
                  <a href="javascript:void(0)" class="dropdown-item" id="btn-video">Video</a>
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
          <div class="row" id="container-images">
            <!-- Aquì se cargan las imagenes previas -->
          </div>

          <!-- Contenido del video vista previa -->
          <div id="container-video">
            <!-- progressbar -->
            <div class="row d-none" id="container-progress-load-video">
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

            <!-- Previsualizador de video traido del servidor -->
            <div id="preview-video-server"></div>

            <!-- Previsualizador de video cargado -->
            <div class="row">
              <div class="col-md-12">
                <video controls id="video-tag" class="d-none">
                  <source id="video-source" src="">
                </video>
              </div>
            </div>
          </div>
          <!-- /. Contenido del video vista previa -->
        </form>

        <!-- Formulario contiene los inputs (imagen / video)-->
        <form id="form-upload-file">
          <input type="file" id="input-new-image" accept="image/*" max="5" multiple hidden />
          <input type="file" id="input-new-video" accept="video/*" size="35" hidden />
        </form>
        <!-- /. Formulario de etiquetas inputs -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-sm btn-info" id="btn-modify-publication">Actualizar</button>
        <button type="button" class="btn btn-sm btn-primary" id="btn-add-publication">Publicar</button>
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
        <h5 class="modal-title text-bold text-uppercase">Denunciar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-report">
          <div class="form-group">
            <label for="motivo">Motivo:</label>
            <select class="custom-select  form-control-border" id="motivo">
              <option selected value="">Selecione</option>
              <option value="Contenido ofensivo">Contenido ofensivo</option>
              <option value="Contenido obsceno">Contenido obsceno</option>
              <option value="Contenido discriminatorio">Contenido discriminatorio</option>
            </select>
          </div>
          <div class="form-group">
            <label for="comentario" class="col-form-label">Cuentanos más sobre tu denuncia:</label>
            <textarea class="form-control form-control-border" id="comentario" maxlength="250"></textarea>
          </div>
        </form>
        <form id="form-image-report">
          <div id="container-image-report" ></div>    

          <input type="file" accept="jpg, png, jpeg" id="input-load-image-report" hidden >
          <button type="button" id="btn-load-image-report" class="btn btn-block btn-primary">
            <i class="fa fas fa-camera-retro"></i> <span>Subir imagen</span>
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar proceso</button>
        <button type="button" class="btn btn-sm btn-danger" id="btn-send-report">Denunciar</button>
      </div>
    </div>
  </div>
</div>
<!--./Modal REPORTAR-->


<!-- Modal Actualizar correo, contraseña y eliminar cuenta -->
<div class="modal fade" id="modalUpdateAccount" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-bold text-uppercase" id="title-modal-account">Actualizar correo electrónico</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form autocomplete="off" id="form-content-credentials">
          <div class="row container-emails">
            <div class="col-12 form-group">
              <label for="emailUser">Correo electrónico</label>
              <input type="email" class="form-control form-control-border" id="emailUser">
            </div>
            <div class="col-md-12 form-group">
              <label for="emailBack">Correo electrónico de respaldo (opcional)</label>
              <input type="email" class="form-control form-control-border" id="emailBack">
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="passwordVerify">Escriba su contraseña actual</label>
              <input type="password" class="form-control form-control-border" id="passwordVerify">
            </div>
          </div>

          <div class="row container-password d-none">
            <div class="col-md-12 form-group">
              <label for="newPassword1">Escriba su nueva contraseña</label>
              <input type="password" class="form-control form-control-border" id="newPassword1">
            </div>
            <div class="col-md-12 form-group">
              <label for="newPassword2">Reescriba su nueva contraseña</label>
              <input type="password" class="form-control form-control-border" id="newPassword2">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-sm btn-info btn-update">Actualizar</button>
        <button type="button" class="btn btn-sm btn-danger btn-delete d-none">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- ZONA DE SCRIPTS -->
<script src="dist/js/uploadFile.js"></script>

<!-- video js -->
<script src="plugins/video-js/video.min.js"></script>

<!-- Perfil -->
<script src="dist/js/pages/galeria.js"></script>
<script src="dist/js/pages/profile.js"></script>

<!-- scripts propios -->
<script src="dist/js/pages/publication-services.js"></script>
