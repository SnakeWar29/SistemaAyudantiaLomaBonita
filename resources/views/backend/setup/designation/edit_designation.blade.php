<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title">Editar designación </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para editar, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('update.designation',$editData->id)}}"> <!-- Apuntamos el form a la ruta de edicion con el id unico del año -->
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                               <h5> Nombre de la asignación <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="text" name="name" minlength="10" class="form-control" required="" value="{{$editData->name}}"> </div>
                                    <!-- Se llama a traer el error que marcara cualqier tipo de error usando message -->
                                    @error('name')
                                        <span class="text-danger"> {{$message="Hubo un error al realizar la operación, puede ser porque la deisgnación ya esta registrada"}}</span>
                                    @enderror

                             </div>
                </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Editar">
             </div>

		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>

@endsection
