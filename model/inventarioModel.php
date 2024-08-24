<?php
require_once("../model/database.php");
class inventarioModel 
{
    public static function agregarPlanta($data){
        try{
            $sql = "'" . $data["Nombre"] . "'" . ", '" . $data["Cientifico"] . "'" . ", '" . $data["Clima"] . "'" . ", '" . $data["Descripcion"] . "'". ", '" . $data["Precio"] . "'". ", '" . $data["Cantidad"] . "'". ", '" . $data["Imagen"] . "'";
            return database::getData("CALL pr_insert_Planta($sql)");
        }catch(Exception $e){
            Utilities::alerta($e->getMessage());
        }
    }

    public static function editarPlanta($data,$id){
        try{
            $sql = "'" . $id . "'" . ", '" . $data["Nombre"] . "'" . ", '" . $data["Cientifico"] . "'" . ", '" . $data["Clima"] . "'" . ", '" . $data["Descripcion"] . "'". ", '" . $data["Precio"] . "'". ", '" . $data["Cantidad"] . "'". ", '" . $data["Imagen"] . "'";
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

}

?>