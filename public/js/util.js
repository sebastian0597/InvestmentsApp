const agregarError = (element) =>{
    
    /*$("#error_"+element).empty()
    let mensaje = "El campo "+ element + " no puede estar vacío."
    $("#error_"+element).append(mensaje)*/
    $("#" + element).addClass("error_border");
    $("#" + element)
    
        .prev()
        .addClass("error_text");
} 

const quitarError = (element) =>{
    //$("#error_"+element).empty()
    $("#" + element).removeClass("error_border");
    $("#"+ element)
    .prev()
    .removeClass("error_text");
} 


const validarSintaxisCorreo = (element) => {
  
    let validador = true
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i
    $("#error_correo").empty()
    if (!emailRegex.test($("#"+element.id).val())) {
        $("#error_correo").append("La sintáxis del correo no es válida.")
        validador = false
    }
    return validador
};


async function consultarAPIDivisas(moneda="COP") {
    let opciones = {method: 'GET', headers: {Accept: 'application/json'}}
    const response = await  fetch(`https://api.fastforex.io/fetch-multi?from=${moneda}&to=COP&api_key=73306c96fe-5a91bbb373-r8ylp0`, opciones);
    const monedas = await response.json();

    return monedas.results.COP;
}


const convertirMoneda = () =>{

   
    let divisa = $("#tipo_moneda").val()
    let base_amount = $("#base_monto_inversion").val().trim()
    if(divisa!="" && base_amount!==""){
        consultarAPIDivisas(divisa).then(moneda => {
            let amount = moneda * base_amount
            $("#monto_inversion").val(amount.toFixed(2));
        });
    }   

}