<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran el rol de los ciudadanos -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script> <!-- exportamos lo necesario para Handlebar.js-->

<div class="content-wrapper">
	<div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
                    <!-- Cuadro para la busqueda personalizada de los ciduadanos -->
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                          <h4 class="box-title"> <strong> Manejear reporte de ganancias </strong></h4>
                        </div>
                        <!-- Inicia el form para poder filtrar ciudadanos -->

                        <div class="box-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Fecha de inicio <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="start_date" id="start_date" class="form-control" required=""> </div>
                                          </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Fecha de corte <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="end_date" id="end_date" class="form-control" required=""> </div>
                                          </div>
                                    </div>

                                    <div class="col-md-4" style="padding-top: 25px;">
                                            <a id="search" class="btn btn-primary" name="search"> Buscar</a>
                                    </div>
                                </div>

                                <!-- Generación de tabla usando JavaScript -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="DocumentResults">
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <table class="table table-bordered table-striped" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                            @{{{thsource}}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                @{{{tdsource}}}
                                                            </tr>
                                                    </tbody>
                                                </table>
                                                <div class="col-md-4" style="padding-top: 25px;">
                                                    <a href="{{route('monthly.profit.view')}}" class="btn btn-info" name="search"> Nueva consulta </a>
                                                </div>
                                            </script>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
			</div>
		  </div>
		</section>

	  </div>
  </div>

  <script type="text/javascript">
    $(document).on('click','#search',function(){
      var start_date = $('#start_date').val(); // Recuperamos la fecha inicial  indicada en el campo
      var end_date = $('#end_date').val(); // Recuperamos la fecha final indicada en el campo
       $.ajax({
        url: "{{ route('report.profit.get')}}", // Llamamos a la ruta para obtener los registros con la fecha
        type: "get",
        data: {'start_date':start_date,'end_date':end_date}, // Pásamos la fecha recuperada
        beforeSend: function() {
        },
        success: function (data) {
          var source = $("#document-template").html(); // Usamos la tabla que definimos
          var template = Handlebars.compile(source); // Usamos Handlebars para compilar la vista
          var html = template(data);
          $('#DocumentResults').html(html); // cargamos todo en el div
          $('[data-toggle="tooltip"]').tooltip(); // Levantamos la ventana
        }
      });
    });

  </script>
@endsection
