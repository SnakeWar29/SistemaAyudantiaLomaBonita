

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title> Ayudantia Municipal Loma Bonita - Recuperar contraseña</title>

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
							<h3 class="mb-0 text-white">Recuperar contraseña</h3>
						</div>
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('¿Olvidaste tu contraseña? Ponte en contacto con el administrador de la Ayudantia o si tienes permisos, coloca tu correo abajo y te llegaran instrucciones para reestablecerla') }}
                        </div>
						<div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        <x-jet-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="block">
                                <input class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Your Email" type="email" name="email" :value="old('email')" required autofocus >
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-info btn-rounded margin-top-10"> Enviar correo </button>
                                  </div>
                            </div>
                        </form>
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
