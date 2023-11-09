<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista editara los años de un ciudadano  -->

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title">Editar años del ciudadano </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para editar el año, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('update.citizen.year',$editData->id)}}"> <!-- Apuntamos el form a la ruta de edicion con el id unico del año -->
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                               <h5> Año del ciudadano <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="text" name="name" maxlength="4" minlength="4" onpaste="return false;"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" class="form-control" required="" value="{{$editData->name}}"> </div>
                                    <!-- Se llama a traer el error que marcara cualqier tipo de error usando message -->
                                    @error('name')
                                        <span class="text-danger"> {{$message="Hubo un error al realizar la operación, puede ser porque el año ya este registrado"}}</span>
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
