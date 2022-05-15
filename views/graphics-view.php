<?php
  require_once 'access-security.php';
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
        <h3 class="card-title text-uppercase">Cantidad de usuarios por servicio</h3>

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
<script src="dist/js/pages/graphics.js"></script>