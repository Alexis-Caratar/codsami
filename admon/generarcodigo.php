<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/ConectorBD.php'; 
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;


$cadenasql="select max(idcompra)+12345 from compras ";
$datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$d=rand(1,999999999)*999;
$codigogenerado=$d+$datos[0][0];
 
 
header("location: principal.php?CONTENIDO=admon/formulariocompra.php&codigos=$codigogenerado&accion=$accion")
?>
