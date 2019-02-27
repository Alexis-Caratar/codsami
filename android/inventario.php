<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$cadenaSQL="SELECT idinventario,nombre,descripcion,cantidad,valor FROM inventario  ";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'codsami');
echo json_encode($resultado);

?>