<?php
 class Utilities {
    public static function alerta($message){
        //Metodo para imprimir una alerta usando javascript
        ?><script type="text/javascript">alert("<?=$message?>");</script><?php
    }
 }
?>