<!-- Se llama a traer la vista que contiene el header, footer y la barra lateral -->
@extends('admin.admin_view')
@section('admin')
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Contenido principal -->
        <section class="content">
            <h1> Accesos rápidos </h1> <br>
            @if(Auth::user()->role=='Admin')
            <h2> ¡Bienvenido Administrador! </h2>
            <h4> Empieza a administrar por completo el sistema, usa la barra lateral para navegar o usa un accesso rápido.</h4> <br>
            @endif
            @if(Auth::user()->role=='Encargado')
            <h2> ¡Bienvenido Encargado! </h2>
            <h4> Empieza a administrar diferentes partes del sistema, usa la barra lateral para navegar o usa un accesso rápido.</h4> <br>
            @endif
            @if(Auth::user()->role=='Visualizador')
            <h2> ¡Bienvenido Visualizador! </h2>
            <h4> Empieza a consultar diferente información del sistema, usa la barra lateral para navegar o usa un accesso rápido.</h4> <br>
            @endif
@if(Auth::user()->role=='Admin')
			<div class="row">
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-primary-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								 <a href="{{route('user.view')}}"> <h3 class="text-white mb-0 font-weight-500">Usuarios </h3> </a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a administrar los usuarios destinados a usar el sistema</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-warning-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('employee.registration.view')}}"><h3 class="text-white mb-0 font-weight-500">Empleados </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a administrar los empleados de la Ayudantía, permitiendo controlar su asistencia, salario, etc...</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-info-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('citizen.registration.view')}}"><h3 class="text-white mb-0 font-weight-500">Ciudadanos </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a administrar los ciudadanos dados de alta en el sistema de la Ayudantía</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-danger-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-calculator" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('citizen.fee.view')}}"><h3 class="text-white mb-0 font-weight-500">Contabilidad </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a administrar la contabilidad de la Ayudantía, dando de alta diferentes tipos de costos</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-success-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('monthly.profit.view')}}"><h3 class="text-white mb-0 font-weight-500">Informes </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a general informes con los datos del sistema, tales como: beneficios, asistencias y ciudadanos</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-white-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-database" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('database.import.view')}}"><h3 class="text-white mb-0 font-weight-500"> Respaldo </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a general un respaldo de seguridad de los datos en formato XLSX</p>
							</div>
						</div>
					</div>
				</div>
			</div>
@endif

@if(Auth::user()->role=='Encargado')
			<div class="row">
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-warning-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('employee.registration.view')}}"><h3 class="text-white mb-0 font-weight-500">Empleados </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a administrar los empleados de la Ayudantía, permitiendo controlar su asistencia, salario, etc...</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-info-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('citizen.registration.view')}}"><h3 class="text-white mb-0 font-weight-500">Ciudadanos </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a administrar los ciudadanos dados de alta en el sistema de la Ayudantía</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-danger-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-calculator" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('citizen.fee.view')}}"><h3 class="text-white mb-0 font-weight-500">Contabilidad </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a administrar la contabilidad de la Ayudantía, dando de alta diferentes tipos de costos</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
                            <a href=""> <div class="icon bg-success-light rounded w-60 h-60"></a>
                                <center>
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </center>
							</div>
							<div>
								<a href="{{route('monthly.profit.view')}}"><h3 class="text-white mb-0 font-weight-500">Informes </h3></a>
                                <p class="text-mute mt-20 mb-0 font-size-16">Empieza a general informes con los datos del sistema, tales como: beneficios, asistencias y ciudadanos</p>
							</div>
						</div>
					</div>
				</div>
			</div>
@endif

@if(Auth::user()->role=='Visualizador')
		<!-- /.Acaba el contenido -->
        <div class="row">
            <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <a href=""> <div class="icon bg-warning-light rounded w-60 h-60"></a>
                            <center>
                                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                            </center>
                        </div>
                        <div>
                            <a href="{{route('employee.registration.view')}}"><h3 class="text-white mb-0 font-weight-500">Empleados </h3></a>
                            <p class="text-mute mt-20 mb-0 font-size-16">Empieza a consultar los empleados de la Ayudantía, permitiendo visualizar su asistencia, salario, etc...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <a href=""> <div class="icon bg-info-light rounded w-60 h-60"></a>
                            <center>
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </center>
                        </div>
                        <div>
                            <a href="{{route('citizen.registration.view')}}"><h3 class="text-white mb-0 font-weight-500">Ciudadanos </h3></a>
                            <p class="text-mute mt-20 mb-0 font-size-16">Empieza a consultar los ciudadanos dados de alta en el sistema de la Ayudantía</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <a href=""> <div class="icon bg-danger-light rounded w-60 h-60"></a>
                            <center>
                                <i class="fa fa-calculator" aria-hidden="true"></i>
                            </center>
                        </div>
                        <div>
                            <a href="{{route('citizen.fee.view')}}"><h3 class="text-white mb-0 font-weight-500">Contabilidad </h3></a>
                            <p class="text-mute mt-20 mb-0 font-size-16">Empieza a consultar la contabilidad de la Ayudantía</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <a href=""> <div class="icon bg-success-light rounded w-60 h-60"></a>
                            <center>
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </center>
                        </div>
                        <div>
                            <a href="{{route('monthly.profit.view')}}"><h3 class="text-white mb-0 font-weight-500">Informes </h3></a>
                            <p class="text-mute mt-20 mb-0 font-size-16">Empieza a general informes con los datos del sistema, tales como: beneficios, asistencias y ciudadanos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif
	  </div>
    </section>
  </div>

  <!-- Terminamos la seccion que contendra los footers, header y barra lateral -->
  @endsection
