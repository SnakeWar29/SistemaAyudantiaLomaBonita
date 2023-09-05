<!-- Esta vista sera la encargada de poder editar un usuario desde el botón especifico -->
<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Editar usuario </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">
		<!-- Inicia el formulario -->
		   <form method="POST" action="{{route('users.update',$editData->id)}}">
		   @csrf
			 <div class="row">
			   <div class="col-12">	
				<!-- -->

				<div class="row"> <!-- Inicia la clase row-->
					<div class="col-md-6">
						<!-- Formulario para editar el rol del usuario  -->
						<div class="form-group">
							<h5> Rol de usuario <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="usertype" id="usertype" required="" class="form-control">
									<option value="" selected="" disabled=""> Selecciona el rol </option>
									<option value="Admin" {{($editData->usertype == "Admin" ? "selected":"")}}>Administrador</option>
									<option value="Encargado" {{($editData->usertype == "Encargado" ? "selected":"")}}>Encargado</option>
									<option value="Visualizador" {{($editData->usertype == "Visualizador" ? "selected":"")}}>Visualizador</option>
                                    <!-- Las funciones son para poder llamar el tipo de usuario al que pertenece actualmente, si esta en blanco, mostrara el mensaje predeterminado-->
								</select>
							</div>
						</div>
					</div>
						<!-- Formulario para editar el nombre de usuario -->
					<div class="col-md-6">		
						<div class="form-group">
					  	 <h5> Nombre completo <span class="text-danger">*</span></h5>
					  	 <div class="controls">
                                                    <!-- Llamamos al campo requerido dependiedo del ID-->
							   <input type="text" name="name" class="form-control" value="{{$editData->name}}" required=""> </div>
				 	    </div>
					</div>
				</div> <!-- Termina row -->


				<div class="row"> <!-- Inicia la clase row2-->
				<div class="col-md-6">		
					<!-- Formulario para editar el correo electronico del usuario -->
						<div class="form-group">
					  	 <h5> Correo Electrónico <span class="text-danger">*</span></h5>
					  	 <div class="controls">
							   <input type="email" name="email" class="form-control" value="{{$editData->email}}" required=""> </div>
				 	    </div>
					</div>
					<!-- Formulario para pedir la contraseña del usuario -->
					<div class="col-md-6">		
						
					</div>
				</div> <!-- Termina row2 -->
				
				   <div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Editar usuario">
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

@endsection