<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_visualizza_profilo{
        public static function start();
    }

    class visualizza_profilo extends controllo_utente implements i_visualizza_profilo{
        public static function start(){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";
            $user_data = $_SESSION["utente"];
            $user = new utente;
            $result = $user->get_user($user_data["id"]);
            return $result;
        }
    }
?>