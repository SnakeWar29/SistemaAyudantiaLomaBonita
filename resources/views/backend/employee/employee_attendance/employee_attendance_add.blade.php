<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
	  <section class="content">

 <div class="box">
   <div class="box-header with-border">
	 <h4 class="box-title"> Pasar lista </h4>
   </div>
   <div class="box-body">
	 <div class="row">
	   <div class="col">

        <!-- Se coloca la ruta para añadir la clase, para que sea llamada a la hora de entregar el formulario -->
		<form method="POST" action="{{route('employee.attendance.store')}}">
		   @csrf
				<!-- -->
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5> Fecha de la asistencia <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" id="date" class="form-control" required=""> </div>
                                        <script>
                                            var today = new Date().toISOString().split('T')[0];
                                            document.getElementById("date").setAttribute("max",today);
                                            document.getElementById("date").setAttribute("min",today);
                                        </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                        <!-- Empieza la tabla -->
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped" style="width: 100%">
                            <!-- Encabezado -->
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">ID</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Lista de empleados</th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%">Estado de la asistencia</th>
                                </tr>
                                <tr>
                                    <th class="text-center btn present_all" style="display: table-cell; background-color: #093f09">Presente</th>
                                    <th class="text-center btn leave_all" style="display: table-cell; background-color: #661f0d">Ausente</th>
                                    <th class="text-center btn absent_all" style="display: table-cell; background-color: #858f03">Justificado</th>
                                </tr>
                            </thead>
                            <!-- Cuerpo -->
                            <tbody>
                                @foreach($employees as $key => $employee)
                                <tr id="div{{$employee->id}}" class="text-center">
                                    <input type="hidden" name="employee_id[]" value="{{$employee->id}}"> <!-- Se crea un arreglo para almacenar todo el pase de asistencia simultaneo -->
                                    <td>{{$key+1}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td colspan="3">
                                        <div class="switch-toggle switch-3 switch-candy">
                                            <input name="attend_status{{$key}}" type="radio" value="Presente" id="present{{$key}}" checked="checked">
                                            <label for="present{{$key}}">Presente  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                                            <input name="attend_status{{$key}}" type="radio" value="Ausente" id="leave{{$key}}">
                                            <label for="leave{{$key}}">Ausente   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                                            <input name="attend_status{{$key}}" type="radio" value="Justificado" id="absent{{$key}}">
                                            <label for="absent{{$key}}">Justificado</label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

             <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Pasar lista">
             </div>

		</form> <!-- Termina el formulario -->
	 </div>
   </div>
 </div>

</section>

	  </div>
  </div>

@endsection
