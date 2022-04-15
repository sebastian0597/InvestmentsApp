const crearInversion = ()=>{

    if(validarCrearInversion()){

        $('#btn_crear_inversion').text('Creando inversion...');
        $('#btn_crear_inversion').addClass('placeholder'); 
        $('#btn_crear_inversion').prop('disabled', true);

        let id_cliente = $('#id_cliente').val().trim();
        let tipo_moneda = $('#tipo_moneda').val().trim();
        let metodo_pago = $('#metodo_pago').val().trim();
        let base_monto_inversion = quitarformatNumber(
            $('#base_monto_inversion').val().trim()
        );
        let monto_inversion = quitarformatNumber(
            $('#monto_inversion').val().trim()
        );
        let archivo_consignacion = document.getElementById(
            'archivo_consignacion'
        ).files[0];

        let tipo_inversion = $('#tipo_inversion').val();


        var form_data = new FormData();
        form_data.append('id_customer', id_cliente);
        form_data.append('code_currency', tipo_moneda);
        form_data.append('id_investment_type', tipo_inversion);
        form_data.append('id_payment_method', metodo_pago);
        form_data.append('base_amount', base_monto_inversion);
        form_data.append('amount', monto_inversion);
        form_data.append('consignment_file', archivo_consignacion);
        form_data.append('registered_by', 1);
        
        let url = document.location.origin + '/api/v1/investment';
        let method = 'POST';

        Swal.fire({
            icon: 'warning',
            title: 'Asegurese que los datos ingresados sean los correctos.',
            html: `Por favor, revise que los datos ingresados, como el monto, el medio de pago de la inversión 
            son los correctos <br/><br/>
                    El monto a invertir es: <b>$${formatNumber(
                        monto_inversion
                    )}</b><br> 
                    El cliente es: <b>${$('#nombre_cliente').val()}</b><br>
                    El correo es: <b>${$('#email_cliente').val()}</b><br> 
                   `,

            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                enviarPeticion(url, method, form_data, 'continuarCrearInversion');
            }
            if (result.isDismissed) {
                $('#btn_crear_inversion').text('Crear Inversion');
                $('#btn_crear_inversion').prop('disabled', false);
                $('#btn_crear_inversion').removeClass('placeholder'); 
            }
        });
    }
      
}

const continuarCrearInversion = (response) => {
    setResponseMessage(response);
    $('#btn_crear_inversion').text('Crear Inversion');
    $('#btn_crear_inversion').prop('disabled', false);
    $('#btn_crear_inversion').removeClass('placeholder'); 
    console.log(response);
}

const validarCrearInversion = ()=>{
    let validador = true;

    if ($('#tipo_moneda').val() == '') {
        agregarError('tipo_moneda');
        validador = false;
    } else {
        quitarError('tipo_moneda');
    }

    if ($('#metodo_pago').val() == '') {
        agregarError('metodo_pago');
        validador = false;
    } else {
        quitarError('metodo_pago');
    }
    if ($('#base_monto_inversion').val() == '') {
        agregarError('base_monto_inversion');
        validador = false;
    } else {
        quitarError('base_monto_inversion');
    }

    if ($('#archivo_consignacion').val().trim() == '') {
        agregarError('archivo_consignacion');
        validador = false;
    } else {
        quitarError('archivo_consignacion');
    }
    if (!validarMontoMinimo()) {
        validador = false;
    }

    return validador;
   

}