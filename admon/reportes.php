<?php 
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$filtro="";
$reporte="";

if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresmenu=$_POST['nombre'];
    $filtro=" where concat(idinventario,nombre) like'%$nombresmenu%'";           
}

$cadenasql="SELECT idcompras,nombre,descripcion,valorventauni, SUM(ventasdetalle.cantidad)as cantidad,valorcomprauni from ventasdetalle,compras WHERE idcompras=idcompra GROUP by idcompras $filtro order by cantidad desc limit 10";
$datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$lista="";
$resultado="";
$contador=1;
$contadortotal=1;
if(count($datos)>0){
    for ($i = 0; $i < count($datos); $i++) {
    $lista.="<tr>";
    $lista.="<td>{$contador}</td>";
    $lista.='<td><img src="presentacion/lib/barcode.php?text='.$datos[$i][0].'&size=20&codetype=code39&print=true "></td>';
    $lista.="<td>{$datos[$i][1]}</td>";
    $lista.="<td>{$datos[$i][2]}</td>";
    $lista.="<td>{$datos[$i][4]}</td>";
    $subtotalventas=$datos[$i][3]*$datos[$i][4];
    $subtotalcompras=$datos[$i][5]*$datos[$i][4];
    $ganancia=$subtotalventas-$subtotalcompras;
    $lista.="<td> $".number_format($ganancia)."</td>";
    $lista.="<td> $".number_format($subtotalventas)."</td>";
  
    $lista.="</tr>";
    $contador=$contador+1;
    $contadortotal+=$subtotalventas;
    }   
    $resultado.="<h2 class='text-center'> Total $ ". number_format($contadortotal)."</h2 >   ";
           
    
    } else {
$lista.="<tr><td style='color:red;'>No se encuentra registrado en la base de datos<td><tr>";    
}


?>


<br><br><br>


<div class=" col-md-6 "style="z-index: 100;  position: fixed; margin:-1% 0%; background: #236780;color: white;">
     <ul class="text-info">
         <li><a href="principal.php?CONTENIDO=admon/reportes.php"  class="table-hover btn btn-primary " style="margin: 1% 0%;">Productos mas vendidos</a>--    <a href="principal.php?CONTENIDO=admon/gananciasemana.php"  style="margin: 1% 0%;"class="table-hover btn btn-primary">Ganancia por semanana</a></li>
        
    </ul>
</div>
 <div class="container-fluid">
     
     <br><br>
    <H2 >REPORTE DE PRODUCTOS MAS VENDIDOS </H2>
    <div class="text-right">
                <a href="admon/imprimirreporte.php?export=excel" target="_blank"><img src="presentacion/imagenes/exel.png" title="Exportar a Excel" width="50" height="50"/></a>
                <a href="admon/imprimirreporte.php?export=word" target="_blank"><img src="presentacion/imagenes/word.jpg" title="Exportar a Excel" width="50" height="50"/></a>
               <a href="admon/imprimirreporte.php?export=pdf" target="_blank"><img src="presentacion/imagenes/pdf.png" title="Exportar a Pdf" width="50" height="50"/></a>
               </div>
        <table class="table table-responsive  table-hover " style="background: white;">
            <tr class="table-dark successx"><th>NUMERO</th><th>CODIGO</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CANTIDAD VENDIDA</th> <th>GANANCIA</th> <th>SUBTOTAL</th>
               </tr>
            <?=$lista?>
        </table>
    <?=$resultado?>
   
  </div>
        