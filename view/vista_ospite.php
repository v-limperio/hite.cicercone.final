<?php 
    class vista_ospite{
        public static function call_controller($function){
                require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_ospite/$function.php";
                $function::start();
        }
        public static function render($page){
            header("location: http://localhost/hite.cicerone.io/html/ospite/$page.php");
        }
    }
?>