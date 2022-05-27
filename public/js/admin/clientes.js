const seleccionarActividadEconomica = () => {
    $('#div_independiente').css('display', 'none')
    $('#div_empleado').css('display', 'none')
    $('#div_empleado_2').css('display', 'none')
    $('#div_empleado_3').css('display', 'none')
    $('#div_pensionado').css('display', 'none')
    $('#div_otros').css('display', 'none')

    switch ($('#actividad_economica').val()) {
        case '1':
            $('#div_independiente').css('display', 'flex')
            //Se muestra el div de Independiente
            break
        case '2':
            $('#div_empleado').css('display', 'flex')
            $('#div_empleado_2').css('display', 'flex')
            $('#div_empleado_3').css('display', 'flex')

            //Se muestra el div de Empleado
            break
        case '3':
            $('#div_pensionado').css('display', 'flex')

            //Se muestra el div de Pensionado
            break
        case '4':
            $('#div_otros').css('display', 'flex')

            //Se muestra el div de Otra actividad
            break

        default:
            break
    }
}

const seleccionarCuentaBancaria = () => {
    $('#div_cuenta_personal').css('display', 'none')
    $('#div_cuenta_personal_2').css('display', 'none')
    $('#div_cuenta_tercero').css('display', 'none')
    $('#div_cuenta_tercero_2').css('display', 'none')
    $('#div_cuenta_tercero_3').css('display', 'none')

    switch ($('#cuenta_bancaria').val()) {
        case '1':
            $('#div_cuenta_personal').css('display', 'flex')
            $('#div_cuenta_personal_2').css('display', 'flex')

            break

        case '2':
            $('#div_cuenta_tercero').css('display', 'flex')
            $('#div_cuenta_tercero_2').css('display', 'flex')
            $('#div_cuenta_tercero_3').css('display', 'flex')

            break

        default:
            break
    }
}

$('#base_monto_inversion').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '')
})

$('#telefono').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '')
})

$('#numero_documento').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '')
})

$('#numero_cuenta').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '')
})

$('#cedula_tercero').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '')
})

const validarMontoMinimo = () => {
    let validador = true
    convertirMoneda()
    $('#error_base_monto_inversion').empty()
    if (quitarformatNumber($('#monto_inversion').val().trim()) < 1000000) {
        agregarError('base_monto_inversion')
        validador = false
        $('#error_base_monto_inversion').append(
            'El monto no puede ser menor a ' + formatNumber(1000000)
        )
    } else {
        quitarError('base_monto_inversion')
    }
    return validador
}

const convertirAformatoMoneda = (element) => {
    let valor = $('#' + element.id).val()
    valor = formatNumber(valor)
    $('#' + element.id).val(valor)
}

