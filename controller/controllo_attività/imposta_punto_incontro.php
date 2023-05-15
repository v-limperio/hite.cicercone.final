<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_imposta_punto_incontro{
        public static function start();
    }

    class imposta_punto_incontro extends controllo_attività implements i_imposta_punto_incontro{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/attività.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività/ricerca_attività.php";

            $_SESSION['crea_attività']['incontro_lat'] = $_POST['lat'];
            $_SESSION['crea_attività']['incontro_lng'] = $_POST['lng'];
            $_SESSION['crea_attività']['indirizzo_incontro'] = $_POST['indirizzo'];

            $activity = new attività;
            $activity->create_activity($_SESSION['crea_attività']);

            unset($_SESSION['crea_attività']);
            $_SESSION["message"] = "L'attività è stata creata con successo !!";
            
            ricerca_attività::start();
        }
    }

?>