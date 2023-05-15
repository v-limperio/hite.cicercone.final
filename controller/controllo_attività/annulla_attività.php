<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_annulla_attività{
        public static function start();
    }

    class annulla_attività extends controllo_attività implements i_annulla_attività{
        public static function start(){
            session_start();
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/attività.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività/ricerca_attività.php";
            // echo $_POST['id'];
            $activity= new attività;
            
            unset($_SESSION['data']);

            $activity->delete_activity($_POST['id']);

            $_SESSION['message']= "L'attività è stata eliminata con successo!";

            ricerca_attività::start();
        }
    }


?>