const crearCliente = () => {
   
    if (validarFormularioCliente()) {
        $('#btn_crear_cliente').text('Creando cliente...')
        $('#btn_crear_cliente').addClass('placeholder') 
        $('#btn_crear_cliente').prop('disabled', true)

        let nombres = $('#nombres').val().trim()
        let apellidos = $('#apellidos').val().trim()
        let tipo_documento = $('#tipo_documento').val().trim()
        let numero_documento = $('#numero_documento').val().trim()
        let actividad_economica = $('#actividad_economica').val().trim()
        let cuenta_bancaria = $('#cuenta_bancaria').val().trim()
        let tipo_moneda = $('#tipo_moneda').val().trim()
        let metodo_pago = $('#metodo_pago').val().trim()
        let base_monto_inversion = quitarformatNumber(
            $('#base_monto_inversion').val().trim()
        )
        let monto_inversion = quitarformatNumber(
            $('#monto_inversion').val().trim()
        )
     
        let correo = $('#correo').val().trim()
        let telefono = $('#telefono').val().trim()

        let pais = $('#pais').val().trim()
        let departamento = $('#departamento').val().trim()
        let ciudad = $('#ciudad').val().trim()
        let direccion = $('#direccion').val().trim()

        let archivo_documento =
            document.getElementById('archivo_documento').files[0]

        let descripcion_independiente = ''
        if ($('#descripcion_independiente').is(':visible')) {
            descripcion_independiente = $('#descripcion_independiente')
                .val()
                .trim()
        }

        let archivo_rut = ''
        if ($('#archivo_rut').is(':visible')) {
            archivo_rut = document.getElementById('archivo_rut').files[0]
        }

        let empresa = ''
        if ($('#empresa').is(':visible')) {
            empresa = $('#empresa').val().trim()
        }

        let cargo = ''
        if ($('#cargo').is(':visible')) {
            cargo = $('#cargo').val().trim()
        }

        let antiguedad = ''
        if ($('#antiguedad').is(':visible')) {
            antiguedad = $('#antiguedad').val().trim()
        }

        let tipo_contrato = ''
        if ($('#tipo_contrato').is(':visible')) {
            tipo_contrato = $('#tipo_contrato').val().trim()
        }

        let certificado_laboral = ''
        if ($('#certificado_laboral').is(':visible')) {
            certificado_laboral = document.getElementById('certificado_laboral')
                .files[0]
        }

        let fondo_pension = ''
        if ($('#fondo_pension').is(':visible')) {
            fondo_pension = $('#fondo_pension').val().trim()
        }

        let otros_actividad = ''
        if ($('#otros_actividad').is(':visible')) {
            otros_actividad = $('#otros_actividad').val().trim()
        }

        let numero_cuenta = ''
        if ($('#numero_cuenta').is(':visible')) {
            numero_cuenta = $('#numero_cuenta').val().trim()
        }

        let tipo_cuenta = ''
        if ($('#tipo_cuenta').is(':visible')) {
            tipo_cuenta = $('#tipo_cuenta').val().trim()
        }

        let nombre_banco = ''
        if ($('#nombre_banco').is(':visible')) {
            nombre_banco = $('#nombre_banco').val()
        }

        let certificado_cuenta = ''
        if ($('#certificado_cuenta').is(':visible')) {
            certificado_cuenta =
                document.getElementById('certificado_cuenta').files[0]
        }

        let cedula_tercero = ''
        if ($('#cedula_tercero').is(':visible')) {
            cedula_tercero = $('#cedula_tercero').val().trim()
        }

        let nombre_tercero = ''
        if ($('#nombre_tercero').is(':visible')) {
            nombre_tercero = $('#nombre_tercero').val().trim()
        }

        let parentesco = ''
        if ($('#parentesco').is(':visible')) {
            parentesco = $('#parentesco').val().trim()
        }

        let certificado_bancario_tercero = ''
        if ($('#certificado_bancario_tercero').is(':visible')) {
            certificado_bancario_tercero = document.getElementById(
                'certificado_bancario_tercero'
            ).files[0]
        }

        let carta_tercero = ''
        if ($('#carta_tercero').is(':visible')) {
            carta_tercero = document.getElementById('carta_tercero').files[0]
        }

        let rut_tercero = ''
        if ($('#rut_tercero').is(':visible')) {
            rut_tercero = document.getElementById('rut_tercero').files[0]
        }

        let archivo_consignacion = document.getElementById(
            'archivo_consignacion'
        ).files[0]

        let form_data = new FormData()
        form_data.append('name', nombres)
        form_data.append('last_name', apellidos)
        form_data.append('email', correo)
        form_data.append('phone', telefono)
        form_data.append('address', direccion)
        form_data.append('country', pais)
        form_data.append('department', departamento)
        form_data.append('city', ciudad)
        form_data.append('document_number', numero_documento)
        form_data.append('file_document', archivo_documento)
        form_data.append('description_ind', descripcion_independiente)
        form_data.append('file_rut', archivo_rut)
        form_data.append('business', empresa)
        form_data.append('position_business', cargo)
        form_data.append('antique_bussiness', antiguedad)
        form_data.append('type_contract', tipo_contrato)

        form_data.append('work_certificate', certificado_laboral)
        form_data.append('pension_fund', fondo_pension)
        form_data.append('especification_other', otros_actividad)
        form_data.append('account_number', numero_cuenta)

        form_data.append('account_type', tipo_cuenta)
        form_data.append('bank_name', nombre_banco)
        form_data.append('account_certificate', certificado_cuenta)
        form_data.append('document_third', cedula_tercero)
        form_data.append('name_third', nombre_tercero)
        form_data.append('account_certificate', certificado_bancario_tercero)
        form_data.append('letter_authorization_third', carta_tercero)

        form_data.append('kinship_third', parentesco)
        form_data.append('rut_third', rut_tercero)
        form_data.append('id_document_type', tipo_documento)
        form_data.append('id_economic_activity', actividad_economica)
        form_data.append('id_bank_account', cuenta_bancaria)
        form_data.append('registered_by', $('#user_id').val().trim())

        form_data.append('base_amount', base_monto_inversion)
        form_data.append('amount', monto_inversion)
        form_data.append('code_currency', tipo_moneda)
        form_data.append('id_payment_method', metodo_pago)
        form_data.append('id_investment_type', 2)

        form_data.append('consignment_file', archivo_consignacion)

        let url = document.location.origin + '/api/v1/customer/'
        let method = 'POST'
        let txt_numero_cuenta =
            numero_cuenta != ''
                ? `El número de cuenta es: <b>${numero_cuenta}</b> <br> `
                : ''
        let txt_banco =
            nombre_banco != ''
                ? `El banco es: <b>${nombre_banco}</b> <br>`
                : ''

        Swal.fire({
            icon: 'warning',
            title: 'Asegurese que los datos ingresados sean los correctos.',
            html: `Por favor, que revise el número de cuenta, el banco seleccionado sean los correctos <br/><br/>
                    El monto a invertir es: <b>$${formatNumber(
                        monto_inversion
                    )}</b><br> 
                    El correo del cliente es: <b>${correo}</b><br>
                    El numero de documento es: <b>${numero_documento}</b><br> 
                    ${txt_numero_cuenta + txt_banco}
                   `,

            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            allowEscapeKey: false,
            allowOutsideClick: false,

        }).then((result) => {
            if (result.isConfirmed) {
                enviarPeticion(url, method, form_data, 'continuarCrearCliente')
            }
            if (result.isDismissed) {
                $('#btn_crear_cliente').text('Crear cliente')
                $('#btn_crear_cliente').prop('disabled', false)
                $('#btn_crear_cliente').removeClass('placeholder') 
            }
        })
    }
}

