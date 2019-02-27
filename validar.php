<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/Clases/ConectorBD.php'; 

foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
$cadenasql="select*from usuario where idusuario='$usuario' and clave='$clave'";
$datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
if ($usuario=$datos[0][0]&&$clave==$datos[0][1]){
    header("location:principal.php?CONTENIDO=inicio.php");
}else{
    $mensaje="ERROR DE USUARIO Y/O CONTRASEÑA";
     header("location: index.php?mensaje=".$mensaje);
}


?>


