<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran los tipos de tarifas  -->

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Salario de empleados </h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th> Nombre </th>
                                <th> ID identificativo </th>
                                <th> Fecha de ingreso </th>
                                <th> Salario </th>
								<th width="20%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $value)
							<tr>
								<td>{{$key+1}}</td>  <!-- Boton editar y eliminar pendientes -->
								<td>{{$value->name}}</td>
                                <td>{{$value->id_no}}</td>
                                <td>{{ date('d-m-Y', strtotime($value->join_date))}}</td>
                                <td>{{$value->salary}}</td>
								<td>
                                    @if(Auth::user()->role=='Admin')
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a title="Incrementar salario" href="{{route('employee.salary.increment',$value->id)}}" class="btn btn-info"> <i class="fa fa-plus-circle"></i> </a>
                                    <a title="Reporte PDF" href="{{route('employee.salary.details',$value->id)}}" class="btn btn-primary" >  <i class="fa fa-eye" aria-hidden="true"> </i> </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a title="Incrementar salario" href="{{route('employee.salary.increment',$value->id)}}" class="btn btn-info"> <i class="fa fa-plus-circle"></i> </a>
                                    <a title="Reporte PDF" href="{{route('employee.salary.details',$value->id)}}" class="btn btn-primary" >  <i class="fa fa-eye" aria-hidden="true"> </i> </a>
                                    @endif
                                    @if(Auth::user()->role=='Visualizador')
                                    <!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a title="Reporte PDF" href="{{route('employee.salary.details',$value->id)}}" class="btn btn-primary" >  <i class="fa fa-eye" aria-hidden="true"> </i> </a>
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
