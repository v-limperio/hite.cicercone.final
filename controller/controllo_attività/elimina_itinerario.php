<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_elimina_itinerario{
        public static function start();
    }

    class elimina_itinerario extends controllo_attività implements i_elimina_itinerario{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/itinerario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
            unset($_SESSION['data']);

            $activity = $_SESSION['selected_activity']['id'];
            

            $root = new itinerario($activity);
            $root->delete();
            unset($_SESSION['itinerario']);

            $_SESSION['message'] = "L'itinerario è stato rimosso";
            vista_attività::render('itinerario');

        }
    }
?>