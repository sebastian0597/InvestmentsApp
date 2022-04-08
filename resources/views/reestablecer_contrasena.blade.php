<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Recuperar contraseña</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('js/app.js')}}" defer></script>
        <script src="{{ asset('js/util.js')}}" defer></script>
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
        <script src="{{ asset('js/reestablecer_contrasenas.js')}}" defer></script>
        <script src="{{ asset('js/ajax.js')}}" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>


        <div class="login-box">
        <h1 style="text-align: left;">Reestablecimiento de contraseña</h1>  
            <form>	

                <div class="user-box">
                    <input type="text" id="codigo" placeholder="Ingrese código único">
                    <span class="msg_error_login" id="error_codigo"></span>
                </div>

                <div class="link-contraseña" >
                    <a href="{{url('login')}}" class="decoracion" id="olvido">
                        Regresar al login
                    </a>
                </div>

                <div class="link-contraseña">  
                    <button type="button" id="btn_reestablecer_contrasena" onclick="reestablecerContrasena()" class="neon">Solicitar contraseña</button>
                </div>

            </form>
        </div> 
    </body>
</html>