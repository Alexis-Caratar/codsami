<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../Clases/ConectorBD.php';

if (isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];
else $mensaje='';

if (isset($_GET['claveactual'])) $claveactual=$_GET['claveactual'];
else $claveactual='';


if (isset($_GET['clavenueva'])) $clavenueva=$_GET['clavenueva'];
else $clavenueva='';

if (isset($_GET['confirmarclave'])) $confirmarclave=$_GET['confirmarclave'];
else $confirmarclave='';
 $cadena="select*from usuario ";
    $datos= ConectorBD::ejecutarQuery($cadena, null);
?>
<br><br>
<br><br>

<h2>CAMBIO DE CONTRASEÑA </h2>
<div class="container col-md-5"><br>
        
    <form name="formulario" action="principal.php?CONTENIDO=admon/actualizarClave.php" method="post">
        <table class="table table-hover table-responsive-lg table-content ">
        <font color="red" face="arial"><?= $mensaje?>
        <tr><th>Usuario</th><th><input class="form-control" type="text" name="usuario" placeholder="Nuevo usuario" required autofocus value="<?= $datos[0][0]?>"> </th></tr>
        <tr><th>Contraseña Actual</th><th><input class="form-control" type="password" name="claveactual" placeholder="Ingrese contraseña actual" required autofocus value="<?= $claveactual?>"> </th></tr>
        <tr><th>Contraseña nueva</th><th><input  class="form-control"type="password" name="clavenueva" placeholder="Ingrese contraseña nueva" required  value="<?= $clavenueva?>"> </th></tr>
        <tr><th>Confirmar contraseña</th><th><input class="form-control" type="password" name="confirmarclave" placeholder="repita la contraseña actual" value="<?= $confirmarclave?>"required > </th></tr>
        <tr><td></td><td> <input class=" btn btn-primary"type="submit" value="Confirmar"></td></tr>
        </table>
       

    </form>
</div>