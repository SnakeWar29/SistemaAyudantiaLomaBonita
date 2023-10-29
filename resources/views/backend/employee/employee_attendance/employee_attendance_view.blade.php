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
				  <h3 class="box-title"> Lista de asistencia de los empleados </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                  @if(Auth::user()->role=='Admin')
                  <a href="{{route('employee.attendance.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir asistencia </a>
                  @endif
                  @if(Auth::user()->role=='Encargado')
                  <a href="{{route('employee.attendance.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir asistencia </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">ID</th>
                                <th> Fecha (D-M-A) </th>
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $value)
							<tr>
								<td>{{$key+1}}</td>
                                <td>{{date('d-m-Y',strtotime($value->date))}}</td> <!-- Usamos los valores directamente  -->
								<td>
                                    @if(Auth::user()->role=='Admin')
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('employee.attendance.edit',$value->date)}}" class="btn btn-info"> Editar </a>
                                    <a href="{{route('employee.attendance.details',$value->date)}}" class="btn btn-success"> Detalles </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('employee.attendance.edit',$value->date)}}" class="btn btn-info"> Editar </a>
                                    <a href="{{route('employee.attendance.details',$value->date)}}" class="btn btn-success"> Detalles </a>
                                    @endif
                                    @if(Auth::user()->role=='Visualizador')
                                    <a href="{{route('employee.attendance.details',$value->date)}}" class="btn btn-success"> Detalles </a>
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
