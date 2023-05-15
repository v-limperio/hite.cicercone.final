<?php 
    class controllo_utente{
        public static function start(){}

        public static function logout(){
            require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite/signin.php");
            session_start();
            session_destroy(); 
            signin::render('login');
        }
    }
    
?>