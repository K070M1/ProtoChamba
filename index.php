<?php
session_start();
//Sesion aperturada TRUE
// if ($_SESSION['login'] == false){
//   header('location:index.php');    
// }   
// }else{
//   $fotografia =  $_SESSION['fotografia'];
//   $usuario = $_SESSION['nombreusuario'];
// }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>REACTIVACIÓN ECONOMICA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="dist/css/themes.css">
  <link rel="stylesheet" href="dist/css/switch-dark-mode.css">

  <!--Estilos de los modales y formularios-->
  <link rel="stylesheet" href="dist/css/pages/modal-forms.css">

  <!-- Glider -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <!-- Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <!-- Switch -->
      <li class="nav-item item-switch-darkmode">
        <div class="theme-switch-wrapper nav-link dropdown-toggle">
          <label class="theme-switch" for="checkbox-theme">
            <input type="checkbox" id="checkbox-theme" />
            <span class="slider round">
              <i class="fa fa-solid fa-sun"></i>
              <i class="fa fa-solid fa-moon"></i>
            </span>
          </label>
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <!-- User Account: style can be found in dropdown.less -->
      <li class="nav-item dropdown user user-menu">
        <a href="#" class="nav-link" data-toggle="dropdown">
          <img src="./dist/img/user2-160x160.jpg" class="user-image user-image-top" alt="User Image">
          <span class="hidden-xs">Nombre del usuario</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right user-menu">
          <!-- User image -->
          <li class="user-header bg-blue">
            <img src="./dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

            <p>
              NOMBRE Y APELLIDO COMPLETO
              <small>Febrero . 2022</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body border-0">
            <div class="row-flex ">
              <a href="#" class="nav-link">Seguidores</a>
              <a href="#" class="nav-link">Seguidos</a>
              <a href="#" class="nav-link">Servicios</a>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer row-flex">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Perfil</a>
            </div>
            
            <div class="pull-right">
              <a href="#" class="btn btn-default btn-flat">Cerrar sesión</a>
            </div>
          </li>
        </ul>
      </li>

      <!--Login Form-->
      <li class="nav-item dropdown login-form">
        <a href="#" class="nav-link" data-toggle="dropdown">Iniciar de sesión</a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="login-tittle">
            <label >Inicio Sesión</label>
          </div>     
          <form>

            <div class="form-group">
              <label>Correo electronico:</label>
              <input type="email" placeholder="Correo electronico" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Contraseña:</label>
              <input type="password" placeholder="Contraseña" class="form-control"  required>
            </div>

            <div class="form-check">
              <input type="checkbox" class="form-check-input">               
              <label class="form-check-label">Recordar cuenta</label>
            </div>

            <div>
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-question" >Acceder</button>
            </div>

          </form>
          <div class="login-password-lnk">
            <a href="#" data-toggle="modal" data-target="#modal-res-contra1" >¿Olvidaste tu contraseña?</a>
          </div>
        </div>
      </li>

      <!--Register modal-->
      <li class="nav-item">
        <a href="#" data-toggle="modal" data-target="#modalRegister" class="nav-link">Registrarse</a>
      </li>

      <!-- Full screen -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <!-- Config -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!-- <img src="dist/img/logo-editado-5.png" alt="" class="logo"> -->

      <img src="dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold"> Q' Tal Chamba</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Nombre del usuario</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar text-sm flex-column nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Demos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demo 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demo 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Aldair
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?view=perfil-view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perfil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view=geolocalizacion-view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Geolocalización</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Jesus
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?view=inicio-view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inicio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view=bcorta-view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Filtrado V-corta</p>
                </a>
              </li>          
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Najhely
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?view=admin-permissions-view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permisos de admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view=report-history-view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial de reportes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view=graficos-view" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Graficos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="index.php?view=calendar-view" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Calendario
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?view=work-done-view" class="nav-link">
              <i class="fas fa-briefcase nav-icon"></i>
              <p>Trabajos publicados</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?view=calendario-view" class="nav-link">
              <i class="nav-icon fas fa-chart-area"></i>
              <p>
                Graficos
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper text-sm" id="content-body">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" id="content-data">
        <!-- Aqui se cargan los datos dinamicos -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Subir al inicio -->
    <a id="back-to-top" href="#content-body" class="btn btn-dark back-to-top d-none" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="overflow: hidden;">
    <!-- Control sidebar content goes here -->
    <div class="p-3 control-sidebar-content text-sm" style="height: fit-content;">
      <h5>Configuración</h5>
      <hr class="mb-2"/>

      <h6>Barra lateral izquierdo</h6>

      <div class="mb-1">
        <input type="checkbox" class="mr-1" checked id="cbox-sidebar-mini">
        <span>Reducido</span>
      </div>
      <div class="mb-1">
        <input type="checkbox" class="mr-1" id="cbox-sidebar-flat-style">
        <span>Estilo flat</span>
      </div>
      <div class="mb-4">
        <input type="checkbox" class="mr-1" id="cbox-sidebar-disable-focus">
        <span>Deshabilitar autoexpansión</span>
      </div>

      <h6>Reducir el tamaño del texto</h6>

      <div class="mb-1">
        <input type="checkbox" class="mr-1" checked id="cbox-small-text-content-wrapper">
        <span>Contenido</span>
      </div>
      <div class="mb-1">
        <input type="checkbox" class="mr-1" id="cbox-small-text-sidebar" checked>
        <span>Barra lateral (Izq, Der)</span>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer text-sm">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!--Modal de registro-->
  <div class="modal fade" id="modalRegister"  data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title font-weight-bold">Creación de cuenta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group row">
              <div class="col-sm-6"> 
                <label for="">Apellidos:</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">Nombres:</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class=" form-group row">
              <div class="col-sm-6"> 
                <label for="">Fecha de nacimiento:</label>
                <input type="date" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">Telefono:</label>
                <input type="tel" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label for="">Dirección:</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label for="">Correo Electrónico:</label>
                <input type="email" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6"> 
                <label for="">Contraseña:</label>
                <input type="password" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">Repetir contraseña:</label>
                <input type="password" class="form-control">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" id="btn-regist-opn" >Registrarse</button>
        </div>
      </div>
    </div>
  </div>
