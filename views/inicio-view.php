<!-- Link de los iconos de fontawesome -->
<script src="https://kit.fontawesome.com/e58c03f22e.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="dist/css/pages/main.css">
<link rel="stylesheet"  href="dist/css/pages/owl.carousel.min.css">
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.theme.default.min.css">


<div class="wrapper-main">

    <!-- HERO -->
    <div class="hero align-items-center" style="height: 50vh;"id="home">
      <div class="titulos">
        <h1 class=" text-center display-3 text-white " >Bienvenido a Q'tal Chamba</h1> 
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
    <div class="servicios ">
      <div class="recomendados">
        <div class="row">
          <div class = "col-md-6">
            <h3 class="text-center" style="margin-right: 55%;">Servicios Destacados</h3>
          </div>
          <div class="col-md-6">
            <button class="btn btn text-white" style="background: linear-gradient(45deg, #392e6d, #2e3881); margin-left: 76%;" type="submit" >Ver mas</button>
          </div>
        </div>
      </div>
       
      <div class="slider">
          <div class="owl-carousel">
            <div class="caja">
              
            </div>
          </div>
      </div>

      

    </div><!-- Fin de la seccion servicios -->

</div>  <!-- Fin del weaper main  -->

<script src="dist/js/pages/owl.carousel.min.js"></script>
<script src="dist/js/pages/ap.js"></script>
<script src="dist/js/config.owl.carousel.js"></script>

<script>
 $(document).ready(function (){

    function getSpecialty(){
      $.ajax({
        url: 'controller/especialidad.php',
        type: 'GET',
        data: 'op=getSpecialty',
        success : function(e){
         /*  console.log(e); */

          $('.container-cards').html(e);

        }
      });
    }
    
    



    getSpecialty();
    
 });

</script>

