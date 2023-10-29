
<!-- Se llama a traer la vista que contiene el header, footer y la barra lateral -->
@extends('admin.admin_view')
@section('admin')

<html>
  <head>
  </head>
    <body>
        <section class="content">
            <div class="content-wrapper">
                <div class="container-full">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title"> Exportar/Importar </h3>
                            <br>
                            <div class="d-inline-block align-items-center"></div>
                        </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="box">
                            <div class="box-body">
                                <h4 class="box-title"> Exportar - Usuarios/Empleados/Ciudadanos </h4>
                                <h6> IMPORTANTE: Una vez que se genere el archivo de exportación, no realizar ningún cambio sin autorización a este mismo. </h6>
                                <div>
                                    <center>
                                        <a class="btn btn-app btn-warning" href="{{route('database.export.execute')}}">
                                            <span class="badge bg-primary">.xlsx</span>
                                            <i class="fa fa-users"></i> Descargar
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="box">
                            <div class="box-body">
                                <h4 class="box-title"> Exportar - Año/Turno/Grupo/Clase de los ciudadanos </h4>
                                <h6> IMPORTANTE: Una vez que se genere el archivo de exportación, no realizar ningún cambio sin autorización a este mismo. </h6>
                                <h6> Generación: 4 Archivos </h6>
                                <div>
                                    <center>
                                        <a class="btn btn-app btn-primary" href="{{route('database.citizens.class')}}">
                                            <span class="badge bg-success">Clases</span>
                                            <i class="fa fa-save"></i> Descargar
                                        </a>

                                        <a class="btn btn-app btn-success" href="{{route('database.citizens.group')}}">
                                            <span class="badge bg-danger">Grupos</span>
                                            <i class="fa fa-save"></i> Descargar
                                        </a>

                                        <a class="btn btn-app btn-danger" href="{{route('database.citizens.shift')}}">
                                            <span class="badge bg-primary">Turnos</span>
                                            <i class="fa fa-save"></i> Descargar
                                        </a>

                                        <a class="btn btn-app btn-secondary" href="{{route('database.citizens.year')}}">
                                            <span class="badge bg-success">Años</span>
                                            <i class="fa fa-save"></i> Descargar
                                        </a>
                                    </center>
                                    <br><br>
                                    <a href="{{route('database.citizens.assignation')}}" class="btn btn-rounded btn-success btn-block">Exportar asignación</a>
                                    <br>
                                    <h6> La asignación de los ciudadanos depende de los 4 archivos anteriormente generados.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="box">
                            <div class="box-body">
                                <h4 class="box-title"> Importar - Usuarios/Empleados/Ciudadanos </h4>
                                <h6> IMPORTANTE: Solo importe los datos en caso de pérdida de estos mismos y con los permisos necesarios. </h6>
                                <div>
                                    <form action="{{route('database.import.execute')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file">
                                        <br><br>
                                        <input type="submit" value="Importar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
@endsection
