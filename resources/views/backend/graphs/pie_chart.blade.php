<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Clase', 'Ciudadanos pertenecientes'],
          <?php echo $chartData; ?>
        ]);

        var options = {
          title: 'Ciudadanos ordenados por clase',
          is3D: true,
        };

        var chart_div = document.getElementById('piechart_3d');
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));


        // Wait for the chart to finish drawing before calling the getImageURI() method.
        google.visualization.events.addListener(chart, 'ready', function () {
            chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
            console.log(chart_div.innerHTML);
        });

        chart.draw(data, options);
        document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '" target="_blank">Printable version</a>';
        google.charts.setOnLoadCallback(drawChart);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d"  style="width: 900px; height: 500px;"></div>

  </body>
</html>
