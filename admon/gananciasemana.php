<?php 
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$filtro="";
$reporte="";

if (isset($_POST['desde'])&&$_POST['desde']!=NULL&&isset($_POST['hasta'])&&$_POST['hasta']!=NULL){
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $filtro="  and fechasistema>='$desde' and fechasistema<='$hasta'";          
}

$cadenasql="SELECT  SUBSTRING(fechasistema, -19,10)as fechasistema,sum(ventasdetalle.cantidad), SUM(ventasdetalle.cantidad*compras.valorventauni),SUM(ventasdetalle.cantidad*compras.valorcomprauni)from ventas,ventasdetalle,compras where ventas.idventa=ventasdetalle.idventa and idcompra=idcompras $filtro group by DATE_FORMAT(fechasistema, '%Y-%m-%d') order by fechasistema DESC limit 7;";
 $datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$lista="";
$resultado="";
$contador=1;
$contadortotal="";

if(count($datos)>0){
    for ($i = 0; $i < count($datos); $i++) {
    $lista.="<tr>";
    $lista.="<td>{$contador}</td>";
    $lista.="<td>{$datos[$i][0]}</td>";
    $lista.="<td>{$datos[$i][1]}</td>";
    $lista.="<td>{$datos[$i][2]}</td>";
    $ganancia=$datos[$i][2]-$datos[$i][3];
    $lista.="<td>$ganancia</td>";
    $lista.="</tr>";
    $contador=$contador+1;
    $contadortotal+=$ganancia;
    }   
    $resultado.="<h2 class='text-center'> Total Ganancia $ ". number_format($contadortotal)."</h2 >   ";
           
    
    } else {
$lista.="<tr><td style='color:red;'>No se encuentra registrado en la base de datos<td><tr>";    
}

?>
<div class=" col-md-6  "style="z-index: 100; margin:1.2% 50%;  height: 66px;  position: absolute;background: #236780;">
 

    <form method="post" >
        <table class="table-responsive-lg table table-dark "   >
          <tr>
             <td>DESDE<td><input  class="form-control" type="date"   name="desde" ></td>
       
             <td>HASTA<td><input  class="form-control" type="date"   name="hasta" ></td>
             <td><input class=" btn btn-primary"type="submit" value="BUSCAR"></td>
          </tr>
              
        
       </table>
 </form>
</div>
<br>

<div class=" col-md-6 "style="z-index: 100;  position: fixed; margin:-1% 0%; background: #236780;color: white;">
     <ul class="text-info">
         <li><a href="principal.php?CONTENIDO=admon/reportes.php"  class="table-hover btn btn-primary " style="margin: 1% 0%;">Productos mas vendidos</a>--    <a href="principal.php?CONTENIDO=admon/gananciasemana.php"  style="margin: 1% 0%;"class="table-hover btn btn-primary">Ganancia por semanana</a></li>
    </ul>
</div>
 <div class="container-fluid">
     <br><br>
    <H2 >REPORTE DE GANANCIAS POR SEMANA </H2>
    <div class="text-right">
        <a href="admon/gananciareport.php?export=excel" target="_blank"><img src="presentacion/imagenes/exel.png" title="Exportar a Excel" width="50" height="50"/></a>
     <a href="admon/gananciareport.php?export=word" target="_blank"><img src="presentacion/imagenes/word.jpg" title="Exportar a Excel" width="50" height="50"/></a>
    <a href="admon/gananciareport.php?export=pdf" target="_blank"><img src="presentacion/imagenes/pdf.png" title="Exportar a Pdf" width="50" height="50"/></a>
    
     
        
    </div>
        <table class="table table-responsive  table-hover " style="background: white;">
            <tr class="table-dark successx"><th>DIA</th><th>FECHA</th><th>PRODUCTOS VENDIDOS</th> <th>TOTAL</th> <th>GANANCIA</th>
               </tr>
            <?=$lista?>
        </table>
    <?=$resultado?>
    
     
  </div>
       