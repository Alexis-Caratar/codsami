<?php 
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
$filtro="";
$ganancia="";

if (isset($_POST['nombre'])&&$_POST['nombre']!=NULL){
    $nombresmenu=$_POST['nombre'];
    $filtro=" where concat(idinventario,nombre) like'%$nombresmenu%'";           
}

$cadenasql="SELECT idcompras,nombre,descripcion,valorventauni, SUM(ventasdetalle.cantidad),valorcomprauni from ventasdetalle,compras WHERE idcompras=idcompra GROUP by idcompras $filtro order by cantidad desc limit 10";
$datos= ConectorBD::ejecutarQuery($cadenasql, NULL);
$lista="";
$resultado="";
$contador=1;
$contadortotal=1;
if(count($datos)>0){
    for ($i = 0; $i < count($datos); $i++) {
    $lista.="<tr>";
    $lista.="<td>{$contador}</td>";
   // $lista.='<td><img src="presentacion/lib/barcode.php?text='.$datos[$i][0].'&size=20&codetype=code39&print=true "></td>';
    $lista.="<td>{$datos[$i][1]}</td>";
    $lista.="<td>{$datos[$i][2]}</td>";
    $lista.="<td>{$datos[$i][4]}</td>";
    $subtotalventas=$datos[$i][3]*$datos[$i][4];
    $lista.="<td> ".number_format($subtotalventas)."</td>";
    $subtotalcompras=$datos[$i][5]*$datos[$i][4];
    $ganancia=$subtotalventas-$subtotalcompras;
    $lista.="<td> ".number_format($ganancia)."</td>";
    
  
    $lista.="</tr>";
    $contador=$contador+1;
    $contadortotal+=$subtotalventas;
    }   
    $resultado.="<h2 class='text-center'> Total $ ". number_format($contadortotal)."</h2 >   ";
           
    
    } else {
$lista.="<tr><td style='color:red;'>No se encuentra registrado en la base de datos<td><tr>";    
}



if(isset($_GET['export'])) {
	if($_GET['export']=='excel'){
		$filename = "reporte.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
                
	} 
}
if(isset($_GET['export'])) {
	if($_GET['export']=='word'){
		$filename = "reporte.doc";
		header("Content-Type: application/vnd.ms-word");
		header("Content-Disposition: attachment; filename=".$filename);
        
	}
        }
        if(isset($_GET['export'])) {
	if($_GET['export']=='pdf'){
		require_once dirname(__FILE__) . '/../presentacion/lib/mpdf-master/mpdf.php';
		$html = ' <H2 >REPORTE DE PRODUCTOS MAS VENDIDOS </H2>
                    <table class="table table-responsive  table-hover " style="background: white;">
                <tr class="table-dark successx"><th>NUMERO</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CANTIDAD VENDIDA</th> <th>SUBTOTAL</th> <th>GANANCIA</th>
            ';
                $html.=$lista;
		$html.='</table>';
		$mpdf=new mPDF('c');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit();
	}
        }

?>
<center>
        <H2 >REPORTE DE PRODUCTOS MAS VENDIDOS </H2>
            <table class="table table-responsive  table-hover " style="background: white;">
                <tr class="table-dark successx"><th>NUMERO</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CANTIDAD VENDIDA</th> <th>SUBTOTAL</th> <th>GANANCIA</th>
                   </tr>
                <?=$lista?>
            </table>
        <?=$resultado?>

      </div>
</center>        