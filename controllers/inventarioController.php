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

    public static function ctrlVerificarCantidad($data){
        try{
            if($data["Cantidad"] > inventarioModel::getCantidad($data)[0]['stock']){
                return false;
            }else{
                return true;
            }
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function ctrlComprarPlanta($data){
        try{
            $nuevaCantidad = inventarioModel::getCantidad($data)[0]['stock'] - $data["Cantidad"];
            return inventarioModel::restarCantidad($data,$nuevaCantidad);
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

}


?>