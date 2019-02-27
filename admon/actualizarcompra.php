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

switch ($accion){
    case 'ADICIONAR':
       
             $cadena="insert into compras  values('$idcompra','$nombre','$descripcion',$cantidad,$stockminimo,$valorcomprauni,$valorventauni);";
         ConectorBD::ejecutarQuery($cadena, null);
        $cadena="insert into inventario  values('$idcompra','$nombre','$descripcion',$cantidad,$stockminimo,$valorventauni);";
         ConectorBD::ejecutarQuery($cadena, null);
        
        break;
    case 'MODIFICAR':
        $cadena="update compras set idcompra='$idcompra',nombre='$nombre',descripcion='$descripcion',cantidad=$cantidad,stockminimo=$stockminimo,valorcomprauni=$valorcomprauni,valorventauni=$valorventauni  where idcompra='$idcompraA'";
        ConectorBD::ejecutarQuery($cadena, null);
        $cadena="update inventario set idinventario='$idcompra',nombre='$nombre',descripcion='$descripcion',cantidad=$cantidad,stockminimo=$stockminimo,valor=$valorventauni  where idinventario='$idcompraA'";
        print_r($cadena);
        ConectorBD::ejecutarQuery($cadena, null);
        break;
    case 'ELIMINAR':
        $cadena="delete from compras where idcompra='$idcompra'";
         ConectorBD::ejecutarQuery($cadena, null);
        $cadena="delete from inventario where idinventario='$idcompra'";
         ConectorBD::ejecutarQuery($cadena, null);
            break;
}
header("location: principal.php?CONTENIDO=admon/compras.php")
?>
