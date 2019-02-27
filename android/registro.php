<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';

$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$cantidad=$_POST['cantidad'];
$stockminimo=$_POST['stockminimo'];
$valorcomprauni=$_POST['valorcomprauni'];
$valorventauni=$_POST['valorventauni'];

$cadenaSQL="insert into compras values($codigo,'$nombre','$descripcion',$cantidad,$stockminimo,$valorcomprauni,$valorventauni);";
ConectorBD::ejecutarQuery($cadenaSQL,'codsami');
$cadenaSQL1="insert into inventario values($codigo,'$nombre','$descripcion',$cantidad,$stockminimo,$valorventauni);";
ConectorBD::ejecutarQuery($cadenaSQL1,'codsami');
?>