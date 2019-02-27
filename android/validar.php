<?php
header('HTTP/1.1 200 OK');
header ('Content-Type: application/json;charset=UTF-8');
require_once '../Clases/ConectorBD.php';
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$cadenaSQL="select idusuario,clave from usuario where idusuario='$usuario' and clave='$clave'";
$resultado=ConectorBD::ejecutarQuery($cadenaSQL,'codsami');

if(count($resultado)>0) {
	$json=array();
	for ($i = 0; $i < count($resultado); $i++) {
		$json[$i]['idusuario'] = $resultado[$i]['idusuario'];
		$json[$i]['clave'] = $resultado[$i]['clave'];
		
	} echo json_encode($json);
} else echo 'false';
?>	