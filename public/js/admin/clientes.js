const seleccionarActividadEconomica = () => {
    $("#div_independiente").css("display", "none")
    $("#div_empleado").css("display", "none")
    $("#div_empleado_2").css("display", "none")
    $("#div_empleado_3").css("display", "none")
    $("#div_pensionado").css("display", "none")
    $("#div_otros").css("display", "none")

    switch ($("#actividad_economica").val()) {
        case "1":
            $("#div_independiente").css("display", "flex")
            //Se muestra el div de Independiente
            break
        case "2":
            $("#div_empleado").css("display", "flex")
            $("#div_empleado_2").css("display", "flex")
            $("#div_empleado_3").css("display", "flex")

            //Se muestra el div de Empleado
            break
        case "3":
            $("#div_pensionado").css("display", "flex")

            //Se muestra el div de Pensionado
            break
        case "4":
            $("#div_otros").css("display", "flex")

            //Se muestra el div de Otra actividad
            break

        default:
            break
    }
}

const seleccionarCuentaBancaria = () => {
    $("#div_cuenta_personal").css("display", "none")
    $("#div_cuenta_personal_2").css("display", "none")
    $("#div_cuenta_tercero").css("display", "none")
    $("#div_cuenta_tercero_2").css("display", "none")

    switch ($("#cuenta_bancaria").val()) {
        case "1":
            $("#div_cuenta_personal").css("display", "flex")
            $("#div_cuenta_personal_2").css("display", "flex")

            break

        case "2":
            $("#div_cuenta_tercero").css("display", "flex")
            $("#div_cuenta_tercero_2").css("display", "flex")

            break

        default:
            break
    }
}

$("#base_monto_inversion").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "")
})

$("#telefono").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "")
})

$("#numero_documento").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "")
})

$("#numero_cuenta").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "")
})

$("#cedula_tercero").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "")
})

const validarMontoMinimo = () => {
    convertirMoneda()
    if (parseFloat($("#monto_inversion").val().trim()) < 1000000) {
        alert("El monto no puede ser menor a 1000000")
    }
}

