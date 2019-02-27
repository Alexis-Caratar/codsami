<?php 
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$filtro="";
if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresmenu=$_POST['nombre'];
    $filtro=" where concat(idinventario,nombre) like'%$nombresmenu%'";           
}

$cadenasql="select*from inventario $filtro";
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
  
    
   $lista.="</tr>";
    $contador=$contador+1;
    }    
    
    } else {
$lista.="<tr><td style='color:red;'>No se encuentra registrado en la base de datos<td><tr>";    
}
?>
<div class="offset-8 col-md-4  "style="z-index: 100;  margin:5% 65%; position:absolute;background: #236780;">
    <form method="post" class="">
     <table class="table-responsive-lg table table-dark " >
          <tr>
              <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"   name="nombre" placeholder="Nombre o codigo" ></td>
              <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
         </tr>
       </table>
 </form>
</div>
<br><br><br><br>

 <div class="container-fluid">
    <H2 >INVENTARIO </H2>

        <table class="table table-responsive  table-hover" style="background: white;">
            <tr class="table-dark successx"><th>NUMERO</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CANTIDAD</th>   
               </tr>
            <?=$lista?>
        </table>
  </div>
        