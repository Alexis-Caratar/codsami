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

$contadortotal=0;

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

if(isset($_GET['export'])) {
	if($_GET['export']=='excel'){
		$filename = "reporteganacia.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
	} 
}
if(isset($_GET['export'])) {
	if($_GET['export']=='word'){
		$filename = "reporteganacia.doc";
		header("Content-Type: application/vnd.ms-word");
		header("Content-Disposition: attachment; filename=".$filename); 
        }
        } if(isset($_GET['export'])) {
	if($_GET['export']=='pdf'){
		require_once dirname(__FILE__) . '/../presentacion/lib/mpdf-master/mpdf.php';
		$html = '<H2 >REPORTE DE GANANCIAS POR SEMANA </H2>
           <table class="table table-responsive  table-hover " style="background: white;">
               <tr class="table-dark successx"><th>DIA</th><th>FECHA</th><th>PRODUCTOS VENDIDOS</th> <th>TOTAL</th> <th>GANANCIA</th>
                  </tr>';
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
    <div class="container-fluid ">
        <br><br>
       <H2 >REPORTE DE GANANCIAS POR SEMANA </H2>
           <table class="table table-responsive  table-hover " style="background: white;">
               <tr class="table-dark successx"><th>DIA</th><th>FECHA</th><th>PRODUCTOS VENDIDOS</th> <th>TOTAL</th> <th>GANANCIA</th>
                  </tr>
               <?=$lista?>
           </table>
       <?=$resultado?>

     </div>
 </center>   
       