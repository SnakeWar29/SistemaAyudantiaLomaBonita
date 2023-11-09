<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran los usuarios registrados en el sistema -->

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
                    <!-- Cuadro para la busqueda personalizada de los ciduadanos -->
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                          <h4 class="box-title"> <strong> Buscar ciudadanos </strong></h4>
                        </div>
                        <!-- Inicia el form para poder filtrar ciudadanos -->
                        <!-- ENTRADA - Información del ciudadano en los campos
                             SALIDA - Ciudadanos que coincidan con la busqueda -->
                        <div class="box-body">
                            <form method="GET" action="{{route('citizen.year.class.wise')}}">
                                <div class="row">
                                    <!-- Campo para el año del ciudadano -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Año del ciudadano <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="year_id" required="" class="form-control">
                                                    <option value="" selected="" disabled=""> Selecciona el año </option>
                                                    <!-- Se mostrara cada año registrado -->
                                                    @foreach($years as $year)
                                                    <option value="{{$year->id}}" {{($year_id == $year->id)? "selected":""}}> {{$year->name}} </option>  <!-- Creamos un ciclo para recuperar todos los años registrados -->
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Campo para la clase del ciudadano -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Clase del ciudadano <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="class_id" required="" class="form-control">
                                                    <option value="" selected="" disabled=""> Selecciona la clase </option>
                                                    <!-- Se mostrara cada clase ciudadano -->
                                                    @foreach($classes as $class)
                                                    <option value="{{$class->id}}" {{($class_id == $class->id)? "selected":""}}> {{$class->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Boton para enviar el formulario -->
                                    <div class="col-md-4" style="padding-top: 25px;">
                                        <input type="submit" class="btn btn-dark mb-5" name="search" value="Buscar ciudadano">
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
            </div>

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Lista de ciudadanos </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                  @if(Auth::user()->role=='Admin')
                  <a href="{{route('citizen.registration.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir ciudadano </a>
                  @endif
                  @if(Auth::user()->role=='Encargado')
                  <a href="{{route('citizen.registration.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir ciudadano </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <!-- Campos para mostrar la información -->
								<th width="5%">#</th>
								<th> Nombre </th>
                                <th> Número de ID </th>
                                <th> Rol </th>
                                <th> Año </th>
                                <th> Clase </th>
                                <th> Imagen </th>
                                <!--  Hacer que el codigo solo pueda ser visualizado por un administrador
                                @if (Auth::user()->role == "Admin")
                                <th> Código </th>
                                @endif-->
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $value)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$value['citizen']['name']}}</td>
                                <td>{{$value['citizen']['id_no']}}</td>
                                <td> {{$value->roll}}</td>
                                <td>{{$value['citizen_year']['name']}}</td>
                                <td>{{$value['citizen_class']['name']}}</td>
                                <td>
                                    <img src="{{(!empty($value['citizen']['image']))? url('upload/citizen_images/'.$value['citizen']['image']):url('upload/sin_imagen.jpg') }}" style="width: 60px; width: 60px;">
                                </td>
								<td>
                                    @if(Auth::user()->role=='Admin')
                                    <!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('citizen.registration.edit',$value->citizen_id)}}" class="btn btn-info mb-5"> Editar </a>
                                    <a href="{{route('citizen.registration.delete',$value->citizen_id)}}" class="btn btn-danger mb-5" id="delete"> Eliminar </a>
                                    <!-- Boton para general un PDF -->
                                    <a href="{{route('citizen.registration.details',$value->citizen_id)}}" class="btn btn-primary mb-5" target="_blank"> PDF </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('citizen.registration.edit',$value->citizen_id)}}" class="btn btn-info"> Editar </a>
                                    <a href="{{route('citizen.registration.delete',$value->citizen_id)}}" class="btn btn-danger mb-5" id="delete"> Eliminar </a>
                                    <!-- Boton para general un PDF -->
                                    <a href="{{route('citizen.registration.details',$value->citizen_id)}}" class="btn btn-primary mb-5" target="_blank"> PDF </a>
                                    @endif
                                    @if(Auth::user()->role=='Visualizador')
                                    <!-- Boton para general un PDF -->
                                    <a href="{{route('citizen.registration.details',$value->citizen_id)}}" class="btn btn-primary mb-5" target="_blank"> PDF </a>
                                    @endif
                                </td>
							</tr>
                            @endforeach
						</tbody>
					  </table>
 <!-- Aqui va el @  -  else -->
                <!-- Aqui va el formulario copiado -->
                      <!-- 308 - 6:01 -->
<!-- Aqui va el @ - endif -->
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</section>

	  </div>
  </div>

@endsection
