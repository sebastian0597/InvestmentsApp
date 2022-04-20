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
        let numero_documento = $('#numero_documento').val().trim()
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
        form_data.append('document_number', numero_documento);
    
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
   
}

const validarCrearInversion = ()=>{
    let validador = true;
   
    if ($('#tipo_moneda').val() == '' && $('#tipo_moneda').is(':visible')) {
        agregarError('tipo_moneda');
        validador = false;
    } else {
        quitarError('tipo_moneda');
    }

    if ($('#metodo_pago').val() == '' && $('#metodo_pago').is(':visible')) {
        agregarError('metodo_pago');
        validador = false;
    } else {
        quitarError('metodo_pago');
    }
    if ($('#base_monto_inversion').val() == '' && $('#base_monto_inversion').is(':visible')) {
        agregarError('base_monto_inversion');
        validador = false;
    } else {
        quitarError('base_monto_inversion');
    }

    if ($('#archivo_consignacion').val().trim() == '' && $('#archivo_consignacion').is(':visible')) {
        agregarError('archivo_consignacion');
        validador = false;
    } else {
        quitarError('archivo_consignacion');
    }
    if (!validarMontoMinimo() && $('#monto_inversion').is(':visible')) {
        validador = false;
    }
    
    if($('#tipo_inversion').val() == ''){
        agregarError('tipo_inversion');
        validador = false;
    } else {
        quitarError('tipo_inversion');
    }

    return validador;
   

}

const buscarInversionesPorParametros = () => {
    quitarError('busqueda_inversiones');
    if($('#busqueda_inversiones').val().trim() != ''){
    
        form_data = {}
        let param = $('#busqueda_inversiones').val().trim();
        let url = document.location.origin + `/api/v1/investments_by_param/${param}`;
        let method = 'GET';
        enviarPeticion(url, method, form_data, 'continuarBuscarInversionesPorParametros');
        
    }else{
        agregarError('busqueda_inversiones');
    }
}

const continuarBuscarInversionesPorParametros = (response) => {
    let inversiones = response.data
   
    $('#investments_container').empty()
    let html=''
    if(inversiones.length>0){
        let tr_inversiones=''
       
        inversiones.forEach(function (inversion) {
            let url = document.location.origin + `/editar_inversion/${inversion.id}`
            tr_inversiones +=`
            <tr>
                <th scope="row"><a href="${url}">${inversion.id}</a></th>
                <td><a href="${url}">${inversion.amount}</a></td>
                <td><a href="${url}">${inversion.investment_date}</a></td>
                <td><a href="${url}">${inversion.customer.name} ${inversion.customer.lastname}</a></td>
            </tr>`
        })

        html+=`<table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Monto</th>
            <th scope="col">Fecha</th>
            <th scope="col">Cliente</th>
          </tr>
        </thead>
        <tbody>
        `+ tr_inversiones +`
        </tbody>
      </table>`

    }else{
        html+=`<span>No se han encontrado inversiones para los parámetros ingresados.</span>` 
    }
    
    $('#investments_container').append(html)
}

const seleccionarTipoInversion = () =>{

    $('#div_inversion').css('display', 'none');
    $('#div_inversion_2').css('display', 'none');

    if($('#tipo_inversion').val() != '' && $('#tipo_inversion').val()=='2'){

        $('#div_inversion').css('display', 'flex');
        $('#div_inversion_2').css('display', 'flex');
    }

}

const actualizarInversion = () =>{

    if(validarActualizarInversion()){

        $('#btn_editar_inversion').text('Actualizando inversion...');
        $('#btn_editar_inversion').addClass('placeholder'); 
        $('#btn_editar_inversion').prop('disabled', true);

        let id_cliente = $('#id_cliente').val().trim();
        let id_inversion = $('#id_inversion').val().trim();
        let numero_documento = $('#numero_documento').val().trim()
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
        ).files[0] == undefined ? $('#archivo_consignacion_txt').val() : document.getElementById(
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
        form_data.append('document_number', numero_documento);        
        form_data.append('updated_by', 1);
        form_data.append('status', 1);
        
        let url = document.location.origin + `/api/v1/investment/update/${id_inversion}`;
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
                enviarPeticion(url, method, form_data, 'continuarActualizarInversion');
            }
            if (result.isDismissed) {
                $('#btn_editar_inversion').text('Actualizar inversion');
                $('#btn_editar_inversion').prop('disabled', false);
                $('#btn_editar_inversion').removeClass('placeholder'); 
            }
        });
    }
}


const continuarActualizarInversion = (response) =>{
    $('#btn_editar_inversion').text('Actualizar inversion');
    $('#btn_editar_inversion').prop('disabled', false);
    $('#btn_editar_inversion').removeClass('placeholder'); 
    setResponseMessage(response);
}

const validarActualizarInversion = ()=>{

    let validador = true;
   
    if ($('#tipo_moneda').val() == '' && $('#tipo_moneda').is(':visible')) {
        agregarError('tipo_moneda');
        validador = false;
    } else {
        quitarError('tipo_moneda');
    }

    if ($('#metodo_pago').val() == '' && $('#metodo_pago').is(':visible')) {
        agregarError('metodo_pago');
        validador = false;
    } else {
        quitarError('metodo_pago');
    }
    if ($('#base_monto_inversion').val() == '' && $('#base_monto_inversion').is(':visible')) {
        agregarError('base_monto_inversion');
        validador = false;
    } else {
        quitarError('base_monto_inversion');
    }

    if ($('#archivo_consignacion').is(':visible') && 
        ($('#archivo_consignacion').val().trim() == '' && $('#archivo_consignacion_txt').val().trim() == '')
       ){
        agregarError('archivo_consignacion');
        validador = false;
    } else {
        quitarError('archivo_consignacion');
    }
    if (!validarMontoMinimo() && $('#monto_inversion').is(':visible')) {
        validador = false;
    }
    
    if($('#tipo_inversion').val() == ''){
        agregarError('tipo_inversion');
        validador = false;
    } else {
        quitarError('tipo_inversion');
    }

    return validador;
}
