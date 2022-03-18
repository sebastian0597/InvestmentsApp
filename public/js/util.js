const agregarError = (element) =>{
   
    $("#error_"+element).empty()
    let mensaje = "El campo "+ element + " no puede estar vacío."
    $("#error_"+element).append(mensaje)
   
    $("#error_" + element)
        .prev()
        .addClass("error_border");
} 

const quitarError = (element) =>{
    $("#error_"+element).empty()
    $("#error_" + element)
    .prev()
    .removeClass("error_border");
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


async function consultarAPIDivisas(moneda="USD") {
    let opciones = {method: 'GET', headers: {Accept: 'application/json'}}
    const response = await  fetch(`https://api.fastforex.io/fetch-multi?from=${moneda}&to=COP&api_key=73306c96fe-5a91bbb373-r8ylp0`, opciones);
    const monedas = await response.json();
    return monedas.results.COP;
}
