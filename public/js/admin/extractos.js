const buscarClientePorParametros = () => {
    let parametro = $('#busqueda_cliente_extractos').val().trim()
    quitarError('busqueda_cliente_extractos')
    if (parametro != '') {
        form_data = {}
        let url =
            document.location.origin +
            `/api/v1/get_customers_param/${parametro}`
        let method = 'GET'

        enviarPeticion(
            url,
            method,
            form_data,
            'continuarBuscarClientePorParametros'
        )
    } else {
        agregarError('busqueda_cliente_extractos')
    }
}

const continuarBuscarClientePorParametros = (response) => {
    let cliente = response.data[0]
    cliente = cliente == undefined || null ? {} : cliente
    $('#content-clientes').empty()
    $('#div_premium_form').empty()

    if (!isObjEmpty(cliente)) {
        trInversiones = ``
        cliente.investments.forEach(function (inversion) {
            let amount = formatNumber(inversion.amount)

            if (inversion.status == 1) {
                trInversiones += `
                <tr>
                    <td>${
                        inversion.investment_date == null
                            ? ''
                            : inversion.investment_date
                    }</td>
                    <td>$${amount == null ? 0 : amount}</td>
                    <td>${
                        inversion.percentage_investment == null
                            ? 0
                            : inversion.percentage_investment
                    }</td>
                    <td>$${amount == null ? 0 : amount}</td>
                </tr>
                `
            }
        })

        html =
            ` 
            <div style='margin-top:20px; margin-bottom:20px;    '>
                <h5>Datos del cliente</h5>
                
                <div class='row'>
                    <div class='col-sm'>
                        <label>Nombres</label>
                        <input type='text' disabled class='form-control' placeholder='${cliente.name}'>
                    </div>
                    <div class='col-sm'>
                        <label>Apellidos</label>
                        <input type='text' disabled class='form-control' placeholder='${cliente.last_name}'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-sm'>
                        <label>Número documento</label>
                        <input type='text' disabled class='form-control' placeholder='${cliente.document_number}'>
                    </div>
                    <div class='col-sm'>
                        <label>Tipo de cliente</label>
                        <input type='text' disabled class='form-control' placeholder='${cliente.customer_type}'>
                    </div>
                </div>
        
            </div>
            <div style='margin-top:20px'>
                <h5>Datos inversiones</h5>
                <div class='table-responsive add-project'>
                
                    <table class='table card-table table-vcenter text-nowrap'>
                        <thead>
                            <tr>
                                <th scope='col'>Fecha</th>
                                <th scope='col'>Valor</th>
                                <th scope='col'>% Rentabilidad mensual</th>
                                <th scope='col'>Total invertido</th>
                            </tr>
                        </thead>
                        <tbody>
                        ` +
                        trInversiones +
                        `</tbody>
                                </table>
                            </div>
                    
                        </div>

            <div style='margin-top:20px'>
                <h5>Datos de inversiones</h5>
                
                <div class='row'>
                    <div class='col-sm'>
                        <label>Total Desembolsado</label>
                        <input type='text' disabled class='form-control' placeholder='0'>
                    </div>
                    <div class='col-sm'>
                        <label>Gran Total Invertido</label>
                        <input type='text' disabled class='form-control' placeholder='$${cliente.total_investments}'>
                    </div>
                </div>
                <br>
                <div class='row'>
                    <div class='col-sm'>
                        <button type='button' onclick='generarInformeExtractos()' class='btn btn-primary'>Generar informe</button>
                    </div>
               
                </div>
            </div>
          
         `
    } else {
        html = `<span>No hay datos para los parámetros ingresados.</span>`
    }
    $('#content-clientes').append(html)
}

const seleccionarTipoCliente = () => {

    if($('#tipo_cliente').val() != ''){

        $('#div_cliente_premium').css('display', 'none')
        $('#div_porcentaje').css('display', 'block')
        $('#div_premium_form').empty()
        $("#btn_guardar_porcentaje").css('display', 'block')

        if ($('#tipo_cliente').val() == '3') {

            $('#div_cliente_premium').css('display', 'block')
            $('#div_porcentaje').css('display', 'none')

        }

    }else{

        $('#div_cliente_premium').css('display', 'none')
        $('#div_porcentaje').css('display', 'none')
        $("#btn_guardar_porcentaje").css('display', 'none')
    }
  
}

