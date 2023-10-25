<!DOCTYPE html>
<html>
<head>
<style>
.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  color: #001028;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 12px;
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}

.header,
.footer {
    width: 100%;
    text-align: center;
    position: fixed;
}
.header {
    top: 0px;
}
.footer {
    bottom: 0px;
}
.pagenum:before {
    content: counter(page);
}

</style>
</head>
<body>
    <div class="footer">
        Página <span class="pagenum"></span>
    </div>
    <header class="clearfix">

      <div>
        <center> <img src="{{ public_path('backend/images/logo/logo_reportes.jpg')}}" width="250" height="100"> </center>
      </div>
      <h1> Ayudantía Municipal de Loma Bonita Tepoztlán </h1>
      <div id="project">
        <div><span>AYUDANTE</span> C. José Pérez López </div>
        <div><span>DIRECCIÓN</span>Prolongación Articulo 127 S/N</div>
        <div><span>CORREO</span> <a href="jose.daemi@hotmail.com">jose.daemi@hotmail.com</a></div>
        <div><span>TELEFONO</span> 7775102765</div>
        <div><span>GENERACIÓN </span>  {{ date("d/M/Y") }} </div>
        <div><span>TIPO </span> <strong> <u> Reporte de asistencias del empleado </u> </strong> </div>
      </div>
    </header>
    <br>
    <br>
    <strong> Empleado: </strong> {{$allData['0']['user']['name']}} <br>
    <strong> ID Identificativo: </strong> {{$allData['0']['user']['id_no']}} <br>
    <strong> Mes: </strong> {{$month}} <br> <br>
    <main>
        <hr style="border: dashed 2px; width:95%; color: #070707; margin-bottom:50px">
      <table>
          <tr>
            <td class="service"><center> <strong> Fecha </strong></center></td>
            <td class="desc"> <center> <strong> Estado de la asistencia </strong> </center> </td>
          </tr>
          @foreach($allData as $value)
          <tr>
            <td class="service"><center> {{date('d-m-Y',strtotime($value->date))}}</center></td>
            <td class="desc"> <center> {{$value->attend_status}} </center> </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4"> <strong> Faltas = </strong> {{$absents}} </td>
          </tr>
          <tr>
            <td colspan="4"> <strong> Faltas justificadas = </strong>  {{$leaves}} </td>
          </tr>
          <tr>
            <td colspan="4"> <strong> Asistencias = </strong>  {{$assist}} </td>
          </tr>
      </table>


      <br>
      <hr style="border: dashed 2px; width:95%; color: #000000; margin-bottom:50px">
      <div id="notices">
        <div>NOTA:</div>
        <div class="notice"> Esta información fue tomada directamente del sistema de la Ayudantia Municipal de Loma Bonita, si tiene dudas o desea modificar algúno de los datos, favor de presentarse en la Ayudantia con una identificación oficial y vigente.</div>
      </div>

    </main>
  </body>
</html>
