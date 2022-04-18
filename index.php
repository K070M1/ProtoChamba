

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

  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="dist/css/themes.css">
  <link rel="stylesheet" href="dist/css/switch-dark-mode.css">

  <!--Estilos de los modales y formularios-->
  <link rel="stylesheet" href="dist/css/pages/modal-forms.css">
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
              <label>Inicio Sesión</label>
            </div>
            <form>

              <div class="form-group">
                <label>Correo electronico:</label>
                <input type="email" placeholder="Correo electronico" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" placeholder="Contraseña" class="form-control" required>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label">Recordar cuenta</label>
              </div>

              <div>
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-question">Acceder</button>
              </div>

            </form>
            <div class="login-password-lnk">
              <a href="#" data-toggle="modal" data-target="#modal-res-contra1">¿Olvidaste tu contraseña?</a>
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
        <i class="nav-icon fab fa-qq ml-4" style="font-size: 24px;"></i>
        <span class="brand-text font-weight-bold"> Q' Tal Chamba</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Nombre del usuario</a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar text-sm flex-column nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
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
            <li class="nav-header">MENU</li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Gestión de perfil
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?view=perfil-view" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mi Perfil</p>
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
                <i class="fas fa-users-cog nav-icon"></i>
                <p>
                  Rol administrador
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
            <li class="nav-header">FUNCIONES</li>
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
              <a href="index.php?view=geolocalizacion-view" class="nav-link">
                <i class="nav-icon fas fa-map-marker-alt"></i>
                <p>
                  Ubicaciones
                </p>
              </a>
            </li>

            <!--  -->
            <li class="nav-item">
              <a href="index.php?view=work-done-view" class="nav-link">
                <i class="fas fa-briefcase nav-icon"></i>
                <p>Trabajos publicados</p>
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
        </div>
        <!--/. container-fluid -->
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
        <hr class="mb-2" />

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
  <div class="modal fade" id="modalRegister" data-backdrop="static">
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
                <label for="inApellidos">Apellidos:</label>
                <input type="text" class="form-control form-control-border" id="inApellidos" placeholder="Apellidos">
              </div>
              <div class="col-sm-6">
                <label for="inNombres">Nombres:</label>
                <input type="text" class="form-control form-control-border" id="inNombres" placeholder="Nombres">
              </div>
            </div>
            <div class=" form-group row">
              <div class="col-sm-6">
                <label for="inFechaNac">Fecha de nacimiento:</label>
                <input type="date" class="form-control form-control-border" id="inFechaNac">
              </div>
              <div class="col-sm-6">
                <label for="inTelef">Telefono:</label>
                <input type="tel" class="form-control form-control-border" id="inTelef" placeholder="Telefono" maxlength="11">
              </div>
            </div>
            <div class="form-group row">
              <div div class="col-sm-4">
                <label for="slcDepartReg">Departamento:</label>
                <select id="slcDepartReg" class="custom-select form-control-border">

                </select>
                <!-- <input type="text" class="form-control"> -->
              </div>
              <div class="col-sm-4">
                <label for="slcProvinReg">Provincia:</label>
                <select id="slcProvinReg" class="custom-select form-control-border">

                </select>
              </div>
              <div class="col-sm-4">
                <label for="slcDistrReg">Distrito:</label>
                <select id="slcDistrReg" class="custom-select form-control-border">

                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label>Dirección:</label>
                <div class="form-group row">
                  <div class="col-md-2">
                    <Select class="custom-select form-control-border" id="inTipoC">
                      <option value="AV">AV</option>
                      <option value="CA">CA</option>
                      <option value="JR">JR</option>
                      <option value="PJ">PJ</option>
                      <option value="UR">UR</option>
                      <option value="LT">LT</option>
                    </Select>
                  </div>
                  <div class="col-md-6">
                    <input type="text" placeholder="Nombre de calle" class="form-control form-control-border" id="inNCalle">
                  </div>
                  <div class="col-md-2">
                    <input type="number" class="form-control form-control-border" placeholder="N°" id="inNC" maxlength="5">
                  </div>
                  <div class="col-md-2">
                    <input type="number" class="form-control form-control-border" placeholder="Piso" id="inPiso" maxlength="5">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label for="inCorreoE">Correo Electrónico:</label>
                <input type="email" class="form-control form-control-border" id="inCorreoE" placeholder="Correo Electronico">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label for="inPass1">Contraseña:</label>
                <input type="password" class="form-control form-control-border" id="inPass1" placeholder="Contraseña">
              </div>
              <div class="col-sm-6">
                <label for="inPass2">Repetir contraseña:</label>
                <input type="password" class="form-control form-control-border" id="inPass2" placeholder="Repetir Contraseña">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" id="btn-regist-opn">Registrarse</button>
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
            <button type="button" class="btn btn-secondary" id="btn-omt-prf">Omitir</button>
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
          <a href="" data-dismiss="modal">Este no soy yo, cambiar de cuenta</a>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de preguntas de seguridad -->

  <!--Modales Restablecimiento de contraseña-->
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
          <h3 class="font-weight-bold">He olvidado mi contraseña...!</h3>
          <span><label>Suarez*********@gmail.com</label></span>
          <div class="cnt-res">
            <h5>Obtener un código de verificación</h5>
            <p>Se enviará un código de verificación temporal al correo indicado</p>
          </div>
          <div id="btn-gen-res">
            <button type="button" class="btn btn-secondary" id="btnRes3">Generar Código</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de restablecimiento tercer paso -->

  <!---Modal de restablecimiento cuarto paso-->
  <div class="modal fade" id="modal-res-contra4" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body m-res">
          <div id="back-icon">
            <a href="#">
              <i class="fas fa-arrow-left"></i>
            </a>
            <div class="wrapper">
              <div class="pie spinner"></div>
              <div class="pie filler"></div>
              <div class="mask"></div>
            </div>​ 
          </div>
          <h3 class="font-weight-bold">Validar el código de verificación</h3>
          <span><label>Suarez*********@gmail.com</label></span>
          <form id="form-horizontal"">
              <div class=" form-group row">
                <div class="col-sm-5">
                  <label for="">Ingrese el código enviado:</label>
                </div>
                <div class="col-sm-7">
                  <input type="password" class="form-control">
                </div>
            </div>
          </form>
          <div id="btn-gen-res">
            <button type="button" class="btn btn-secondary" id="btnRes4">Validar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---./Modal de restablecimiento cuarto paso-->

  <!-- Modal de restablecimiento quinto paso -->
  <div class="modal fade" id="modal-res-contra5" data-backdrop="static">
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
            <button type="button" class="btn btn-secondary" id="btnRes5">Crear contraseña</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ./Modal de restablecimiento quinto paso -->

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
          <h3 class="font-weight-bold">Solicitar cambio de contraseña</h3>
          <form id="form-horizontal">
            <div class="form-group row">
              <div class="col-sm-12">
                <label for="">Los procesos se enviarán a:</label>
                <input type="email" class="form-control" disabled value="1299595@senati.pe" id="emailDir">
              </div>
            </div>
            <a href="#" data-toggle="modal" data-target="#modal-res-contra2">!No tengo acceso a este correo...!</a>
          </form>
          <div id="btn-gen-res">
            <button type="button" class="btn btn-secondary" id="btnRes1">Siguiente</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de restablecimiento primer paso -->


  <!-- Modal de restablecimiento segundo paso -->
  <div class="modal fade" id="modal-res-contra2" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body m-res">
          <div id="back-icon">
            <a href="#">
              <i class="fas fa-arrow-left"></i>
            </a>
          </div>
          <h3 class="font-weight-bold">Cambio de email de repaldo</h3>
          <form id="form-horizontal">
            <div class="form-group row">
              <div class="col-sm-12">
                <label for="">Los procesas han sido cambiados al email:</label>
                <input type="email" class="form-control" disabled value="1302314@senai.pe" id="emailResp">
              </div>
            </div>
          </form>
          <div id="btn-gen-res">
            <button type="button" class="btn btn-secondary" id="btnRes2">Siguiente</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--./Modal de restablecimiento segundo paso -->

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

  <!-- plugins - Datatable -->
  <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
  <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <!-- /. plugins - Datatable -->

  <!-- Config theme -->
  <script src="dist/js/config.js"></script>

  <!-- Sweetalert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.all.js"></script>

  <script src="dist/js/pages/galeria.js"></script>
  <script>
    $(document).ready(function() {

      var view = getParam("view");
      if (view != false)
        $("#content-data").load(`views/${view}.php`);
      else
        $("#content-data").load(`views/welcome.php`);


      $("#btn-regist-opn").click(function(){
        $("#modal-perfil-img").modal('toggle');
        $("#modalRegister").modal('hide');
      });

      $("#btn-omt-prf").click(function() {
        $("#modal-perfil-img").modal('hide');
      });

      /* Movimiento entre modales */
      $("#btnRes1").click(function() {
        var email = $("#emailDir").val();
        var res = email.replace(/[a-z0-9\-_.]+@/ig, (c) => c.substr(0, 3) + c.split('').slice(3, -1).map(v => '*').join('') + '@');
        $("#emailDir").val(res);
        
        $("#modal-res-contra1").modal("hide");
        $("#modal-res-contra3").modal("toggle");
      });

      $("#btnRes2").click(function() {
        var emailres = $("#emailResp").val();
        var res = email.replace(/[a-z0-9\-_.]+@/ig, (c) => c.substr(0, 3) + c.split('').slice(3, -1).map(v => '*').join('') + '@');
        $("#emailResp").val(res);
        
        $("#modal-res-contra2").modal("hide");
        $("#modal-res-contra3").modal("toggle");
      });

      $("#btnRes3").click(function() {
        $("#modal-res-contra3").modal("hide");
        $("#modal-res-contra4").modal("toggle");
      });

      $("#btnRes4").click(function() {
        $("#modal-res-contra4").modal("hide");
        $("#modal-res-contra5").modal("toggle");
      });

      $("#btnRes5").click(function() {
        $("#modal-res-contra5").modal("hide");
      });
      /* ./Movimiento entre modales */


      /* Registrar usuario */

      // Cargar datos de departamentos
      function slclstDepartm() {
        $.ajax({
          url: 'controller/ubigeo.controller.php',
          type: 'GET',
          data: 'op=getDepartments',
          success: function(e) {
            $("#slcDepartReg").html(e);
          }
        });
      }

      // Cargar datos de provincias
      $("#slcDepartReg").change(function() {
        let iddepart = $(this).val();

        $.ajax({
          url: 'controller/ubigeo.controller.php',
          type: 'GET',
          data: 'op=getProvinces&iddepartamento=' + iddepart,
          success: function(e) {
            $("#slcProvinReg").html(e);
          }
        });

      });

      //Cargar datos de distritos
      $("#slcProvinReg").change(function() {
        let idprovin = $(this).val();

        $.ajax({
          url: 'controller/ubigeo.controller.php',
          type: 'GET',
          data: 'op=getDistricts&idprovincia=' + idprovin,
          success: function(e) {
            $("#slcDistrReg").html(e);
          }
        });
      });

      //Registrarse
      function registerUser() {

        var formData = new FormData();

        let apellidos = $("#inApellidos").val();
        let nombres = $("#inNombres").val();
        let fechanac = $("#inFechaNac").val();
        let telefono = $("#inTelef").val();
        let iddistrito = $("#slcDistrReg").val();
        let tipocalle = $("#inTipoC").val();
        let nombrecalle = $("#inNCalle").val();
        let numerocalle = $("#inNC").val();
        let pisodepa = $("#inPiso").val();
        let email = $("#inCorreoE").val();
        let clave = $("#inPass1").val();

        formData.append("op", "registerUser");
        formData.append("apellidos", apellidos);
        formData.append("nombres", nombres);
        formData.append("fechanac", fechanac);
        formData.append("telefono", telefono);
        formData.append("iddistrito", iddistrito);
        formData.append("tipocalle", tipocalle);
        formData.append("nombrecalle", nombrecalle);
        formData.append("numerocalle", numerocalle);
        formData.append("pisodepa", pisodepa);
        formData.append("email", email);
        formData.append("clave", clave);

        $.ajax({
          url: 'controller/user.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(e) {
            console.log(e);
          }
        });
      }

      $("#btn-regist-opn").click(registerUser);
      slclstDepartm();
      /*./Registrar usuario */


      /* Verificar correo y contraseña */
      $('#btn-login').click(function() {

        var email = $('#email').val();
        var clave = $('#clave').val();
        $.ajax({
          url: 'controller/user.controller.php',
          type: 'GET',
          datatype: 'JSON',
          data: {
            'op': 'loginUser',
            'email': email,
            'clave': clave
          },
          success: res => {
            console.log(res);
          },
          error: e => {
            console.log(e.responseJSON);
          }
        })
      })

    });
  </script>
</body>
</html>