const buscarClientePremiumPorDocumento = () => {

    let param = $('#busqueda_cliente_premium_extractos').val().trim();
    let tipo_cliente = $('#tipo_cliente').val().trim();
    let method = 'POST'
    let url = document.location.origin+`/api/v1/get_customers_by_customer_premium`
   
    if(param != '' && tipo_cliente != ''){
       
        let form_data = new FormData();
        form_data.append('id_customer_type', tipo_cliente);
        form_data.append('param', param);
      
        enviarPeticion(
            url,
            method,
            form_data,
            'continuarBuscarClientePremiumPorDocumento'
        )
    }
}

const continuarBuscarClientePremiumPorDocumento = (response) =>{
    $('#div_premium_form').empty()
    $('#content-clientes').empty()

    cliente = response.data == undefined || null ? {} : response.data
    let html = ''
    
    if(!isObjEmpty(cliente)){

        html+=` <div style='margin-top:20px; margin-bottom:20px;    '>
                    <h5>Datos del cliente</h5>
                    
                    <div class='row'>
                        <div class='col-sm'>
                            <label>Nombres</label>
                            <input type='text' disabled class='form-control' placeholder='${cliente.name}'>
                        </div>
                        <div class='col-sm'>
                            <label>Apellidos</label>
                            <input type='text' disabled class='form-control' placeholder='${cliente.last_name}'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm'>
                            <label>Número documento</label>
                            <input type='text' id='numero_documento' disabled class='form-control' value='${cliente.document_number}' placeholder='${cliente.document_number}'>
                        </div>
                        <div class='col-sm'>
                            <label>Tipo de cliente</label>
                            <input type='text' disabled class='form-control' placeholder='${cliente.customer_type}'>
                        </div>
                    </div>

                    <div class='row'>
                        <div id='div_porcentaje' class='col-md-3'>
                            <label class='form-label'>Porcentaje</label>
                            <div class='input-group mb-3'>
                                <input type='text' class='form-control' id='porcentaje_pm'>
                                <div class='input-group-append'>
                                    <span class='input-group-text'>%</span>
                                </div>
                            </div>
                         
                        </div>
                    </div>

                </div>`
    }else{
        html += `<span>No hay clientes para los parámetros ingresados.</span>`
    }
    $('#div_premium_form').append(html)
}

const guardarPorcentajeRentabilidad = () =>{

    if(validarPorcentajeRentabilidad()){
        let porcentaje = $('#porcentaje_pm').val() == '' || $('#porcentaje_pm').val() == undefined ? $('#porcentaje').val() : $('#porcentaje_pm').val()
        let tipo_cliente = $('#tipo_cliente').val() 
        let url = document.location.origin
        let form_data = new FormData();
        let method = 'POST'
      
        switch (parseInt(tipo_cliente)) {
            case 1:
            case 2:
                url = url+`/api/v1/extracts_by_customer_type`
                form_data.append('id_customer_type', tipo_cliente);
                form_data.append('percentage', porcentaje);
                

                break;
            case 3:
                let numero_documento = $('#numero_documento').val() 
               
                url = url+`/api/v1/extracts_customer_premium`

                form_data.append('document_number', numero_documento);
                form_data.append('percentage', porcentaje);
                break;
            
        
            default:
                break;
        }

         
        enviarPeticion(
            url,
            method,
            form_data,
            'continuarGuardarPorcentajeRentabilidad'
        )
       
    }
}

const continuarGuardarPorcentajeRentabilidad = (response) =>{
  
    setResponseMessage(response);
}

const validarPorcentajeRentabilidad = () =>{
    let validador=true
    if($('#porcentaje_pm').is(':visible') && $('#porcentaje_pm').val() == ''){
        validador=false
        agregarError('porcentaje_pm');
        
    }else{
        quitarError('porcentaje_pm')
    }

    if($('#tipo_cliente').val()  == ''){
        validador=false
        agregarError('tipo_cliente');
        
    }else{
        quitarError('tipo_cliente')
    }

    

    if($('#porcentaje').is(':visible') && $('#porcentaje').val() == '' ){
        validador=false
        agregarError('porcentaje');

    }else{
        quitarError('porcentaje')      
    }

    return validador
} 
  

$("input[type='file']").on('change', function(){
  var fileList = $(this)[0].files || [] 
  for (file of fileList){ 
    ext=file.name.split('.').pop()
    
    if(ext == 'pdf' || ext == 'png' || ext == 'jpg' || ext == 'jpeg'  || ext == 'bim'){
      
    }
    else{
        alert('Tipo de archivo incorrecto.')
        file.name = null
    }
  }
})