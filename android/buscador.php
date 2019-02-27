<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';

$codigo=$_POST['codigo'];
$cadenaSQL="SELECT idinventario,nombre,descripcion,cantidad,stockminimo,valor FROM inventario where idinventario=$codigo ";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'codsami');
echo json_encode($resultado);
	
	?>