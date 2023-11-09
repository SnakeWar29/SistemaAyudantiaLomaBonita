
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">
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
							<h3 class="mb-0 text-white">Reestablecer contraseña </h3>
						</div>
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Si tu token es válido, rellena los campos solicitados para reestablecer tu contraseña') }}
                        </div>

                        <x-jet-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->token }}">

                            <div class="block">
                                <h5> Correo Electrónico <span class="text-danger">*</span></h5>
                                <div class="block">
                                    <x-jet-input id="email" class="form-control pl-15 bg-transparent text-white plc-white"  readonly="readonly" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5> Nueva contraseña <span class="text-danger">*</span></h5>
                                <div class="block">
                                    <input id="password" class="form-control pl-15 bg-transparent text-white plc-white" type="password" name="password" required autocomplete="new-password" >
                                </div>
                            </div>
                            <!--
                            <div class="mt-4">
                                <h5> Contraseña <span class="text-danger">*</span></h5>
                                <div class="block">
                                    <input id="password_confirmation" class="form-control pl-15 bg-transparent text-white plc-white" type="password" name="password_confirmation" required autocomplete="new-password" >
                                </div>
                            </div> -->
                            <br><br>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-info btn-rounded margin-top-10"> Reestablecer contraseña </button>
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
