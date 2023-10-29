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
				  <h3 class="box-title"> Lista de costos adicionales </h3>
                  @if(Auth::user()->role=='Admin')
                  <a href="{{route('other.cost.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir costo adicional </a>
                  @endif
                  @if(Auth::user()->role=='Encargado')
                  <a href="{{route('other.cost.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir costo adicional </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th> Fecha </th>
                                <th> Monto </th>
                                <th> Descripción </th>
                                <th> Imagen </th>
                                <th> Acción </th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $value)
							<tr>
								<td><center> {{$key+1}} </center></td>
								<td>{{date('d-m-y', strtotime($value->date))}}</td>
                                <td>{{number_format($value->amount,2,'.')}} MXN$</td>
                                <td>{{$value->description}}</td>
                                <td>
                                   <center> <img  src="{{(!empty($value->image))? url('upload/cost_images/'.$value->image):url('upload/sin_imagen.jpg') }}" style="width: 70px; height: 70px;"> </center>
                                </td>
                                <td>
                                    <!-- Aqui van los botones para las diferentes acciones-->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    @if(Auth::user()->role=='Admin')
                                    <center> <a href="{{route('other.cost.edit',$value->id)}}" class="btn btn-info"> Editar </a> </center>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <center> <a href="{{route('other.cost.edit',$value->id)}}" class="btn btn-info"> Editar </a> </center>
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
