<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran el rol de los ciudadanos -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
	<div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
                    <!-- Cuadro para la busqueda personalizada de los ciduadanos -->
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                          <h4 class="box-title"> <strong> General rol del ciudadano </strong></h4>
                        </div>
                        <!-- Inicia el form para poder filtrar ciudadanos -->

                        <div class="box-body">
                            <form method="post" action="{{route('roll.generate.store')}}">
                            @csrf
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

                                <div class="row d-none" id="rol-generate"> <!-- La clase row d-none sirve para ocultar la tabla-->
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Nombre del ciudadano </th>
                                                    <th> Contacto de Emergencia A </th>
                                                    <th> Genero </th>
                                                    <th> Rol </th>
                                                </tr>
                                            </thead>
                                            <tbody id="rol-generate-tr">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                        <input type="submit" class="btn btn-info"  value="Generar Rol">
                            </form>
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
      var year_id = $('#year_id').val(); // Recuperamos el año obtenido del campo
      var class_id = $('#class_id').val(); // Recuperamos la clase obtenido del campo
       $.ajax({
        url: "{{ route('citizen.registration.getcitizens')}}", // Se redigirge a la ruta para buscar los datos del ciudadano
        type: "GET",
        data: {'year_id':year_id,'class_id':class_id}, // Se pasa los datos obtenidos anteriormente
        success: function (data) { // Retornamos la funcion con los datps pbtenidos de la ruta
          $('#rol-generate').removeClass('d-none'); // Re remueve la clase d-none que hace que la tabla sea invisible
          var html = '';
          $.each( data, function(key, v){
            html +=
            '<tr>'+  // Se empieza a llenar la tabla con los tr,rd y los campos obtenidos
            '<td>'+v.citizen.id_no+'<input type="hidden" name="citizen_id[]" value="'+v.citizen_id+'"></td>'+ // Se coloca citizen_id[] para cubrir todo los posibles registros de golpe
            '<td>'+v.citizen.name+'</td>'+
            '<td>'+v.citizen.fname+'</td>'+
            '<td>'+v.citizen.gender+'</td>'+
            '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
            '</tr>';
          });
          html = $('#rol-generate-tr').html(html);  // Se genera la tabla con los datos
        }
      });
    });

  </script>
@endsection
