
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
                                <h4 class="box-title"> Exportar - Base de datos completa </h4>
                                <h6> IMPORTANTE: Se generará un archivo .zip con los datos completos en formato .sql </h6>
                                <div>
                                    <center>
                                        <a class="btn btn-app btn-primary" href="{{route('database.complete.export')}}">
                                            <span class="badge bg-success"> .SQL </span>
                                            <i class="fa fa-save"></i> Descargar
                                        </a>
                                    </center>
                                    <h6> La descarga de este archivo solamente debe realizarse si se tiene conocimientos en el formato del archivo asignado </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="box">
                            <div class="box-body">
                                <h4 class="box-title"> Importar - Base de datos completa </h4>
                                <h6> IMPORTANTE: Una vez que se realice la importación de los datos, los datos anteriores no se podrán recuperar </h6>
                                <h6> SUGERENCIA: Respaldar la base de datos actual antes de proceder con la importación </h6>
                                <div>
                                    <form action="{{route('database.complete.import')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="archivo_zip" name="archivo_zip" accept=".zip" required="">
                                        <br> <br>
                                        <h6> El archivo debe ser un formato .sql comprimido en un archivo .zip </h6>
                                        <br>

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
