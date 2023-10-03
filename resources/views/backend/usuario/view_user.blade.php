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
				  <h3 class="box-title"> Lista de usuarios </h3>
                  <!-- Boton que permitira añadir un nuevo usuario desde la misma vista -->
                    <a href="{{route('users.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Añadir usuario </a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th>Rol</th>
								<th>Nombre</th>
								<th>Correo Electrónico</th>
                                <th> Código </th>
								<th width="25%">Acción</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                            @foreach($allData as $key => $user)
							<tr>
								<td>{{$key+1}}</td>
								<td> {{$user->role}} </td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
                                <td>{{$user->code}}</td>
								<td>
                                    <!-- Aqui van los botones para las diferentes acciones sobre cada usuario -->
									<!-- En el boton editar, llamamos al a función de editar apuntando a un ID especifico-->
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-info"> Editar </a>
									<!-- Boton de eliminar usuario por ID -->
                                    <a href="{{route('users.delete',$user->id)}}" class="btn btn-danger" id="delete"> Eliminar </a>
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
