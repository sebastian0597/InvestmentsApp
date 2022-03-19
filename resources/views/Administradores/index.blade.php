<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js')}}" defer></script>
    <script src="{{ asset('js/util.js')}}" defer></script>
</head>
<body>
    <div style="margin-top:20%; margin-left:40%;">
        <form>
            <div class="form-row">
              <div class="col-4">
                <select onchange="convertirMoneda();" id="divisa" class="form-control">
                    <option selected>Seleccione...</option>
                    @foreach ($currencies as $item)
                        <option value="{{$item->code}}" >{{$item->name}}</option>
                    @endforeach
              </div>
              <div class="col-4">
                <input type="number" onblur="convertirMoneda();" id="base_amount" class="form-control" placeholder="Monto de inversón">
              </div>
              <div class="col-4">
                <input type="text" id="amount" class="form-control" placeholder="Monto en COP" disabled>
              </div>
            </div>
        </form>

    </div>
   

</body>
</html>