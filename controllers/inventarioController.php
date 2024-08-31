<?php
require_once("../../model/inventarioModel.php");

class inventarioController{
    public static function ctrlAddPlanta($data,$img){
        try{
            return inventarioModel::agregarPlanta($data,$img);
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function ctrlGetPlantas(){
        try{
            return inventarioModel::getPlantas();
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function ctrlgetPlantaId($data){
        try{
            return inventarioModel::getPlantaID($data);
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function ctrlDelPlanta($data){
        try{
            return inventarioModel::eliminarPlanta($data);
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function ctrlUpdatePlanta($data,$img){
        try{
            if($data["ImagenActual"] != "" && $img == ""){
                $img = $data["ImagenActual"];
            }
            return inventarioModel::editarPlanta($data,$img);
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function ctrlAddToCart($plantaId, $cantidad) {
        // Ensure the session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Ensure 'carrito' is an array
        if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
            $_SESSION['carrito'] = []; // Initialize as an empty array if not set or not an array
        }
    
        // Normalize any scalar values in 'carrito'
        foreach ($_SESSION['carrito'] as $key => $value) {
            if (!is_array($value)) {
                // Convert the scalar value to an array with default details
                $_SESSION['carrito'][$key] = [
                    'id_planta' => $key,
                    'cantidad' => $value
                ];
            }
        }
    
        // Check if the plant is already in the cart
        if (isset($_SESSION['carrito'][$plantaId])) {
            // Update the quantity
            $_SESSION['carrito'][$plantaId]['cantidad'] += $cantidad;
        } else {
            // Add the plant to the cart
            $planta = inventarioModel::getPlantaID($plantaId);
            if ($planta) {
                $_SESSION['carrito'][$plantaId] = [
                    'id_planta' => $plantaId,
                    'nombre' => $planta[0]['nombre_popular'],
                    'precio' => $planta[0]['precio'],
                    'cantidad' => $cantidad,
                    'img' => $planta[0]['img']
                ];
                
            }
        }
    }

    public static function ctrlRemoveFromCart($id_planta) {
        if (isset($_SESSION['carrito'][$id_planta])) {
            unset($_SESSION['carrito'][$id_planta]);
        }
    }
    
    




}


?>