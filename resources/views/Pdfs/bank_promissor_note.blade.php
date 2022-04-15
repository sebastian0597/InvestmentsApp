<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        
        :root {
            --bs-font-sans-serif: "Nunito", sans-serif;
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 0.9rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.6;
            --bs-body-color: #212529;
            --bs-body-bg: #f8fafc;
        }
        body {
            margin: 0;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            text-align: var(--bs-body-text-align);
            background-color: var(--bs-body-bg);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        .container, .container-fluid, .container-xxl, .container-xl, .container-lg, .container-md, .container-sm {
            width: 100%;
            padding-right: var(--bs-gutter-x, 0.75rem);
            padding-left: var(--bs-gutter-x, 0.75rem);
            margin-right: auto;
            margin-left: auto;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }
        hoja de estilo de user-agent
        div {
            display: block;
        }
    
    </style>
</head>
<body>
   
    <div class="container">
        <h1 align="center">Contrato de inversiones</h1>
        <span align="center">Contrato de inversion de {{$params["customer_name"]}}</span> el dia {{$params["investment_date"]}}
        <br>
        Esto es el pagaré número  {{$params["bank_promissor_number"]}} 
        <br>
        Realizado por el monto de: {{$params["amount"]}}
    </div>

   
</body>
</html>