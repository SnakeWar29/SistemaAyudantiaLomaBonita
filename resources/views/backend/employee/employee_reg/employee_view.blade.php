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
				  <h3 class="box-title"> Empleados </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                  @if(Auth::user()->role=='Admin')
                  <a href="{{route('employee.registration.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir empleado </a>
                  @endif
                  @if(Auth::user()->role=='Encargado')
                  <a href="{{route('employee.registration.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir empleado </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%"> # </th>
								<th> Nombre </th>
                                <th> ID identificativo </th>
                                <th> Teléfono </th>
                                <th> Dirección </th>
                                <th> Fecha de ingreso </th>
                                <th> Salario </th>
                                @if(Auth::user()->role== 'Admin')  <!-- Solamente visible con el rol de admin -->
                                <th> Código </th>
                                @endif
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $employee)
							<tr>
								<td>{{$key+1}}</td>  <!-- Boton editar y eliminar pendientes -->
								<td>{{$employee->name}}</td>
                                <td>{{$employee->id_no}}</td>
                                <td>{{$employee->mobile}}</td>
                                <td>{{$employee->address}}</td>
                                <td>{{$employee->join_date}}</td>
                                <td>{{$employee->salary}}</td>
                                @if(Auth::user()->role== 'Admin')
                                <td>{{$employee->code}}</td>
                                @endif
								<td>
                                    @if(Auth::user()->role=='Admin')
                                    <!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('employee.registration.edit',$employee->id)}}" class="btn btn-info"> Editar </a>
                                    <a href="{{route('employee.registration.delete',$employee->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
                                    <a href="{{route('employee.registration.details',$employee->id)}}" class="btn btn-primary"  target="_blank"> Detalles </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('employee.registration.edit',$employee->id)}}" class="btn btn-info"> Editar </a>
                                    <a href="{{route('employee.registration.delete',$employee->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
                                    <a href="{{route('employee.registration.details',$employee->id)}}" class="btn btn-primary"  target="_blank"> Detalles </a>
                                    @endif
                                    @if(Auth::user()->role=='Visualizador')
                                    <a href="{{route('employee.registration.details',$employee->id)}}" class="btn btn-primary"  target="_blank"> Detalles </a>
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
