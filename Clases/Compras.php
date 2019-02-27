<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Compras
 *
 * @author johan
 */
class Compras {
    private $idcompra;
    private $nombre;
    private $descripcion;
    private $cantidad;
    private $stockminimo;
    private $valorcomprauni;
    private $valorventauni;
    function __construct($campo,$valor) {
             if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select*from compras where $campo='$valor' ";
                print_r($cadenaSQL);
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idcompra=$vector['idcompra'];
        $this->nombre=$vector['nombre'];
        $this->descripcion=$vector['descripcion'];
        $this->cantidad=$vector['cantidad'];
        $this->stockminimo=$vector['stockminimo'];
        $this->valorcomprauni=$vector['valorcomprauni'];
        $this->valorventauni=$vector['valorventauni'];
    }
    
    function getIdcompra() {
        return $this->idcompra;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getstockminimo() {
        return $this->stockminimo;
    }

    function getValorcomprauni() {
        return $this->valorcomprauni;
    }

    function getValorventauni() {
        return $this->valorventauni;
    }

    function setIdcompra($idcompra) {
        $this->idcompra = $idcompra;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setstockminimo($stockminimo) {
        $this->stockminimo = $stockminimo;
    }

    function setValorcomprauni($valorcomprauni) {
        $this->valorcomprauni = $valorcomprauni;
    }

    function setValorventauni($valorventauni) {
        $this->valorventauni = $valorventauni;
    }
}
