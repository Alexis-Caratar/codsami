<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once dirname(__FILE__).'/../Clases/ConectorBD.php';

    foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
    foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;

        $cadenasql="select nombre,descripcion,ventasdetalle.cantidad,valorventauni,ventasdetalle.cantidad*valorventauni as subtotal from compras,ventasdetalle where idcompras=idcompra and idventa='$idventa'";
        $datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$lista="";
$venta="";
$contador=1;
if(count($datos)>0){
    for ($i = 0; $i < count($datos); $i++) {
    $lista.="<tr>";
    $lista.="<td>{$contador}</td>";
    $lista.="<td>{$datos[$i][0]}</td>";
    $lista.="<td>{$datos[$i][1]}</td>";
    $lista.="<td>{$datos[$i][2]}</td>";
    $lista.="<td>$ ". number_format($datos[$i][3])."</td>";
    $lista.="<td>$ ". number_format($datos[$i][4])."</td>";
    $lista.="</tr>";
    $contador=$contador+1;
   
    }   
    
    $cadenasql1="select sum(ventasdetalle.cantidad*valorventauni)as total from ventasdetalle,compras where idcompras=idcompra and idventa='$idventa' ";
      $datos1= ConectorBD::ejecutarQuery($cadenasql1, NULL);
      $venta="<H2 class='text-center'> Total venta ". number_format($datos1[0][0])."</H2>";
      
    } else {
        $lista.="<tr><td style='color:red;'>No se encuentra productos en esta factura<td><tr>";    
}
?>


<br><br><br>


<H2  >DETALLE DE LA VENTA <?= strtoupper($idventa)?> </H2>
<table class="table table-responsive  table-hover" style="background: white;">
        <tr class="table-dark successx"><th>ITEM</th><th>PRODUCTO</th><th>DESCRIPCION</th><th>CANTIDAD</th><th>VALOR</th><th>SUBTOTAL</th>
      </tr>
        <?=$lista?>
    </table>
<?=$venta?>
