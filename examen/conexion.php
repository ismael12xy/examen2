<?php
    function conect(): mysqli{
        $bd = mysqli_connect("localhost", "root","","parras");

        if ($bd){
            echo "conetado";
        }else{
            echo "no conectado";
        }

        return $bd;
    }
    
?>   