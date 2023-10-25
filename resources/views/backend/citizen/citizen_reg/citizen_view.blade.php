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

                        <div class="box-body">
                            <form method="GET" action="{{route('citizen.year.class.wise')}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Año del ciudadano <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="year_id" required="" class="form-control">
                                                    <option value="" selected="" disabled=""> Selecciona el año </option>
                                                    @foreach($years as $year)
                                                    <option value="{{$year->id}}" {{($year_id == $year->id)? "selected":""}}> {{$year->name}} </option>  <!-- Creamos un ciclo para recuperar todos los años registrados -->
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5> Clase del ciudadano <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="class_id" required="" class="form-control">
                                                    <option value="" selected="" disabled=""> Selecciona la clase </option>
                                                    @foreach($classes as $class)
                                                    <option value="{{$class->id}}" {{($class_id == $class->id)? "selected":""}}> {{$class->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

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
                    <a href="{{route('citizen.registration.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir ciudadano </a>
				</div>
				<div class="box-body">
					<div class="table-responsive">

                        <!-- Se coloca un IF para mostrar solo los datos encontrados con el formulario de busqueda -->
 <!-- Aqui va el @  -  if -->
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th> Nombre </th>
                                <th> Numero de ID </th>
                                <th> Rol </th>
                                <th> Año </th>
                                <th> Clase </th>
                                <th> Imagen </th>
                                <!--  Hacer que el codigo solo pueda ser visualizado por un administrador -->
                                @if (Auth::user()->role == "Admin")
                                <th> Código </th>
                                @endif
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
                                <td>{{$value->year_id}}</td>
								<td>
                                    <!-- Aqui van los botones para las diferentes acciones sobre cada año -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('citizen.registration.edit',$value->citizen_id)}}" class="btn btn-info"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a> <!-- Regresamos la vista de edicion con el id del ciudadano -->
									<!-- Boton de eliminar un año por ID 
                                    <a href="{{route('citizen.registration.promotion',$value->citizen_id)}}" class="btn btn-success"> <i class="fa fa-arrow-up" aria-hidden="true"></i> </a> -->
                                    <!-- Boton para general un PDF -->
                                    <a href="{{route('citizen.registration.details',$value->citizen_id)}}" class="btn btn-success" target="_blank">  <i class="fa fa-file-pdf-o" aria-hidden="true"></i> </a>
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
