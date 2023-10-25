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
      <h4 class="box-title"> Editar costo adicional </h4>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col">
         <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
         <form method="POST" action="{{route('update.other.cost',$editData->id)}}" enctype="multipart/form-data">
            @csrf
                 <div class="row">
                     <div class="col-12">
                         <div class="row">
                             <div class="col-md-3">
                                 <div class="form-group">
                                     <h5> Monto <span class="text-danger">*</span></h5>
                                     <div class="controls">
                                     <input type="number" name="amount" min="1" class="form-control" required="" value="{{$editData->amount}}">
                                     </div>
                                 </div>

                             </div>

                             <div class="col-md-3">
                                 <div class="form-group">
                                     <h5> Fecha de aplicación <span class="text-danger">*</span></h5>
                                     <div class="controls">
                                     <input type="date" name="date" class="form-control" required="" value="{{$editData->date}}">
                                     </div>
                                 </div>

                             </div>

                             <div class="col-md-3">
                                 <div class="form-group">
                                     <h5> Imagen (En caso de ser requerida) <span class="text-danger">*</span></h5>
                                     <div class="controls">
                                   <!-- Campo para subir la imagen-->
                                         <input type="file" name="image" class="form-control" id="image"> </div>
                                   </div>
                             </div>

                             <div class="col-md-3">
                                 <!-- Mostramos la imagen actual de perfil -->
                                 <div  div class="form-group">
                                     <div class="controls">
                                         <center> <img id="showImage" src="{{(!empty($editData->image))? url('upload/cost_images/'.$editData->image):url('upload/sin_imagen.jpg') }}" style="width: 70px; height: 70px;"> </center>
                                     </div>
                                 </div>
                             </div>
                         </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <h5> Descripción <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                             <textarea name="description" id="description" class="form-control" required="" placeholder="Introduce la descripción del costo adicional" aria-invalid="false"> {{$editData->description}}</textarea>
                                         <div class="help-block"></div></div>
                                     </div>
                                 </div>

                             </div>
                     </div>
             </div>
              <div class="text-xs-right">
                 <input type="submit" class="btn btn-rounded btn-info mb-5" value="Actualizar costo adicional">
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
