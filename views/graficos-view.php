<?php
  $months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  $current_date = date('Y-m-d', time());
?>

<link rel="stylesheet" href="dist/css/chart-responsive.css">

<!-- Cabecera -->
<div class="callout callout-info">
  <h5><i class="fas fa-chart-area"></i> Dashboard</h5>
</div>

<!-- filtros -->
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">FILTRAR POR FECHA</h3>

        <div class="card-tools">
          <button class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="card-body">
        <form id="form-filtros">
          <!-- Campos -->
          <div class="row">
            <div class="col-md-6 col-6">

              <div class="row">
                <div class="col-12">
                  <label for="year-start">FECHA INICIO</label>
                </div>

                <!-- año inicial -->
                <div class="col-xs-6 col-ms-6 col-sm-6 col-md-6 form-group">
                  <select class="form-control rounded-0" id="year-start">
                    <option value="">Año</option>
                    <?php
                    for ($i = 2002; $i <= $current_date; $i++) {
                      echo "
                        <option value='{$i}'>{$i}</option>
                        ";
                    }
                    ?>
                  </select>
                </div>
                <!-- Año final -->

                <!-- Meses inicial-->
                <div class="col-xs-6 col-ms-6 col-sm-6 col-md-6 form-group">
                  <select class="form-control rounded-0" id="month-start">
                    <option value="">Mes</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                      echo "
                        <option value='{$i}'>{$months[$i - 1]}</option>
                        ";
                    } ?>
                  </select>
                </div>

              </div>
            </div>

            <div class="col-md-6 col-6">
              <div class="row">
                <div class="col-12">
                  <label for="year-end">FECHA FINAL</label>
                </div>

                <!-- año final -->
                <div class="col-xs-6 col-sm-6 col-md-6 form-group">
                  <select class="form-control rounded-0" id="year-end">
                    <option value="">Año</option>
                    <?php
                    for ($i = 2002; $i <= $current_date; $i++) {
                      echo "
                        <option value='{$i}'>{$i}</option>
                        ";
                    }
                    ?>
                  </select>
                </div>
                <!-- Año final -->

                <!-- Meses final -->
                <div class="col-xs-6 col-sm-6 col-md-6 form-group">
                  <select class="form-control rounded-0" id="month-end">
                    <option value="">Mes</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                      echo "
                        <option value='{$i}'>{$months[$i - 1]}</option>
                        ";
                    } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- Botones -->
          <div class="row">
            <div class="col-md-12 text-right">
              <button type="button" id="default" class=" btn btn btn-primary"><i class="fas fa-poll"></i> Mostrar todos</button>
              <button type="button" id="filtered" class=" btn btn btn-warning"><i class="fas fa-sync"></i> Filtrar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Graficos -->
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title text-uppercase">Reportes de usuarios por mes</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="lineChartReports" class="chart-responsive"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title text-uppercase">Total de usuarios por servicio</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>

      <div class="card-body">
        <div class="chart">
          <canvas id="servicesPopular" class="chart-responsive"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title text-uppercase">Niveles de usuario</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>

      <div class="card-body">
        <div class="chart">
          <canvas id="levelUser" class="chart-responsive"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="dist/js/colors-chart.js"></script>