<!--./Modal de registro-->

<!--Modal de foto de perfil-->
  <div class="modal fade" id="modal-perfil-img" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered md-perfil" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center m-ft-pf">
          <h2>TE DAMOS LA BIENVENIDA...!!</h2>
          <p>Seleccione su foto de perfil </p>
          <div class="ft-pf">
              <img src="dist/img/user2-160x160.jpg" class="img-circle">
              <div class="btn-file-up">
                <button class="btn-upload"><i class="fas fa-upload"></i></button>
                <input class="inpt-file" type="file">
              </div>
          </div>
          <div class="btn-omitir">
            <button type="button"  class="btn btn-secondary" id="btn-omt-prf" >Omitir</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--./Modal de foto de perfil-->

<!--Modal de preguntas de seguridad -->
  <div class="modal fade" id="modal-question" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body quest-md">
          <div>
            <img src="./dist/img/user1-128x128.jpg" class="img-circle">
          </div>
          <label class="md-quest-lb">@USERNAME</label>
          <p>Para verificar que realmente eres tú, responde la siguiente pregunta</p>
          <form class="form-horizontal">
            <div class="form-group row">
              <select class="form-control col-sm-6">
                <option selected>Seleccionar pregunta</option>
                <option value="1">¿Cuando es mi cumpleaños?</option>
                <option value="2">¿El nombre de mi perro es..?</option>
              </select>
              <div class="col-sm-6">
                <input type="text" class="form-control">
              </div>
            </div>
          </form>
          <div class="form-group">
            <button class="btn btn-primary" data-dismiss="modal">INGRESAR</button>
          </div>
          <a href="" data-dismiss="modal" >Este no soy yo, cambiar de cuenta</a>
        </div>
      </div>
    </div>
  </div>
<!--./Modal de preguntas de seguridad -->

