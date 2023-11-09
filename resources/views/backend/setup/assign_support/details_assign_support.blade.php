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
				  <h3 class="box-title"> Detalles de la asignación del apoyo </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                    <a href="{{route('assign.support.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir asignación de apoyo </a>
				</div>
				<div class="box-body">
                    <h4> <strong> Clase de la ciudadano : </strong>{{$detailsData['0']['citizen_class']['name']}}</h4>
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-light"
						<thead>
							<tr>
								<th width="5%">#</th>
								<th width="20%"> Apoyo </th>
								<th width="20%"> Apoyo total </th>
                                <th width="20%"> Apoyo mensual </th>
                                <th width="20%"> Total de pagos </th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($detailsData as $key => $detail)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$detail['Assign_support']['name']}}</td>
								<td>{{$detail->full_support}}</td>
                                <td>{{$detail->monthly_support}}</td>
                                <td>{{$detail->total_payments}}</td>
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
