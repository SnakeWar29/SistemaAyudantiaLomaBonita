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
	 <h4 class="box-title"> Editar empleado </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('update.employee.registration',$editData->id)}}" enctype="multipart/form-data">
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4">

                                    <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Nombre del empleado <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="name" minlength="10" class="form-control" required="" value="{{$editData->name}}">
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">

                                <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Contacto de emergencia A <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="fname" minlength="10" class="form-control" required="" value="{{$editData->fname}}">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">

                            <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Contacto de emergencia B <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="mname" minlength="10" class="form-control" required="" value="{{$editData->mname}}">
                                    </div>
                                </div>

                            </div>

                        </div>


                        <!-- -------------------------------------------   Segunda sección ---------------------------------------- -->

                        <div class="row">
                            <div class="col-md-4">

                                    <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Teléfono del empleado  <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="mobile" class="form-control" required="" value="{{$editData->mobile}}" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">

                                <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Dirección del empleado <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="address" minlength="10" class="form-control" required="" value="{{$editData->address}}">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">

                            <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Género del empleado <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender"  required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona el género </option>
                                            <option value="Masculino" {{($editData->gender == 'Masculino')? 'selected':''}}> Masculino </option>
                                            <option value="Femenino" {{($editData->gender == 'Femenino')? 'selected':''}}> Femenino </option>
                                            <option value="No binario" {{($editData->gender == 'No binario')? 'selected':''}}> No binario </option>
                                            <option value="Prefiero no decirlo" {{($editData->gender == 'Prefiero no decirlo')? 'selected':''}}> Prefiero no decirlo </option>
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
                                            <option value="Fisica" {{($editData->Disabilities == 'Física')? 'selected':''}}> Física </option>
                                            <option value="Mental" {{($editData->Disabilities == 'Mental')? 'selected':''}}> Mental </option>
                                            <option value="Intelectual" {{($editData->Disabilities == 'Intelectual')? 'selected':''}}> Intelectual </option>
                                            <option value="Psicosocial" {{($editData->Disabilities == 'Psicosocial')? 'selected':''}}> Psicosocial </option>
                                            <option value="Sensorial" {{($editData->Disabilities == 'Sensorial')? 'selected':''}}> Sensorial </option>
                                            <option value="Auditiva" {{($editData->Disabilities == 'Auditiva')? 'selected':''}}> Auditiva </option>
                                            <option value="Visual" {{($editData->Disabilities == 'Visual')? 'selected':''}}> Visual </option>
                                            <option value="No aplica" {{($editData->Disabilities == 'No aplica')? 'selected':''}}> No aplica </option>
                                        </select>
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Fecha de nacimiento <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="date" name="dob" class="form-control" max="2023-11-06" required="" value="{{$editData->dob}}">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Designación <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="designation_id" required="" class="form-control">
                                            <option value="" selected="" disabled=""> Selecciona el puesto </option>
                                            @foreach($designation as $desi)
                                            <option value="{{$desi->id}}" {{($editData->designation_id == $desi->id)?'selected':''}}> {{$desi->name}} </option>  <!-- Creamos un ciclo para recuperar todos los años registrados -->
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5> Salario <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="salary" class="form-control" required="" value="{{$editData->salary}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5> Fecha de ingreso <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="date" name="join_date" class="form-control" required="" value="{{$editData->join_date}}">
                                        </div>
                                    </div>

                                </div>
                            -->
                        </div>

                         <!-- -------------------------------------------   Cuarta sección ---------------------------------------- -->

                        <div class="row">




                        </div>

                        <!-- -------------------------------------------   Quinta sección ---------------------------------------- -->

                        <div class="row">

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
                                        <center> <img id="showImage" src="{{(!empty($editData->image))? url('upload/employee_images/'.$editData->image):url('upload/sin_imagen.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;"> </center>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Actualizar">
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
