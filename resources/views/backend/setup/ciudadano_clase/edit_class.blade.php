<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista se añadira nuevas clases de ciudadanos  -->

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title">Editar clase de ciudadano </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('update.citizen.class',$editData->id)}}"> <!-- Apuntamos el form a la ruta de edicion con el id unico del usuario -->
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                        <!-- Campo para el nombre de la clase del ciudadno -->
                            <div class="form-group">
                               <h5> Nombre de la clase del ciudadano <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="text" name="name" class="form-control" required="" value="{{$editData->name}}"> </div>
                                    <!-- Se llama a traer el error que marcara cualqier tipo de error usando message -->
                                    @error('name')
                                        <span class="text-danger"> {{$message="Hubo un error al realizar la operación, puede ser porque la clase ya esta registrada"}}</span>
                                    @enderror

                             </div>
                </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Editar"> <!-- aca lo dejamos -->
             </div>

		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>

@endsection
