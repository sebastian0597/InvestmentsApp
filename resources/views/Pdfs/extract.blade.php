<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>EXTRACTO - VIP WORLD TRADING</title>
    <style type="text/css">
 

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: 'Rubik', sans-serif;
  font-size: 14px; 
  font-family: 'Rubik', sans-serif;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}
H1{
  color: #7366ff;

}
#invoice h1 {
  color: #7366ff;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 6px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
 
}

table td {
  text-align: center;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  
  background: #7366ff;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #7366ff;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}

p{
  font-size:17px; 
  text-align: justify;
}
h4{
  font-size:17px;
  margin: 6px; 
  
}
#contenedor {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

#contenedor > div {
  width: 50%;
}
.page_break {
  page-break-before: always;
}
h2 {
    display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}
    </style>
  </head>
  <body>
      
      
    <header class="clearfix">
      <br><br> <br><br> <br><br>
      <div style="line-height:5px">
        <h1 >VIP WORLD TRADING</h1>
        <h1>REGISTRO DE RENTABILIDAD:<strong> <span>(MES {{date('m')}} DE 2022)</span></strong></h1>
        
      </div>
      <br>

      <div style="line-height:5px">
        <h2>Inversionista:  <strong> <span>{{mb_strtoupper($customer['name'])}} {{mb_strtoupper($customer['last_name'])}}</span></strong></h2>
      <h2>Identificación:  <strong> <span>{{$customer['document_number']}}</span></strong></h2>
      </div>
      
      <span id="invoice" style="margin-top: 0px;font-size: 18px;">ISF-XXXXX</span>
    </header>
    <main>
      <div id="details" class="clearfix">
       
        <br>
     
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
       <tr>
         <th class="no" scope="row">Fecha consignación</th>
         <th class="no" scope="row">Fecha operación</th>
         <th class="no" scope="row">No. contrato</th>
         <th class="no" scope="row">Vlr. inversión</th>
         <th class="no" scope="row">Capital</th>
         <th class="no" scope="row">Rentabilidad</th>
         <th class="no" scope="row">Capital + Rentabilidad</th>
       
       </tr>
     </thead>
    
     <tbody>
      
      @foreach ($extracts as $item)
                
          <tr>
            <td class="unit">{{$item['fecha_consignacion']}}</td>
            <td class="qty" >{{$item['fecha_inicio']}}</td>
            <td class="unit" >C-{{$item['numero_pagare']}}</td>
            <td class="qty" >${{number_format($item['valor_inversion'],0,'', '.')}}</td>
            <td class="unit" >${{number_format($item['capital_inicial_mes'],0,'', '.')}}</td>
            <td class="qty" >${{number_format($item['investment_return'],0,'', '.')}}</td>
            <td class="unit ">${{number_format(intval($item['capital_inicial_mes']) + intval($item['investment_return']),0,'', '.')}}</td>
          </tr>
        @endforeach
                 
     </tbody>
   </table>

<h1>HISTORICO</h1>
      <table border="0" cellspacing="0" cellpadding="0">
           
        <thead>
          <tr>
            <th class="no">Capital Inicial</th>
            <th class="no">Rentabilidad Acumulada </th>
            <th class="no">Desembolsos Efectuados</th>
            <th class="no">Subtotal</th>
           
          </tr>
        </thead>
        <tbody>
         
          <tr>
            <td class="unit">${{number_format(intval($capital_inicial),0,'', '.')}}</td>
            <td class="qty">${{number_format(intval($rentabilidad_acumulada),0,'', '.')}}</td>
            <td class="unit">${{number_format(intval($desembolsos_efectuados),0,'', '.')}}</td>
            <td class="qty">${{number_format(intval($capital_inicial),0,'', '.')}}</td>
           
          </tr>
        </tbody>

         </table>

  <h1>MES ACTUAL</h1>
      <table border="0" cellspacing="0" cellpadding="0">
           
        <thead>
          <tr>
            <th class="no">Rentabilidad del mes <span>{{$current_extract['profitability_percentage']}}%</span> </th>
            <th class="no">Capital Neto</th>
                      
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td class="unit">${{number_format(intval($current_extract['total_profitability']),0,'', '.')}}</td>
            <td class="qty">${{number_format(intval($capital_neto),0,'', '.')}}</td>
          </tr>
        </tbody>

          

      </table>

      
      
      
      

      <br><br> <br><br> <br><br>
      
          <div id="contenedor">
            <div style="line-height:10px">
                
                <h4>SERGIO ANDRES FIGUEROA GOMEZ</h4>
                <h4>CC. 1.098.816.339</h4>
                <h4>Trader Profesional</h4>
   
            </div>
           <div style="line-height:10px">
          
   
            </div>

        </div>
        </div>
    </main>
    
  </body>
</html>