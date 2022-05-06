const seleccionarTipoDesembolso = () => {
    $("#div_mensual").css("display", "none")
    $("#div_mensual_reportes").css("display", "none")
    $("#div_parcial").empty()

    $("#div_total").empty()

    $("#div_mensual_desembolso").empty()
    $("#container_datos_cliente").empty()

    let html = `<div class="col-md-4">
                    <div class="input-group">
                        <input class="form-control" id="param_desembolso" type="text"
                            placeholder="N° Identificación">

                        <button class="btn btn-secondary" id="btn_buscar_cliente"
                            onclick="buscarClienteDesembolso()" type="submit">Buscar</button>
                    </div>
                </div>`

    switch ($("#tipo_desembolso").val()) {
        case "1":
            $("#div_mensual").css("display", "flex")
            $("#div_mensual_reportes").css("display", "flex")

            break
        case "2":
            $("#div_parcial").append(html)

            break
        case "3":
            $("#div_total").append(html)

            break

        default:
            break
    }
}

const seleccionarTipoClienteDesembolsos = () => {
    $("#div_mensual_desembolso").empty()

    let html = ""
    let titulo = ""

    switch ($("#tipo_cliente").val()) {
        case "1":
            titulo = `<h3>Cliente estandar</h3>`
            break
        case "2":
            $("#div_vip").css("display", "flex")
            titulo = `<h3>Cliente VIP</h3>`
            //Se muestra el div de Empleado
            break
        case "3":
            $("#div_premium").css("display", "flex")
            titulo = `<h3>Cliente Premium</h3>`
            //Se muestra el div de Pensionado
            break
        default:
            break
    }

    html += `
        <div class="row g-3">

            ${titulo}
            <div class="col-md-6">
                <button class="btn btn-primary btn-sm" id="btn_generar_informe_desembolso"
                    onclick="guardarRegistroDesembolso(${$(
                        "#tipo_desembolso"
                    ).val()})" type="button">Generar informe</button>

                </div>
            </div>
            <br>
            <div class="col-md-6">
                <input class="form-control" type="file">
                <br><br>
                <button class="btn btn-outline-success" id="btn_guardar_desembolso"
                onclick="guardarInformeDesembolso()" type="button">Guardar
                informe</button>
            </div>

        </div>`

    $("#div_mensual_desembolso").append(html)
}

const buscarClienteDesembolso = () => {
    let param = $("#param_desembolso").val().trim()
    let form_data = {}
    quitarError("param_desembolso")

    if (param != "") {
        let url =
            window.location.origin + `/api/v1/get_customers_param/${param}`
        let method = "GET"

        enviarPeticion(
            url,
            method,
            form_data,
            "continuarBuscarClienteDesembolso"
        )
    } else {
        agregarError("param_desembolso")
    }
}

const buscarClienteDesembolsoTabla = () => {
    let param = $("#param_desembolso_tabla").val().trim()
    let form_data = {}
    quitarError("param_desembolso_tabla")

    if (param != "") {
        let url =
            window.location.origin + `/api/v1/get_customers_param/${param}`
        let method = "GET"

        enviarPeticion(
            url,
            method,
            form_data,
            "continuarbuscarClienteDesembolsoTabla"
        )
    } else {
        agregarError("param_desembolso_tabla")
    }
}

const continuarbuscarClienteDesembolsoTabla = (response) => {
    

    let clientes = response.data

    clientes = clientes == undefined || null ? {} : clientes
    let html = ''
    $('#content_clientes_tabla').empty()

    if (!isObjEmpty(clientes)) {

        tr_clientes = ''

        clientes.forEach(cliente => {
            
            tr_clientes += 
            `<tr>
                <td><a class="text-inherit">${cliente.name} ${cliente.last_name}</a></td>
                <td>${cliente.document_number}</td>
                <td>${cliente.status}</td>
            </tr>`
            
        })

        html = `<table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>N° identificación</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tr_clientes}
                        </tbody>
                </table>
                <br><br>`

    }else{

        html = `<span>No se han encontrado clientes para los parámetros ingresados.</span>  <br><br>`
    }

    $('#content_clientes_tabla').append(html)
    

}

