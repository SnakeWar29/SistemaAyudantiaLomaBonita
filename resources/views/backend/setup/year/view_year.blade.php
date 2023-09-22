<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran los usuarios registrados en el sistema -->

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Año de los ciudadanos </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                    <a href="{{route('citizen.year.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir año </a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th>Año</th>
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $year)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$year->name}}</td>
								<td>
                                    <!-- Aqui van los botones para las diferentes acciones sobre cada año -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('citizen.year.edit',$year->id)}}" class="btn btn-info"> Editar </a>
									<!-- Boton de eliminar un año por ID -->
                                    <a href="{{route('citizen.year.delete',$year->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
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