<script src="dist/js/options-chart.js"></script>
<script>
  $(function() {

    // GRAFICO 1 - REPORTES DE USUARIOS
    const contextReports = $("#lineChartReports").get(0).getContext("2d");
    const chartReports = new Chart(contextReports, {
      type: 'line',
      data: {
        labels: ["Dem1", "Dem2", "Dem3"],
        datasets: [{
          label: 'title 1',
          data: [5, 35, 58],
          backgroundColor: 'rgba(41, 128, 185, 0.4)',
          borderColor: 'rgb(41, 128, 185)',
          borderWidth: 2,
          lineTension: 0.3,
          fill: false,
          pointRadius: 3,
          pointHoverRadius: 6
        }/* ,{
          label: 'title 2',
          data: [45, 6, 28],
          backgroundColor: 'rgba(220, 118, 51, 0.4)',
          borderColor: 'rgb(220, 118, 51)',
          borderWidth: 2,
          lineTension: 0.3,
          fill: false,
          pointRadius: 3,
          pointHoverRadius: 6
        } */],
      },
      options: optionsChart
    });

    // GRAFICO 2 - SERVICIOS POPULARES
    const contextServices = $("#servicesPopular").get(0).getContext("2d");
    const chartServices = new Chart(contextServices, {
      type: 'bar',
      data: {
        labels: ["Dem1", "Dem2", "Dem3"],
        datasets: [{
          label: 'title 1',
          data: [5, 60, 58],
          backgroundColor: listBgColor,
          borderColor: listBrColor,
          borderWidth: 1
        }],
      },
      options: optionsChart
    });

    // GRAFICO 3 - NIVEL DE USUARIOS
    const contextLevelUser = $("#levelUser").get(0).getContext("2d");
    const chartLevelUser = new Chart(contextLevelUser, {
      type: 'pie',
      data: {
        labels: ["Dem1", "Dem2", "Dem3"],
        datasets: [{
          label: 'title 1',
          data: [5, 60, 58],
          backgroundColor: listBgColor,
          borderColor: listBrColor,
          borderWidth: 1
        }],
      },
      options: optionsChart
    });


    // cargar reportes mensuales
    function loadMonthlyReports(dataSend) {

      let dataLabels = [];
      let dataSource = [];

      $.ajax({
        url: 'controllers/graphic.controller.php',
        type: 'GET',
        data: dataSend,
        success: function(result) {
          if(result == ""){
            chartReports.data.labels = ["Sin datos"];
            chartReports.data.datasets[0].label = 'Sin datos';
            chartReports.data.datasets[0].data = [0];
            chartReports.update();
          } else{
            let dataController = JSON.parse(result);
  
            // Recorrer el arreglo
            dataController.forEach(value => {
              dataLabels.push(value.mes);
              dataSource.push(value.reportes);
            });
  
            chartReports.data.labels = dataLabels;
            chartReports.data.datasets[0].label = 'Total';
            chartReports.data.datasets[0].data = dataSource;
            chartReports.update();
          }
        }
      });
    }

    // Total de usuarioes por servicio
    function totalUsersByService(dataSend){

      let dataLabels = [];
      let dataSource = [];

      $.ajax({
        url: 'controllers/graphic.controller.php',
        type: 'GET',
        data: dataSend,
        success: function(result){
          if(result == ""){
            chartServices.data.labels = ["Sin datos"];
            chartServices.data.datasets[0].label = 'Sin datos';
            chartServices.data.datasets[0].data = [0];
            chartServices.update();
          } else{
            let dataController = JSON.parse(result);
  
            // Recorrer el array
            dataController.forEach(value => {
              dataLabels.push(value.nombreservicio);
              dataSource.push(value.total);
            });
  
            // Asignar datos al grafico
            chartServices.data.labels = dataLabels;
            chartServices.data.datasets[0].label = 'Usuarios';
            chartServices.data.datasets[0].data = dataSource;
            chartServices.update();
          }
        }
      });
    }

    // usuarios por niveles
    function totalUsersByLevels(dataSend){
      let dataLabels = [];
      let dataSource = [];

      $.ajax({
        url: 'controllers/graphic.controller.php',
        type: 'GET',
        data: dataSend,
        success: function(result){
          if(result == ""){
            chartLevelUser.data.labels = ["Sin datos"];
            chartLevelUser.data.datasets[0].data = [0];
            chartLevelUser.update();
          } 
          else {
            let dataController = JSON.parse(result);
  
            // Recorrer el arreglo
            dataController.forEach(value => {
              dataLabels.push(value.nivelusuario);
              dataSource.push(value.total);
            });
  
            // Asignando datos al gráfico
            chartLevelUser.data.labels = dataLabels;
            chartLevelUser.data.datasets[0].data = dataSource;
            chartLevelUser.update();
          }
        }
      }); // fin ajax
    }

    // Filtrar por fecha
    $("#filtered").click(function(){
      if(datesIsEmpty()){
        sweetAlertWarning("Fechas no validas", "Complete todas las fechas");
      } else {
        let dates = getDatesFilter();

        // Grafico 1
        loadMonthlyReports({
          op          : 'monthlyReports',
          fechainicio : dates.dateStart,
          fechafin    : dates.dateEnd
        });

        // Grafico 2
        totalUsersByService({
          op: 'countUsersByService',
          fechainicio : dates.dateStart,
          fechafin    : dates.dateEnd
        });

        // Grafico 3
        totalUsersByLevels({
          op: 'userLevels',
          fechainicio : dates.dateStart,
          fechafin    : dates.dateEnd
        });
      }
    });

    // Datos por defecto
    $("#default").click(function(){
      loadMonthlyReports({op: 'monthlyReports'}); 
      totalUsersByService({op: 'countUsersByService'}); 
      totalUsersByLevels({op: 'userLevels'});
    });

    // Obtener fecha
    function getDatesFilter(){
      let yearStart = $("#year-start").val();
      let monthStart = $("#month-start").val();
      let yearEnd = $("#year-end").val();
      let monthEnd = $("#month-end").val();

      monthStart = monthStart < 10? "0" + monthStart: monthStart;
      monthEnd   = monthEnd < 10? "0" + monthEnd: monthEnd;

      let dates = {
        dateStart: yearStart + "-" + monthStart + "-" + "01",
        dateEnd  : yearEnd + "-" + monthEnd + "-" + "01"
      }

      return dates;
    }

    // validar fechas obtenidas
    function datesIsEmpty(){
      return $("#year-start").val() == "" || $("#month-start").val() == "" ||  $("#year-end").val() == "" || $("#month-end").val() == "";
    }

    // Funciones que cargan de datos a los graficos
    loadMonthlyReports({op: 'monthlyReports'}); 
    totalUsersByService({op: 'countUsersByService'}); 
    totalUsersByLevels({op: 'userLevels'});
  })
</script>