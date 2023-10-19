<!-- Se llama a traer las vistas que contiene el footer, header y barra lateral -->
@extends('admin.admin_view')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- En esta vista sera donde se administraran los tipos de tarifas  -->

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Contenido principal -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Detalles de la lista de asistencia <strong> {{$details['0']['date']}} <strong> </h3>
			</div>
				<div class="box-body">
					<div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th> Nombre </th>
                                    <th> ID Identificativo </th>
                                    <th> Fecha </th>
                                    <th> Estado de asistencia </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Declaramos la variable user que nos ayudara a traer los datos -->
                                @foreach($details as $key => $value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value['user']['name']}}</td> <!-- Usamos la función user creada en el modelo para unir los campos -->
                                    <td>{{$value['user']['id_no']}}</td>
                                    <td>{{date('d-m-Y',strtotime($value->date))}}</td> <!-- Usamos los valores directamente  -->
                                    <td>{{$value->attend_status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                         </table>
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</section>

	  </div>
  </div>
@endsection
