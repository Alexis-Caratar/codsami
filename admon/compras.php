<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresmenu=$_POST['nombre'];
    $filtro=" where concat(idcompra,nombre) like'%$nombresmenu%'";           
}
$cadenasql="select*from compras $filtro";
$datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$lista="";
$contador=1;
if(count($datos)>0){
    for ($i = 0; $i < count($datos); $i++) {
    $lista.="<tr>";
    $lista.="<td>{$contador}</td>";
 //   $lista.='<td><img src="presentacion/lib/barcode.php?text='.$datos[$i][0].'&size=20&codetype=code39&print=true "></td>';
    $lista.="<td>{$datos[$i][1]}</td>";
    $lista.="<td>{$datos[$i][2]}</td>";
    $lista.="<td>{$datos[$i][3]}</td>";
    $totalcompra=$datos[$i][5]*$datos[0][3];
    $lista.="<td>$". number_format($totalcompra)."</td>";
    $lista.="<td> ".number_format($datos[$i][6])."</td>";
    $totalventa=$datos[$i][6]*$datos[0][3]-$totalcompra;
    $lista.="<td>$". number_format($totalventa)."</td>";
    $lista.="<td>$". number_format($totalventa+$totalcompra)."</td>";
  
    $lista.='<th><a href="principal.php?CONTENIDO=admon/formulariocompra.php&accion=Modificar&idcompra='.$datos[$i][0].'" ><img src="presentacion/imagenes/Modificar.png" title="MODIFICAR" /></a>'
            . '<img src="presentacion/imagenes/Eliminar.png" title="ELIMINAR" onclick="eliminar('.$datos[$i][0].') " /></th>';  
    $lista.="</tr>";
    $contador=$contador+1;
    }    
    
    } else {
$lista.="<tr><td style='color:red;'>No se encuentra registrado en la base de datos<td><tr>";    
}

?>
<div class="container-fluid">
<div class="offset-8 col-md-4  "style="z-index: 100;  margin:5% 65%; position: absolute;background: #236780;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"   name="nombre" placeholder="Nombre o codigo" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>
<br><br><br>  


<H2 >COMPRAS </H2>
<table class="table table-responsive  table-hover" style="background: white;">
        <tr class="table-dark successx"><th>NUMERO</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CANTIDAD</th><th>VALOR COMPRA UNI</th><th>VALOR VENTA UNI</th> <th>GANANCIA</th> <th> VALOR TOTAL</th>
            <th><a href="principal.php?CONTENIDO=admon/formulariocompra.php&accion=Adicionar" accesskey="a" ><img src="presentacion/imagenes/Adicionar.png" title="ADICIONAR" </a></th>
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
        