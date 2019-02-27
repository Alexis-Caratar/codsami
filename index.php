<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$mensaje="";
if (isset($_GET['mensaje'])) {$mensaje=$_GET['mensaje'];}  
?>



<!DOCTYPE html>
<html lang="en">
    
<head>	
    <title>CODSAMI</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="presentacion/css/index/images/iconbarras.PNG"/>
	<link rel="stylesheet" type="text/css" href="presentacion/css/index/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="presentacion/css/index/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="presentacion/css/index/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="presentacion/css/index/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="presentacion/css/index/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="presentacion/css/index/css/util.css">
	<link rel="stylesheet" type="text/css" href="presentacion/css/index/css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
                    <div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
                                    <H2>SISTEMA DE INFORMACION PARA MINIMARKET</H2>	
				</div>
				<div class="login100-pic js-tilt" data-tilt> 
                                    <img src="presentacion/css/index/images/INDEX.jpg" alt="IMG">
				</div>
				<div class="login100-pic js-tilt" data-tilt> 
                                    <img src="presentacion/css/index/images/index2.jpg" alt="IMG">
				</div>
				<form class="login100-form validate-form"  name="formulario" method="POST" action="validar.php">
					<span class="login100-form-title">
						 LOGIN
						 <h5 style="color: red;"><?=$mensaje?></h5>
					</span>
					<div class="wrap-input100 validate-input " data-validate = "usuario requerido ">
						<input class="input100 form-control" type="text" name="usuario" placeholder="USUARIO">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input " data-validate = "ingrese contraseña">
						<input class="input100 form-control" type="password" name="clave" placeholder="CONTRASEÑA">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
                                        	 <input class="login100-form-btn"  type="submit"  value="INGRESAR">
					</div>			
				</form>
			</div>
		</div>
	</div>	
	<script src="presentacion/css/index/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="presentacion/css/index/vendor/bootstrap/js/popper.js"></script>
	<script src="presentacion/css/index/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="presentacion/css/index/vendor/select2/select2.min.js"></script>	<script src="presentacion/css/index/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<script src="presentacion/css/index/js/main.js"></script>

</body>
</html>







