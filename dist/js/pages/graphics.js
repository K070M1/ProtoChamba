// GRAFICO 1 - REPORTES DE USUARIOS
const contextReports = $("#lineChartReports").get(0).getContext("2d");
const chartReports = new Chart(contextReports, {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: '',
      data: [],
      backgroundColor: 'rgba(41, 128, 185, 0.4)',
      borderColor: 'rgb(41, 128, 185)',
      borderWidth: 2,
      lineTension: 0.3,
      fill: true,
      pointRadius: 3,
      pointHoverRadius: 6
    }],
  },
  options: optionsChart
});

// GRAFICO 2 - SERVICIOS POPULARES
const contextServices = $("#servicesPopular").get(0).getContext("2d");
const chartServices = new Chart(contextServices, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [{
      label: '',
      data: [],
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
    success: function (result) {
      if (result == "") {
        chartReports.data.labels = ["Sin datos"];
        chartReports.data.datasets[0].label = 'Sin datos';
        chartReports.data.datasets[0].data = [0];
        chartReports.update();
      } else {
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
function totalUsersByService(dataSend) {

  let dataLabels = [];
  let dataSource = [];

  $.ajax({
    url: 'controllers/graphic.controller.php',
    type: 'GET',
    data: dataSend,
    success: function (result) {
      if (result == "") {
        chartServices.data.labels = ["Sin datos"];
        chartServices.data.datasets[0].label = 'Sin datos';
        chartServices.data.datasets[0].data = [0];
        chartServices.update();
      } else {
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
function totalUsersByLevels(dataSend) {
  let dataLabels = [];
  let dataSource = [];

  $.ajax({
    url: 'controllers/graphic.controller.php',
    type: 'GET',
    data: dataSend,
    success: function (result) {
      if (result == "") {
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
$("#filtered").click(function () {
  if (datesIsEmpty()) {
    sweetAlertWarning("Fechas no validas", "Complete todas las fechas");
  } else {
    if(!dateIsValid()){
      sweetAlertError("Fechas no validas", "Fecha de inicio no puede ser mayor o igual al final");
    } else {
      let dates = getDatesFilter();
  
      // Grafico 1
      loadMonthlyReports({
        op: 'monthlyReports',
        fechainicio: dates.dateStart,
        fechafin: dates.dateEnd
      });
  
      // Grafico 2
      totalUsersByService({
        op: 'countUsersByService',
        fechainicio: dates.dateStart,
        fechafin: dates.dateEnd
      });
  
      // Grafico 3
      totalUsersByLevels({
        op: 'userLevels',
        fechainicio: dates.dateStart,
        fechafin: dates.dateEnd
      });
    }
  }
});

// Datos por defecto
$("#default").click(function () {
  loadMonthlyReports({ op: 'monthlyReports' });
  totalUsersByService({ op: 'countUsersByService' });
  totalUsersByLevels({ op: 'userLevels' });
});

// Obtener fecha
function getDatesFilter() {
  let yearStart = $("#year-start").val();
  let monthStart = $("#month-start").val();
  let yearEnd = $("#year-end").val();
  let monthEnd = $("#month-end").val();

  monthStart = monthStart < 10 ? "0" + monthStart : monthStart;
  monthEnd = monthEnd < 10 ? "0" + monthEnd : monthEnd;

  let dates = {
    dateStart: yearStart + "-" + monthStart + "-" + "01",
    dateEnd: yearEnd + "-" + monthEnd + "-" + "01"
  }

  return dates;
}

// validar fechas obtenidas
function datesIsEmpty() {
  return $("#year-start").val() == "" || $("#month-start").val() == "" || $("#year-end").val() == "" || $("#month-end").val() == "";
}

// Comprueba fechas validas
function dateIsValid(){
  let yearStart = $("#year-start").val();
  let yearEnd = $("#year-end").val();
  let monthStart = $("#month-start").val();
  let monthEnd = $("#month-end").val();

  return (yearStart < yearEnd) || (yearStart == yearEnd && parseInt(monthStart) < parseInt(monthEnd));
}

// Funciones que cargan de datos a los graficos
loadMonthlyReports({ op: 'monthlyReports' });
totalUsersByService({ op: 'countUsersByService' });
totalUsersByLevels({ op: 'userLevels' });