const crearCliente = () => {
    if (validarFormularioCliente()) {
        $("#btn_crear_cliente").text("Creando cliente...")
        $("#btn_crear_cliente").prop("disabled", true)

        let nombres = $("#nombres").val().trim()
        let apellidos = $("#apellidos").val().trim()
        let tipo_documento = $("#tipo_documento").val().trim()
        let numero_documento = $("#numero_documento").val().trim()
        let actividad_economica = $("#actividad_economica").val().trim()
        let cuenta_bancaria = $("#cuenta_bancaria").val().trim()
        let tipo_moneda = $("#tipo_moneda").val().trim()
        let metodo_pago = $("#metodo_pago").val().trim()
        let base_monto_inversion = $("#base_monto_inversion").val().trim()
        let monto_inversion = $("#monto_inversion").val().trim()
        let correo = $("#correo").val().trim()
        let telefono = $("#telefono").val().trim()

        let pais = $("#pais").val().trim()
        let departamento = $("#departamento").val().trim()
        let ciudad = $("#ciudad").val().trim()
        let direccion = $("#direccion").val().trim()

        let archivo_documento =
            document.getElementById("archivo_documento").files[0]

        let descripcion_independiente = ""
        if ($("#descripcion_independiente").is(":visible")) {
            descripcion_independiente = $("#descripcion_independiente")
                .val()
                .trim()
        }

        let archivo_rut = ""
        if ($("#archivo_rut").is(":visible")) {
            archivo_rut = document.getElementById("archivo_rut").files[0]
        }

        let empresa = ""
        if ($("#empresa").is(":visible")) {
            empresa = $("#empresa").val().trim()
        }

        let cargo = ""
        if ($("#cargo").is(":visible")) {
            cargo = $("#cargo").val().trim()
        }

        let antiguedad = ""
        if ($("#antiguedad").is(":visible")) {
            antiguedad = $("#antiguedad").val().trim()
        }

        let tipo_contrato = ""
        if ($("#tipo_contrato").is(":visible")) {
            tipo_contrato = $("#tipo_contrato").val().trim()
        }

        let certificado_laboral = ""
        if ($("#certificado_laboral").is(":visible")) {
            certificado_laboral = document.getElementById("certificado_laboral")
                .files[0]
        }

        let fondo_pension = ""
        if ($("#fondo_pension").is(":visible")) {
            fondo_pension = $("#fondo_pension").val().trim()
        }

        let otros_actividad = ""
        if ($("#otros_actividad").is(":visible")) {
            otros_actividad = $("#otros_actividad").val().trim()
        }

        let numero_cuenta = ""
        if ($("#numero_cuenta").is(":visible")) {
            numero_cuenta = $("#numero_cuenta").val().trim()
        }

        let tipo_cuenta = ""
        if ($("#tipo_cuenta").is(":visible")) {
            tipo_cuenta = $("#tipo_cuenta").val().trim()
        }

        let nombre_banco = ""
        if ($("#nombre_banco").is(":visible")) {
            nombre_banco = $("#nombre_banco").val().trim()
        }

        let certificado_cuenta = ""
        if ($("#certificado_cuenta").is(":visible")) {
            certificado_cuenta =
                document.getElementById("certificado_cuenta").files[0]
        }

        let cedula_tercero = ""
        if ($("#cedula_tercero").is(":visible")) {
            cedula_tercero = $("#cedula_tercero").val().trim()
        }

        let nombre_tercero = ""
        if ($("#nombre_tercero").is(":visible")) {
            nombre_tercero = $("#nombre_tercero").val().trim()
        }

        let parentesco = ""
        if ($("#parentesco").is(":visible")) {
            parentesco = $("#parentesco").val().trim()
        }

        let certificado_bancario_tercero = ""
        if ($("#certificado_bancario_tercero").is(":visible")) {
            certificado_bancario_tercero = document.getElementById(
                "certificado_bancario_tercero"
            ).files[0]
        }

        let carta_tercero = ""
        if ($("#carta_tercero").is(":visible")) {
            carta_tercero = document.getElementById("carta_tercero").files[0]
        }

        let rut_tercero = ""
        if ($("#rut_tercero").is(":visible")) {
            rut_tercero = document.getElementById("rut_tercero").files[0]
        }

        let archivo_consignacion = document.getElementById(
            "archivo_consignacion"
        ).files[0]

        var form_data = new FormData()
        form_data.append("name", nombres)
        form_data.append("last_name", apellidos)
        form_data.append("email", correo)
        form_data.append("phone", telefono)
        form_data.append("address", direccion)
        form_data.append("country", pais)
        form_data.append("department", departamento)
        form_data.append("city", ciudad)
        form_data.append("document_number", numero_documento)
        form_data.append("file_document", archivo_documento)
        form_data.append("description_ind", descripcion_independiente)
        form_data.append("file_rut", archivo_rut)
        form_data.append("business", empresa)
        form_data.append("position_business", cargo)
        form_data.append("antique_bussiness", antiguedad)
        form_data.append("type_contract", tipo_contrato)

        form_data.append("work_certificate", certificado_laboral)
        form_data.append("pension_fund", fondo_pension)
        form_data.append("especification_other", otros_actividad)
        form_data.append("account_number", numero_cuenta)

        form_data.append("account_type", tipo_cuenta)
        form_data.append("bank_name", nombre_banco)
        form_data.append("account_certificate", certificado_cuenta)
        form_data.append("document_third", cedula_tercero)
        form_data.append("name_third", nombre_tercero)
        form_data.append("account_certificate", certificado_bancario_tercero)
        form_data.append("letter_authorization_third", carta_tercero)

        form_data.append("kinship_third", parentesco)
        form_data.append("rut_third", rut_tercero)
        form_data.append("id_document_type", tipo_documento)
        form_data.append("id_economic_activity", actividad_economica)
        form_data.append("id_bank_account", cuenta_bancaria)
        form_data.append("registered_by", 1)

        form_data.append("base_amount", base_monto_inversion)
        form_data.append("amount", monto_inversion)
        form_data.append("code_currency", tipo_moneda)
        form_data.append("id_payment_method", metodo_pago)
        form_data.append("id_investment_type", 2)

        form_data.append("consignment_file", archivo_consignacion)

        let url = document.location.origin + "/api/v1/customer/"
        let method = "POST"

        enviarPeticion(url, method, form_data, "continuarCrearCliente")
    }
}

const continuarCrearCliente = (response) => {
    $("#btn_crear_cliente").text("Crear cliente")
    $("#btn_crear_cliente").prop("disabled", false)

    switch (response.status) {
        case 200:
        case 201:
        case 202:
            Swal.fire({
                icon: "success",
                confirmButtonColor: "#6610f2",
                confirmButtonText: "Aceptar",
                text: response.message,
                allowEscapeKey: false,
                allowOutsideClick: false,
            })
            break

        case 400:
        case 401:
        case 402:
            console.log(response)
            break

        case 422:
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6610f2",
                confirmButtonText: "Aceptar",
                text: response.responseText,
                allowEscapeKey: false,
                allowOutsideClick: false,
            })

            break
        case 404:
            break

        case 500:
            Swal.fire({
                icon: "error",
                confirmButtonColor: "#6610f2",
                confirmButtonText: "Aceptar",
                text: response.responseJSON.message,
                allowEscapeKey: false,
                allowOutsideClick: false,
            })

            break
        default:
            console.log(response)
            break
    }
}

