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
                          <h4 class="box-title"> <strong> Tarifa de registro </strong></h4>
                        </div>
                        <!-- Inicia el form para poder filtrar ciudadanos -->

                        <div class="box-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Año del ciudadano <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="year_id" id="year_id" required="" class="form-control">
                                                    <option value="" selected="" disabled=""> Selecciona el año </option>
                                                    @foreach($years as $year)
                                                    <option value="{{$year->id}}"> {{$year->name}} </option>  <!-- Creamos un ciclo para recuperar todos los años registrados -->
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Clase del ciudadano <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="class_id" id="class_id" required="" class="form-control">
                                                    <option value="" selected="" disabled=""> Selecciona la clase </option>
                                                    @foreach($classes as $class)
                                                    <option value="{{$class->id}}"> {{$class->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                                        @{{#each this}}
                                                            <tr>
                                                                @{{{tdsource}}}
                                                            </tr>
                                                        @{{/each}}
                                                    </tbody>
                                                </table>
                                            </script>
                                        </div>
                                        <div class="col-md-4" style="padding-top: 25px;">
                                            <a href="{{route('registration.fee.view')}}" class="btn btn-info" name="search"> Nueva consulta </a>
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
      var year_id = $('#year_id').val(); // Recuperamos el año indicado en el campo
      var class_id = $('#class_id').val(); // Recuperamos la clase indicada en el campo
       $.ajax({
        url: "{{ route('citizen.registration.fee.classwise.get')}}", // Llamamos a la ruta para obtener las tarifas
        type: "get",
        data: {'year_id':year_id,'class_id':class_id}, // Pásamos los datos extraidos anterioremes
        beforeSend: function() {
        },
        success: function (data) {
          var source = $("#document-template").html(); // Usamos la tabla que definimos
          var template = Handlebars.compile(source); // Usamos Handlebars para compilar la vista
          var html = template(data);
          $('#DocumentResults').html(html);
          $('[data-toggle="tooltip"]').tooltip(); // Levantamos la ventana
        }
      });
    });

  </script>
@endsection
