<?php
class Carrito {
    private $articulos;
    private $total;

    function agregarArticulo($id,$cantidad){
        if(session_status() == PHP_SESSION_ACTIVE){
            session_start();
            //verifica si hay un carrito existente
            if(!isset($_SESSION["carrito"])){
                $_SESSION["carrito"] = new Carrito();
            }

            //Obtiene informacion de la planta en la DB
            $dbSession = new Database();
            $dbSession->connect();
            $planta = new Planta($dbSession->get("Planta",$id,"Nombre"), $dbSession->get("Planta",$id,"Categoria"), $dbSession->get("Planta",$id,"Precio"), $dbSession->get("Planta",$id,"Cantidad"));

            //Agrega la(s) planta al carrito
            for($i=0;$i<=$cantidad;$i++){
                array_push($articulos, $planta);
            }
            
            //Elimina los articulos del inventario
            //$dbSession::edit("Planta",$id,"Cantidad",$planta->disponibles - $cantidad)
            $dbSession->closeConnection();
        }else{
            throw Utilities::alerta("Por favor inicie sesion");
        }
    }
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