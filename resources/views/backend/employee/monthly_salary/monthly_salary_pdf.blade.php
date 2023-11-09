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
        <div><span>TELÉFONO</span> 7775102765</div>
        <div><span>GENERACIÓN </span>  {{ date("d/M/Y") }} </div>
        <div><span>TIPO </span> <strong> <u> Reporte de salario mensual de empleados </u> </strong> </div>
      </div>
    </header>

    @php
        // Realizamos calculos con PHP
        $date = date('Y-m',strtotime($details['0']->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];  // Verificamos si los campos no estan vacios, es decir, la selección por defecto
        }
            $totalattend = App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$details['0']->employee_id)->get(); // Usamos toda la ruta del controlador
            $salary = (float)$details['0']['user']['salary']; // Recuperamos el salario
            $salaryperday = (float)$salary/30; // Declaramos el salario por dia, dividiendo entre 30 (mes)
            $absentcount = count($totalattend->where('attend_status','Ausente')); // Recuperamos los registros con justificación
            $totalsalaryminus = (float)$absentcount*(float)$salaryperday; // recuperamos el cuento de los justificados y se multiplica por el salario por dia
            $totalsalary = (float)$salary-(float)$totalsalaryminus; // Restamos la cantidad al salario base
    @endphp

    <main>
        <hr style="border: dashed 2px; width:95%; color: #070707; margin-bottom:50px">
      <table>
        <thead>
          <tr>
            <th class="service"> <center> <strong> Número </strong></center></th>
            <th> <strong> Campo </strong></th>
            <th> <strong> Información </strong></th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td class="service"><center> <strong> 1 </strong></center></td>
                <td class="desc"> <center> <strong> ID identificativo </strong> </center> </td>
                <td class="desc"> <center> {{ $details['0']['user']['id_no']}} </center></td>
              </tr>
          <tr>
            <td class="service"><center> <strong> 2 </strong></center></td>
            <td class="desc"> <center> <strong> Nombre completo </strong> </center> </td>
            <td class="desc"> <center> {{ $details['0']['user']['name']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 3 </strong></center></td>
            <td class="desc"> <center> <strong> Salario base </strong> </center> </td>
            <td class="desc"> <center> {{ $details['0']['user']['salary']}} MXN$</center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 4 </strong></center></td>
            <td class="desc"> <center> <strong> Faltas en este mes </strong> </center> </td>
            <td class="desc"> <center> {{ $absentcount }} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 5 </strong></center></td>
            <td class="desc"> <center> <strong> Salario mensual final </strong> </center> </td>
            <td class="desc"> <center> {{ number_format($totalsalary,2,'.') }} MXN$</center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 5 </strong></center></td>
            <td class="desc"> <center> <strong> Mes </strong> </center> </td>
            <td class="desc"> <center> {{ date('M Y',strtotime($details['0']->date))}}</center></td>
          </tr>
        </tbody>
      </table>



      <hr style="border: dashed 2px; width:95%; color: #000000; margin-bottom:50px">
      <div id="notices">
        <div>NOTA:</div>
        <div class="notice"> Esta información fue tomada directamente del sistema de la Ayudantia Municipal de Loma Bonita, si tiene dudas o desea modificar algúno de los datos, favor de presentarse en la Ayudantia con una identificación oficial y vigente.</div>
      </div>

    </main>
  </body>
</html>
