<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <style>
        .container{
            width: 100%;
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            max-width: 100%;
            text-align: center;
        }
        .label{
           font-size: 18px;
        }
        .data{
            font-size: 18px;
            font-weight: bold;
        }
         
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <span class="label">Correo electrónico:</span> <span class="data"> {{$data["email"]}}</span><br>
                <span class="label">Código personal de acceso:</span> <span class="data"> {{$data["code"]}}</span><br>
                <span class="label">Contraseña:</span><span class="data"> {{$data["password"]}}</span><br><br>
                <a href="#" class="btn btn-primary">Ir a la plataforma</a>
            </div>
        </div>
        
   </div>
</body>
</html>