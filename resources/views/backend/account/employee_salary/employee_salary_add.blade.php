<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran el rol de los ciudadanos -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>

<div class="content-wrapper">
	<div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
                    <!-- Cuadro para la busqueda personalizada de los ciduadanos -->
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                          <h4 class="box-title"> <strong> Salario del empleado </strong></h4>
                        </div>
                        <!-- Inicia el form para poder filtrar ciudadanos -->

                        <div class="box-body">
                            @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5> Fecha <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <input type="date" name="date" id="date" class="form-control" required=""> </div>
                                          </div>
                                    </div>

                                    <div class="col-md-6" style="padding-top: 25px;">
                                            <a id="search" class="btn btn-primary" name="search"> Buscar</a>
                                            <br><br>
                                    </div>
                                </div>

                                <!-- Generación de tabla usando JavaScript -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="DocumentResults">
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <form action="{{route('account.salary.store')}}" method="post">
                                                @csrf
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
                                                        <div class="col-md-4" style="padding-top: 25px;">
                                                            <button type="submit" class="btn btn-success" style="margin-top: 10px;"> Registrar/Editar pago </button>
                                                        </div>
                                                </form>
                                                <!-- boton para recargar la vista y realizar una nueva consulta -->
                                                <div class="col-md-4" style="padding-top: 25px;">
                                                    <a href="{{route('account.salary.add')}}" class="btn btn-info"> Nueva consulta </a>
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
      var date = $('#date').val(); // Recuperamos la fecha indicada en el campo
       $.ajax({
        url: "{{ route('account.salary.getemployee')}}", // Llamamos a la ruta para obtener los registros con la fecha
        type: "get",
        data: {'date':date}, // Pásamos la fecha recuperada
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
