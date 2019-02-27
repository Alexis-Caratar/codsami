<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/Clases/ConectorBD.php';
date_default_timezone_set('America/Bogota');
$horayfecha=date( ' o-j-Y h:i:s A');
    
?>


<div class="container-fluid container "  id="contenido">
    <br> <br><br><br>
    
    <h2 class="text-right text-info" style="margin: -2% 70%; position: absolute;"> VENTAS</h2>
   

    <div class="" style="z-index: 100; margin: -80%;   position: absolute;">
        <form method="post" class="" name="formulario" onsubmit="return consultarProducto()">
            <input class="form-control" type="text"   id="nombre"  name="nombre"    onblur="this.focus()">
        </form>
    </div>

 
    <div class="container-fluid">
        <h3 class="text-left" style="font-weight: bold; font-size: 30px; font-family: Teamviwer;">DETALLES DE VENTA</h3> 
        <hr>
        <table   id='tabla'  class="table table-striped  "  >
                <tr class="cabecera">
                    <th>Item</th><th>Producto</th><th>Cantidad</th><th>Valorunitario</th><th>Subtotal</th>
                    <th><img src='Presentacion/imagenes/Adicionar.png' width="30" height="30"title='Adicionar' data-toggle='modal' data-target='#exampleModal'></th>             
                </tr>
                
            <thead>
                
            <tbody class="contenidoProductos">
            </tbody>
        </table>
        <h3 class="text-center" style="font-size: 30px; font-weight: bold;">TOTAL: <span id="subTotalFinal">0</span></h3>

        <form name="formularioEnvio" method="post" action="admon/ventaAcutalizar.php" onsubmit="return guradarVenta()">
            <input class="cadenaFinal" type="hidden" name="cadenaFinal">
            <button class="btn btn-primary center-block" >GUARDAR</button><br>
        </form>
        <h4>FECHA VENTA:<label><?=$horayfecha?></label> </h4>
  </div>  

    
</div>
<!-- Modal -->
    <div class="modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel ">ADICIONAR PRODUCTO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="carga">
                    <input  type="text" class="form-control" placeholder="Buscar por Codigo o Nombre" onchange="buscarproducto()" id="codigoBuscar"  />
                    <!--<button class="btn-primary" onclick="buscarproducto()">Buscar</button>-->

                    <!--cargar productos-->
<!--                    <button onclick="consultarproducto()">cargar productos</button>-->
                    <table id="cargarbuscador"></table>
<!--                    <table id="cargar"></table>-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button value="" type="button" class="btn btn-primary" id="btn_adicionar" data-dismiss="modal" onclick="agregarManualMente(this.value)">adicionar</button>
                </div>
            </div>
        </div>
    </div>
<!-- Fin moda -->
<!-- script -->
    <script type="text/javascript">        
        //<
   function ponleFocus(){
    document.getElementById("nombre").focus();
}

