<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista se cambiara la contraseña del usuario logueado actualmente  -->

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Cambiar contraseña </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">
		<!-- Inicia el formulario usando POST hacia la ruta de actualizar la contraseña-->
		<form method="POST" action="{{route('password.update')}}">
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                        <!-- Campo para confirmar la contraseña anterior -->	
                            <div class="form-group">
                               <h5> Contraseña actual <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="password" name="oldpassword"  id="current_password" class="form-control" required=""> </div>
                                    <!-- Se llama a traer el error que marcara cualqier tipo de error usando message -->
                                    @error('oldpassword')
                                        <span class="text-danger"> {{$message="La contraseña no coincide con nuestros registros"}}</span>
                                    @enderror
                                    
                             </div>
                </div>
            </div>
            <!-- Campo para la nueva contraseña -->		
            <div class="form-group">
               <h5> Nueva contraseña <span class="text-danger">*</span></h5>
               <div class="controls">
                   <input type="password" name="password" id="password" class="form-control" required=""> </div>
                   <!-- Se llama a traer el error que marcara cualqier tipo de error usando message -->
                   @error('password')
                   <span class="text-danger"> {{$message="Las nuevas contraseñas no coinciden"}}</span>
                   @enderror
             </div>	

            <!-- Campo para confirmar la nueva contraseña -->	
            <div class="form-group">
                   <h5> Confirmar nueva contraseña <span class="text-danger">*</span></h5>
                   <div class="controls">
                       <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required=""> </div>
                       <!-- Se llama a traer el error que marcara cualqier tipo de error usando message -->
                       @error('password_confirmation')
                       <span class="text-danger"> {{$message="Las nuevas contraseñas no coinciden"}}</span>
                       @enderror
            </div>
    
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Cambiar contraseña">
             </div>
                
		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>
	  
	  </div>
  </div>

@endsection