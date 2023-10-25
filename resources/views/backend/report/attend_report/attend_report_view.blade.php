<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<!-- En esta vista sera donde se administraran el rol de los ciudadanos -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script> <!-- exportamos lo necesario para Handlebar.js-->

 <div class="content-wrapper">
	  <div class="container-full">
		<section class="content">
		  <div class="row">
<div class="col-12">
<div class="box bb-3 border-warning">
	<div class="box-header">
		<h4 class="box-title"><strong> Reporte de asistencia </strong></h4>
	</div>
<div class="box-body">

 <form method="GET" action="{{ route('report.attendance.get') }}" target="_blank">
@csrf
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <h5> Nombre del empleado <span class="text-danger"> </span></h5>
        <div class="controls">
        <select name="employee_id" id="employee_id" required="" class="form-control">
            <option value="" selected="" disabled=""> Seleccione el empleado </option>
        @foreach($employees as $yemployee)
            <option value="{{ $yemployee->id}}" >{{ $yemployee->name }}</option>
        @endforeach
            </select>
        </div>
        </div>
    </div>

    <div class="col-md-4">
            <div class="form-group">
            <h5> Fecha <span class="text-danger">*</span></h5>
            <div class="controls">
        <input type="date" name="date" class="form-control" required="" >
        </div>
        </div>
    </div>

    <div class="col-md-4" style="padding-top: 25px;" >
    <input type="submit" class="btn btn-rounded btn-primary" value="Buscar">
    </div>
</div>



		</form>


			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>
  </div>






@endsection
