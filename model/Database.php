<?php

 class Database{


    function connect(){
        //conexion a la base de datos
        try{

        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }

    function get($tabla,$id,$atributo){
        try{

        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }

    function delete($tabla,$id){
        try{

        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }

    function edit($tabla,$id,$atributo,$valor){
        try{

        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }

    function closeConnection(){
        try{
            
        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }


}
?>