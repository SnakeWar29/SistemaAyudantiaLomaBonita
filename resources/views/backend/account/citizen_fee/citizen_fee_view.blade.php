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
				  <h3 class="box-title"> Lista de tarifas pagadas de ciudadanos </h3>
                  @if(Auth::user()->role=='Admin')
                  <a href="{{route('citizen.fee.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir/Editar pago </a>
                  @endif
                  @if(Auth::user()->role=='Encargado')
                  <a href="{{route('citizen.fee.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir/Editar pago </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th> ID identificativo </th>
                                <th> Nombre del ciudadano </th>
                                <th> Año </th>
                                <th> Clase </th>
                                <th> Tipo de tarifa </th>
                                <th> Fecha </th>
                                <th> Total </th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $value)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$value['citizen']['id_no']}}</td>
                                <td>{{$value['citizen']['name']}}</td>
                                <td>{{$value['citizen_year']['name']}}</td>
                                <td>{{$value['citizen_class']['name']}}</td>
                                <td>{{$value['fee_category']['name']}}</td>
                                <td>{{date('M Y', strtotime($value->date))}}</td>
                                <td>{{number_format($value->amount,2,'.')}} MXN$</td>
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
