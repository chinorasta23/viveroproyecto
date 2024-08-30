<?php

require_once("Utilities.php");

 class database{

    private static function connect($scriptSQL){
        //conexion a la base de datos
        try{
        //cadena de conexion
        $conexion = mysqli_connect(
            'localhost',
            'root',
            'Nicolle123@',
            'viveroproyecto'
        ) or die ('No se puede conectar a la DB');

        //Ejecucion de los Scripts
        $script = mysqli_query($conexion,$scriptSQL);
        $resultado = array(
            'exito' => $script,
            'error' => mysqli_error($conexion),
            'conexion' => $conexion
        );

        return $resultado;

        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }

    public static function getData($scriptSQL){
        try{
            $resultado = self::connect($scriptSQL);
            $filas = array();

            if($resultado['exito'] instanceof mysqli_result){
                while($fila = mysqli_fetch_array($resultado['exito'], MYSQLI_ASSOC)){
                    $filas[] = $fila;
                }
                self::closeConnection($resultado['conexion'],$resultado);
                return $filas;
            }else{
                return $resultado;
            }
        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }

    private static function closeConnection($conexion,$resultado){
        try{
            mysqli_close($conexion);
            if($resultado instanceof mysqli_result){
                mysqli_free_result($resultado);
            }    
        }catch(Exception $e){
            //Manejo del error 
            Utilities::alerta($e->getMessage());
        }
    }


}
?>