const continuarBuscarClienteDesembolso = (response) => {
    let cliente = response.data[0]

    cliente = cliente == undefined || null ? {} : cliente

    $("#container_datos_cliente").empty()
    let html = ""

    if (!isObjEmpty(cliente)) {
        //SE DEBE CONSULTAR SI EL CLIENTE TIENE DESEMBOLSOS PENDIENTES POR REALIZAR.

        //if(cliente.status != 'Inactivo'){

        let tipo_desembolso = $("#tipo_desembolso").val().trim()

        let total_rentabilidad = 0
        let grand_total_invested = 0

        if (cliente.investments.length > 0) {
            cliente.investments.forEach((investment) => {

                total_rentabilidad +=
                    investment.extract_detail == null || undefined
                        ? 0
                        : parseInt(investment.extract_detail.investment_return)

                grand_total_invested +=
                investment.extract_detail == null || undefined
                    ? 0
                    : parseInt(investment.extract_detail.investment_amount)
            })

           
        }

        let total_ganancia = total_rentabilidad + grand_total_invested

        let class_color_ganacia = ""
        let simbolo = ""

        if (Math.sign(total_rentabilidad) == -1) {
            //Si la rentabilidad es negativa
            class_color_ganacia = "perdida"
            simbolo = "-"
        } else if (Math.sign(total_rentabilidad) == 1) {
            class_color_ganacia = "ganancia"
        }

        let input_valor = ""

        if (tipo_desembolso == "2") {
            input_valor = ` <input class="form-control " onkeyup="convertirAformatoMoneda(this)" id='valor_consignar' type="text" value="">`
        } else if (tipo_desembolso == "3") {
            input_valor = ` <input class="form-control " disabled id='valor_consignar' type="text" value="$${formatNumber(
                total_ganancia
            )}">`
        }

        let button_guardar_desembolso = ""

        if (total_rentabilidad == 0) {
            Swal.fire({
                icon: "warning",
                text:
                    "Para realizar un desembolso, primero genere el extracto del mes para el cliente " +
                    cliente.name +
                    " " +
                    cliente.last_name,
                confirmButtonText: "Aceptar",
            })
        } else {
            button_guardar_desembolso = ` <button type="button" id="btn_guardar_desembolso" onclick='guardarRegistroDesembolso(${tipo_desembolso})' class="btn btn-primary">Guardar registro</button>`
        }

        html = `
            <h5>Datos del cliente</h5>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Nombre de
                        cliente</label>
                    <input class="form-control" id="nombre_cliente" disabled type="text" value="${
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
                        cliente.total_investments_actives
                    }">
                </div>
            
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" >Rentabilidad mensual </label>
                    <input class="form-control ${class_color_ganacia}" disabled type="text" value="$${simbolo}${formatNumber(
            total_rentabilidad
        )}"
                        required="">
                </div>

                <div class="col-md-6">
                    <label class="form-label" ><b>Total capital</b> (inversión + rentabilidad mensual)</label>
                    <input id='total_rentabilidad_desembolso' class="form-control " disabled type="text" value="$${formatNumber(
                        total_ganancia
                    )}"
                        required="">
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" >Valor a consignar</label>
                    ${input_valor}
                
                </div>
            
            </div>
            <br>
            <div class="row g-3">
                <div class="col-md-4">
                ${button_guardar_desembolso}
                </div>
            
            </div>`
        /*}else{

            Swal.fire({
                icon: 'warning',
                text: 'El cliente ' + cliente.name + ' '+ cliente.last_name + ' se encuentra inactivo.',
                confirmButtonText: 'Aceptar',

            }) 

        }*/
    } else {
        html = `<span>No hay datos para los parámetros ingresados.</span>`
    }

    $("#container_datos_cliente").append(html)
}

