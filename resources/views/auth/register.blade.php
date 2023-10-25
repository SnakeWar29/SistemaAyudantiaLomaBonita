<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title> Ayudantia Loma Bonita - Registro </title>

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
							<h2 class="text-white">Sistema de la Ayudantia de Loma Bonita</h2>
							<p class="text-white-50">Registrar un nuevo usuario</p>
						</div>
						<div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            <!-- Empieza el formulario de registro -->
                            <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                            <!-- usame Jet-validation-errors para poder mostrar los errores generados al rellenar el formulario -->
                            <x-jet-validation-errors class="mb-4" />
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
										</div>
                                        <!--Nombre -->
										<input type="text" id="name" name="name" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Nombre completo" required autofocus autocomplete="name">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-email"></i></span>
										</div>
                                        <!-- Correo electronico -->
										<input type="email" id="email" name="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Correo electrónico" required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
                                        <!-- Contraseña -->
										<input type="password" id="password" name="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Contraseña" required autocomplete="new-password">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
                                        <!-- Contraseña comfirmacion -->
										<input type="password" id="password_confirmation" name="password_confirmation" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Confirmar contraseña" required autocomplete="new-password">
									</div>
								</div>
                                <div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
                                        <!-- Contraseña comfirmacion -->
										<input type="password" id="password_confirmation" name="password_confirmation" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Confirmar contraseña" required autocomplete="new-password">
									</div>
								</div>
								  <div class="row">
									<div class="col-12">
									  <div class="checkbox text-white">
										<input type="checkbox" id="basic_checkbox_1" >
										<label for="basic_checkbox_1"> Estoy de acuerdo con los <a href="#" class="text-warning"><b>Términos de uso </b></a></label>
									  </div>
									</div>
									<div class="col-12 text-center">
									  <button type="submit" class="btn btn-info btn-rounded margin-top-10"> Registrarse </button>
									</div>
								  </div>
                            </form>

							<div class="text-center">
								<p class="mt-15 mb-0 text-white">¿Ya estas registrado? <a href="{{ route('login') }}" class="text-danger ml-5"> Iniciar sesión </a></p>
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
