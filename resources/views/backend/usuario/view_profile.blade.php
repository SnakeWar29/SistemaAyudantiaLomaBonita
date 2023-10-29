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
                <div class="box box-widget widget-user">
					<div class="widget-user-header bg-black" >
                            <!-- Desplega el nombre del usuario logueado-->
                        <h3 class="widget-user-username"> Nombre: {{$user->name}}</h3>
                        <a href="{{route('profile.edit')}}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Editar perfil </a>
					    <h6 class="widget-user-desc"> Rol: {{$user->role}}</h6>
                        <h6 class="widget-user-desc"> Correo electrónico: {{$user->email}}</h6>
                            <!-- Boton para poder editar la información de perfil -->
					</div>
					<div class="widget-user-image">
                        <!--En caso de que el usuario no tenga foto, se usara la foto por defecto de Sin Imagen-->
					  <img class="rounded-circle"
                      src="{{(!empty($user->image))? url('upload/user_images/'.$user->image):url('upload/sin_imagen.jpg') }}" alt="Imagen de perfil">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Teléfono </h5>
							<span class="description-text">{{$user->mobile}}</span>
						  </div>
						</div>
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Dirección</h5>
							<span class="description-text">{{$user->address}}</span>
						  </div>
						</div>
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Género</h5>
							<span class="description-text">{{$user->gender}}</span>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				<div class="box">
            </div>
		  </div>
		</section>

	  </div>
  </div>

@endsection
