<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_logout{
        public static function start();
    }

    class logout extends controllo_utente implements i_logout{
        public static function start(){
            require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite.php");
            session_start();
            session_destroy(); 
            vista_ospite::render('login');
        }
    }
?>