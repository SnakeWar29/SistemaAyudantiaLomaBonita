<!-- Esta vista sera la encargada de poder editar un usuario desde el botón especifico -->
<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- Javascript para la subida de imagen -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Editar mi perfil </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">
		<!-- Inicia el formulario -->
		   <form method="POST" action="{{route('profile.store')}}" enctype="multipart/form-data">
		   @csrf
			 <div class="row">
			   <div class="col-12">	
				<!-- -->
				<div class="row"> <!-- Inicia la clase row2-->
				<div class="col-md-6">		
					<!-- Campo para cambiar el nombre -->
						<div class="form-group">
					  	 <h5> Nombre completo <span class="text-danger">*</span></h5>
					  	 <div class="controls">
							   <input type="text" name="name" class="form-control" value="{{$editData->name}}" required=""> </div>
				 	    </div>
					</div>
					<!-- Campo para cambiar el correo electronico -->
					<div class="col-md-6">		
						<div class="form-group">
                            <h5> Correo Electrónico <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="email" name="email" class="form-control" value="{{$editData->email}}" required=""> </div>
                        </div>
					</div>
                    <!-- Campo para cambiar el telefono -->
                    <div class="col-md-6">		
						<div class="form-group">
                            <h5> Telefono de contacto <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="mobile" class="form-control" value="{{$editData->mobile}}" required=""> </div>
                        </div>
					</div>
                    <!-- Campo para cambiar la dirección personal -->
                    <div class="col-md-6">		
						<div class="form-group">
                            <h5> Dirección personal <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="address" class="form-control" value="{{$editData->address}}" required=""> </div>
                        </div>
					</div>
				</div> <!-- Termina row2 -->

                <div class="row"> <!-- Inicia la clase row-->
					<div class="col-md-6">
						<!-- Formulario para editar el rol del usuario  -->
						<div class="form-group">
							<h5> Genero <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="gender" id="gender" required="" class="form-control">
									<option value="" selected="" disabled=""> Seleccionar genero </option>
									<option value="Masculino" {{($editData->gender == "Masculino" ? "selected":"")}}>Masculino</option>
									<option value="Femenino" {{($editData->gender == "Femenino" ? "selected":"")}}>Femenino</option>
									<option value="Prefiero no decirlo" {{($editData->gender == "Prefiero no decirlo" ? "selected":"")}}>Prefiero no decirlo</option>
                                    <!-- Las funciones son para poder llamar el tipo de usuario al que pertenece actualmente, si esta en blanco, mostrara el mensaje predeterminado-->
								</select>
							</div>
						</div>
					</div>
						<!-- Formulario para editar el nombre de usuario -->
					<div class="col-md-6">		
						<div class="form-group">
					  	 <h5> Imagen de perfil <span class="text-danger">*</span></h5>
					  	 <div class="controls">
                         <!-- Campo para subir la imagen-->
							   <input type="file" name="image" class="form-control" id="image"> </div>
				 	    </div>
                        <!-- Mostramos la imagen actual de perfil -->
                         <div class="form-group">
                            <div class="controls">
                                <img id="showImage" src="{{(!empty($user->image))? url('upload/user_images/'.$user->image):url('upload/sin_imagen.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;">
                            </div>
                          </div>
					</div>
				</div> <!-- Termina row -->
				
				   <div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Guardar cambios">
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

  <!-- Función en JavaScript para cambiar la imagen mostrada en tiempo real al momento de subirla   -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
  </script>

@endsection