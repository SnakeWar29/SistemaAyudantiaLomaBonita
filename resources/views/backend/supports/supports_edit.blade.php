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
                          <h4 class="box-title"> <strong> Editar entregar de apoyo </strong></h4>
                        </div>
                        <!-- Inicia el form para poder filtrar ciudadanos -->

                        <div class="box-body">
                            <form method="post" action="{{route('supports.entry.edit.store')}}">
                            @csrf
                                <div class="row">
                                    <div class="col-md-3">
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

                                    <div class="col-md-3">
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

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5> Apoyo <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="assign_support_id" id="assign_support_id" required="" class="form-control">
                                                    <option selected=""> Selecciona el apoyo </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="padding-top: 25px;">
                                            <a id="search" class="btn btn-primary" name="search"> Buscar</a>
                                    </div>
                                </div>

                                <!-- Generación de tabla usando JavaScript -->

                                <div class="row d-none" id="supports-entry"> <!-- La clase row d-none sirve para ocultar la tabla-->
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Nombre del ciudadano </th>
                                                    <th> Contacto de Emergencia A </th>
                                                    <th> Género </th>
                                                    <th> Total de apoyo otorgado</th>
                                                </tr>
                                            </thead>
                                            <tbody id="supports-entry-tr">
                                            </tbody>
                                        </table>
                                            <input type="submit" class="btn btn-rounded btn-primary"  value="Actualizar">
                                    </div>

                                </div>
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
      var assign_support_id = $('#assign_support_id').val(); // Recuperamos el apoyo obtenido del campo
       $.ajax({
        url: "{{ route('citizen.edit.get')}}", // Se redigirge a la ruta para buscar los datos del ciudadano
        type: "GET",
        data: {'year_id':year_id,'class_id':class_id,'assign_support_id':assign_support_id},
        success: function (data) { // Retornamos la funcion con los datps pbtenidos de la ruta
          $('#supports-entry').removeClass('d-none'); // Se remueve la clase d-none que hace que la tabla sea invisible
          var html = '';
          $.each( data, function(key, v){
            html +=
            '<tr>'+  // Se empieza a llenar la tabla con los tr,rd y los campos obtenidos
            '<td>'+v.citizen.id_no+'<input type="hidden" name="citizen_id[]" value="'+v.citizen_id+'"><input type="hidden" name="id_no[]" value="'+v.citizen_id_no+'"></td>'+ // Se coloca citizen_id[] para cubrir todo los posibles registros de golpe
            '<td>'+v.citizen.name+'</td>'+
            '<td>'+v.citizen.fname+'</td>'+
            '<td>'+v.citizen.gender+'</td>'+
            '<td><input type="text" class="form-control form-control-sm" minlength="2" maxlength="5" onpaste="return false;" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" name="marks[]" value="'+v.marks+'"></td>'+
            '</tr>';
          });
          html = $('#supports-entry-tr').html(html);  // Se genera la tabla con los datos
        }
      });
    });

  </script>

<!-- Script para recuperar los apoyos asignados por clase de forma real-->
<script type="text/javascript">
    $(function(){
      $(document).on('change','#class_id',function(){
        var class_id = $('#class_id').val();
        $.ajax({
          url:"{{ route('marks.getsupports') }}", // Mandamos la ruta para recuperar la información
          type:"GET",
          data:{class_id:class_id},
          success:function(data){
            var html = '<option value="">Selecciona el apoyo</option>'; // Valor por defecto
            $.each( data, function(key, v) {
              html += '<option value="'+v.id+'">'+v.assign_support.name+'</option>'; // Usamos la función del modelo para  relacionar id y apuntar al name
            });
            $('#assign_support_id').html(html); // Cargamos todo el las opciones con este id
          }
        });
      });
    });
  </script>
@endsection
