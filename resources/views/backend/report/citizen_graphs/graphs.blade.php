<!-- Se llama a traer la vista que contiene el header, footer y la barra lateral -->
@extends('admin.admin_view')
@section('admin')

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Inicia JavaScript para la grafica de clases de los ciudadanos -->
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Clase', 'Ciudadanos pertenecientes'],
            <?php echo $chartData; ?>
        ]);

        var options = {
            legendTextStyle: { color: '#FFF' },
            backgroundColor: { fill:'transparent' },
            is3D: true,
        };

        //var chart_div = document.getElementById('piechart_3d');
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

        /* google.visualization.events.addListener(chart, 'ready', function () {
            chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
            console.log(chart_div.innerHTML);
        }); */

        chart.draw(data, options);
        /* document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '" target="_blank">Printable version</a>';
        google.charts.setOnLoadCallback(drawChart); */
        }
    </script>

  //
  <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Año', 'Ciudadanos'],
          <?php echo $chartYear; ?>
        ]);

        var options = {
          legendTextStyle: { color: '#FFF' },
          backgroundColor: { fill:'transparent' },
          pieHole: 0.4,
        };


        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>


  </head>
    <body>
        <section class="content">
            <div class="content-wrapper">
                <div class="container-full">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title"> Graficas informativas de los ciudadanos </h3>
                            <br>
                            <div class="d-inline-block align-items-center"></div>
                        </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="box">
                            <div class="box-body">
                                <h4 class="box-title"> Ciudadanos categorizados por clase</h4>
                                <div>
                                    <div id="piechart_3d" style="width: 900px; height: 500px;"> </div>
                                    <a class="btn btn-app btn-warning" href="{{route('citizen.graph.view')}}">
							            <i class="fa fa-repeat"></i> Actualizar
						            </a>
                                    <a class="btn btn-app btn-danger" target="_blank" href="{{route('citizen.graph.class')}}">
							            <i class="fa fa-save"></i> PDF
						            </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="box">
                            <div class="box-body">
                                <h4 class="box-title"> Ciudadanos pertenecientes a cada año </h4>
                                <div>
                                    <div id="donutchart" style="width: 900px; height: 500px;"></div>
                                    <a class="btn btn-app btn-warning" href="{{route('citizen.graph.view')}}">
							            <i class="fa fa-repeat"></i> Actualizar
						            </a>
                                    <a class="btn btn-app btn-danger" target="_blank" href="{{route('citizen.graph.year')}}">
							            <i class="fa fa-save"></i> PDF
						            </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </body>
</html>
@endsection
