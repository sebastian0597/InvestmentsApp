const generarKPI = () =>{

    let fecha = $('#fecha_busqueda').val().trim()
    quitarError('fecha_busqueda')

    if (fecha != '') {
        form_data = {}
        let url =
            document.location.origin +
            `/api/v1/kpi/${fecha}`
        let method = 'GET'

        enviarPeticion(
            url,
            method,
            form_data,
            'continuarGenerarKPI'
        )
    } else {
        agregarError('fecha_busqueda')
    }

}

const continuarGenerarKPI = (response) => {

    let html_activos=''
    let tr_standard = ''
    let tr_vip = ''
    let tr_premium = ''

    let total_clientes_activos=0
    let total_inversiones_activos=0
    let total_total_rentabilidad_activos=0
    let total_total_disbursed_activos=0


    let html_inactivos=''
    let tr_standard_inac = ''
    let tr_vip_inac = ''
    let tr_premium_inac = ''

    let total_clientes_inactivos=0
    let total_inversiones_inactivos=0
    let total_total_rentabilidad_inactivos=0
    let total_total_disbursed_inactivos=0

    let clientes = response.data
    clientes = clientes == undefined || null ? {} : clientes

    $('#kpi_clientes_activos').empty();
    $('#kpi_clientes_inactivos').empty();
    console.log(clientes)
    if (!isObjEmpty(clientes)) {
        clientes.forEach(function (cliente) {
            
            if(cliente.status == 1){ //Clientes activos.

                if(cliente.id_customer_type == 1){ //Standards
                        
                        total_clientes_activos+=cliente.cantidad
                        total_inversiones_activos+=parseInt(cliente.inversiones)
                        total_total_rentabilidad_activos+=parseInt(Math.floor(cliente.total_rentabilidad))
                        total_total_disbursed_activos+=parseInt(cliente.total_total_disbursed_activos)

                        tr_standard=`

                            <tr>
                                <td>${cliente.cantidad}</td>
                                <td>Standard</td>
                                <td>$${formatNumber(cliente.inversiones)}</td>
                                <td>$${formatNumber(Math.floor(cliente.total_rentabilidad))}</td>
                                <td>$${formatNumber(cliente.total_disbursed)}</td>
                            </tr>
                        
                        `
                }
                if(cliente.id_customer_type == 2){ //Vips
                        
                        total_clientes_activos+=cliente.cantidad
                        total_inversiones_activos+=parseInt(cliente.inversiones)
                        total_total_rentabilidad_activos+=parseInt(Math.floor(cliente.total_rentabilidad))
                        total_total_disbursed_activos+=parseInt(cliente.total_total_disbursed_activos)

                        tr_vip=`

                            <tr>
                                <td>${cliente.cantidad}</td>
                                <td>VIP</td>
                                <td>$${formatNumber(cliente.inversiones)}</td>
                                <td>$${formatNumber(Math.floor(cliente.total_rentabilidad))}</td>
                                <td>$${formatNumber(cliente.total_disbursed)}</td>
                            </tr>
                        
                        `

                }
                if(cliente.id_customer_type == 3){ //Premium
                        
                        total_clientes_activos+=cliente.cantidad    
                        total_inversiones_activos+=parseInt(cliente.inversiones)
                        total_total_rentabilidad_activos+=parseInt(Math.floor(cliente.total_rentabilidad))
                        total_total_disbursed_activos+=parseInt(cliente.total_total_disbursed_activos)

                        tr_premium=`

                            <tr>
                                <td>${cliente.cantidad == '' ? 0 : cliente.cantidad}</td>
                                <td>Premium</td>
                                <td>$${formatNumber(cliente.inversiones)}</td>
                                <td>$${formatNumber(Math.floor(cliente.total_rentabilidad))}</td>
                                <td>$${formatNumber(cliente.total_disbursed)}</td>
                            </tr>
                        
                        `
                }

            } 
            if(cliente.status == 0){ //Clientes activos.

                if(cliente.id_customer_type == 1){ //Standards
                        
                        total_clientes_inactivos+=cliente.cantidad
                        total_inversiones_inactivos+=parseInt(cliente.inversiones)
                        total_total_rentabilidad_inactivos+=parseInt(Math.floor(cliente.total_rentabilidad))
                        total_total_disbursed_inactivos+=parseInt(cliente.total_total_disbursed_activos)

                        tr_standard_inac=`

                            <tr>
                                <td>${cliente.cantidad}</td>
                                <td>Standard</td>
                                <td>$${formatNumber(cliente.inversiones)}</td>
                                <td>$${formatNumber(Math.floor(cliente.total_rentabilidad))}</td>
                                <td>$${formatNumber(cliente.total_disbursed)}</td>
                            </tr>
                        
                        `
                }
                if(cliente.id_customer_type == 2){ //Vips
                        
                        total_clientes_inactivos+=cliente.cantidad
                        total_inversiones_inactivos+=parseInt(cliente.inversiones)
                        total_total_rentabilidad_inactivos+=parseInt(Math.floor(cliente.total_rentabilidad))
                        total_total_disbursed_inactivos+=parseInt(cliente.total_total_disbursed_activos)

                        tr_vip_inac=`

                            <tr>
                                <td>${cliente.cantidad}</td>
                                <td>VIP</td>
                                <td>$${formatNumber(cliente.inversiones)}</td>
                                <td>$${formatNumber(Math.floor(cliente.total_rentabilidad))}</td>
                                <td>$${formatNumber(cliente.total_disbursed)}</td>
                            </tr>
                        
                        `

                }
                if(cliente.id_customer_type == 3){ //Premium
                        
                        total_clientes_inactivos+=cliente.cantidad    
                        total_inversiones_inactivos+=parseInt(cliente.inversiones)
                        total_total_rentabilidad_inactivos+=parseInt(Math.floor(cliente.total_rentabilidad))
                        total_total_disbursed_inactivos+=parseInt(cliente.total_total_disbursed_activos)

                        tr_premium_inac=`

                            <tr>
                                <td>${cliente.cantidad == '' ? 0 : cliente.cantidad}</td>
                                <td>Premium</td>
                                <td>$${formatNumber(cliente.inversiones)}</td>
                                <td>$${formatNumber(Math.floor(cliente.total_rentabilidad))}</td>
                                <td>$${formatNumber(cliente.total_disbursed)}</td>
                            </tr>
                        
                        `
                }

            } 
        })
    }
    
    html_activos = `
                    <div class="card">
                        <div class="card-header">
                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        <div class="table-responsive add-project">
                            <h4 class="card-title mb-0">Clientes Activos:</h4>
                            <br><br>
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th>N° clientes</th>
                                        <th>Tipo cliente</th>
                                        <th>Total inversión</th>
                                        <th>Total rentabilidad</th>
                                        <th>Total desembolsado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${tr_standard}
                                    ${tr_vip}
                                    ${tr_premium}
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th>${total_clientes_activos}</th>
                                        <th></th>
                                        <th>$${formatNumber(total_inversiones_activos) == '' ? 0 : formatNumber(total_inversiones_activos)}</th>
                                        <th>$${formatNumber(total_total_rentabilidad_activos == '' ? 0 : formatNumber(total_total_rentabilidad_activos) )}</th>
                                        <th>$${formatNumber(total_total_disbursed_activos) == '' ? 0 : formatNumber(total_total_disbursed_activos)}</th>
                                    </tr>
                                </thead>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>`


    html_inactivos =`
        <div class="card">
            <div class="card-header">
            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            <div class="table-responsive add-project">
                <h4 class="card-title mb-0">Clientes Inativos:</h4>
                <br><br>
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                    <tr>
                        <th>N° clientes</th>
                        <th>Tipo cliente</th>
                        <th>Total inversión</th>
                        <th>Total rentabilidad</th>
                        <th>Total desembolsado</th>
                    </tr>
                    </thead>
                    <tbody>  
                        ${tr_standard_inac}
                        ${tr_vip_inac}
                        ${tr_premium_inac}
                    <thead>
                        <tr>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <thead>
                    <tr>
                        <th>${total_clientes_inactivos}</th>
                        <th></th>
                        <th>$${formatNumber(total_inversiones_inactivos) == '' ? 0 : formatNumber(total_inversiones_inactivos)}</th>
                        <th>$${formatNumber(total_total_rentabilidad_inactivos == '' ? 0 : formatNumber(total_total_rentabilidad_inactivos) )}</th>
                        <th>$${formatNumber(total_total_disbursed_inactivos) == '' ? 0 : formatNumber(total_total_disbursed_inactivos)}</th>
                    </thead>
                    </tbody>
                </table>
            </div>
            </div>
        </div>`

    $('#kpi_clientes_activos').append(html_activos);
    $('#kpi_clientes_inactivos').append(html_inactivos);
  
}