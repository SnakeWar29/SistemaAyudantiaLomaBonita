<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- En esta vista se añadira nuevos años de ciudadanos  -->

@if(Auth::user()->role=='Admin')

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Añadir nueva asignación de apoyo  </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('store.assign.support')}}">
		   @csrf
				<!-- -->

                <div class="row">
                    <div class="col-12">
                        <div class="add_item">
                            <!-- Selection box para la categoria de la tarifa-->
                            <div class="form-group">
                                <h5> Clase de los ciudadanos <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="class_id" required="" class="form-control">
                                        <option value="" selected="" disabled=""> Selecciona la clase </option>
                                        <!-- Desplegamos la lista de las categorias de tarifa registradas, se usa foreach, para cada uno de los registros -->
                                        @foreach($classes as $class) <!-- Llamamos a las clases y extraemos el nombre de cada registro existente -->
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <!-- Selection box para la clase del ciudadano -->
                                    <div class="form-group">
                                        <h5> Apoyo <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="support_id[]" required="" class="form-control">
                                                <option value="" selected="" disabled=""> Selecciona el apoyo </option>
                                                <!-- Desplegamos la lista de las clases de ciudadanos se usa foreach, para cada uno de los registros -->
                                                @foreach($supports as $support) <!-- Llamamos a la categoria y extraemos el nombre de cada registro existente -->
                                                <option value="{{$support->id}}">{{$support->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <!-- Campo para el monto de la tarifa-->
                                        <div class="form-group">
                                            <h5> Total del apoyo <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="full_support[]" class="form-control" required="" minlength="2" maxlength="5" onpaste="return false;" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)"> </div>
                                        </div>
                                </div>

                                <div class="col-md-2">
                                    <!-- Campo para el monto de la tarifa-->
                                        <div class="form-group">
                                            <h5> Total de pago mensual <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="monthly_support[]" class="form-control" required="" minlength="2" maxlength="5" onpaste="return false;" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)"> </div>
                                        </div>
                                </div>

                                <div class="col-md-2">
                                    <!-- Campo para el monto de la tarifa-->
                                        <div class="form-group">
                                            <h5> Total de pagos <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                            <input type="text" name="total_payments[]" class="form-control" required="" minlength="1" maxlength="2" onpaste="return false;" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)"> </div>
                                        </div>
                                </div>

                                <div class="col-md-2" style="padding-top: 25px;">
                                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"> </i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Añadir asignación">
             </div>

		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>

  <!-- Emepiza el div para actuar al presionar el boton +-->
  <div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="col-md-4">
                    <!-- Selection box para la clase del ciudadano -->
                    <div class="form-group">
                        <h5> Apoyo <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="support_id[]" required="" class="form-control">
                                <option value="" selected="" disabled=""> Selecciona el apoyo </option>
                                <!-- Desplegamos la lista de las clases de ciudadanos se usa foreach, para cada uno de los registros -->
                                @foreach($supports as $support) <!-- Llamamos a la categoria y extraemos el nombre de cada registro existente -->
                                <option value="{{$support->id}}">{{$support->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <!-- Campo para el monto de la tarifa-->
                        <div class="form-group">
                            <h5> Total del apoyo <span class="text-danger">*</span></h5>
                            <div class="controls">
                            <input type="text" name="full_support[]" class="form-control" required=""> </div>
                        </div>
                </div>

                <div class="col-md-2">
                    <!-- Campo para el monto de la tarifa-->
                        <div class="form-group">
                            <h5> Total de pago mensual <span class="text-danger">*</span></h5>
                            <div class="controls">
                            <input type="text" name="monthly_support[]" class="form-control" required=""> </div>
                        </div>
                </div>

                <div class="col-md-2">
                    <!-- Campo para el monto de la tarifa-->
                        <div class="form-group">
                            <h5> Total de pagos <span class="text-danger">*</span></h5>
                            <div class="controls">
                            <input type="text" name="total_payments[]" class="form-control" required=""> </div>
                        </div>
                </div>


                <div class="col-md-2" style="padding-top: 25px;">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"> </i></span> <!-- Añadir -->
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"> </i></span> <!-- Remover -->
                </div>
            </div>
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

  <!-- Codigo de javaScript para añadir y eliminar el cuadro para añadir nueva tarifa en una consulta-->
  <script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click",'.removeeventmore',function(event){
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1
        });
    });
  </script>

@endsection
