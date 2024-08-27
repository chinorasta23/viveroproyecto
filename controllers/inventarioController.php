<?php
require_once("../model/inventarioModel.php");

class inventarioController{
    public static function ctrlAddPlanta($data){
        try{
            return inventarioModel::agregarPlanta($data);
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

    public static function ctrlDelPlanta($data){
        try{
            return inventarioModel::eliminarPlanta($data);
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function ctrlUpdatePlanta($data){
        try{
            return inventarioModel::editarPlanta($data);
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

}


?>