const validarFormularioCliente = () => {
    let validador = true
    if ($("#nombres").val().trim() == "") {
        agregarError("nombres")
        validador = false
    } else {
        quitarError("nombres")
    }

    if ($("#correo").val().trim() == "") {
        agregarError("correo")
        validador = false
    } else {
        quitarError("correo")
    }

    if ($("#telefono").val().trim() == "") {
        agregarError("telefono")
        validador = false
    } else {
        quitarError("telefono")
    }

    if ($("#archivo_documento").val().trim() == "") {
        agregarError("archivo_documento")
        validador = false
    } else {
        quitarError("archivo_documento")
    }

    if ($("#pais").val().trim() == "") {
        agregarError("pais")
        validador = false
    } else {
        quitarError("pais")
    }

    if ($("#departamento").val().trim() == "") {
        agregarError("departamento")
        validador = false
    } else {
        quitarError("departamento")
    }

    if ($("#ciudad").val().trim() == "") {
        agregarError("ciudad")
        validador = false
    } else {
        quitarError("ciudad")
    }

    if ($("#direccion").val().trim() == "") {
        agregarError("direccion")
        validador = false
    } else {
        quitarError("direccion")
    }

    if ($("#apellidos").val().trim() == "") {
        agregarError("apellidos")
        validador = false
    } else {
        quitarError("apellidos")
    }
    if ($("#tipo_documento").val() == "") {
        agregarError("tipo_documento")
        validador = false
    } else {
        quitarError("tipo_documento")
    }
    if ($("#numero_documento").val().trim() == "") {
        agregarError("numero_documento")
        validador = false
    } else {
        quitarError("numero_documento")
    }

    //Actividad económica
    if ($("#actividad_economica").val() == "") {
        agregarError("actividad_economica")
        validador = false
    } else {
        quitarError("actividad_economica")
    }
    if (
        $("#descripcion_independiente").val().trim() == "" &&
        $("#descripcion_independiente").is(":visible")
    ) {
        agregarError("descripcion_independiente")
        validador = false
    } else {
        quitarError("descripcion_independiente")
    }
    if ($("#empresa").val().trim() == "" && $("#empresa").is(":visible")) {
        agregarError("empresa")
        validador = false
    } else {
        quitarError("empresa")
    }
    if ($("#cargo").val().trim() == "" && $("#cargo").is(":visible")) {
        agregarError("cargo")
        validador = false
    } else {
        quitarError("cargo")
    }
    if (
        $("#antiguedad").val().trim() == "" &&
        $("#antiguedad").is(":visible")
    ) {
        agregarError("antiguedad")
        validador = false
    } else {
        quitarError("antiguedad")
    }

    if ($("#tipo_contrato").val() == "" && $("#tipo_contrato").is(":visible")) {
        agregarError("tipo_contrato")
        validador = false
    } else {
        quitarError("tipo_contrato")
    }

    if (
        $("#certificado_laboral").val() == "" &&
        $("#certificado_laboral").is(":visible")
    ) {
        agregarError("certificado_laboral")
        validador = false
    } else {
        quitarError("certificado_laboral")
    }
    if (
        $("#fondo_pension").val().trim() == "" &&
        $("#fondo_pension").is(":visible")
    ) {
        agregarError("fondo_pension")
        validador = false
    } else {
        quitarError("fondo_pension")
    }

    if (
        $("#otros_actividad").val().trim() == "" &&
        $("#otros_actividad").is(":visible")
    ) {
        agregarError("otros_actividad")
        validador = false
    } else {
        quitarError("otros_actividad")
    }

    if ($("#cuenta_bancaria").val() == "") {
        agregarError("cuenta_bancaria")
        validador = false
    } else {
        quitarError("cuenta_bancaria")
    }

    //Personal

    if (
        $("#numero_cuenta").val().trim() == "" &&
        $("#numero_cuenta").is(":visible")
    ) {
        agregarError("numero_cuenta")
        validador = false
    } else {
        quitarError("numero_cuenta")
    }

    if (
        $("#tipo_cuenta").val().trim() == "" &&
        $("#tipo_cuenta").is(":visible")
    ) {
        agregarError("tipo_cuenta")
        validador = false
    } else {
        quitarError("tipo_cuenta")
    }

    if (
        $("#nombre_banco").val().trim() == "" &&
        $("#nombre_banco").is(":visible")
    ) {
        agregarError("nombre_banco")
        validador = false
    } else {
        quitarError("nombre_banco")
    }

    if (
        $("#certificado_cuenta").val().trim() == "" &&
        $("#certificado_cuenta").is(":visible")
    ) {
        agregarError("certificado_cuenta")
        validador = false
    } else {
        quitarError("certificado_cuenta")
    }

    //tercero

    if (
        $("#cedula_tercero").val().trim() == "" &&
        $("#cedula_tercero").is(":visible")
    ) {
        agregarError("cedula_tercero")
        validador = false
    } else {
        quitarError("cedula_tercero")
    }

    if (
        $("#nombre_tercero").val().trim() == "" &&
        $("#nombre_tercero").is(":visible")
    ) {
        agregarError("nombre_tercero")
        validador = false
    } else {
        quitarError("nombre_tercero")
    }

    if (
        $("#parentesco").val().trim() == "" &&
        $("#parentesco").is(":visible")
    ) {
        agregarError("parentesco")
        validador = false
    } else {
        quitarError("parentesco")
    }

    if (
        $("#certificado_bancario_tercero").val().trim() == "" &&
        $("#certificado_bancario_tercero").is(":visible")
    ) {
        agregarError("certificado_bancario_tercero")
        validador = false
    } else {
        quitarError("certificado_bancario_tercero")
    }

    if (
        $("#carta_tercero").val().trim() == "" &&
        $("#carta_tercero").is(":visible")
    ) {
        agregarError("carta_tercero")
        validador = false
    } else {
        quitarError("carta_tercero")
    }

    if ($("#tipo_moneda").val() == "") {
        agregarError("tipo_moneda")
        validador = false
    } else {
        quitarError("tipo_moneda")
    }

    if ($("#metodo_pago").val() == "") {
        agregarError("metodo_pago")
        validador = false
    } else {
        quitarError("metodo_pago")
    }
    if ($("#base_monto_inversion").val() == "") {
        agregarError("base_monto_inversion")
        validador = false
    } else {
        quitarError("base_monto_inversion")
    }

    if ($("#archivo_consignacion").val().trim() == "") {
        agregarError("archivo_consignacion")
        validador = false
    } else {
        quitarError("archivo_consignacion")
    }

    return validador
}

