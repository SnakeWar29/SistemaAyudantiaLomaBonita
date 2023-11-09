<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran los usuarios registrados en el sistema -->
@if(Auth::user()->role=='Admin')
<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Añadir usuario </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">
		<!-- Inicia el formulario -->
		   <form method="POST" action="{{route('users.store')}}">
		   @csrf
			 <div class="row">
			   <div class="col-12">
				<!-- -->

				<div class="row"> <!-- Inicia la clase row-->
					<div class="col-md-6">
						<!-- Formulario para pedir el rol del usuario a añadir -->
						<div class="form-group">
							<h5> Rol de usuario <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="role" id="role" required="" class="form-control">
									<option value="" selected="" disabled=""> Selecciona el rol </option>
									<option value="Admin">Administrador</option>
									<option value="Encargado">Encargado</option>
									<option value="Visualizador">Visualizador</option>
								</select>
							</div>
						</div>
					</div>
						<!-- Formulario para pedir el nombre de usuario -->
					<div class="col-md-6">
						<div class="form-group">
					  	 <h5> Nombre completo <span class="text-danger">*</span></h5>
					  	 <div class="controls">
							   <input type="text" name="name" class="form-control" required=""> </div>
				 	    </div>
					</div>
				</div> <!-- Termina row -->


				<div class="row"> <!-- Inicia la clase row2-->
				<div class="col-md-6">
					<!-- Formulario para pedir el correo electronico del usuario -->
						<div class="form-group">
					  	 <h5> Correo Electrónico <span class="text-danger">*</span></h5>
					  	 <div class="controls">
							   <input type="email" name="email" class="form-control" required=""> </div>
                               @error('email')
                               <span class="text-danger"> {{$message="Hubo un error al realizar la operacion, puede deberse a que el correo electrónico ya está registrado"}}</span>
                               @enderror
				 	    </div>
					</div>
				</div> <!-- Termina row2 -->

				   <div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Añadir usuario">
				   </div>
			   </div>
			 </div>
		   </form> <!-- Termina el formulario -->
	   </div>
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>
@endif

<!-- EN CASO DE QUE NO SEA USUARIO AUTORIZADO -->
  @if(Auth::user()->role=='Encargado')
<div class="content-wrapper">
    <div class="px-30 my-15 no-print">
        <div class="callout callout-danger" style="margin-bottom: 0!important;">
          <h4><i class="fa fa-info"></i> AVISO:</h4>
          UPS! No tienes permiso para usar esta página!
        </div>
      </div>
</div>
@endif

@if(Auth::user()->role=='Visualizador')
<div class="content-wrapper">
    <div class="px-30 my-15 no-print">
        <div class="callout callout-danger" style="margin-bottom: 0!important;">
          <h4><i class="fa fa-info"></i> AVISO:</h4>
          UPS! No tienes permiso para usar esta página!
        </div>
      </div>
</div>
@endif

@endsection
