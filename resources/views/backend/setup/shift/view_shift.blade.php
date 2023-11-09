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
				  <h3 class="box-title"> Turno de atención de los ciudadanos </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                  @if(Auth::user()->role=='Admin')
                    <a href="{{route('citizen.shift.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir turno </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th>Turno</th>
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $shift)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$shift->name}}</td>
								<td>
                                    @if(Auth::user()->role=='Admin')
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('citizen.shift.edit',$shift->id)}}" class="btn btn-info"> Editar </a>
									<!-- Boton de eliminar un año por ID -->
                                    <a href="{{route('citizen.shift.delete',$shift->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('citizen.shift.edit',$shift->id)}}" class="btn btn-info"> Editar </a>
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
