<!-- En este archivo se coloca la plantilla de la barra lateral y su footer -->

@php
// Se crea la variable para hacer dinamico la selección de una opción en la barra lateral
// Se crea la variable para obtener el prefix de la ruta, es decir, la ruta padre
$prefix = Request::route()->getPrefix();
// Se crea la variable para obtener la ruta actual del usuario, es decir, la ruta hijo
$route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- Barra lateral-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{route('dashboard')}}">
				  <!-- Logo para celulares y de ofrma normal -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="{{asset('backend/images/logo/Logo_Ayudantia.png')}}" alt="">
              <h4>  </h4>
					 </div>
				</a>
			</div>
        </div>

      <!-- Menu dde la barra lateral -->
      <ul class="sidebar-menu" data-widget="tree">

        <!-- Se pone la condicion que si es la misma ruta, se mostrara como opción activa en el panel lateral -->
		<li class="{{($route == 'dashboard')?'active':'' }}">
          <a href="{{route('dashboard')}}">
            <i data-feather="pie-chart"></i>
			      <span> Panel de control </span>
          </a>
        </li>

        <li class="treeview {{($prefix == '/users')?'active':'' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span> Administrar usuarios </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.view')}}"><i class="ti-more"></i> Visualizar usuario</a></li>
            <li><a href="{{route('users.add')}}"><i class="ti-more"></i> Añadir usuario </a></li>
          </ul>
        </li>
         <!-- Se pone la condicion que si es el mismo prefix, se mostrara como opción activa en el panel lateral -->
        <li class="treeview {{($prefix == '/profile')?'active':'' }}">
          <a href="#">
            <i data-feather="mail"></i> <span> Perfil </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('profile.view')}}"><i class="ti-more"></i> Mi perfil </a></li>
            <li><a href="{{route('password.view')}}"><i class="ti-more"></i> Cambiar contraseña </a></li>
          </ul>
        </li>

        <li class="header nav-small-cap">User Interface</li>

        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
            <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
          </ul>
        </li>
      </ul>
    </section>

	<div class="sidebar-footer">
		<!-- Objeto -->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Configuración" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- Objeto -->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Soporte"><i class="ti-email"></i></a>
		<!-- Objeto -->
		<a href="{{route('admin.logout')}}" class="link" data-toggle="tooltip" title="" data-original-title="Cerrar sesión "><i class="ti-lock"></i></a>
	</div>
  </aside>
