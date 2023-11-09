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
	 <h4 class="box-title"> Añadir nuevo empleado </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('store.employee.registration')}}" enctype="multipart/form-data">
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4">

                                    <!-- Campo para el nombre del empleado -->
                                <div class="form-group">
                                    <h5> Nombre del empleado <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="name" minlength="10" class="form-control" required="">
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">

                                <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Contacto de emergencia A <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="fname" minlength="10" class="form-control" required="">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">

                            <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Contacto de emergencia B <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="mname" minlength="10" class="form-control" required="">
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
                                    <input type="text" name="mobile" minlength="10" onpaste="return false;" class="form-control" required="" maxlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">

                                <!-- Campo para el nombre de la clase del ciudadno -->
                                <div class="form-group">
                                    <h5> Dirección del empleado <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="address" minlength="10" class="form-control" required="">
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
                                            <option value="Masculino"> Masculino </option>
                                            <option value="Femenino"> Femenino </option>
                                            <option value="No binario"> No binario </option>
                                            <option value="Prefiero no decirlo"> Prefiero no decirlo </option>
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
                                            <option value="Fisica"> Física </option>
                                            <option value="Mental"> Mental </option>
                                            <option value="Intelectual"> Intelectual </option>
                                            <option value="Psicosocial"> Psicosocial </option>
                                            <option value="Sensorial"> Sensorial </option>
                                            <option value="Auditiva"> Auditiva </option>
                                            <option value="Visual"> Visual </option>
                                            <option value="No aplica"> No aplica </option>
                                        </select>
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Fecha de nacimiento <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="date" id="date" name="dob" max="2023-11-06" class="form-control" required="">
                                    <script>
                                        var today = new Date().toISOString().split('T')[0];
                                        document.getElementById("date").setAttribute("max",today);
                                    </script>
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
                                            <option value="{{$desi->id}}"> {{$desi->name}} </option>  <!-- Creamos un ciclo para recuperar todos los años registrados -->
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Salario <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="salary" minlength="3" onpaste="return false;" class="form-control" required="" maxlength="5" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Fecha de ingreso <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="date" name="join_date" id="join_date" max="2023-11-06" class="form-control" required="">
                                    <script>
                                        var today = new Date().toISOString().split('T')[0];
                                        document.getElementById("join_date").setAttribute("max",today);
                                    </script>
                                    </div>
                                </div>

                            </div>

                        </div>

                         <!-- -------------------------------------------   Cuarta sección ---------------------------------------- -->

                        <div class="row">




                        </div>

                        <!-- -------------------------------------------   Quinta sección ---------------------------------------- -->

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Imagen de perfil <span class="text-danger"></span></h5>
                                    <div class="controls">
                                  <!-- Campo para subir la imagen-->
                                        <input type="file" name="image" class="form-control" id="image"> </div>
                                  </div>
                            </div>


                            <div class="col-md-4">
                                <!-- Mostramos la imagen actual de perfil -->
                                <div  div class="form-group">
                                    <div class="controls">
                                        <center> <img id="showImage" src="{{url('upload/sin_imagen.jpg')}}" style="width: 100px; width: 100px; border: 1px solid #000000;"> </center>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Añadir empleado">
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
