<?php
class carrito {
    private $articulos;
    private $total;

//Setters
    function setArticulos($articulos){
        $this->$articulos = $articulos;
    }

    function setTotal($total){
        $this->$total = $total;
    }

//Getters
    function getArticulos(){
        return $this->articulos;
    }

    function getTotal(){
        return $this->articulos;
    }
}
?>