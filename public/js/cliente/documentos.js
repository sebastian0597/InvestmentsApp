const cargarDocumentoContrato = () =>{

   let contrato_inversion = document.getElementById('contrato_inversion').files[0]
   let id_usuario = $('#user_id').val()
   quitarError('contrato_inversion')
   if($('#contrato_inversion').val().trim() != '' && $('#contrato_inversion').val().trim() != undefined){

    let url = window.location.origin + '/api/v1/customer/charge_customer_contract'
    let form_data = new FormData()
    let method = 'POST'

    form_data.append('file', contrato_inversion)
    form_data.append('id_user', id_usuario)
   
    enviarPeticion(url, method, form_data, 'continuarCargarDocumentoContrato')
    
   }else{
       agregarError('contrato_inversion')
   }
}

const continuarCargarDocumentoContrato = (response) => {
    
    setResponseMessage(response, '/cliente/documentos')

}

const cargarDocumentoSARLAFT = () =>{

    let documento_sarlaft = document.getElementById('documento_sarlaft').files[0]
    let id_usuario = $('#user_id').val()
    quitarError('documento_sarlaft')
    
    if($('#documento_sarlaft').val().trim() != '' && $('#documento_sarlaft').val().trim() != undefined){
 
     let url = window.location.origin + '/api/v1/customer/charge_sarlaft_document'
     let form_data = new FormData()
     let method = 'POST'
 
     form_data.append('file', documento_sarlaft)
     form_data.append('id_user', id_usuario)
    
     enviarPeticion(url, method, form_data, 'continuarCargarDocumentoSARLAFT')
     
    }else{
        agregarError('documento_sarlaft')
    }
}

const continuarCargarDocumentoSARLAFT = (response) =>{

    setResponseMessage(response, '/cliente/documentos')
}