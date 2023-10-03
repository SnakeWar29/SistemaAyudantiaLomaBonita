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


        <!-- Se coloca la condicion para que este apartado solo pueda ser accedido por los usuarios con permisos correspondientes -->
        @if(Auth::user()->role=='Admin')
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
        @endif
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

        <!-- se coloca para recuperar la pestaña activa y remarcarla con azul -->
        <li class="treeview {{($prefix == '/setups')?'active':'' }}">
          <a href="#">
            <i data-feather="mail"></i> <span> Gestión general </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('citizen.class.view')}}"><i class="ti-more"></i> Clase de ciudadano </a></li>
            <li><a href="{{route('citizen.year.view')}}"><i class="ti-more"></i> Año del ciudadano </a></li>
            <li><a href="{{route('citizen.group.view')}}"><i class="ti-more"></i> Grupo del ciudadano </a></li>
            <li><a href="{{route('citizen.shift.view')}}"><i class="ti-more"></i> Turno del ciudadano </a></li>
            <li><a href="{{route('fee.category.view')}}"><i class="ti-more"></i> Categoria de la tarifa </a></li>
            <li><a href="{{route('fee.amount.view')}}"><i class="ti-more"></i> Monto de la tarifa </a></li>
            <li><a href="{{route('badge.type.view')}}"><i class="ti-more"></i> Tipo de divisa </a></li>
            <li><a href="{{route('support.type.view')}}"><i class="ti-more"></i> Apoyos </a></li>
            <li><a href="{{route('assign.support.view')}}"><i class="ti-more"></i> Asignar apoyo </a></li>
            <li><a href="{{route('designation.view')}}"><i class="ti-more"></i> Designación </a></li>
          </ul>
        </li>

        <li class="treeview {{($prefix == '/citizens')?'active':'' }}">
            <a href="#">
              <i data-feather="mail"></i> <span> Administrar ciudadanos </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('citizen.registration.view')}}"><i class="ti-more"></i> Registrar ciudadano </a></li>
            </ul>
          </li>

        <li class="header nav-small-cap"> Avanzado </li>

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