ponleFocus();
        var datosCadena = "null";
        var subTotalFinal = 0;
        function consultarProducto() {            
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var valores = "idInventario=" + document.formulario.nombre.value;
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {//verificamos que todo se correcto
                    var datos = xmlhttp.responseText
                    if (datos != "null") {                        
                        var datosCadenaArray = datosCadena.split("=:=");
                        var datosArray = datos.split("==");
                        var indiceBuscarProducto = buscarProducto(datosArray[0]);
                        if (indiceBuscarProducto < 0) {
                            if (datosCadena != "null") {
                                datosCadena += "=:=" + datos;
                            } else {
                                datosCadena = datos;
                            }
                            var item = datosCadenaArray.length;
                            if(datosCadenaArray[0] != "null"){
                               item=item+1
                            }
                            subTotalFinal= subTotalFinal+parseInt(datosArray[2]);
                            document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>1</td><td>" + datosArray[2] + "</td><td>" + datosArray[2] + "</td><td><button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                        } else {
                            document.getElementsByClassName("contenidoProductos")[0].innerHTML="";
                            datosCadena = "null";
                            var datosArrrayAntiguos = datosArray;
                            subTotalFinal = 0;
                            for (var i = 0; i < datosCadenaArray.length; i++) {
                                var item = i+1;
                                var datosArray = datosCadenaArray[i].split("==");
                                if(i == indiceBuscarProducto){
                                    var cantidad = parseInt(datosArray[3])+parseInt(datosArrrayAntiguos[3]);
                                    var subTotal = parseInt(datosArray[2])*cantidad;
                                    subTotalFinal+=subTotal;
                                    document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>"+cantidad+"</td><td>" + datosArray[2] + "</td><td>" + subTotal + "</td><td><button class='btn-primary'  value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                                    var cadenaNueva = datosArray[0]+"=="+datosArray[1]+"=="+datosArray[2]+"=="+cantidad;
                                    regrabarCadena(cadenaNueva);
                                }else{
                                    
                                var subTotal = parseInt(datosArray[2])*parseInt(datosArray[3]);
                                subTotalFinal+=subTotal;
                                    document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>"+datosArray[3]+"</td><td>" + datosArray[2] + "</td><td>" + subTotal + "</td><td><button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                                    var cadenaNueva = datosArray[0]+"=="+datosArray[1]+"=="+datosArray[2]+"=="+datosArray[3];
                                    regrabarCadena(cadenaNueva);
                                }
                            }
                        }
                    } else {
                        alert("El producto no esta registrado base de datos");
                    }
                    
                    document.getElementById('subTotalFinal').innerHTML=subTotalFinal;
                }
            }
            xmlhttp.open("POST", "admon/consultarProducto.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(valores);
            document.formulario.nombre.value="";
             $('#nombre').focus();
            return false;
        }
        function elimianrProducto(codigo, accion){
            var indiceBuscarProducto = buscarProducto(codigo);
            var datosCadenaArray = datosCadena.split("=:=");
            datosCadena = "null";
            document.getElementsByClassName("contenidoProductos")[0].innerHTML ="";
            subTotalFinal = 0;
            for (var i = 0; i < datosCadenaArray.length; i++) {
                var item = i+1;
                var datosArray = datosCadenaArray[i].split("==");
                if(i == indiceBuscarProducto){
                    if(accion == 0){
                        var cantidad = parseInt(datosArray[3])-1;
                        if(cantidad != 0){
                            var subTotal = parseInt(datosArray[2])*cantidad;
                            subTotalFinal+=subTotal;
                            document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>"+cantidad+"</td><td>" + datosArray[2] + "</td><td>" + subTotal + "</td><td><button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                            var cadenaNueva = datosArray[0]+"=="+datosArray[1]+"=="+datosArray[2]+"=="+cantidad;
                            regrabarCadena(cadenaNueva);
                        }
                        
                    }
                }else{
                    var subTotal = parseInt(datosArray[2])*parseInt(datosArray[3]);
                    subTotalFinal+=subTotal;
                    document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>"+datosArray[3]+"</td><td>" + datosArray[2] + "</td><td>" + subTotal + "</td><td><button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                    var cadenaNueva = datosArray[0]+"=="+datosArray[1]+"=="+datosArray[2]+"=="+datosArray[3];
                    regrabarCadena(cadenaNueva);
                }
            }
               $('#nombre').focus();
            document.getElementById('subTotalFinal').innerHTML=subTotalFinal;
        }
        function buscarProducto(codigo) {
            datosArray = datosCadena.split('=:=');
            for (var i = 0; i < datosArray.length; i++) {
                var codigoA = datosArray[i];
                codigoA = codigoA.split("==")[0];
                if (codigoA == codigo) {
                    return i;
                }
            }
            return -1
        } 
        function regrabarCadena(datos){if (datosCadena != "null") {datosCadena += "=:=" + datos;} else {datosCadena = datos;} }
        function guradarVenta(){
            
            document.getElementsByClassName("cadenaFinal")[0].value=datosCadena;
            document.formulario.nombre.focus()
            if(datosCadena != "null"){
                
                if(confirm("Desea realizar la venta?")){
                    return true;
                }else{
                    return false;
                }
                
            }else{
                alert("Ingese un producto");
                return false;
            }
             $('#nombre').focus();
        }
        function agregarManualMente(productosCadena){
            
            var datos = productosCadena;
            if (datos != "null") {
                        var datosCadenaArray = datosCadena.split("=:=");
                        var datosArray = datos.split("==");
                        var indiceBuscarProducto = buscarProducto(datosArray[0]);
                        if (indiceBuscarProducto < 0) {
                            if (datosCadena != "null") {
                                datosCadena += "=:=" + datos;
                            } else {
                                datosCadena = datos;
                            }
                            var item = datosCadenaArray.length;
                            if(datosCadenaArray[0] != "null"){
                               item=item+1
                            }
                            subTotalFinal= subTotalFinal+parseInt(datosArray[2]);
                            document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>1</td><td>" + datosArray[2] + "</td><td>" + datosArray[2] + "</td><td><button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                        } else {
                            document.getElementsByClassName("contenidoProductos")[0].innerHTML="";
                            datosCadena = "null";
                            var datosArrrayAntiguos = datosArray;
                            subTotalFinal = 0;
                            for (var i = 0; i < datosCadenaArray.length; i++) {
                                var item = i+1;
                                var datosArray = datosCadenaArray[i].split("==");
                                if(i == indiceBuscarProducto){
                                    var cantidad = parseInt(datosArray[3])+parseInt(datosArrrayAntiguos[3]);
                                    var subTotal = parseInt(datosArray[2])*cantidad;
                                    subTotalFinal+=subTotal;
                                    document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>"+cantidad+"</td><td>" + datosArray[2] + "</td><td>" + subTotal + "</td><td><button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                                    var cadenaNueva = datosArray[0]+"=="+datosArray[1]+"=="+datosArray[2]+"=="+cantidad;
                                    regrabarCadena(cadenaNueva);
                                }else{
                                    
                                var subTotal = parseInt(datosArray[2])*parseInt(datosArray[3]);
                                subTotalFinal+=subTotal;
                                    document.getElementsByClassName("contenidoProductos")[0].innerHTML += "<tr><td>" + item + "</td><td>" + datosArray[1] + "</td><td>"+datosArray[3]+"</td><td>" + datosArray[2] + "</td><td>" + subTotal + "</td><td><button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 0)'>-</button> <button class='btn-primary' value='"+datosArray[0]+"' onclick='elimianrProducto(this.value, 1)'>x</button></td><tr>";
                                    var cadenaNueva = datosArray[0]+"=="+datosArray[1]+"=="+datosArray[2]+"=="+datosArray[3];
                                    regrabarCadena(cadenaNueva);
                                }
                            }
                            document.getElementById('exampleModal').style.display="none";
                            
                            
                        }
                    } else {
                        alert("El producto no esta disponible");
                    }
            document.getElementById('subTotalFinal').innerHTML=subTotalFinal;
          $('#nombre').focus();
             $('#cargarbuscador').html()("");
   
        }
        //>
        //
        //
        //para cargar el buscador en la modal
        function  buscarproducto() {
       //  $('#cargarbuscador').val('');
            var codigo = $('#codigoBuscar').val();
            if (codigo != '') {
                var $cadenasql = "select*From inventario where concat(idinventario,nombre) like'%" + codigo + "%'";
                $.ajax({
                    url: 'admon/consultaproducto.php',
                    type: 'post',
                    data: {cadenasql: $cadenasql},
                    success: function (data, textStatus, jqXHR) {
                       lista = "<table   id='tabla' class='table' ><tr><th>Item</th><th>Producto</th><th>Cantidad</th><th>Valorunitario</th><th>Subtotal</th></tr>";
                        if(data != "null"){
                            dataArray = data.split("==");
                            var item = dataArray.length;
                            if(dataArray[0] != "null"){
                                   item=item+1
                            }  
                            var fila = "<tr><td>"+1+"</td><td>"+dataArray[1]+"</td><td>1</td><td>"+dataArray[2]+"</td><td>"+dataArray[2]+"</td></tr>"
                            lista += fila;
                            lista += "<table>";
                            $('#cargarbuscador').html(lista);
                        }else{
                            alert("producto agotado");   
                        }
                        document.getElementById("btn_adicionar").value=data;
                        
                    }
                });
                
            } else {
                $('#cargarbuscador').html('<H4>Escribe algo</H4>');
            }
            $('#codigoBuscar').val("");
           
            
            
        }
        //para cargar todos los producto en la modal
//        function consultarproducto() {
//            var $cadenasql = "select*From inventario";
//            $.ajax({
//                url: 'admon/consultaproducto.php',
//                type: 'post',
//                data: {cadenasql: $cadenasql},
//                success: function (data, textStatus, jqXHR) {
//                    var lista = "<table border='2'  id='tabla' class='table' ><tr><th>Item</th><th>Producto</th><th>Cantidad</th><th>Valorunitario</th><th>Subtotal</th>";
//                    lista += data;
//                    lista += "<table>";
//                    $('#cargar').html(lista);
//                }
//            });
//        }
      
    </script>