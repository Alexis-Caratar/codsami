<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';

$idInventario = $_POST['idInventario'];

$cadenaSQL = "select * from inventario where idinventario = '$idInventario'";
$datos = ConectorBD::ejecutarQuery($cadenaSQL, NULL);

    if(count($datos)>0){
     echo "{$datos[0]['idinventario']}=={$datos[0]['nombre']}=={$datos[0]['valor']}==1";
    }else{
        echo 'null';
    }



?>
