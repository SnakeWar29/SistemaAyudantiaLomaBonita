<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Incrementar salario </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('update.salary',$editData->id)}}">
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                               <h5> Incremento <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="text" name="increment_salary" class="form-control" required="" maxlength="15" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)"> </div>
                             </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                               <h5> Salario afectado el <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="date" name="effected_salary" class="form-control" required=""> </div>
                             </div>
                    </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Incrementar salario">
             </div>

		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>

@endsection
