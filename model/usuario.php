<?php
 class Usuario{
    //informacion basica del usuario
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $correo; 
    private $username; //unico identificador en el sistema

    //valor booleano, permitira al usuario tener vista de empleado y acceso a funciones exclusivas de los empleados cuando el valor sea falso 
    private $cliente; 
    

    //Constructor 
    function Usuario($nombre,$primerApellido,$segundoApellido,$correo,$username,$cliente){
        $this->setNombre($nombre);
        $this->setPrimerApellido($primerApellido);
        $this->setSegundoApellido($segundoApellido);
        $this->setCorreo($correo);
        $this->setUsername($username);
        $this->setCliente($cliente);
    }

//Setters
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setPrimerApellido($primerApellido){
        $this->primerApellido = $primerApellido;
    }

    public function setSegundoApellido($segundoApellido){
        $this->segundoApellido = $segundoApellido;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function setUsername($username){
        $this->username = $username;
    }

//Getters
    public function getNombre(){
        return $this->nombre;
    }

    public function getPrimerApellido(){
        return $this->primerApellido;
    }

    public function getSegundoApellido(){
        return $this->segundoApellido;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getUsername(){
        return $this->username;
    }

 }
?>