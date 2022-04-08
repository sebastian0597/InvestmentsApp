<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Login</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="{{ asset('css/login.css') }}" rel="stylesheet">
      <script src="{{ asset('js/login.js')}}" defer></script>
      <script src="{{ asset('js/app.js')}}" defer></script>
      <script src="{{ asset('js/util.js')}}" defer></script>
      <script src="{{ asset('js/ajax.js')}}" defer></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <meta name="csrf-token" content="{{ csrf_token() }}">
   </head>
   <body>
      <div class="login-box">
         <h1>VIP WORLD TRADING</h1>
         <br></br>
         <form>
            <div class="user-box">
               <input type="text" id="codigo" name="codigo" placeholder="Codigo">
               <span class="msg_error_login" id="error_codigo"></span>
            </div>
            <div class="user-box">
               <input onblur="validarSintaxisCorreo(this)" type="text" id="correo" name="correo" placeholder="Correo electrónico">
               <span class="msg_error_login" id="error_correo"></span>
            </div>
            <div class="user-box">
               <input type="password" id="contrasena"  name="contrasena" placeholder="Contraseña">
               <span class="msg_error_login" id="error_contrasena"></span>
            </div>
            <div class="link-contraseña" >
               <span class="decoracion">
                  ¿Olvidaste la contraseña?, <a class="decoracion" href="{{url('reestablecer_contrasena')}}"><b>restablecela aquí</b></a>
               </span>
     
            </div>
            <div class="link-contraseña">  
               <button type="button" onclick="login();" class="neon">INGRESAR</button>
            </div>
         </form>
      </div>
   </body>
</html>