<!-- En este archivo se coloca la plantilla del header y su footer -->
<header class="main-header">
    <!-- Encabezado -->
    <nav class="navbar navbar-static-top pl-30">
      <!-- Botones en la barra lateral -->
	  <div>
		  <ul class="nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu" role="button">
					<i class="nav-link-icon mdi mdi-menu"></i>
			    </a>
			</li>
			<li class="btn-group nav-item">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
					<i class="nav-link-icon mdi mdi-crop-free"></i>
			    </a>
			</li>
		  </ul>
	  </div>

      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
		  <!-- Pantalla completa  -->
		  <!-- Todo lo necesarios para poder mostrar las notificaciones  -->
		  <li class="dropdown notifications-menu">
			<a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown" title="Notifications">
			  <i class="ti-bell"></i>
			</a>
			<ul class="dropdown-menu animated bounceIn">

			  <li class="header">
				<div class="p-20">
					<div class="flexbox">
						<div>
							<h4 class="mb-0 mt-0">Notificaciones </h4>
						</div>
						<div>
							<a href="#" class="text-danger">Limpiar todo</a>
						</div>
					</div>
				</div>
			  </li>

			  <li>
				<!-- Menu de informacion, contiene la información actual -->
				<ul class="menu sm-scrol">
				  <li>
					<a href="#">
					  <i class="fa fa-users text-info"></i> No olvides pasar la lista de hoy
					</a>
				  </li>

				  <li>
					<a href="#">
					  <i class="fa fa-user text-success"></i> Recordatorio: Pago de empleados del mes
					</a>
				  </li>
				</ul>
			  </li>

			</ul>
		  </li>

		  	<!-- Esto es para obtener la información actual del usuario logueado, para poder recuperar la imagen de perfil -->
		  @php
				$user= DB::table('users')->where('id',Auth::user()->id)->first();
		  @endphp
	      <!-- Cuenta de usuario -->
          <li class="dropdown user user-menu">
			<!-- Se comprueba si se tiene imagen de perfil para mostrar la imagen por defecto o la imagen de perfil-->
			<a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown" title="User">
				<img src="{{(!empty($user->image))? url('upload/user_images/'.$user->image):url('upload/sin_imagen.jpg') }}" alt="">
			</a>
			<ul class="dropdown-menu animated flipInX">
			  <li class="user-body">
				 <a class="dropdown-item" href="{{route('profile.view')}}"><i class="ti-user text-muted mr-2"></i> Perfil </a>
				 
				 <!-- <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i> Configuración </a> -->
				 <div class="dropdown-divider"></div>
				 <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="ti-lock text-muted mr-2"></i> Cerrar sesión</a>
			  </li>
			</ul>
          </li>
		  <li>
           <!--    <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
			  	<i class="ti-settings"></i> -->
			  </a>
          </li>

        </ul>
      </div>
    </nav>
  </header>
