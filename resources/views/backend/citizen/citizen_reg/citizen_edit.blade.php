<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- Javascript para la subida de imagen -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- En esta vista se añadira nuevos años de ciudadanos  -->
<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Editar ciudadano </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('update.citizen.registration',$editData->citizen_id)}}" enctype="multipart/form-data">
		   @csrf
           <input type="hidden" name="id" value="{{$editData->id}}">
				<!-- -->
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4">

                                    <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Nombre del ciudadano <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="name" class="form-control" required="" value="{{$editData['citizen']['name']}}">
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">

                                <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Contacto de emergencia A <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="fname" class="form-control" required="" value="{{$editData['citizen']['fname']}}">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">

                            <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Contacto de emergencia B <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="mname" class="form-control" required="" value="{{$editData['citizen']['mname']}}">
                                    </div>
                                </div>

                            </div>

                        </div>


                        <!-- -------------------------------------------   Segunda sección ---------------------------------------- -->

                        <div class="row">
                            <div class="col-md-4">

                                    <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Teléfono del ciudadano  <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="mobile" class="form-control" required="" value="{{$editData['citizen']['mobile']}}" maxlength="10" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)">
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">

                                <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Dirección del ciudadano <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="address" class="form-control" required="" value="{{$editData['citizen']['address']}}">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">

                            <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Género del ciudadano <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender"  required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona el género </option>
                                            <option value="Masculino" {{($editData['citizen']['gender'] == 'Masculino')? 'selected':''}}> Masculino </option> <!-- Recuperamos la seleccion si pértenece a este sexo -->
                                            <option value="Femenino"  {{($editData['citizen']['gender'] == 'Femenino')? 'selected':''}} > Femenino </option>
                                            <option value="No binario" {{($editData['citizen']['gender'] == 'No binario')? 'selected':''}}> No binario </option>
                                            <option value="Prefiero no decirlo" {{($editData['citizen']['gender'] == 'Prefiero no decirlo')? 'selected':''}}> Prefiero no decirlo </option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <!-- -------------------------------------------   Tercera sección ---------------------------------------- -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Tipo de discapacidad   <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="Disabilities" id="Disabilities"  required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona el tipo </option>
                                            <option value="Fisica" {{($editData['citizen']['Disabilities'] == 'Fisica')? 'selected':''}}> Física </option>
                                            <option value="Mental" {{($editData['citizen']['Disabilities'] == 'Mental')? 'selected':''}}> Mental </option>
                                            <option value="Intelectual" {{($editData['citizen']['Disabilities'] == 'Intelectual')? 'selected':''}}> Intelectual </option>
                                            <option value="Psicosocial" {{($editData['citizen']['Disabilities'] == 'Psicosocial')? 'selected':''}}> Psicosocial </option>
                                            <option value="Sensorial" {{($editData['citizen']['Disabilities'] == 'Sensorial')? 'selected':''}}> Sensorial </option>
                                            <option value="Auditiva" {{($editData['citizen']['Disabilities'] == 'Auditiva')? 'selected':''}}> Auditiva </option>
                                            <option value="Visual" {{($editData['citizen']['Disabilities'] == 'Visual')? 'selected':''}}> Visual </option>
                                            <option value="No aplica" {{($editData['citizen']['Disabilities'] == 'No aplica')? 'selected':''}}> No aplica </option>
                                        </select>
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Fecha de nacimiento <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="date" id="dob" name="dob" class="form-control" required="" value="{{$editData['citizen']['dob']}}">
                                    <script>
                                        var today = new Date().toISOString().split('T')[0];
                                        document.getElementById("dob").setAttribute("max",today);
                                    </script>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Descuento (%) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="discount" class="form-control" required="" value="{{$editData['discount']['discount']}}" onpaste="return false;" min="0" max="50" onKeyDown="return false">
                                       <!-- <input type="text" name="discount" class="form-control" required="" value="{{$editData['discount']['discount']}}" maxlength="2" onkeypress="return (event.charCode >= 48 && event.charCode <= 53)"> -->
                                    </div>
                                </div>

                            </div>

                        </div>

                         <!-- -------------------------------------------   Cuarta sección ---------------------------------------- -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Año del ciudadano <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="year_id" required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona el año </option>
                                            @foreach($years as $year)
                                            <option value="{{$year->id}}" {{($editData->year_id == $year->id)? "selected":""}}> {{$year->name}} </option>  <!-- Creamos un ciclo para recuperar todos los años registrados -->
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Clase del ciudadano <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_id" required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona la clase </option>
                                            @foreach($classes as $class)
                                            <option value="{{$class->id}}" {{($editData->class_id == $class->id)? "selected":""}}> {{$class->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Grupo del ciudadano <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="group_id" required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona el grupo </option>
                                            @foreach($groups as $group)
                                            <option value="{{$group->id}}" {{($editData->group_id == $group->id)? "selected":""}}> {{$group->name}}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- -------------------------------------------   Quinta sección ---------------------------------------- -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Turno del ciudadano <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="shift_id" required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona turno </option>
                                            @foreach($shifts as $shift)
                                            <option value="{{$shift->id}}" {{($editData->shift_id == $shift->id)? "selected":""}}> {{$shift->name}}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Imagen de perfil <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                  <!-- Campo para subir la imagen-->
                                        <input type="file" name="image" class="form-control" id="image"> </div>
                                  </div>
                            </div>


                            <div class="col-md-4">
                                <!-- Mostramos la imagen actual de perfil -->
                                <div  div class="form-group">
                                    <div class="controls">
                                        <center> <img id="showImage" src="{{(!empty($editData['citizen']['image']))? url('upload/citizen_images/'.$editData['citizen']['image']):url('upload/sin_imagen.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;"> </center>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Editar información del ciudadano">
             </div>

		</form> <!-- Termina el formulario -->
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