const guardarRegistroDesembolso = (tipo_desembolso) => {
   
    quitarError("valor_consignar")

    if (tipo_desembolso == "2" || tipo_desembolso == "3") {

        let id_cliente = $("#id_cliente").val().trim()

        let valor_consignar = quitarformatNumber(
            $("#valor_consignar").val().trim()
        )
        let valor_rentabilidad = parseInt(
            quitarformatNumber($("#total_rentabilidad_desembolso").val().trim())
        )

        if (valor_consignar != "") {

            if(parseInt(valor_consignar) < valor_rentabilidad){
                $("#btn_guardar_desembolso").text("Creando registro...")
                $("#btn_guardar_desembolso").prop("disabled", false)
                $("#btn_guardar_desembolso").removeClass("placeholder")

                let url = window.location.origin + `/api/v1/disbursetment`

                let form_data = new FormData()
                form_data.append("id_disbursement_type", tipo_desembolso)
                form_data.append("id_customer", id_cliente)
                form_data.append("disbursement_amount", valor_consignar)
                form_data.append("profibality_amount", valor_rentabilidad)
                /*form_data.append('monthly_return', valor_consignar)*/

                let method = "POST"

                Swal.fire({
                    icon: "warning",
                    title: "Asegurese que los datos ingresados sean los correctos.",
                    html: `Por favor, revise que el monto del desembolso sea el correcto.<br/><br/>
                            El monto a desembolsar es: <b>$${formatNumber(
                                valor_consignar
                            )}</b><br> 
                            El cliente es: <b>${$("#nombre_cliente").val()}</b><br>
                        `,

                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        enviarPeticion(
                            url,
                            method,
                            form_data,
                            "continuarGuardarRegistroDesembolso"
                        )
                    }
                    if (result.isDismissed) {
                        $("#btn_guardar_desembolso").text("Crear registro")
                        $("#btn_guardar_desembolso").prop("disabled", false)
                        $("#btn_guardar_desembolso").removeClass("placeholder")
                    }
                })
            }else{

                Swal.fire({
                    icon: "warning",
                    text: "El monto a desembolsar no puede ser mayor o igual al valor total de la rentabilidad",
                    confirmButtonText: "Aceptar",
                })

            }

        } else{
            agregarError("valor_consignar")
        }

    }else if(tipo_desembolso == "1"){

            /*$("#btn_guardar_desembolso").text("Creando registro...")
            $("#btn_guardar_desembolso").prop("disabled", false)
            $("#btn_guardar_desembolso").removeClass("placeholder")*/

            let url = window.location.origin + `/api/v1/disbursetment`

            let form_data = new FormData()
            let id_tipo_cliente = $('#tipo_cliente').val()

            form_data.append("id_disbursement_type", tipo_desembolso)
            form_data.append("id_customer", 0)
            form_data.append("id_customer_type", id_tipo_cliente)
            form_data.append("disbursement_amount", 0)
            form_data.append("profibality_amount", 0)
            
            let tipo_cliente = ''
            switch (id_tipo_cliente) {

                case '1':
                    tipo_cliente='Standard'
                    break
                case '2':
                    tipo_cliente='VIP'
                break
                case '3':
                    tipo_cliente='Premium'
                break

            }
            let method = "POST"

            Swal.fire({
                icon: "warning",
                title: "Asegurese que los datos ingresados sean los correctos.",
                html: `Se va a generar el informe de desembolso para los clientes ${tipo_cliente}.<br/><br/>
                    `,

                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Aceptar",
                allowEscapeKey: false,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({                     
                        url: url,
                        method: method,
                        cache:false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function (response) {
                          var a = document.createElement("a")
                          response=response.message
                          console.log(response)
                          a.href = response.file 
                          a.download = response.name
                          document.body.appendChild(a)
                          a.click()
                          a.remove()
                          //$("#downloadExcel").show()
                          //$("#ExcelDownloadLoader").hide()
                          },
                          error: function (ajaxContext) {
                            //$("#downloadExcel").show()
                            //$("#ExcelDownloadLoader").hide()
                            //alert('Export error: '+ajaxContext.responseText)
                            console.log(ajaxContext.responseText)
                          }
                    }) 

                    /*enviarPeticion(
                        url,
                        method,
                        form_data,
                        "continuarGuardarRegistroDesembolso"
                    )*/
                }
                if (result.isDismissed) {
                    /*$("#btn_guardar_desembolso").text("Crear registro")
                    $("#btn_guardar_desembolso").prop("disabled", false)
                    $("#btn_guardar_desembolso").removeClass("placeholder")*/
                }
            })

            
        }
    } 


const continuarGuardarRegistroDesembolso = (response) => {

    console.log(response)
    $("#btn_guardar_desembolso").text("Crear registro")
    $("#btn_guardar_desembolso").prop("disabled", false)
    $("#btn_guardar_desembolso").removeClass("placeholder")
    setResponseMessage(response, "/desembolsos")
}

const buscarDesembolsosPorParametros = () => {
    quitarError("busqueda_desembolsos")

    let param = $("#busqueda_desembolsos").val().trim()
    let form_data = {}
    if (param != "") {
        let url =
            window.location.origin +
            `/api/v1/get_disbursetments_by_params/${param}`
        let method = "GET"

        enviarPeticion(
            url,
            method,
            form_data,
            "continuarBuscarDesembolsosPorParametros"
        )
    } else {
        agregarError("busqueda_desembolsos")
    }
}

