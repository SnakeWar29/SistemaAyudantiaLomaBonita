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
				  <h3 class="box-title"> Detalles del salario del empleado </h3>
                  <br> <br>
                    <h5> <strong> Nombre del empleado: </strong> {{$details->name}}</h5>
                    <h5> <strong> ID Identificativo: </strong> {{$details->id_no}}</h5>
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">#</th>
                                <th> Salario previo </th>
                                <th> Incremento </th>
                                <th> Salario actual </th>
                                <th> Fecha de efecto </th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable que nos ayudara a traer los datos -->
                            @foreach($salary_log as $key => $log)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$log->previous_salary}}</td>
                                <td>{{$log->increment_salary}}</td>
                                <td>{{$log->present_salary}}</td>
                                <td>{{$log->effected_salary}}</td>
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

