<link rel="stylesheet" href="dist/css/pages/bcorta.css">


<!-- HERO -->
<div class="hero align-items-center" style="height: 50vh;" id="home">
  <div class="titulos mt-0">
    <h1 class=" text-center display-3 text-white mt-0 ">Bienvenido a Q'tal Chamba</h1>
    <h5 class="text-white text-center">Hoy tenemos 150 servicios disponibles para ti</h5>
  </div>
  <div class="row" id="inputsearch">
        <div class="col-md-4">
          <select class ="custom-select" id="searchEst">
            <optgroup label="Departamentos" id="departamentos">
              
              <!-- <option value="1">Naranjas</option>
              <option value="2">Manzanas</option>
              <option value="3">Sandia</option>
              <option value="4">Frutilla</option>
              <option value="5">Durazno</option>
              <option value="6">Ciruela</option> -->
            </optgroup>
            <!-- <optgroup label="Provincias" id="provincias">
              <option value="7">Lechuga</option>
              <option value="8">Acelga</option>
              <option value="9">Zapallo</option>
              <option value="10">Papas</option>
              <option value="11">Batatas</option>
              <option value="13">Zanahorias</option>
              <option value="14">Rabanitos</option>
              <option value="15">Calabaza</option>
            </optgroup> -->
          </select>
        </div>
        <div class="col-md-4">
        <input type="text" class="form-control" id="inputService" placeholder="Ingrese el Servicio">
        </div>
        <div class="col-md-4">
          <a href="#" class="btn btn-outline-light" id="SearchIndex">Buscar Servicios</a>
        </div>
  </div>


</div><!-- //HERO -->

<!-- SERVICES -->
<div class="servicios">
  <div class="recomendados">
    <div class="row">
      <div class="col-md-6">
        <h3 class="text-center" style="margin-right: 43%;">Coincidencias Encontradas</h3>
      </div>
      <div class="col-md-2">
        <h4 class="text-center" style="margin-left: 40%;">Ordenar por :</h4>
      </div>
      <div class="col-md-2">
        <select class="form-control" id="exampleFormControlSelect1">
          <option selected>Seleccione</option>
          <option>Ultimos Servicios Agregados</option>
          <option>Antiguos Servicios</option>
        </select>
      </div>

    </div>
  </div><!-- Fin de Recomendados -->


  <div class="row">
    <div class="col-md-4">
      <div class="card text-center m-auto" id="cardfilterStar" style="width: 18rem;">
        <div class="card-head text-center">
            <h6 class="text-center p-3">Panel de filtro por Estrellas</h6>
            <span> <i class="fas fa-star"></i></span>
        </div>
        <div class="card-body text-center">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              1 estrellas
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              2 estrellas
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              3 estrellas
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              4 estrellas
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              5 estrellas
            </label>
          </div>
        </div>
      </div>
      <hr>
      <div class="card text-center m-auto" id="cardfilterTarifa" style="width: 18rem;">
        <div class="card-head text-center">
            <h6 class="text-center p-3">Panel de filtro por Tarifa</h6>
            <span><i class="fas fa-dollar-sign"></i></i></span>
        </div>
        <div class="card-body text-center">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input type="text" class="form-control" id="searchTarifa" >
          </div>
        </div>
      </div>

    </div><!-- Fin del row 4 -->

    <div class="col-md 8">
      
      <div class="caja">
      
        <ul class="nav nav-pills" style="margin-left:80%;" id="pills-tab" role="tablist">

          <li class="nav-item " role="presentation">
            <a class="nav-link active " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-th" id="icono-grid"></i></a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-list" id="icono-lista"></i></a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="group-cards" id="cards-servicios">
                <!-- Card vista grid -->
            </div>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="" id="cards-serviciosl">
                <!-- Cards vista list -->
            </div>  
          </div>
        </div>
      </div> <!-- Fin de la caja que contiene los cards -->
    </div><!-- Fin del col-md-8 -->
  </div> <!-- fin del row principal -->


</div><!-- Fin de la seccion servivcios -->

<script>
 $(document).ready(function (){


    var datagrid = {
        op : 'filterSpecialty',
        iddepartamento : '',
        search : '',
      };

      var datalist = {
        op : 'filterSpecialtyLarge',
        iddepartamento : '',
        search : '',
      };

      var datatarifa = {
        op : 'filterTarifasGrid',
        tarifa : '',
      };

      var datatarifalist = {
        op : 'filterTarifasList',
        tarifa : '',
      };


    function getSpecialty(){
      $.ajax({
        url: 'controllers/specialty.controller.php',
        type: 'GET',
        data: datagrid,
        success : function(e){
         /*  console.log(e); */
          $('#cards-servicios').html(e);
        }
      });
    }

    function getSpecialtyLarge(){
      $.ajax({
        url: 'controllers/specialty.controller.php',
        type: 'GET',
        data: datalist,
        success : function(e){
         /*  console.log(e); */
          $('#cards-serviciosl').html(e);
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


    function filterTarifa(){
        
      $.ajax({
        url: 'controllers/specialty.controller.php',
        type: 'GET',
        data: datatarifa,
        success : function(e){
          console.log(e);
          $('#cards-servicios').html(e);
        }
      });
    }

    function filterTarifaList(){
        
        $.ajax({
          url: 'controllers/specialty.controller.php',
          type: 'GET',
          data: datatarifalist,
          success : function(e){
            console.log(e);
            $('#cards-serviciosl').html(e);
          }
        });
      }

    $("#searchTarifa").keyup(function(e){
      
      datatarifa['tarifa'] = $(this).val();

        
        updateDataTarifa();
        filterTarifa();
    });

    $("#searchTarifa").keyup(function(e){
      
      datatarifalist['tarifa'] = $(this).val();

        
        updateDataTarifaList();
        filterTarifaList();
      });

      //Boton que realiza la busqeuda del servicio y departamento
    $("#SearchIndex").click(function(){

        datagrid['iddepartamento'] = $(this).val();
        datagrid['search'] = $(this).val();
       
        
        updateDataGrid();
        getSpecialty();
        
    });

    $("#SearchIndex").click(function(){

      datalist['iddepartamento'] = $(this).val();
      datalist['search'] = $(this).val();

      updateDataList();
      getSpecialtyLarge();
    });

    //Buscar por tarifa
    

    function updateDataGrid(){
      datagrid['iddepartamento'] = $("#searchEst").val();
      datagrid['search'] = $("#inputService").val().trim();
    }

    function updateDataList(){
      datalist['iddepartamento'] = $("#searchEst").val();
      datalist['search'] = $("#inputService").val().trim();
    }

    function updateDataTarifa(){
      datatarifa['tarifa'] = $("#searchTarifa").val().trim();
    }

    function updateDataTarifaList(){
      datatarifalist['tarifa'] = $("#searchTarifa").val().trim();
    }

    
    slclstDepartm();
    getSpecialty();
    getSpecialtyLarge();
    
    
 });

</script>
