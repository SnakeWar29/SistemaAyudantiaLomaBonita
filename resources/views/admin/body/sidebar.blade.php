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

        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Se coloca la condicion para que este apartado solo pueda ser accedido por los usuarios con permisos correspondientes -->
        @if(Auth::user()->role=='Admin') <!-- Si el tipo de usuario es admin, se mostrara esta sección -->
            <li class="treeview {{($prefix == '/users')?'active':'' }}">
                <a href="#">
                    <i data-feather="hard-drive"></i>
                    <span> Administrar usuarios </span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{($route == 'user.view')?'active':'' }}"><a href="{{route('user.view')}}"><i class="ti-more"></i> Visualizar usuario</a></li>
                    <li class="{{($route == 'users.add')?'active':'' }}"><a href="{{route('users.add')}}"><i class="ti-more"></i> Añadir usuario </a></li>
                </ul>
            </li>
        @endif
         <!-- Se pone la condicion que si es el mismo prefix, se mostrara como opción activa en el panel lateral -->
        <li class="treeview {{($prefix == '/profile')?'active':'' }}">
          <a href="#">
            <i data-feather="edit-2"></i> <span> Perfil </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'profile.view')?'active':'' }}"><a href="{{route('profile.view')}}"><i class="ti-more"></i> Mi perfil </a></li>
            <li class="{{($route == 'password.view')?'active':'' }}"><a href="{{route('password.view')}}"><i class="ti-more"></i> Cambiar contraseña </a></li>
          </ul>
        </li>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- se coloca para recuperar la pestaña activa y remarcarla con azul -->
        <li class="treeview {{($prefix == '/setups')?'active':'' }}">
          <a href="#">
            <!-- -->
            @if(Auth::user()->role=='Admin')
            <i data-feather="hard-drive"></i> <span> Gestión general </span>
            @endif
            @if(Auth::user()->role=='Encargado')
            <i data-feather="hard-drive"></i> <span> Gestión general </span>
            @endif
            @if(Auth::user()->role=='Visualizador')
            <i data-feather="hard-drive"></i> <span> Visualización general </span>
            @endif
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
            <!-- -->
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'citizen.class.view')?'active':'' }}"><a href="{{route('citizen.class.view')}}"><i class="ti-more"></i> Clase de ciudadano </a></li>
            <li class="{{($route == 'citizen.year.view')?'active':'' }}"><a href="{{route('citizen.year.view')}}"><i class="ti-more"></i> Año del ciudadano </a></li>
            <li class="{{($route == 'citizen.group.view')?'active':'' }}"><a href="{{route('citizen.group.view')}}"><i class="ti-more"></i> Grupo del ciudadano </a></li>
            <li class="{{($route == 'citizen.shift.view')?'active':'' }}"><a href="{{route('citizen.shift.view')}}"><i class="ti-more"></i> Turno del ciudadano </a></li>
            <li class="{{($route == 'fee.category.view')?'active':'' }}"><a href="{{route('fee.category.view')}}"><i class="ti-more"></i> Categoria de la tarifa </a></li>
            <li class="{{($route == 'fee.amount.view')?'active':'' }}"><a href="{{route('fee.amount.view')}}"><i class="ti-more"></i> Monto de la tarifa </a></li>
            <li class="{{($route == 'support.type.view')?'active':'' }}"><a href="{{route('support.type.view')}}"><i class="ti-more"></i> Apoyos </a></li>
            <li class="{{($route == 'assign.support.view')?'active':'' }}"><a href="{{route('assign.support.view')}}"><i class="ti-more"></i> Asignar apoyo </a></li>
            <li class="{{($route == 'designation.view')?'active':'' }}"><a href="{{route('designation.view')}}"><i class="ti-more"></i> Designación </a></li>
          </ul>
        </li>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <li class="treeview {{($prefix == '/citizens')?'active':'' }}">
            <a href="#">
                @if(Auth::user()->role=='Admin')
                <i data-feather="hard-drive"></i> <span> Administrar ciudadanos </span>
                @endif
                @if(Auth::user()->role=='Encargado')
                <i data-feather="hard-drive"></i> <span> Administrar ciudadanos </span>
                @endif
                @if(Auth::user()->role=='Visualizador')
                <i data-feather="hard-drive"></i> <span> Visualizar ciudadanos </span>
                @endif
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{($route == 'citizen.registration.view')?'active':'' }}"><a href="{{route('citizen.registration.view')}}"><i class="ti-more"></i> Ciudadanos </a></li>
              <!-- -->
              @if(Auth::user()->role=='Admin')
              <li class="{{($route == 'rol.generate.view')?'active':'' }}"><a href="{{route('rol.generate.view')}}"><i class="ti-more"></i> Generar rol </a></li>
              @endif
              @if(Auth::user()->role=='Encargado')
              <li class="{{($route == 'rol.generate.view')?'active':'' }}"><a href="{{route('rol.generate.view')}}"><i class="ti-more"></i> Generar rol </a></li>
              @endif
              <!-- -->
              <li class="{{($route == 'registration.fee.view')?'active':'' }}"><a href="{{route('registration.fee.view')}}"><i class="ti-more"></i> Tarifa de registro </a></li>
              <li class="{{($route == 'monthly.fee.view')?'active':'' }}"><a href="{{route('monthly.fee.view')}}"><i class="ti-more"></i> Tarifa mensual </a></li>
            </ul>
        </li>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <li class="treeview {{($prefix == '/employees')?'active':'' }}">
            <a href="#">
                @if(Auth::user()->role=='Admin')
                <i data-feather="hard-drive"></i> <span> Administrar empleados </span>
                @endif
                @if(Auth::user()->role=='Encargado')
                <i data-feather="hard-drive"></i> <span> Administrar empleados </span>
                @endif
                @if(Auth::user()->role=='Visualizador')
                <i data-feather="hard-drive"></i> <span> Visualizar empleados </span>
                @endif
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{($route == 'employee.registration.view')?'active':'' }}"><a href="{{route('employee.registration.view')}}"><i class="ti-more"></i> Empleados </a></li>
              <li class="{{($route == 'employee.salary.view')?'active':'' }}"><a href="{{route('employee.salary.view')}}"><i class="ti-more"></i> Salarios </a></li>
              <!-- -->
              @if(Auth::user()->role=='Admin')
              <li class="{{($route == 'employee.leave.view')?'active':'' }}"><a href="{{route('employee.leave.view')}}"><i class="ti-more"></i> Justificar inasistencias </a></li>
              @endif
              @if(Auth::user()->role=='Encargado')
              <li class="{{($route == 'employee.leave.view')?'active':'' }}"><a href="{{route('employee.leave.view')}}"><i class="ti-more"></i> Justificar inasistencias </a></li>
              @endif
              @if(Auth::user()->role=='Visualizador')
              <li class="{{($route == 'employee.leave.view')?'active':'' }}"><a href="{{route('employee.leave.view')}}"><i class="ti-more"></i> Visualizar inasistencias </a></li>
              @endif
              <!-- -->
              <li class="{{($route == 'employee.attendance.view')?'active':'' }}"><a href="{{route('employee.attendance.view')}}"><i class="ti-more"></i> Lista de asistencia </a></li>
              <li class="{{($route == 'employee.monthly.salary.view')?'active':'' }}"><a href="{{route('employee.monthly.salary.view')}}"><i class="ti-more"></i> Salario mensual </a></li>
            </ul>
        </li>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        @if(Auth::user()->role=='Admin')
        <li class="treeview {{($prefix == '/supports')?'active':'' }}">
            <a href="#">
              <i data-feather="hard-drive"></i> <span> Administrar apoyos </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{($route == 'supports.entry.add')?'active':'' }}"><a href="{{route('supports.entry.add')}}"><i class="ti-more"></i> Entrega apoyo </a></li>
              <li class="{{($route == 'supports.entry.edit')?'active':'' }}"><a href="{{route('supports.entry.edit')}}"><i class="ti-more"></i> Editar entrega </a></li>
            </ul>
        </li>
        @endif
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <li class="treeview {{($prefix == '/accounts')?'active':'' }}">
          <a href="#">
            @if(Auth::user()->role=='Admin')
            <i data-feather="hard-drive"></i> <span> Administración contable </span>
            @endif
            @if(Auth::user()->role=='Encargado')
            <i data-feather="hard-drive"></i> <span> Administración contable </span>
            @endif
            @if(Auth::user()->role=='Visualizador')
            <i data-feather="hard-drive"></i> <span> Visualización contable </span>
            @endif
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'citizen.fee.view')?'active':'' }}"><a href="{{route('citizen.fee.view')}}"><i class="ti-more"></i> Tarifa de ciudadanos </a></li>
            <li class="{{($route == 'account.salary.view')?'active':'' }}"><a href="{{route('account.salary.view')}}"><i class="ti-more"></i> Salario del empleado </a></li>
            <li class="{{($route == 'other.cost.view')?'active':'' }}"><a href="{{route('other.cost.view')}}"><i class="ti-more"></i> Costos adicionales </a></li>
        </ul>
      </li>
      <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <li class="header nav-small-cap"> Reportes generales </li>
        <li class="treeview {{($prefix == '/reports')?'active':'' }}">
            <a href="#">
              <i data-feather="hard-drive"></i> <span> Gestión de informes </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{($route == 'monthly.profit.view')?'active':'' }}"><a href="{{route('monthly.profit.view')}}"><i class="ti-more"></i> Beneficio mensual/anual </a></li>
              <li class="{{($route == 'attendance.report.view')?'active':'' }}"><a href="{{route('attendance.report.view')}}"><i class="ti-more"></i> Reporte de asistencias </a></li>
              <li class="{{($route == 'citizen.graph.view')?'active':'' }}"><a href="{{route('citizen.graph.view')}}"><i class="ti-more"></i> Reporte de ciudadanos </a></li>
          </ul>
        </li>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        @if(Auth::user()->role=='Admin')
        <li class="treeview {{($prefix == '/database')?'active':'' }}">
            <a href="#">
              <i data-feather="hard-drive"></i> <span> Exportar/Importar </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{($route == 'database.import.view')?'active':'' }}"><a href="{{route('database.import.view')}}"><i class="ti-more"></i> General </a></li>
          </ul>
        </li>
        @endif
      </ul>
    </section>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
	<div class="sidebar-footer">
		<!-- Objeto -->
		<!-- <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Configuración" aria-describedby="tooltip92529"><i class="ti-settings"></i></a> -->
		<!-- Objeto -->
		<!-- <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Soporte"><i class="ti-email"></i></a> -->
		<!-- Objeto -->
		<a href="{{route('admin.logout')}}" class="link" data-toggle="tooltip" title="" data-original-title="Cerrar sesión "><i class="ti-lock"></i></a>
	</div>
  </aside>