<!--Modales Restablecimiento de contraseña-->
  <!-- Modal de restablecimiento primer paso -->
    <div class="modal fade" id="modal-res-contra1" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body m-res">
            <div id="back-icon">
              <a href="#">
                <i class="fas fa-arrow-left"></i>
              </a>
            </div>
            <h3 class="font-weight-bold">He olvidado mi contraseña...!</h3>
            <span><label>Suarez*********@gmail.com</label></span>
            <div class="cnt-res">
              <h5>Obtener un código de verificación</h5>
              <p>Se enviará un código de verificación temporal al correo indicado</p>
            </div>
          <div id="btn-gen-res">
            <button type="button"  class="btn btn-secondary"  id="btnRes1">Generar Código</button>
          </div>
            </div>
          </div>
        </div>
    </div>
  <!--./Modal de restablecimiento primer paso -->

  <!---Modal de restablecimiento segundo paso-->
    <div class="modal fade" id="modal-res-contra2" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body m-res">
            <div id="back-icon">
              <a href="#">
                <i class="fas fa-arrow-left"></i>
              </a>
              <div id="contador-pass"></div>
            </div>
            <h3 class="font-weight-bold">Validar el código de verificación</h3>
            <span><label>Suarez*********@gmail.com</label></span>
            <form id="form-horizontal"">
              <div class="form-group row">
                <div class="col-sm-5">
                  <label for="">Ingrese el código enviado:</label>
                </div>
                <div class="col-sm-7">
                  <input type="password" class="form-control">
                </div>
              </div>
            </form>
            <div id="btn-gen-res">
              <button type="button"  class="btn btn-secondary" id="btnRes2">Validar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!---./Modal de restablecimiento segundo paso-->

  <!-- Modal de restablecimiento tercer paso -->
    <div class="modal fade" id="modal-res-contra3" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body m-res">
            <div id="back-icon">
              <a href="#">
                <i class="fas fa-arrow-left"></i>
              </a>
            </div>
            <h3 class="font-weight-bold">Crear nueva contraseña</h3>
            <span><label for="">Suarez*********@gmail.com</label></span>
            <form class="form-horizontal">
              <div class="form-group row">
                <div class="col-sm-5">
                  <label for="">Nueva contraseña:</label>
                </div>
                <div class="col-sm-7">
                  <input type="password" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-5">
                  <label for="">Repetir contraseña:</label>
                </div>
                <div class="col-sm-7">
                  <input type="password" class="form-control">
                </div>
              </div>
            </form>
            <div id="btn-gen-res">
              <button type="button"  class="btn btn-secondary" id="btnRes3">Crear contraseña</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- ./Modal de restablecimiento tercer paso -->
<!--./Modales Restablecimiento de contraseña-->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Cargar pagina incrustada -->
<script src="dist/js/loadweb.js"></script>

<!-- Config theme -->
<script src="dist/js/config.js"></script>

<!-- Sweetalert2 -->
<script src="./plugins/sweetalert2/sweetalert2.all.js"></script>

<!--Configuración del temporizador-->
<script src="dist/js/pages/md-restabl-temporizador.js"></script>

<!-- Script glider -->
<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>


<script>
  $(document).ready(function (){
    var view = getParam("view");
    if (view != false)
      $("#content-data").load(`views/${view}.php`);
    else
      $("#content-data").load(`views/welcome.php`);

    $(".nav-link").click(function(){
      $(".nav-link").removeClass('active');
      //$(".nav-link + .nav-treeview").addClass('d-none');
      $(this).addClass('active');
      //$(".nav-link.active + .nav-treeview").removeClass('d-none');
    
    $("#btn-regist-opn").click(function(){
      $("#modal-perfil-img").modal('toggle');
      $("#modalRegister").modal('hide');
    });

    $("#btn-omt-prf").click(function(){
      $("#modal-perfil-img").modal('hide');
    });

    /* Movimiento entre modales */
    $("#btnRes1").click(function(){
      $("#modal-res-contra1").modal("hide");
      $("#modal-res-contra2").modal("toggle");
    });

    $("#btnRes2").click(function(){
      $("#modal-res-contra2").modal("hide");
      $("#modal-res-contra3").modal("toggle");
    });

    $("#btnRes3").click(function(){
      $("#modal-res-contra3").modal("hide");
    });

    /* ./Movimiento entre modales */

    /*Temporizador*/
    $("#btnRes1").click(function(){
      startTimer();
    });
    /*./Temporizador */
    });
  });
</script>
</body>
</html>
