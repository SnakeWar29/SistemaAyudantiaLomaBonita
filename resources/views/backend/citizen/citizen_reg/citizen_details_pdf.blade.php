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
        <div><span>TIPO </span>  Reporte de ciudadano </div>
      </div>
    </header>
    <main>
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
                <td class="desc"> <center> {{ $details['citizen']['id_no']}} </center></td>
              </tr>
          <tr>
                <td class="service"><center> <strong> 2 </strong></center></td>
                <td class="desc"> <center> <strong> Rol </strong> </center> </td>
                <td class="desc"> <center> {{ $details->roll}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 3 </strong></center></td>
            <td class="desc"> <center> <strong> Nombre completo </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen']['name']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 4 </strong></center></td>
            <td class="desc"> <center> <strong> Teléfono </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen']['mobile']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 5 </strong></center></td>
            <td class="desc"> <center> <strong> Dirección </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen']['address']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 6 </strong></center></td>
            <td class="desc"> <center> <strong> Género </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen']['gender']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 7 </strong></center></td>
            <td class="desc"> <center> <strong> Discapacidad </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen']['Disabilities']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 8 </strong></center></td>
            <td class="desc"> <center> <strong> Clase </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen_class']['name']}}</center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 9 </strong></center></td>
            <td class="desc"> <center> <strong> Grupo </strong> </center> </td>
            <td class="desc"> <center> {{ $details['group']['name']}}  </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 10 </strong></center></td>
            <td class="desc"> <center> <strong> Año </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen_year']['name']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 11 </strong></center></td>
            <td class="desc"> <center> <strong> Turno </strong> </center> </td>
            <td class="desc"> <center> {{ $details['shift']['name']}} </center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 12 </strong></center></td>
            <td class="desc"> <center> <strong> Descuento </strong> </center> </td>
            <td class="desc"> <center> {{ $details['discount']['discount']}}%</center></td>
          </tr>
          <tr>
            <td class="service"><center> <strong> 13 </strong></center></td>
            <td class="desc"> <center> <strong> Fecha de nacimiento </strong> </center> </td>
            <td class="desc"> <center> {{ $details['citizen']['dob']}} </center></td>
          </tr>

          <!-- <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">$5,200.00</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">$6,500.00</td>
          </tr> -->
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice"> Esta información fue tomada directamente del sistema de la Ayudantia Municipal de Loma Bonita, si tiene dudas o desea modificar algúno de los datos, favor de presentarse en la Ayudantia con una identificación oficial y vigente.</div>

    </div>
    </main>
  </body>
</html>
