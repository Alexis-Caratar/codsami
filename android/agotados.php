<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';

$jsons='';
$cadenaSQL="SELECT idinventario,nombre,descripcion,cantidad,stockminimo,valor FROM inventario ";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'codsami');
	$json='[';
	
	for ($i = 0; $i < count($resultado); $i++) {
		if( $resultado[$i]['stockminimo']>=$resultado[$i]['cantidad']){
			$json.='{';
			$json.="'idinventario':'{$resultado[$i]['idinventario']}',";
			$json.="'nombre':'{$resultado[$i]['nombre']}',";
			$json.="'descripcion':'{$resultado[$i]['descripcion']}',";
			$json.="'cantidad':'{$resultado[$i]['cantidad']}',";
			$json.="'stockminimo':'{$resultado[$i]['stockminimo']}',";
			$json.="'valor':'{$resultado[$i]['valor']}'";
				$json.="},";
		}
	} 
	$rest = substr($json,0,-1);
	$jsons.=$rest.']';
	echo($jsons);	
	
	
?>