const continuarCrearCliente = (response) => {
    $('#btn_crear_cliente').text('Crear cliente')
    $('#btn_crear_cliente').prop('disabled', false)
    $('#btn_crear_cliente').removeClass('placeholder') 
  
    setResponseMessage(response, '/crear_cliente')
    //location.reload()
}

const validarFormularioCliente = () => {
    let validador = true
    if ($('#nombres').val().trim() == '') {
        agregarError('nombres')
        validador = false
    } else {
        quitarError('nombres')
    }

    if ($('#correo').val().trim() == '') {
        agregarError('correo')
        validador = false
    } else {
        quitarError('correo')
    }

    if ($('#telefono').val().trim() == '') {
        agregarError('telefono')
        validador = false
    } else {
        quitarError('telefono')
    }

    if ($('#archivo_documento').val().trim() == '') {
        agregarError('archivo_documento')
        validador = false
    } else {
        quitarError('archivo_documento')
    }

    if ($('#pais').val().trim() == '') {
        agregarError('pais')
        validador = false
    } else {
        quitarError('pais')
    }

    if ($('#departamento').val().trim() == '') {
        agregarError('departamento')
        validador = false
    } else {
        quitarError('departamento')
    }

    if ($('#ciudad').val().trim() == '') {
        agregarError('ciudad')
        validador = false
    } else {
        quitarError('ciudad')
    }

    if ($('#direccion').val().trim() == '') {
        agregarError('direccion')
        validador = false
    } else {
        quitarError('direccion')
    }

    if ($('#apellidos').val().trim() == '') {
        agregarError('apellidos')
        validador = false
    } else {
        quitarError('apellidos')
    }
    if ($('#tipo_documento').val() == '') {
        agregarError('tipo_documento')
        validador = false
    } else {
        quitarError('tipo_documento')
    }
    if ($('#numero_documento').val().trim() == '') {
        agregarError('numero_documento')
        validador = false
    } else {
        quitarError('numero_documento')
    }

    //Actividad económica
    if ($('#actividad_economica').val() == '') {
        agregarError('actividad_economica')
        validador = false
    } else {
        quitarError('actividad_economica')
    }
    if (
        $('#descripcion_independiente').val().trim() == '' &&
        $('#descripcion_independiente').is(':visible')
    ) {
        agregarError('descripcion_independiente')
        validador = false
    } else {
        quitarError('descripcion_independiente')
    }
    if ($('#empresa').val().trim() == '' && $('#empresa').is(':visible')) {
        agregarError('empresa')
        validador = false
    } else {
        quitarError('empresa')
    }
    if ($('#cargo').val().trim() == '' && $('#cargo').is(':visible')) {
        agregarError('cargo')
        validador = false
    } else {
        quitarError('cargo')
    }
    if (
        $('#antiguedad').val().trim() == '' &&
        $('#antiguedad').is(':visible')
    ) {
        agregarError('antiguedad')
        validador = false
    } else {
        quitarError('antiguedad')
    }

    if ($('#tipo_contrato').val() == '' && $('#tipo_contrato').is(':visible')) {
        agregarError('tipo_contrato')
        validador = false
    } else {
        quitarError('tipo_contrato')
    }

    if (
        $('#certificado_laboral').val() == '' &&
        $('#certificado_laboral').is(':visible')
    ) {
        agregarError('certificado_laboral')
        validador = false
    } else {
        quitarError('certificado_laboral')
    }
    if (
        $('#fondo_pension').val().trim() == '' &&
        $('#fondo_pension').is(':visible')
    ) {
        agregarError('fondo_pension')
        validador = false
    } else {
        quitarError('fondo_pension')
    }

    if (
        $('#otros_actividad').val().trim() == '' &&
        $('#otros_actividad').is(':visible')
    ) {
        agregarError('otros_actividad')
        validador = false
    } else {
        quitarError('otros_actividad')
    }

    if ($('#cuenta_bancaria').val() == '') {
        agregarError('cuenta_bancaria')
        validador = false
    } else {
        quitarError('cuenta_bancaria')
    }

    //Personal

    if (
        $('#numero_cuenta').val().trim() == '' &&
        $('#numero_cuenta').is(':visible')
    ) {
        agregarError('numero_cuenta')
        validador = false
    } else {
        quitarError('numero_cuenta')
    }

    if (
        $('#tipo_cuenta').val().trim() == '' &&
        $('#tipo_cuenta').is(':visible')
    ) {
        agregarError('tipo_cuenta')
        validador = false
    } else {
        quitarError('tipo_cuenta')
    }

    if (
        $('#nombre_banco').val().trim() == '' &&
        $('#nombre_banco').is(':visible')
    ) {
        agregarError('nombre_banco')
        validador = false
    } else {
        quitarError('nombre_banco')
    }

    if (
        $('#certificado_cuenta').val().trim() == '' &&
        $('#certificado_cuenta').is(':visible')
    ) {
        agregarError('certificado_cuenta')
        validador = false
    } else {
        quitarError('certificado_cuenta')
    }

    //tercero

    if (
        $('#cedula_tercero').val().trim() == '' &&
        $('#cedula_tercero').is(':visible')
    ) {
        agregarError('cedula_tercero')
        validador = false
    } else {
        quitarError('cedula_tercero')
    }

    if (
        $('#nombre_tercero').val().trim() == '' &&
        $('#nombre_tercero').is(':visible')
    ) {
        agregarError('nombre_tercero')
        validador = false
    } else {
        quitarError('nombre_tercero')
    }

    if (
        $('#parentesco').val().trim() == '' &&
        $('#parentesco').is(':visible')
    ) {
        agregarError('parentesco')
        validador = false
    } else {
        quitarError('parentesco')
    }

    if (
        $('#certificado_bancario_tercero').val().trim() == '' &&
        $('#certificado_bancario_tercero').is(':visible')
    ) {
        agregarError('certificado_bancario_tercero')
        validador = false
    } else {
        quitarError('certificado_bancario_tercero')
    }

    if (
        $('#carta_tercero').val().trim() == '' &&
        $('#carta_tercero').is(':visible')
    ) {
        agregarError('carta_tercero')
        validador = false
    } else {
        quitarError('carta_tercero')
    }

    if ($('#tipo_moneda').val() == '') {
        agregarError('tipo_moneda')
        validador = false
    } else {
        quitarError('tipo_moneda')
    }

    if ($('#metodo_pago').val() == '') {
        agregarError('metodo_pago')
        validador = false
    } else {
        quitarError('metodo_pago')
    }
    if ($('#base_monto_inversion').val() == '') {
        agregarError('base_monto_inversion')
        validador = false
    } else {
        quitarError('base_monto_inversion')
    }

    if ($('#archivo_consignacion').val().trim() == '') {
        agregarError('archivo_consignacion')
        validador = false
    } else {
        quitarError('archivo_consignacion')
    }
    if (!validarMontoMinimo()) {
        validador = false
    }
    /*if(!validarSintaxisCorreo('<input onblur='validarSintaxisCorreo(this)' class='form-control' id='correo' type='email' data-bs-original-title='' title=''>')){
        validador = false
        agregarError('correo')
    }else{
        quitarError('correo')
    }*/

    return validador
}