const buscarClientePorParametros = () => {
    let parametro = $("#busqueda_cliente_extractos").val().trim()
    quitarError("busqueda_cliente_extractos")
    if (parametro != "") {
        form_data = {}
        let url =
            document.location.origin +
            `/api/v1/get_customers_param/${parametro}`
        let method = "GET"

        enviarPeticion(
            url,
            method,
            form_data,
            "continuarBuscarClientePorParametros"
        )
    } else {
        agregarError("busqueda_cliente_extractos")
    }
}

const continuarBuscarClientePorParametros = (response) => {
    let cliente = response.data[0]
    cliente = cliente == undefined || null ? {} : cliente
    $("#content-clientes").empty()
    
    if (!isObjEmpty(cliente)) {

        trInversiones = ``
        cliente.investments.forEach(function(element) {
           let amount = formatNumber(element.amount)
            if (element.status == 1) {
                
                trInversiones += `
                <tr>
                    <td>${element.investment_date == null ? '' : element.investment_date}</td>
                    <td>$${amount == null ? 0 : amount}</td>
                    <td>${element.percentage_investment == null ? 0 : element.percentage_investment}</td>
                    <td>${element.percentage_investment == null ? 0 : element.percentage_investment}</td>
                    <td>$${amount == null ? 0 : amount}</td>
                </tr>
                `
            }       
                                  
        });
        
        html = ` 
            <div style="margin-top:20px">
                <h5>Datos del cliente</h5>
                
                <div class="row">
                    <div class="col">
                        <label>Nombres</label>
                        <input type="text" disabled class="form-control" placeholder="${cliente.name}">
                    </div>
                    <div class="col">
                        <label>Apellidos</label>
                        <input type="text" disabled class="form-control" placeholder="${cliente.last_name}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Número documento</label>
                        <input type="text" disabled class="form-control" placeholder="${cliente.document_number}">
                    </div>
                    <div class="col">
                        <label>Tipo de cliente</label>
                        <input type="text" disabled class="form-control" placeholder="${cliente.customer_type}">
                    </div>
                </div>
        
            </div>
            <div style="margin-top:20px">
                <h5>Datos inversiones</h5>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Consolidado de Inversiones</th>
                            <th scope="col">% Rentabilidad</th>
                            <th scope="col">Total invertido</th>
                        </tr>
                    </thead>
                    <tbody>
                       `+
                         trInversiones      
                    +`</tbody>
                </table>
        
            </div>
           `


    }else{
        html = `<span>No hay datos para los parámetros ingresados</span>`
    }
    $("#content-clientes").append(html)
}

