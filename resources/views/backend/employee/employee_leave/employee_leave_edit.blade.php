<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Editar ausencia </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('update.employee.leave',$editData->id)}}">
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                           <h5> Empleado <span class="text-danger">*</span></h5>
                           <div class="controls">
                               <select name="employee_id" required="" class="form-control">
                                    <option value="" selected="" disabled=""> Selecciona el empleado </option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}" {{($editData->employee_id == $employee->id)? 'selected':'' }}>{{$employee->name}}</option>
                                    @endforeach
                               </select>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                           <h5> Razón <span class="text-danger">*</span></h5>
                           <div class="controls">
                               <select name="leave_purpose_id" id="leave_purpose_id" required="" class="form-control">
                                    <option value="" selected="" disabled=""> Selecciona la razón </option>
                                    @foreach($leave_purpose as $leave)
                                        <option value="{{$leave->id}}" {{($editData->leave_purpose_id == $leave->id)? 'selected':'' }}>{{$leave->name}}</option>
                                    @endforeach
                                    <option value="0">Otro</option>
                               </select>
                               <input type="text" name="name" id="add_another" class="form-control" placeholder="Escribe la razón" style="display: none;">
                               <!-- Se desplegara usando javaScript, por defecti esta en none -->
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                               <h5> Fecha de inicio de la ausencia <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="date" name="start_date" class="form-control" required="" value="{{$editData->start_date}}"> </div>
                             </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                               <h5> Fecha de fin de la ausencia <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="date" name="end_date" class="form-control" required="" value="{{$editData->end_date}}"> </div>
                             </div>
                    </div>
            </div>
             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Actualizar ausencia">
             </div>

		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>

  <!-- Codigo en JavaScript para añadir una nueva razón -->
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#leave_purpose_id',function(){
            var leave_purpose_id = $(this).val();
            if (leave_purpose_id == '0'){ // Si se selecciona el campo, se muestra
                $('#add_another').show();
            }else{
                $('#add_another').hide(); // Si se deseleccional el campo, desaparece
            }
        })
    })
  </script>

@endsection
