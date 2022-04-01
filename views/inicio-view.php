
<!-- ===== Link del Swiper ===== -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<!-- Link de los iconos de fontawesome -->
<script src="https://kit.fontawesome.com/e58c03f22e.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
<link rel="stylesheet" href="dist/css/pages/main.css">

<!-- Script glider -->
<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
<script src="dist/js/pages/ap.js"></script>


<div class="wrapper-main">
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="#">
          <h2>Q'TAL CHAMBA</h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <button class="btn ms-lg-3" style="background-color: #244289; color: aliceblue;">Iniciar Sesion</button>
            <button class="btn  ms-lg-3" style="background-color: #244289; color: aliceblue;">Registrarse</button>
          </ul>
          
      </div>
    </div>
  </nav><!-- //NAVBAR -->
  
  <!-- HERO -->
  <div class="hero vh-100 d-flex align-items-center" id="home">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h1 class="display-3 text-white">Bienvenido a Q'tal Chamba</h1> 
                <h5 class="text-white text-center">Hoy tenemos 150 servicios disponibles para ti</h5>  
            </div>
            <div class="indice">
              <div class="row">
                <div class="col-md-3">      
                </div>
                <div class="col-md-3">
                  <div class="grupo-input">
                    <input type="text" class="form-control" placeholder="Ingrese el servicio"><br>
                    <img src="./img/work.png" alt="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="grupo-input">
                    <input type="text" class="form-control" placeholder="Ingrese la Locacion"><br>
                    <img src="./img/location.png" alt="">
                  </div>
                </div>
                <div class="col-md-3">
                  <a href="#" class="btn btn-outline-light " style="margin-top: 5%;">Buscar Servicios</a>
                </div>
              </div>
            </div>
            
            
        </div>
          
    </div>
  </div><!-- //HERO -->
        
  <!-- SERVICES -->
  <div class="servicios">
    <div class="recomendados">
      <div class="row">
        <div class = "col-md-6">
          <h3 class="text-center" style="margin-right: 55%;">Servicios Destacados</h3>
        </div>
        <div class="col-md-6">
          <button class="btn" style="background-color: #244289; color: aliceblue; margin-left: 76%;" type="submit" >Ver mas</button>
        </div>
      </div>
    </div>
  
    <div class="contenedor">
    
      <div class="carousel">
        <div class="carousel-contenedor">
  
          <button aria-label="Anterior" class="carousel-anterior">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          
          <div class="carousel-lista">
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senatite2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Comunicarse</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion Est</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">  
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
          </div><!-- Fin del carousel lista -->
          
          
  
          <button aria-label="Siguiente" class="carousel-siguiente">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div><!-- Fin del carousel contenedor -->
  
        <div role="tablist" class="carousel-indicadores"></div>
      </div><!-- Fin del carousel -->
    </div><!-- Fin del contenedor -->
  
  
    <div class="recomendados">
      <div class="row">
        <div class = "col-md-6">
          <h3 class="text-center" style="margin-right: 55%;">Carpinteria</h3>
        </div>
        <div class="col-md-6">
          <button class="btn" style="background-color: #244289; color: aliceblue; margin-left: 76%;" type="submit" >Ver mas</button>
        </div>
      </div>
    </div>
    
    <div class="contenedor">
    
      <div class="carousel">
        <div class="carousel-contenedor">
  
          <button aria-label="Anterior" class="carousel-anterior2">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          
          <div class="carousel-lista2">
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senatite2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Comunicarse</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion Est</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->
                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
  
            <div class="carousel-elemento">
              <div class="card-content">  
                <div class="header"><!-- Inicio del header -->
                  <div class="row">
                    <div class="col-md-4">                  
                      <img src="./img/user2.png" alt=""> <!-- Imagen de Perfil -->
                    </div>
                    <div class="col-md-8">
                      <div class="iconos">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <div class="servicio">
                        <h5 class="text-white">Jesus Peve Andazabal</h5>
                        <h6 class="text-white">Electricista</h6>
                      </div>
                    </div><!-- Fin del row de la cabecera -->   
                  </div>
                </div><!-- Fin del header -->

                
                <div class="card-body"><!-- Inicio del cuerpo del card-->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="col-md-11">
                        <h6>senati2022@senati.pe</h6>
                      </div>
                    </div> <!-- Fin del row 1 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>LLamar</h6>
                      </div>
                      <div class="col-md-3"> 
                      </div>
                    </div><!-- Fin del row 2 -->
                    <div class="row">
                      <div class="col-md-1">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="col-md-8">
                        <h6>Ubicacion</h6>
                      </div>
                    </div><!-- Fin del row 3 -->
                </div><!-- Fin del cuerpo del card -->
            
                <div class="card-footer"><!-- Inicio del pie del card -->
                  <div class="redes-sociales">
                      <i class="fa-brands fa-facebook-f"></i>
                      <i class="fa-brands fa-instagram"></i>
                      <i class="fa-brands fa-whatsapp"></i>
                  </div>
                </div><!-- Fin del footer -->
              </div><!-- Fin del card -->
            </div>
          </div><!-- Fin del carousel lista -->
          
          
  
          <button aria-label="Siguiente" class="carousel-siguiente2">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div><!-- Fin del carousel contenedor -->
  
        <div role="tablist" class="carousel-indicadores"></div>
      </div><!-- Fin del carousel -->
    </div><!-- Fin del contenedor -->
  </div><!-- Fin de la seccion servicios -->

</div>  

