<?php

class Planta 
{
    private $id;
    private $nombre;
    private $familia;
    private $precio;
    private $disponibles;

    //Constructor
    function Planta($nombre,$familia,$precio,$disponibles){
        $this->setNombre($nombre);
        $this->setNombre($familia);
        $this->setNombre($precio);
        $this->setDisponibles($disponibles);
    }


//Setters
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setFamilia($familia){
        $this->familia = $familia;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function setDisponibles($disponibles){
        $this->disponibles = $disponibles;
    }


//Getters
    public function getID(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function getFamilia(){
        return $this->familia;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getDisponibles(){
        return $this->disponibles;
    }

    


}

?>