const actualizarCliente = (id_cliente) => {
    if (validarFormularioActualizarCliente()) {
        $('#btn_actualizar_cliente').text('Actualizando cliente...')
        $('#btn_actualizar_cliente').prop('disabled', true)

        let nombres = $('#nombres').val().trim()
        let apellidos = $('#apellidos').val().trim()
        let tipo_documento = $('#tipo_documento').val().trim()
        let numero_documento = $('#numero_documento').val().trim()
        let actividad_economica = $('#actividad_economica').val().trim()
        let cuenta_bancaria = $('#cuenta_bancaria').val().trim()
        let telefono = $('#telefono').val().trim()
        let pais = $('#pais').val().trim()
        let departamento = $('#departamento').val().trim()
        let ciudad = $('#ciudad').val().trim()
        let direccion = $('#direccion').val().trim()
        let correo = $('#correo').val().trim()

        let archivo_documento =
            document.getElementById('archivo_documento').files[0] == undefined
                ? $('#archivo_documento_txt').val()
                : document.getElementById('archivo_documento').files[0]

        let descripcion_independiente = ''
        if ($('#descripcion_independiente').is(':visible')) {
            descripcion_independiente =
                $('#descripcion_independiente').val().trim() == ''
                    ? $('#descripcion_independiente_txt').val().trim()
                    : $('#descripcion_independiente').val().trim()
        }

        let archivo_rut = ''
        if ($('#archivo_rut').is(':visible')) {
            archivo_rut =
                document.getElementById('archivo_rut').files[0] == undefined
                    ? $('#archivo_rut_txt').val()
                    : document.getElementById('archivo_rut').files[0]
        }

        let empresa = ''
        if ($('#empresa').is(':visible')) {
            empresa = $('#empresa').val().trim()
        }

        let cargo = ''
        if ($('#cargo').is(':visible')) {
            cargo = $('#cargo').val().trim()
        }

        let antiguedad = ''
        if ($('#antiguedad').is(':visible')) {
            antiguedad = $('#antiguedad').val().trim()
        }

        let tipo_contrato = ''
        if ($('#tipo_contrato').is(':visible')) {
            tipo_contrato = $('#tipo_contrato').val().trim()
        }

        let certificado_laboral = ''
        if ($('#certificado_laboral').is(':visible')) {
            certificado_laboral =
                document.getElementById('certificado_laboral').files[0] ==
                undefined
                    ? $('#certificado_laboral_txt').val()
                    : document.getElementById('certificado_laboral').files[0]
        }

        let fondo_pension = ''
        if ($('#fondo_pension').is(':visible')) {
            fondo_pension = $('#fondo_pension').val().trim()
        }

        let otros_actividad = ''
        if ($('#otros_actividad').is(':visible')) {
            otros_actividad = $('#otros_actividad').val().trim()
        }

        let numero_cuenta = ''
        if ($('#numero_cuenta').is(':visible')) {
            numero_cuenta = $('#numero_cuenta').val().trim()
        }

        let tipo_cuenta = ''
        if ($('#tipo_cuenta').is(':visible')) {
            tipo_cuenta = $('#tipo_cuenta').val().trim()
        }

        let nombre_banco = ''
        if ($('#nombre_banco').is(':visible')) {
            nombre_banco = $('#nombre_banco').val()
        }

        let certificado_cuenta = ''
        if ($('#certificado_cuenta').is(':visible')) {
            certificado_cuenta =
                document.getElementById('certificado_cuenta').files[0] ==
                undefined
                    ? $('#certificado_cuenta_txt').val()
                    : document.getElementById('certificado_cuenta').files[0]
        }

        let cedula_tercero = ''
        if ($('#cedula_tercero').is(':visible')) {
            cedula_tercero = $('#cedula_tercero').val().trim()
        }

        let nombre_tercero = ''
        if ($('#nombre_tercero').is(':visible')) {
            nombre_tercero = $('#nombre_tercero').val().trim()
        }

        let parentesco = ''
        if ($('#parentesco').is(':visible')) {
            parentesco = $('#parentesco').val().trim()
        }

        let certificado_bancario_tercero = ''
        if ($('#certificado_bancario_tercero').is(':visible')) {
            certificado_bancario_tercero =
                document.getElementById('certificado_bancario_tercero')
                    .files[0] == undefined
                    ? $('#certificado_bancario_tercero_txt').val()
                    : document.getElementById('certificado_bancario_tercero')
                          .files[0]
        }

        let carta_tercero = ''
        if ($('#carta_tercero').is(':visible')) {
            carta_tercero =
                document.getElementById('carta_tercero').files[0] == undefined
                    ? $('#carta_tercero_txt').val()
                    : document.getElementById('carta_tercero').files[0]
        }

        let rut_tercero = ''
        if ($('#rut_tercero').is(':visible')) {
            rut_tercero =
                document.getElementById('rut_tercero').files[0] == undefined
                    ? $('#rut_tercero_txt').val().trim()
                    : document.getElementById('rut_tercero').files[0]
        }
        //let estado = $('#estado_cliente').val().trim()
        let id_usuario = $('#id_usuario_cliente').val()


        let url =
            document.location.origin + `/api/v1/customer/update/${id_cliente}`
        let method = 'POST'

        let form_data = new FormData()
        form_data.append('name', nombres)
        form_data.append('last_name', apellidos)
        form_data.append('email', correo)
        form_data.append('phone', telefono)
        form_data.append('address', direccion)
        form_data.append('country', pais)
        form_data.append('department', departamento)
        form_data.append('city', ciudad)
        form_data.append('id_user', id_usuario)
        form_data.append('document_number', numero_documento)
        form_data.append('file_document', archivo_documento)
        form_data.append('description_ind', descripcion_independiente)
        form_data.append('file_rut', archivo_rut)
        form_data.append('business', empresa)
        form_data.append('position_business', cargo)
        form_data.append('antique_bussiness', antiguedad)
        form_data.append('type_contract', tipo_contrato)
        /*form_data.append('status', estado)*/
        form_data.append('work_certificate', certificado_laboral)
        form_data.append('pension_fund', fondo_pension)
        form_data.append('especification_other', otros_actividad)
        form_data.append('account_number', numero_cuenta)
        form_data.append('account_type', tipo_cuenta)
        form_data.append('bank_name', nombre_banco)
        form_data.append('account_certificate', certificado_cuenta)
        form_data.append('document_third', cedula_tercero)
        form_data.append('name_third', nombre_tercero)
        form_data.append(
            'account_certificate_third',
            certificado_bancario_tercero
        )

        form_data.append('letter_authorization_third', carta_tercero)
        form_data.append('kinship_third', parentesco)
        form_data.append('rut_third', rut_tercero)
        form_data.append('document_type', tipo_documento)
        form_data.append('economic_activity', actividad_economica)
        form_data.append('bank_account', cuenta_bancaria)
        form_data.append('registered_by', 1)

        enviarPeticion(url, method, form_data, 'continuarActualizarCliente')
    }
}

