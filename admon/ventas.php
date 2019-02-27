<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$filtro="";
if (isset($_POST['desde'])&&$_POST['desde']!=NULL&&isset($_POST['hasta'])&&$_POST['hasta']!=NULL){
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $filtro=" where fechasistema between '$desde' and '$hasta'";          
}

$cadenasql="select*from ventas $filtro order by fechasistema desc";
$datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$lista="";
$contador=1;
if(count($datos)>0){
    for ($i = 0; $i < count($datos); $i++) {
      $cadenasql1="select sum(ventasdetalle.cantidad*valorventauni)as total from ventasdetalle,compras where idcompras=idcompra and idventa='{$datos[$i][0]}'  ";
     
      $datos1= ConectorBD::ejecutarQuery($cadenasql1, NULL);
    $lista.="<tr>";
    $lista.="<td>{$contador}</td>";
    $lista.="<td>{$datos[$i][1]}</td>";
    $lista.="<td>$ ". number_format($datos1[0][0])."</td>";
    $lista.='<th><a href="principal.php?CONTENIDO=admon/ventasdetalle.php&accion=Detalle&idventa='.$datos[$i][0].'" ><img src="presentacion/imagenes/detalles.png" title="DETALLES VENTA" /></a>';
    $lista.="</tr>";
    $contador=$contador+1;
   
    }    
    
    } else {
$lista.="<tr><td style='color:red;'>No se encuentra registrado en la base de datos<td><tr>";    
}
?>
<div class="container">
    <div class="offset-8 col-md-6  "style="z-index: 100;  margin:5% 50%; position: absolute;background: #236780;">
        <form method="post" class="">
         <table class="table-responsive-lg table table-dark " >
              <tr>
                 <td>DESDE<td><input  class="form-control" type="date"   name="desde" ></td>

                 <td>HASTA<td><input  class="form-control" type="date"   name="hasta" ></td>
                 <td><input class=" btn btn-primary"type="submit" value="BUSCAR"></td>
              </tr>


           </table>
     </form>
    </div>
    <br><br><br>


    <H2 >VENTAS REALIZADAS </H2>
        <table class="table table-responsive  table-hover" style="background: white;">
            <tr class="table-dark successx"><th>NUM DE VENTA</th><th>FECHA DE REGISTRO</th><th>VALOR TOTAL VENTA</th>
          </tr>
            <?=$lista?>
        </table>
</div>
    <script>
        function  eliminar(idcompra){
            if(confirm("Desea eliminar este registro"))
                location="principal.php?CONTENIDO=admon/actualizarcompra.php&accion=ELIMINAR&idcompra="+idcompra;
        }
        
        $(document).bind('keydown', 'f1', function(){
          location="principal.php?CONTENIDO=admon/formulariocompra.php&accion=Adicionar"
        });
       

    </script>
        