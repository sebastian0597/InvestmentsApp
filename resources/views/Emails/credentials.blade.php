<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .container{
            width: 100%;
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            max-width: 50%;
            text-align: center;
        }/*
      
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;

        }
        .card-body{
            padding-bottom:5rem;
            padding-top:5rem;
        }
        
        .btn-primary {
        color: #fff !important;
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        }
      
        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        */
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
                <span class="label">Correo electrónico:</span> <span class="data"> {{$data["email"]}}</span><br><br>
                <span class="label">Código personal de acceso:</span> <span class="data"> {{$data["code"]}}</span><br><br>
                <span class="label">Contraseña:</span> <span class="data"> {{$data["password"]}}</span><br><br>
                <br>
                <a href="#" class="btn btn-primary">Ir a la plataforma</a>
            </div>
        </div>
        
   </div>
</body>
</html>