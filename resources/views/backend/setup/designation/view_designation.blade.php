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
				  <h3 class="box-title"> Designaciones </h3>
                  <!-- Boton que permitira añadir un nuevo año desde la misma vista -->
                  @if(Auth::user()->role=='Admin')
                    <a href="{{route('designation.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir designación </a>
                  @endif
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th> Nombre </th>
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $designation)
							<tr>
								<td>{{$key+1}}</td>  <!-- Boton editar y eliminar pendientes -->
								<td>{{$designation->name}}</td>
								<td>
                                    @if(Auth::user()->role=='Admin')
                                    <!-- Aqui van los botones para las diferentes acciones -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('designation.edit',$designation->id)}}" class="btn btn-info"> Editar </a>
									<!-- Boton de eliminar un año por ID -->
                                    <a href="{{route('designation.delete',$designation->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
                                    @endif
                                    @if(Auth::user()->role=='Encargado')
                                    <!-- Aqui van los botones para las diferentes acciones -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('designation.edit',$designation->id)}}" class="btn btn-info"> Editar </a>
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
