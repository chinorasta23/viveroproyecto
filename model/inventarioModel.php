<?php
require_once("database.php");
class inventarioModel 
{
    public static function agregarPlanta($data,$img){
        try{
            $sql = "'" . $data["Nombre"] . "'" . ", '" . $data["Cientifico"] . "'" . ", '" . $data["Clima"] . "'" . ", '" . $data["Descripcion"] . "'". ", '" . $data["Precio"] . "'". ", '" . $data["Cantidad"] . "'". ", '" . "$img" . "'";
            return database::getData("CALL pr_insert_Planta($sql)");
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function editarPlanta($data,$img){
        try{
            $sql = "'" . $data["Id"] . "'" . ", '" . $data["Nombre"] . "'" . ", '" . $data["Cientifico"] . "'" . ", '" . $data["Clima"] . "'" . ", '" . $data["Descripcion"] . "'". ", '" . $data["Precio"] . "'". ", '" . $data["Cantidad"] . "'". ", '" . "$img" . "'";
            return database::getData("CALL pr_update_Planta($sql)");
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function getPlantas(){
        try{
            return database::getData("CALL pr_get_Plantas");
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function eliminarPlanta($data){
        try{
            return database::getData("CALL pr_delete_Planta($data)");
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function getCantidad($data){
        try{
            $sql = "'" . $data["Id"] . "'";
            return database::getData("CALL pr_get_Cantidad($sql)");
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function restarCantidad($data,$nuevaCantidad){
        try{
            $sql = "'" . $data["Id"] . "'" . ", '" . $nuevaCantidad . "'";
            return database::getData("CALL pr_set_Cantidad($sql)");
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

}

?>