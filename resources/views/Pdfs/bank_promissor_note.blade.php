<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CONTRATO DE INVERSIÓN - VIP WORLD TRADING</title>
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

        H1 {
            color: #7366ff;

        }

        #invoice h1 {
            color: #7366ff;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
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

        table td h3 {
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

        table .qty {}

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

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
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

        p {
            font-size: 17px;
            text-align: justify;
        }

        h4 {
            font-size: 17px;
            margin: 6px;

        }

        #contenedor {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        #contenedor>div {
            width: 50%;
        }

        .page_break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <header class="clearfix">

        <h1>CONTRATO A FAVOR DE INVERSORES DEL FONDO DE INVERSIÓN VIP WORLD TRADING</h1>
        <span id="invoice" style="margin-top: 0px;font-size: 18px;">ISF-XXXXX</span>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div>
                <p>Entre nosotros, los señores <strong> <span>{{ mb_strtoupper($params['customer_name']) }}</span></strong>, mayor de
                    edad, identificado con la cédula de ciudadanía número
                    <strong><span>{{ mb_strtoupper($params['document_number']) }}</span></strong> expedida en <strong>
                        <span>XXXXXXXXXXXXX</span></strong>, quienes en adelante se denominarán LOS BENEFICIARIOS
                    <strong> <span>(INVERSORES)</span></strong>, y SERGIO ANDRÉS FIGUEROA GÓMEZ, mayor de edad,
                    identificado con la cédula de ciudadanía número 1.098.816.339 expedida en Bucaramanga,
                    quien en adelante se denominará <strong> <span>EL OTORGANTE (OPERADOR)</span></strong>,
                    hemos acordado la elaboración del presente pagaré, de conformidad con el portafolio de inversiones
                    puesto en consideración de las partes,
                    el cual se traduce en las siguientes cláusulas:
                </p>
            </div>

            <div>
                <p>
                    <strong>PRIMERA: </strong> Cuantía Mínima.El monto mínimo para pertenecer a esta categoría asciende
                    a un
                    capital de <strong>${{ number_format($params['amount'], 0, ',', '.') }}</strong> Moneda Legal
                    Colombiana.

                </p>
            </div>

            <div>
                <p> <strong>SEGUNDA:</strong> Propuesta de Inversión. La propuesta de inversión, el porcentaje estimado
                    de rentabilidad y
                    el riesgo asociado a la operación financiera, identifica el mejor y el peor escenario para la
                    decisión de inversión,
                    según como aparece en la siguiente tabla:</p>
            </div>
            <br>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">Fechas</th>
                        <th class="qty">Tasa de Rentabilidad</th>
                        <th class="unit ">Nivel de Riesgo</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- aqui va el porcentaje de la rentabilidad -->
                    <tr>
                        <td class="no">Mes/Año</td>
                        <td class="qty">x%</td>
                        <td class="unit">-x%</td>
                    </tr>
                    <!-- aqui va la rentabilidad del año mes a mes -->
                    <tr>
                        <td class="no">Mes 1</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 2</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 3</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 4</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 5</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 6</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 7</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 8</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 9</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 10</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 11</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Mes 12</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$X.XXX.XXX</td>
                    </tr>


                </tbody>

            </table>

            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">Valoración</th>
                        <th class="qty">Mejor escenario</th>
                        <th class="unit ">Peor escenario</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- aqui va el porcentaje de la rentabilidad -->
                    <tr>
                        <td class="no">Capital</td>
                        <td class="qty">$XXX.XXX.XXX</td>
                        <td class="unit">$XXX.XXX.XXX</td>
                    </tr>
                    <!-- aqui va la rentabilidad del año mes a mes -->
                    <tr>
                        <td class="no">Rentabilidad</td>
                        <td class="qty">x%</td>
                        <td class="unit">-x%</td>
                    </tr>
                    <tr>
                        <td class="no">Rentabilidad mensual</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$XX.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Rentabilidad anual</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$XX.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Capital + rentabilidad</td>
                        <td class="qty">$XX.XXX.XXX</td>
                        <td class="unit">-$XX.XXX.XXX</td>
                    </tr>




                </tbody>
            </table>


            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">Rentabilidad real generada estimada </th>
                        <th class="qty">x%</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="no">Rentabilidad pagada al inversor</td>
                        <td class="qty">x%</td>
                    </tr>
                    <tr>
                        <td class="no">Rentabilidad pagada al inversor</td>
                        <td class="qty">x%</td>
                    </tr>
                    <tr>
                        <td class="no">Rentabilidad recibida para el operador</td>
                        <td class="qty">x%</td>
                    </tr>
                    <tr>
                        <td class="no">Beneficio generado para cliente</td>
                        <td class="qty">$XX.XXX.XXX</td>
                    </tr>
                    <tr>
                        <td class="no">Beneficio generado para operador</td>
                        <td class="qty">$XX.XXX.XXX</td>
                    </tr>
                </tbody>
            </table>

            <div class="page_break">
                <p><strong>TERCERA: </strong>Mecánica de la Operación: EL OTORGANTE <strong>
                        <span>(Operador)</span></strong> recibe el capital de LOS BENEFICIARIOS <strong>
                        <span>(Inversores)</span></strong> y realiza operaciones financieras en la bolsa de valores con
                    el fin de proteger el capital del cliente.</p>
            </div>

            <div>
                <p>
                    <strong>CUARTA:</strong> Estructura del portafolio. Su estructura tendrá los siguientes parámetros:
                </p>
            </div>

            <div>
                <h4>Liquidez: <span>x%</span></h4>
                <h4>Inversión: <span>${{ number_format($params['amount'], 0, ',', '.') }}</span></h4>
                <h4>Activos financieros <span></span></h4>
                <h4>90% <span>derivados Financieros</span></h4>
                <h4>10% <span>reserva bancaria</span></h4>


            </div>


            <div>
                <p>
                    <strong>QUINTA:</strong> Rentabilidad Mínima. El fondo de inversión <strong> <span>(EL
                            OTORGANTE)</span></strong> buscara una rentabilidad mínima mensual del <strong>x%</strong>
                    de rentabilidad sobre el capital entregado por LOS BENEFICIARIOS <strong>
                        <span>(Inversores)</span></strong>.
                </p>
            </div>

            <div>
                <p>
                    <strong>SEXTA:</strong> Pérdidas Financieras. En caso de existir pérdidas financieras y que se
                    reconozca la imposibilidad de generar ganancias en el mes acordado se buscara que la perdida máxima
                    se ha del <strong>x%</strong> sobre el capital de LOS BENEFICIARIOS <strong>
                        <span>(Inversores)</span></strong>.
                </p>
            </div>

            <div>
                <p>
                    <strong>SÉPTIMA:</strong> Retiros de Capital. LOS BENEFICIARIOS<strong>
                        <span>(Inversores)</span></strong> deberán dar aviso al OTORGANTE (Operador) en caso de retiro
                    parcial o total del capital entregado, con un mínimo de anticipación de 30 días calendario en cuyo
                    mes no se generará la rentabilidad acordada, y en su lugar se les reconocerá a LOS BENEFICIARIOS al
                    menos el valor equivalente a la inflación aprobada por el gobierno nacional para dicho mes, con el
                    propósito de no ver afectado su poder adquisitivo.
                </p>
            </div>

            <div>
                <p>
                    <strong>OCTAVA:</strong> Incrementos de Capital. En cualquier momento y durante la vigencia del
                    presente pagaré, LOS BENEFICIARIOS pueden incrementar el valor de su inversión en cualquier monto,
                    sin límites ni restricciones, y el capital adicional estará cobijado por las mismas condiciones
                    pactadas inicialmente en este acuerdo.
                </p>
            </div>
            <div>
                <p>
                    <strong>NOVENA:</strong> Extractos y Pagos. El extracto resumen de la operación se generará y pondrá
                    en conocimiento de LOS BENEFICIARIOS el día primero (1º.) de cada mes y el dinero rentado durante el
                    mes, se consignará a más tardar el día diez (10) de cada mes.
                </p>
            </div>

            <div>
                <p>
                    <strong>DÉCIMA:</strong> Formas de pago. La consignación mensual del valor rentado a LOS
                    BENEFICIARIOS, se hará mediante transferencia bancaria a la cuenta personal de uno (1) solo de
                    ellos. O si se requiere por parte del inversionista se podrá cancelar en efectivo asumiendo el
                    4X1000.
                </p>
            </div>

            <div>
                <p>
                    <strong>DÉCIMA PRIMERA:</strong> Vigencia. El acuerdo descrito por las partes, empezará a regir
                    desde el FECHA EN LETRAS <strong> <span>(FECHA EN NÚMEROS)</span></strong> de MES de AÑO y terminará
                    FECHA EN LETRAS <strong> <span> (FECHA EN NÚMEROS)</span></strong> de MES de AÑO, es decir, tendrá
                    una duración de un (1) año, pudiendo ser renovado a través de un nuevo acuerdo escrito entre las
                    partes o finalizado antes Del año, por acuerdo explícito entre las partes, sin que esto constituya
                    perjuicios para las mismas. En ningún caso tendrá renovación automática.
                </p>
            </div>

            <div>
                <p>
                    <strong>DÉCIMA SEGUNDA:</strong> Normatividad. El presente documento está amparado por la
                    normatividad vigente sobre lo concerniente a los títulos valores, en especial por el artículo 709
                    del Código de Comercio y demás normas concordantes sobre la materia.
                </p>
            </div>

            <div>
                <p>
                    En constancia y aprobación del contenido del presente documento, firman las partes, en la ciudad de
                    Bucaramanga a <strong><span>{{ date('d') }} de {{ date('m') }} de
                            {{ date('Y') }}.</strong>
                </p>
            </div>

            <br><br> <br><br> <br><br>

            <div id="contenedor">
            <div style="line-height:10px">
                <div >
                    <img style="width: 246px;height: auto;margin-inline: 6px;margin-top: -72px;margin: top;"  
                    src="{{ public_path('/images/firma.png') }}">
                </div>
                    <h4>SERGIO ANDRES FIGUEROA GOMEZ</h4>
                    <h4>CC. 1.098.816.339</h4>
                    <h4>Expedida en Bucaramanga.</h4>
                </div>
                <br><br><br><br><br>
                <div style="line-height:10px">

                  <h4>{{ mb_strtoupper($params['customer_name']) }}</h4>
                  <h4>{{ mb_strtoupper($params['document_number']) }}</h4>
                  <h4>Expedida en  XXXXXXXXXXX.</h4>

                </div>

            </div>

    </main>

</body>

</html>
