<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Lista de salarios pagados de los empleados </h3>
                    <a href="{{route('account.salary.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir/Editar pago </a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th> ID identificativo </th>
                                <th> Nombre del empleado </th>
                                <th> Salario total </th>
                                <th> Fecha </th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $value)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$value['employee']['id_no']}}</td>
                                <td>{{$value['employee']['name']}}</td>
                                <td>{{number_format($value->amount,3,'.')}} MXN$</td>
                                <td>{{date('M Y', strtotime($value->date))}}</td>
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
