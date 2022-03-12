<!DOCTYPE html>
<html lang="en">
<head>
	<title>Inicio de Sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/util.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

	</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-51">
						BIENVENIDO
					</span>

					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" id="codigo" name="codigo" placeholder="Codigo">
						<span class="focus-input100"></span>
					</div> 

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" id="correo" name="correo" placeholder="Correo eléctronico">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						

						<div>
							<a href="#" class="txt1">
								Olvidaste la contraseña?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							INGRESAR
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>

</body>
</html>