const continuarActualizarCliente = (response) => {
    $('#btn_actualizar_cliente').text('Actualizar cliente')
    $('#btn_actualizar_cliente').prop('disabled', false)
    setResponseMessage(response, '/clientes')
}

const validarFormularioActualizarCliente = () => {
    let validador = true

    if ($('#nombres').val().trim() == '') {
        agregarError('nombres')
        validador = false
        console.log(1)
    } else {
        quitarError('nombres')
    }
    if ($('#apellidos').val().trim() == '') {
        agregarError('apellidos')
        validador = false
        console.log(2)
    } else {
        quitarError('apellidos')
    }

    if ($('#correo').val().trim() == '') {
        agregarError('correo')
        validador = false
        console.log(3)
    } else {
        quitarError('correo')
    }

    if ($('#telefono').val().trim() == '') {
        agregarError('telefono')
        validador = false
        console.log(4)
    } else {
        quitarError('telefono')
    }

    if (
        $('#archivo_documento').val().trim() == '' &&
        $('#archivo_documento_txt').val().trim() == ''
    ) {
        agregarError('archivo_documento')
        validador = false
        console.log(5)
    } else {
        quitarError('archivo_documento')
    }

    if ($('#pais').val().trim() == '') {
        agregarError('pais')
        validador = false
        console.log(6)
    } else {
        quitarError('pais')
    }

    if ($('#departamento').val().trim() == '') {
        agregarError('departamento')
        validador = false
        console.log(7)
    } else {
        quitarError('departamento')
    }

    if ($('#ciudad').val().trim() == '') {
        agregarError('ciudad')
        validador = false
        console.log(8)
    } else {
        quitarError('ciudad')
    }

    if ($('#direccion').val().trim() == '') {
        agregarError('direccion')
        validador = false
        console.log(9)
    } else {
        quitarError('direccion')
    }

    if ($('#apellidos').val().trim() == '') {
        agregarError('apellidos')
        validador = false
        console.log(10)
    } else {
        quitarError('apellidos')
    }
    if ($('#tipo_documento').val() == '') {
        agregarError('tipo_documento')
        validador = false
        console.log(11)
    } else {
        quitarError('tipo_documento')
    }
    if ($('#numero_documento').val().trim() == '') {
        agregarError('numero_documento')
        validador = false
        console.log(12)
    } else {
        quitarError('numero_documento')
    }

    //Actividad económica
    if ($('#actividad_economica').val() == '') {
        agregarError('actividad_economica')
        validador = false
        console.log(13)
    } else {
        quitarError('actividad_economica')
    }

    if (
        $('#descripcion_independiente').val().trim() == '' &&
        $('#descripcion_independiente_txt').val().trim() == '' &&
        $('#descripcion_independiente').is(':visible')
    ) {
        agregarError('descripcion_independiente')
        validador = false
        console.log(14)
    } else {
        quitarError('descripcion_independiente')
    }

    /*if (
        $('#archivo_rut').val().trim() == '' &&
        $('#archivo_rut').is(':visible') &&
        $('#file_rut_txt').val().trim() == ''
    ) {
        agregarError('archivo_rut')
        validador = false
        console.log(15)
    } else {
        quitarError('archivo_rut')
    }*/

    if ($('#empresa').val().trim() == '' && $('#empresa').is(':visible')) {
        agregarError('empresa')
        validador = false
        console.log(16)
    } else {
        quitarError('empresa')
    }
    if ($('#cargo').val().trim() == '' && $('#cargo').is(':visible')) {
        agregarError('cargo')
        validador = false
        console.log(17)
    } else {
        quitarError('cargo')
    }
    if (
        $('#antiguedad').val().trim() == '' &&
        $('#antiguedad').is(':visible')
    ) {
        agregarError('antiguedad')
        validador = false
        console.log(18)
    } else {
        quitarError('antiguedad')
    }

    if ($('#tipo_contrato').val() == '' && $('#tipo_contrato').is(':visible')) {
        agregarError('tipo_contrato')
        validador = false
        console.log(19)
    } else {
        quitarError('tipo_contrato')
    }

    if (
        $('#certificado_laboral').val() == '' &&
        $('#certificado_laboral').is(':visible') &&
        $('#certificado_laboral_txt').val().trim() == ''
    ) {
        agregarError('certificado_laboral')
        validador = false
        console.log(20)
    } else {
        quitarError('certificado_laboral')
    }
    if (
        $('#fondo_pension').val().trim() == '' &&
        $('#fondo_pension').is(':visible')
    ) {
        agregarError('fondo_pension')
        validador = false
        console.log(21)
    } else {
        quitarError('fondo_pension')
    }

    if (
        $('#otros_actividad').val().trim() == '' &&
        $('#otros_actividad').is(':visible')
    ) {
        agregarError('otros_actividad')
        validador = false
        console.log(22)
    } else {
        quitarError('otros_actividad')
    }

    if ($('#cuenta_bancaria').val() == '') {
        agregarError('cuenta_bancaria')
        validador = false
        console.log(23)
    } else {
        quitarError('cuenta_bancaria')
    }

    //Personal

    if (
        $('#numero_cuenta').val().trim() == '' &&
        $('#numero_cuenta').is(':visible')
    ) {
        agregarError('numero_cuenta')
        validador = false
        console.log(24)
    } else {
        quitarError('numero_cuenta')
    }

    if (
        $('#tipo_cuenta').val().trim() == '' &&
        $('#tipo_cuenta').is(':visible')
    ) {
        agregarError('tipo_cuenta')
        validador = false
        console.log(25)
    } else {
        quitarError('tipo_cuenta')
    }

    if (
        $('#nombre_banco').val().trim() == '' &&
        $('#nombre_banco').is(':visible')
    ) {
        agregarError('nombre_banco')
        validador = false
        console.log(26)
    } else {
        quitarError('nombre_banco')
    }

    if (
        $('#certificado_cuenta').val().trim() == '' &&
        $('#certificado_cuenta').is(':visible') &&
        $('#certificado_cuenta_txt').val().trim() == ''
    ) {
        agregarError('certificado_cuenta')
        validador = false
        console.log(27)
    } else {
        quitarError('certificado_cuenta')
    }

    //tercero

    if (
        $('#cedula_tercero').val().trim() == '' &&
        $('#cedula_tercero').is(':visible')
    ) {
        agregarError('cedula_tercero')
        validador = false
        console.log(28)
    } else {
        quitarError('cedula_tercero')
    }

    if (
        $('#nombre_tercero').val().trim() == '' &&
        $('#nombre_tercero').is(':visible')
    ) {
        agregarError('nombre_tercero')
        validador = false
        console.log(29)
    } else {
        quitarError('nombre_tercero')
    }

    if (
        $('#parentesco').val().trim() == '' &&
        $('#parentesco').is(':visible')
    ) {
        agregarError('parentesco')
        validador = false
        console.log(30)
    } else {
        quitarError('parentesco')
    }

    if (
        $('#certificado_bancario_tercero').val().trim() == '' &&
        $('#certificado_bancario_tercero').is(':visible') &&
        $('#certificado_bancario_tercero_txt').val().trim() == ''
    ) {
        agregarError('certificado_bancario_tercero')
        validador = false
        console.log(31)
    } else {
        quitarError('certificado_bancario_tercero')
    }

    if (
        $('#carta_tercero').val().trim() == '' &&
        $('#carta_tercero').is(':visible') &&
        $('#carta_tercero_txt').val().trim() == ''
    ) {
        agregarError('carta_tercero')
        validador = false
        console.log(32)
    } else {
        quitarError('carta_tercero')
    }

    if (
        $('#rut_tercero').val().trim() == '' &&
        $('#rut_tercero').is(':visible') &&
        $('#rut_tercero_txt').val().trim() == ''
    ) {
        agregarError('rut_tercero')
        validador = false
        console.log(33)
    } else {
        quitarError('rut_tercero')
    }

    return validador
}
