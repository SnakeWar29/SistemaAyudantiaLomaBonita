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
				  <h3 class="box-title"> Detalles del monto de la categoría </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                    <a href="{{route('fee.amount.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir monto de tarifa </a>
				</div>
				<div class="box-body">
                    <h4> <strong> Categoría de la tarifa: </strong>{{$detailsData['0']['fee_category']['name']}}</h4>
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-light"
						<thead>
							<tr>
								<th width="5%">#</th>
								<th>Clase del ciudadano</th>
								<th width="25%">Monto de la tarifa</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($detailsData as $key => $detail)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$detail['citizen_class']['name']}}</td>
								<td>{{$detail->amount}}</td>
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
