const buscarExtractosPorfecha = () =>{
    quitarError('fecha_busqueda')

    let fecha = $('#fecha_busqueda').val().trim()
    let id_usuario = $('#user_id').val()

    if(fecha!= ''){
        let form_data = new FormData()
        let url =
            document.location.origin +
            `/api/v1/customer/extracts_by_customer_date`
        let method = 'POST'
    
        form_data.append('date', fecha)
        form_data.append('id_user', id_usuario)
       
        enviarPeticion(
            url,
            method,
            form_data,
            'continuarBuscarExtractosPorfecha'
        ) 
    }else{
        agregarError('fecha_busqueda')
    }
       
}

const continuarBuscarExtractosPorfecha = (response) =>{
    
    $('#extractos_container').empty()
    let extractos = response.data
    extractos = extractos == undefined || null ? {} : extractos
    let tr_extractos = ''
    let html = ''
  
    if(!isObjEmpty(extractos)) {
        
        extractos.forEach(function (extracto) {
            
                tr_extractos += `
                <tr>
                    <td style='text-align: center; vertical-align: middle;'>${
                        extracto.id
                    }</td>
                    <td style='text-align: center; vertical-align: middle;'>$${formatNumber(parseInt(extracto.grand_total_invested))}</td>
                    <td style='text-align: center; vertical-align: middle;'>${extracto.profitability_percentage}%</td>
                    <td style='text-align: center; vertical-align: middle;'>$${formatNumber(parseInt(extracto.total_profitability))}</td>
                </tr>
                `
        })
        
        html = `<br><br><table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Total invertido</th>
                        <th scope="col">Porcentaje rentabilidad</th>
                        <th scope="col">Total rentabilidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    ${tr_extractos}
                    </tbody>
                </table>`

    }else{
        html = `<span>No hay datos para los parámetros de búsqueda ingresados.</span>`
    }
    $('#extractos_container').append(html)
   
}