const continuarBuscarDesembolsosPorParametros = (response) => {
    let desembolsos = response.data
    desembolsos = desembolsos == undefined || null ? {} : desembolsos

    $("#disbursements_container").empty()
    let html = ""
    if (!isObjEmpty(desembolsos)) {
        let tr_desembolsos = ""

        desembolsos.forEach(function (desembolso) {
            let url =
                document.location.origin +
                `/editar_desembolso/${desembolso.id}`

            tr_desembolsos += `
            <tr>
                <th scope="row"><a href="${url}">${desembolso.id}</a></th>
                <td><a href="${url}">$${formatNumber(
                desembolso.value_consign
            )}</a></td>
                <td><a href="${url}">${desembolso.created_at}</a></td>
                <td><a href="${url}">${desembolso.disbursement_type}</a></td>
                <td><a href="${url}">${desembolso.status}</a></td>
                <td><a href="${url}">${desembolso.customer.fullname}</a></td>

            </tr>`
        })

        html +=
            `<table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Cliente</th>
                    </tr>
                </thead>
                <tbody>` +
            tr_desembolsos +
            `</tbody>
            </table>`
    } else {
        html += `<span>No se han encontrado desembolsos para los parámetros ingresados.</span>`
    }

    $("#disbursements_container").append(html)
}

// /api/v1/disbursetment/

const actualizarDesembolso = () => {
    quitarError("archivo_desembolso")

    if (
        $("#archivo_desembolso").val().trim() != "" ||
        $("#archivo_desembolso_txt").val().trim() != ""
    ) {
        let id_desembolso = $("#id_desembolso").val().trim()

        let archivo_desembolso =
            document.getElementById("archivo_desembolso").files[0] == undefined
                ? $("#archivo_desembolso_txt").val().trim()
                : document.getElementById("archivo_desembolso").files[0]

        let ind_desembolsado =
            $("#check_done").prop("checked") == true ? 1 : ""
        let url =
            window.location.origin +
            `/api/v1/disbursetment/update/${id_desembolso}`

        let method = "POST"
        let form_data = new FormData()

        form_data.append("disbursement_file", archivo_desembolso)
        form_data.append("ind_desembolsado", ind_desembolsado)

        enviarPeticion(url, method, form_data, "continuarActualizarDesembolso")
    } else {
        agregarError("archivo_desembolso")
    }
}

const continuarActualizarDesembolso = (response) => {
    setResponseMessage(response, "/desembolsos")
}

const consultarHistoricoDesembolsos = () => {
    quitarError("fecha_busqueda")
    let param = $("#fecha_busqueda").val().trim()

    if (param != "") {
        let method = "GET"
        let form_data = {}

        let url = window.location.origin + `/api/v1/disbursetment/${param}`
        enviarPeticion(
            url,
            method,
            form_data,
            "continuarConsultarHistoricoDesembolsos"
        )
    } else {
        agregarError("fecha_busqueda")
    }
}

const continuarConsultarHistoricoDesembolsos = (response) => {
    
    let desembolsos = response
    $('#tabla_historico_desembolsos').empty()

    let td_mensual = '<td>$0</td>'
    let td_parcial = '<td>$0</td>'
    let td_total = '<td>$0</td>'

    //if (!isObjEmpty(desembolsos)) {
        desembolsos.forEach(function (desembolso) {

            if(desembolso.id_disbursement_type == 1){//Mensual.
                td_mensual = `<td>$${formatNumber(desembolso.value_consign)}</td>`
            }

            if(desembolso.id_disbursement_type == 2){//Parcial.
                td_parcial = `<td>$${desembolso.value_consign}</td>`
            }
            if(desembolso.id_disbursement_type == 3){//Total.
                td_total = `<td>$${desembolso.value_consign}</td>`
            }

        })

        let html = `
        <table class="table card-table table-vcenter text-nowrap">
            <thead>
                <tr>
                    <th>Tipo desembolsos</th>
                    <th>Rentabilidad mensual</th>
                    <th>Capital parcial</th>
                    <th>Capital total</th>
                </tr>
            </thead>
            <tbody>
                <!--<tr> 
                    <td>N° clientes</td>
                    <td></td>
                    <td></td>
                    <td></td>
                
                </tr> -->
                <tr> 
                    <td>Valor desembolso</td>
                    ${td_mensual}
                    ${td_parcial}
                    ${td_total}
                </tr>
            </tbody>
        </table>`
    //}

   
    
    $('#tabla_historico_desembolsos').append(html)

}

const buscarDesembolsosPorFecha = () => {
    quitarError("fecha_busqueda_desembolsos")
    let fecha = $("#fecha_busqueda_desembolsos").val().trim()

    if (fecha != "") {
        let url = window.location.origin + `/api/v1/disbursetment/${fecha}`
        form_data = {}

        let method = "GET"

        enviarPeticion(
            url,
            method,
            form_data,
            "continuarBuscarDesembolsosPorFecha"
        )
    } else {
        agregarError("fecha_busqueda_desembolsos")
    }
}

const continuarBuscarDesembolsosPorFecha = (respuesta) => {
    console.log(respuesta)
}


/*const generarInformeDesembolso = (tipo_cliente) =>{
    

    console.log(tipo_cliente)
}*/