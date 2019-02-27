<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__). '/../Clases/ConectorBD.php';
foreach ($_POST as $Variable=> $valor)   ${$Variable}=$valor;
foreach ($_GET as $Variable=> $valor)   ${$Variable}=$valor;



    $cadena="select*from usuario where   clave='$claveactual'";
    $datos= ConectorBD::ejecutarQuery($cadena, null);
    
if (count($datos)>0){
    if ($clavenueva==$confirmarclave) {
        $cadena="update usuario set idusuario='$usuario',clave='$clavenueva' where idusuario='{$datos[0][0]}'";
    $datos= ConectorBD::ejecutarQuery($cadena, null);      
    } else {$mensaje="No concuerdan las contraseñas nuevas";
        header("Location:principal.php?CONTENIDO=admon/cambioclaveadmin.php&mensaje=$mensaje&claveactual=$claveactual&clavenueva=$clavenueva&confirmarclave=$confirmarclave ") ;
    }
}
else{
     $mensaje="las contraseña actual es incorrecta";
        header("Location:principal.php?CONTENIDO=admon/cambioclaveadmin.php&mensaje=$mensaje&claveactual=$claveactual&clavenueva=$clavenueva&confirmarclave=$confirmarclave ") ;    
}
?>
<script>
    alert("Contraseña Modificada");
location="index.php?mensaje=Ingrese de nuevo al sistema";
</script>

    

