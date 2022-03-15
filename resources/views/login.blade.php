<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Login</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="{{ asset('css/login.css') }}" rel="stylesheet">
      <script src="{{ asset('js/login.js')}}" defer></script>
      <script src="{{ asset('js/app.js')}}" defer></script>
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
               <label></label>
            </div>
            <div class="user-box">
               <input type="text" id="correo" name="correo" placeholder="Correo electrónico">
               <label></label>
            </div>
            <div class="user-box">
               <input type="password" id="contrasena"  name="contrasena" placeholder="Contraseña">
               <label></label>
            </div>
            <div class="link-contraseña" >
               <a href="#" class="decoracion">
               Olvidaste la contraseña?
               </a>
            </div>
            <div class="link-contraseña">  
               <button type="button" onclick="validarLogin();" class="neon">INGRESAR</button>
            </div>
         </form>
      </div>
   </body>
</html>