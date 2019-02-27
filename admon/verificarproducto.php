<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../Clases/Compras.php';

foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor; 
$datos=ConectorBD::ejecutarQuery($cadenasql, null);
  
  $lista="";
  $contador=1;
  
  if (count($datos)>0){
      $lista.="<H5 style='color:red;'>ya existe el codigo de barras en base de datos</H5>";
           
  }
  echo $lista;