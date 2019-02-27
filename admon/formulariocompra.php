<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../Clases/ConectorBD.php';
require_once dirname(__FILE__).'/../Clases/Compras.php';
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;

$codigo="";
$generarcodigo="";

if ($accion=='Modificar'){$compras=new Compras('idcompra', $idcompra);
$codigoss="";
$codigos="";
$codigo.='<img src="presentacion/lib/barcode.php?text='.$compras->getIdcompra().'&size=80&codetype=code39&print=true ">';
}
   else {$compras=new Compras(null, null);
if (isset($codigos)){$codigos=$codigos;}
else $codigos=null;
   $codigoss.='<img src="presentacion/lib/barcode.php?text='.$codigos.'&size=80&codetype=code39&print=true ">';
   $generarcodigo="<a href='principal.php?CONTENIDO=admon/generarcodigo.php&accion=$accion'>GENERAR CODIGO</a>";
   
   }
   
?>
<br><br><br>
<div class="container-fluid">
    <h2><?= strtoupper($accion)?> COMPRA</h2>
    <div class="offset-2 col-md-8">
        <form  name="formulario" method="POST" action="principal.php?CONTENIDO=admon/actualizarcompra.php">
                <table class="table">
                    <tr><th id="verificar"></th><tr>
                    <tr><th>CODIGO DE BARRAS</th><td><input class="form-control" type="text" id="idcompra" onchange="verificarcodigo()" name="idcompra" value="<?=$codigos?><?=$compras->getIdcompra()?>" required ></td></tr>
                    <tr><th>NOMBRE</th><td><input class="form-control" type="text" name="nombre" value="<?=$compras->getNombre()?>" required></td></tr>
                    <tr><th>DESCRIPCION</th><td><input class="form-control" type="text" name="descripcion" value="<?=$compras->getDescripcion()?>" required></td></tr>
                    <tr><th>CANTIDAD</th><td><input class="form-control" type="number" name="cantidad" value="<?=$compras->getCantidad()?>" required></td></tr>
                    <tr><th>CANTIDAD MINIMA DE PRODUCTO</th><td><input class="form-control" type="number" name="stockminimo" value="<?=$compras->getstockminimo()?>" required></td></tr>
                    <tr><th>VALOR UNITARIO COMPRA</th><td><input class="form-control" type="number" name="valorcomprauni" value="<?=$compras->getValorcomprauni()?>" required></td></tr>
                    <tr><th>VALOR UNITARIO VENTA</th><td><input class="form-control" type="number" name="valorventauni" value="<?=$compras->getValorventauni()?>" required></td></tr>
                </table>
            <center><input  class="btn btn-primary" type="hidden" name="idcompraA" value="<?= $idcompra?>"></center>
            <center><input  class="btn btn-primary"type="submit" name="accion" accesskey="5" value="<?= strtoupper($accion)?>"></center>
        </form>
    </div>    
     <?=$codigo?><?=$generarcodigo?><br><br><?=$codigoss?>
</div>

<script>
function  verificarcodigo(){
    var idcodigo=$('#idcompra').val();
    if(idcodigo!=""){
    var $cadenasql="select*From compras where idcompra='"+idcodigo+"'";  
                $.ajax({
                   url:'admon/verificarproducto.php',
                   type:'post',
                   data:{cadenasql:$cadenasql},
                   success: function (data, textStatus, jqXHR) {
                      $("#verificar").html(data);
                    }
                });
            }
        }
</script>