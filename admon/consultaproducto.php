<?php

require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
require_once dirname(__FILE__) . '/../Clases/Compras.php';

foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;
foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;
$datos = ConectorBD::ejecutarQuery($cadenasql, null);

$lista = "";

if (count($datos) > 0) {
    $lista .= "{$datos[0]['idinventario']}=={$datos[0]['nombre']}=={$datos[0]['valor']}==1";
        
} else {
    $lista .="null";
}


echo $lista;
?>