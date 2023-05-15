<?php 
    class vista_cicerone{
        public static function call($controller, $function){
                require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/$controller.php";
                $controller::$function();
        }
        public static function render($page){
            header("location: http://localhost/hite.cicerone.io/html/cicerone/$page.php");
        }
    }
?>