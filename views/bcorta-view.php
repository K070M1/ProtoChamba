<!-- ===== Link del Swiper ===== -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<!-- Link de los iconos de fontawesome -->
<script src="https://kit.fontawesome.com/e58c03f22e.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
<link rel="stylesheet" href="dist/css/pages/bcorta.css">


  
 <!-- NAVBAR -->
 <nav class="navbar navbar-expand p-2" style="background: linear-gradient(45deg, #392e6d, #2e3881);">
        <a class="navbar-brand" href="#">
           <h2 class="text-white" style="margin-left:20%">Q'TAL CHAMBA</h2>
        </a>
  </nav><!-- //NAVBAR -->
    

         <!-- HERO -->
    <div class="hero align-items-center" style="height: 50vh;"id="home">
            <div class="titulos mt-0">
                  <h1 class=" text-center display-3 text-white mt-0 " >Bienvenido a Q'tal Chamba</h1> 
                  <h5 class="text-white text-center">Hoy tenemos 150 servicios disponibles para ti</h5>  
              </div>
      <div class="input-group">
          <input type="text" class="form-control" placeholder="Ingrese el Servicio" aria-label="Recipient's username with two button addons"><br>
          <i class="fa-solid fa-briefcase" id="iconowork"></i>
          <input type="text" class="form-control" placeholder="Ingrese la ubicacion" aria-label="Recipient's username with two button addons"><br>
          <i class="fa-solid fa-location-dot" id="iconolocation"></i>
          <a href="#" class="btn btn-outline-light">Buscar Servicios</a>
    </div>

      
      <div class= "wave" style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,4.47 C149.99,150.00 406.31,104.13 503.38,-5.41 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: rgb(255, 255, 255);"></path></svg></div>
    </div><!-- //HERO -->
    
        <!-- SERVICES -->
        <div class="servicios">
          <div class="recomendados">
            <div class="row">
              <div class = "col-md-6">
                <h3 class="text-center" style="margin-right: 43%;">Coincidencias Encontradas</h3>
              </div>
              <div class="col-md-2">
                <h4 class="text-center" style="margin-left: 40%;">Ordenar por :</h4>
              </div>
              <div class="col-md-2">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
              </div>
              <div class="col-md-2">
                <i class="fa-solid fa-list"></i>
                <i class="fa-solid fa-list"></i> 
              </div>
            </div>
          </div>
         
  
          <div class="row">
            <div class="col-md-4">
                <div class="card-filtro">
                  <div class="card text-center">
                      <div class="card-header">
                        <h5>Filtrar</h5>
                      </div>
                      <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Nivel de Estrellas
                              </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    1 estrellas
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    2 estrellas
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    3 estrellas
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    4 estrellas
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    5 estrellas
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div><!-- Fin del primer item -->
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Tarifas
                              </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    50-86
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    87-150
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    160-250
                                  </label>
                                </div>
                          
                              </div>
                            </div>
                          </div>
                        </div><!-- Fin del acordion -->
                      </div><!-- Fin del card del body -->
                    </div>
                </div><!-- Fin del card -->
                
                <div class="mapa p-2">
                    <img src="./img/mapa.webp" style="margin-left: 55%;" alt=""><br>
                    <button type="button" style="margin-left: 70%; background-color: #244289; color: aliceblue;" class="btn">Ver en el mapa</button>
                </div>
            </div>
            
            <div class="col-md 8">
                  <div class="d-flex flex-row">
                      <div class="p-2 bd-highlight">
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

                      <div class="p-2 bd-highlight">
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
                      </div><!-- Fin de la 2 fila -->
                  </div>

                  <div class="d-flex flex-row">
                    <div class="p-2 bd-highlight">
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

                    <div class="p-2 bd-highlight">
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
                    </div><!-- Fin de la 2 fila -->
                  </div>

                  <div class="d-flex flex-row">
                    <div class="p-2 bd-highlight">
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

                    <div class="p-2 bd-highlight">
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
                    </div><!-- Fin de la 2 fila -->
                  </div>

            </div>
              
          </div><!-- Fin delrow 2 -->
        </div>
        
         
        </div><!-- Fin de la seccion servivcios -->