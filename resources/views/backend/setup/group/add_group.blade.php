<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista se añadira nuevos años de ciudadanos  -->

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Añadir nuevo grupo de ciudadanos </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir el grupo, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('store.citizen.group')}}">
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                        <!-- Campo para el nombre de la clase del ciudadno -->
                            <div class="form-group">
                               <h5> Grupo del ciudadano <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="text" name="name" minlength="5" onpaste="return false;" class="form-control" required=""> </div>
                                    <!-- Se llama a traer el error que marcara cualqier tipo de error usando message -->
                                    @error('name')
                                        <span class="text-danger"> {{$message="Hubo un error al realizar la operación, puede deberse a que el grupo ya está registrado"}}</span>
                                    @enderror

                             </div>
                </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Añadir grupo">
             </div>

		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>

@endsection
