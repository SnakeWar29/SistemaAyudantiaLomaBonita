<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- En esta vista sera donde se administraran los tipos de tarifas  -->

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Ausencia </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                  @if(Auth::user()->role=='Admin')
                  <a href="{{route('employee.leave.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir ausencia </a>
                  @endif
                  @if(Auth::user()->role=='Encargado')
                  <a href="{{route('employee.leave.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir ausencia </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th> Nombre </th>
                                <th> ID Identificativo </th>
                                <th> Razón </th>
                                <th> Inicio de la ausencia </th>
                                <th> Fin de la ausencia </th>
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $leave)
							<tr>
								<td>{{$key+1}}</td>  <!-- Boton editar y eliminar pendientes -->
								<td>{{$leave['user']['name']}}</td> <!-- Usamos la función user creada en el modelo para unir los campos -->
                                <td>{{$leave['user']['id_no']}}</td>
                                <td>{{$leave['purpose']['name']}}</td> <!-- Usamos la función purpose creada en el modelo para unir los campos -->
                                <td>{{$leave->start_date}}</td>
                                <td>{{$leave->end_date}}</td>
								<td>
                                    @if(Auth::user()->role=='Admin')
                                    <!-- Aqui van los botones para las diferentes acciones -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('employee.leave.edit',$leave->id)}}" class="btn btn-info"> Editar </a>
                                    <a href="{{route('employee.leave.delete',$leave->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <!-- Aqui van los botones para las diferentes acciones -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('employee.leave.edit',$leave->id)}}" class="btn btn-info"> Editar </a>
                                    <a href="{{route('employee.leave.delete',$leave->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
                                    @endif
                                    @if(Auth::user()->role=='Visualizador')
                                    Permisos insuficientes
                                    @endif
                                </td>
							</tr>
                            @endforeach
						</tbody>
					  </table>
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</section>

	  </div>
  </div>
@endsection
