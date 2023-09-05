<!DOCTYPE html> <!-- Esta clase contendra la plantilla del footer, header y la barra lateral que se usara en todo el sitio -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('backend/images/favicon.ico')}}">
    <!-- Se añade el backend a las direcciones para tormarlas directamente de nuestras carpetas -->
    <title> Administración Ayudantia Loma Bonita - Panel principal </title>

	<!-- Estilo Vendor -->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

	<!-- Importaciones de CSS -->
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
  <!-- CSS para poder mostrar notificaciones -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">
  <!-- Se incluye el header -->
  @include('admin.body.header')
  <!-- Se inclue la columna de la izqueirda, tiene el logo y contiene la barra lateral -->
  @include('admin.body.sidebar')
  	<!-- Se una yield para poder referencias el contenido desde otras vistas -->
  	@yield('admin')

  <!-- Se inclue el footer -->
  @include('admin.body.footer')

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./Finontenido -->
<!-- Aqui esportxamos nuestro documentos JavaScript, los cuales son sumamente importantes para poder tener animaciones y creatividad -->
	<!-- Vendor JS -->
	<script src="{{asset('backend/js/vendors.min.js') }}"></script>
  <script src="{{asset('../assets/icons/feather-icons/feather.min.js') }}"></script>
	<script src="{{asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }} "></script>
	<script src="{{asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }} "></script>
	<script src="{{asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }} "></script>

  <script src="{{asset('../assets/vendor_components/datatable/datatables.min.js')}}"></script>
	<script src="{{asset('backend/js/pages/data-table.js')}}"></script>
	<!-- Scripts a los css otorgados por Sunny y bootstrap -->
	<script src="{{asset('backend/js/template.js') }}"></script>
	<script src="{{asset('backend/js/pages/dashboard.js') }}"></script>
  <!-- Script para traer lo necesario para sweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="text/javascript">
    $(function(){

      // Evevento OnCLICK
      $(document).on('click','#delete',function(e){
        // Se programa el display, es decir, una alerta encima de  la pagina de creación de usuarios para evitar que se recargue
        e.preventDefault();
          var link = $(this).attr("href");

          // Se usa el comando extraido de Sweetalert2 
              Swal.fire({
                title: '¿Estas seguro de eliminar el usaurio?',
                text: "No se podra recuperar el usuario posteriormente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Seguro'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = link
                  Swal.fire(
                    'Eliminado',
                    'El usuario ha sido eliminado',
                    'success'
                  )
                }
              })
      });
    });
  </script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Este script funciona cuando detecta un tipo de acción referente al añadir usuario, en cada caso posible-->
  <script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
          switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
          }
      @endif 
  </script>
</body>
</html>
