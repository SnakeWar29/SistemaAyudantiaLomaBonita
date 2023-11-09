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
				  <h3 class="box-title"> Asignar apoyo </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                  @if(Auth::user()->role=='Admin')
                    <a href="{{route('assign.support.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir asignación de apoyo </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th> Nombre de la clase </th>
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $assign)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$assign['citizen_class']['name']}}</td> <!-- Llamamos a traer la funcion en el modelo y que muestre los datos relacionados con el name -->
								<td>
                                    @if(Auth::user()->role=='Admin')
                                    <!-- Aqui van los botones para las diferentes acciones sobre cada tarifa -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('assign.support.edit',$assign->class_id)}}" class="btn btn-info"> Administrar </a>
                                    <a href="{{route('assign.support.details',$assign->class_id)}}" class="btn btn-primary"> Detalles </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <a href="{{route('assign.support.details',$assign->class_id)}}" class="btn btn-primary"> Detalles </a>
                                    @endif
                                    @if(Auth::user()->role=='Visualizador')
                                    <a href="{{route('assign.support.details',$assign->class_id)}}" class="btn btn-primary"> Detalles </a>
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
