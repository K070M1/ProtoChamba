<!-- Link de los iconos de fontawesome -->
<script src="https://kit.fontawesome.com/e58c03f22e.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="dist/css/pages/main.css">

<!-- Carousel -->
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="plugins/owl-carousel/css/owl.theme.default.min.css">
<link rel="stylesheet" href="dist/css/carousel-owl.css">

<!-- owl carousel -->
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script>
<script src="dist/js/config.owl.carousel.js"></script>
<script src="dist/js/pages/ap.js"></script>

<div class="wrapper-main">

    <!-- HERO -->
    <div class="hero align-items-center" style="height: 50vh;"id="home">
      <div class="titulos">
        <h1 class=" text-center display-3 text-white " >Bienvenido a Q'tal Chamba</h1> 
        <h5 class="text-white text-center" style ="margin-top:6%;">Hoy tenemos 150 servicios disponibles para ti</h5>  
      </div>
     <div class="row" id="inputsearch">
        <div class="col-md-4">
         
        </div>
        <div class="col-md-4">
        <a href="index.php?view=bcorta-view" class="btn btn-outline-light btn-lg" id="SearchIndex">Buscar Servicios</a>
        </div>
        <div class="col-md-4">
          
        </div>
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
       
      <div class="group-cards" id="cards-servicios">
          
      </div>

    </div><!-- Fin de la seccion servicios -->

</div>  <!-- Fin del weaper main  -->



<script>
 $(document).ready(function (){

        var data = {
        op : 'filterSpecialty',
        iddepartamento : '',
        search : '',
      };

    function getSpecialty(){
      $.ajax({
        url: 'controllers/specialty.controller.php',
        type: 'GET',
        data: data,
        success : function(e){
          console.log(e);
          $('#cards-servicios').html(e);
        }
      });
    }

    function slclstDepartm() {
        $.ajax({
          url: 'controllers/ubigeo.controller.php',
          type: 'GET',
          data: 'op=getDepartments',
          success: function(e) {
            $("#departamentos").html(e);
          }
        });
      }

    $("#searchEst").change(function(){
      $("#inputService").val("").focus();
      
      data['iddepartamento'] = $(this).val();
      getSpecialty();
    });


    $("#inputService").keyup(function(e){
      var valueInput = $(this).val();

      updateData();
      getSpecialty();
    });


  
   
    slclstDepartm()
    getSpecialty();

    
 });

</script>

