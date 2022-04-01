const buscarClientePorParametros = () => {
    let parametro = $('#busqueda_cliente_extractos').val().trim();
    quitarError('busqueda_cliente_extractos');
    if (parametro != '') {
        form_data = {};
        let url =
            document.location.origin +
            `/api/v1/get_customers_param/${parametro}`;
        let method = 'GET';

        enviarPeticion(
            url,
            method,
            form_data,
            'continuarBuscarClientePorParametros'
        );
    } else {
        agregarError('busqueda_cliente_extractos');
    }
};

const continuarBuscarClientePorParametros = (response) => {
    let cliente = response.data[0];
    cliente = cliente == undefined || null ? {} : cliente;
    $('#content-clientes').empty();

    if (!isObjEmpty(cliente)) {
        trInversiones = ``;
        cliente.investments.forEach(function (inversion) {
            let amount = formatNumber(inversion.amount);

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
                    <td>${
                        inversion.percentage_investment == null
                            ? 0
                            : inversion.percentage_investment
                    }</td>
                    <td>$${amount == null ? 0 : amount}</td>
                </tr>
                `;
            }
        });

        html =
            ` 
            <div style='margin-top:20px'>
                <h5>Datos del cliente</h5>
                
                <div class='row'>
                    <div class='col'>
                        <label>Nombres</label>
                        <input type='text' disabled class='form-control' placeholder='${cliente.name}'>
                    </div>
                    <div class='col'>
                        <label>Apellidos</label>
                        <input type='text' disabled class='form-control' placeholder='${cliente.last_name}'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        <label>Número documento</label>
                        <input type='text' disabled class='form-control' placeholder='${cliente.document_number}'>
                    </div>
                    <div class='col'>
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
                                <th scope='col'>Consolidado de Inversiones</th>
                                <th scope='col'>% Rentabilidad</th>
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
                    <div class='col'>
                        <label>Total Desembolsado</label>
                        <input type='text' disabled class='form-control' placeholder='0'>
                    </div>
                    <div class='col'>
                        <label>Gran Total Invertido</label>
                        <input type='text' disabled class='form-control' placeholder='$${cliente.total_investments}'>
                    </div>
                </div>
              
            </div>
           `;
    } else {
        html = `<span>No hay datos para los parámetros ingresados</span>`;
    }
    $('#content-clientes').append(html);
};

const seleccionarTipoCliente = () => {

    $('#div_cliente_premium').css('display', 'none');

    if ($('#tipo_cliente').val() == '3') {
        $('#div_cliente_premium').css('display', 'block');
    }
};

const buscarClientePremiumPorDocumento = () => {};
