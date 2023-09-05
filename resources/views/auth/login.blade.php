<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title> Ayudantia Loma Bonita - Iniciar sesión </title>
  
    
	<link rel="stylesheet" href="{{asset('backend/css/vendors_css.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/skin_color.css')}}">	

</head>
<body class="hold-transition theme-primary bg-gradient-primary">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-4 col-md-5 col-12">
						<div class="content-top-agile p-10">
							<h2 class="text-white"> Sistema de la Ayudantia de Loma Bonita</h2>
							<p class="text-white-50"> Inicia tu sesión autorizada para comenzar </p>							
						</div>
						<div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            <!-- Empieza el formulario de inicio de sesión -->
							<form method="POST" action="{{ route('login') }}">
                             @csrf
								<div class="form-group">
								<x-jet-validation-errors class="mb-4" />
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
										</div>
										<!-- Se usa jet validartion para mostrar los errores que puedan surgir 
									<x-jet-validation-errors class="mb-4/>-->
                                        <!-- Input para el correo electronico dentro del login -->
										<input type="email" id="email" name="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Correo Electrónico" required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
                                        <!-- Input para la contraseña dentro del login -->
										<input type="password" id="password" name="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Contraseña" required>
									</div>
								</div>
								  <div class="row">
									<div class="col-6">
									  <div class="checkbox text-white">
										<input type="checkbox" id="basic_checkbox_1" >
										<label for="basic_checkbox_1"> Recordarme </label>
									  </div>
									</div>
									<!-- Ruta para dirigirse al reestablecimiento de contraseña  -->
									<div class="col-6">
									 <div class="fog-pwd text-right">
										<a href="{{ route('password.request') }}" class="text-white hover-info"><i class="ion ion-locked"></i> ¿Olvidaste tu contraseña? </a><br>
									  </div>
									</div>
									<!-- Boton para iniciar sesión -->
									<div class="col-12 text-center">
									  <button type="submit" class="btn btn-info btn-rounded mt-10">Iniciar sesión </button>
									</div>
									<!--  -->
								  </div>
							</form>														


							
							<div class="text-center">
                                <!-- Se redireccionar a la pestaña de registro si no se tiene una cuenta y se desea crear una cuenta -->
								<p class="mt-15 mb-0 text-white"> ¿No tienes una cuenta?  <a href="{{ route('register') }}" class="text-info ml-5"> Registrarse </a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Archivos javascript -->
	<script src="{{asset('backend/js/vendors.min.js')}}"></script>
    <script src="{{asset('../assets/icons/feather-icons/feather.min.js')}}"></script>	

</body>
</html>
