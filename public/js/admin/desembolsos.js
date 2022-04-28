const seleccionarTipoDesembolso = () => {
    $("#div_mensual").css("display", "none");
    $("#div_mensual_reportes").css("display", "none");
    $("#div_parcial").empty();

    $("#div_total").empty();

    $("#div_mensual_desembolso").empty();
    $("#container_datos_cliente").empty();

    let html = `<div class="col-md-4">
                    <div class="input-group">
                        <input class="form-control" id="param_desembolso" type="text"
                            placeholder="N° Identificación">

                        <button class="btn btn-secondary" id="btn_buscar_cliente"
                            onclick="buscarClienteDesembolso()" type="submit">Buscar</button>
                    </div>
                </div>`;


    switch ($("#tipo_desembolso").val()) {
        case "1":
            $("#div_mensual").css("display", "flex");
            $("#div_mensual_reportes").css("display", "flex");
            
            break;
        case "2":
          
            $("#div_parcial").append(html);

            break;
        case "3":

            $("#div_total").append(html);

            break;

        default:
            break;
    }
};

const seleccionarTipoClienteDesembolsos = () => {
    $("#div_mensual_desembolso").empty();

    let html = "";
    let titulo = "";

    switch ($("#tipo_cliente").val()) {
        case "1":
            titulo = `<h3>Cliente estandar</h3>`;
            break;
        case "2":
            $("#div_vip").css("display", "flex");
            titulo = `<h3>Cliente VIP</h3>`;
            //Se muestra el div de Empleado
            break;
        case "3":
            $("#div_premium").css("display", "flex");
            titulo = `<h3>Cliente Premium</h3>`;
            //Se muestra el div de Pensionado
            break;
        default:
            break;
    }

    html += `
        <div class="row g-3">

            ${titulo}
            <div class="col-md-6">
                <button class="btn btn-primary btn-sm" id="Bookmark"
                    onclick="generarInformeDesembolso(${$(
                        "#tipo_cliente"
                    ).val()})" type="button">Generar informe</button>

                </div>
            </div>
        
            <div class="col-md-6">
                <input class="form-control" type="file">
                <button class="btn btn-outline-success btn-lg" id="Bookmark"
                onclick="guardarInformeDesembolso()" type="button">Guardar
                informe</button>
            </div>

        </div>`;

    $("#div_mensual_desembolso").append(html);
};

const buscarClienteDesembolso = () => {
    let param = $("#param_desembolso").val().trim();
    let form_data = {};
    quitarError("param_desembolso");

    if (param != "") {
        let url =
            window.location.origin + `/api/v1/get_customers_param/${param}`;
        let method = "GET";

        enviarPeticion(
            url,
            method,
            form_data,
            "continuarBuscarClienteDesembolso"
        );
    } else {
        agregarError("param_desembolso");
    }
};

const continuarBuscarClienteDesembolso = (response) => {
    let cliente = response.data[0];
    cliente = cliente == undefined || null ? {} : cliente;

    $("#container_datos_cliente").empty();
    let html = "";

    if (!isObjEmpty(cliente)) {
        let tipo_desembolso = $("#tipo_desembolso").val().trim()
        let total_rentabiidad =
            cliente.extract == null || undefined
                ? 0
                : parseInt(cliente.extract.total_profitability);

        let grand_total_invested =
            cliente.extract == null || undefined
                ? 0
                : parseInt(cliente.extract.grand_total_invested);

        let total_ganancia = total_rentabiidad + grand_total_invested;

        let input_valor = ''

        if(tipo_desembolso == '2'){

            input_valor = ` <input class="form-control" onkeyup="convertirAformatoMoneda(this)" id='valor_consignar' type="text" value="">`

        }else if(tipo_desembolso == '3'){

            input_valor = ` <input class="form-control" disabled id='valor_consignar' type="text" value="$${formatNumber(total_ganancia)}">`
        }

        html = `
        <h5>Datos del cliente</h5>
        
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Nombre de
                    cliente</label>
                <input class="form-control" disabled type="text" value="${
                    cliente.name
                } ${cliente.last_name}"
                    required="">
                <input type="hidden" id="id_cliente" value="${cliente.id}">
            </div>
            <div class="col-md-4">
                <label class="form-label">N°
                    Identificación</label>
                <input class="form-control" disabled type="text" value="${
                    cliente.document_number
                }"
                    required="">
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" >Tipo de cliente
                </label>
                <input class="form-control" disabled type="text" value="${
                    cliente.customer_type
                }"
                    required="">
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha ingreso
                </label>
                <input class="form-control" disabled type="text" value="${
                    cliente.registered_at
                }"
                    required="">
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" >Banco </label>
                <input class="form-control" disabled type="text" value="${
                    cliente.bank_name
                }"
                    required="">
            </div>
            <div class="col-md-4">
                <label class="form-label" >N° cuenta
                </label>
                <input class="form-control" disabled type="text" value="${
                    cliente.account_number
                }"
                    required="">
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" >Tipo de cuenta
                </label>
                <input class="form-control" disabled type="text" value="${
                    cliente.account_type
                }"
                    required="">
            </div>
            <div class="col-md-4">
                <label class="form-label" >Valor invertido</label>
                <input class="form-control" disabled type="text" value="$${
                    cliente.total_investments
                }">
            </div>
           
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" >Rentabilidad mensual </label>
                <input class="form-control" disabled type="text" value="$${formatNumber(
                    total_rentabiidad
                )}"
                    required="">
            </div>

            <div class="col-md-4">
                <label class="form-label" >Total rentabilidad </label>
                <input class="form-control" disabled type="text" value="$${formatNumber(
                    total_ganancia
                )}"
                    required="">
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" >Valor a consignar</label>
                ${
                  input_valor
                }
               
            </div>
          
        </div>
        <br>
        <div class="row g-3">
            <div class="col-md-4">
                <button type="button" onclick='guardarRegistroDesembolso(${tipo_desembolso})' class="btn btn-primary">Guardar registro</button>
            </div>
          
        </div>
        
        
        `;
    } else {
        html = `<span>No hay datos para los parámetros ingresados.</span>`;
    }

    $("#container_datos_cliente").append(html);
};

const guardarRegistroDesembolso = (tipo_desembolso) => {

    let valor_consignar = $('#valor_consignar').val().trim()
    let id_cliente = $('#id_cliente').val().trim()
    quitarError('valor_consignar')
    console.log(id_cliente)
    if(valor_consignar != ''){

        let url = window.location.origin+`/api/v1/disbursetment`

        let form_data = new FormData();
        form_data.append('id_disbursement_type', tipo_desembolso);
        form_data.append('id_customer', id_cliente);
        //form_data.append('email', correo);


    }else{
        agregarError('valor_consignar')
    }
    
}