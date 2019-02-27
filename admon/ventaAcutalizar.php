<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$datosCadena = $_POST['cadenaFinal'];
$datosCadenaArray = explode("=:=", $datosCadena);
$cadenaSQLVenta = "insert into ventas(fechasistema) values(now())";
ConectorBD::ejecutarQuery($cadenaSQLVenta, null);
$id = ConectorBD::ejecutarQuery("select max(idventa) from ventas", null)[0][0];
for ($i = 0; $i < count($datosCadenaArray); $i++) {
    $datosArray = explode("==", $datosCadenaArray[$i]);
    $cadenaSQLDetalles = "insert into ventasdetalle(idcompras, idventa, cantidad) values('$datosArray[0]', $id, '$datosArray[3]')";
    ConectorBD::ejecutarQuery($cadenaSQLDetalles, null);
    
    $cadena11="select cantidad from inventario where idinventario='$datosArray[0]'";
    $datos=ConectorBD::ejecutarQuery($cadena11, NULL);
$cantidatot=$datos[0][0]-$datosArray[3];
    $cadena111="update inventario set  cantidad=$cantidatot where idinventario='$datosArray[0]'";
    ConectorBD::ejecutarQuery($cadena111, NULL);

}
header("Location: ../principal.php?CONTENIDO=inicio.php");


