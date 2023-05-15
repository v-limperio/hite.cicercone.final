<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_elimina_orario{
        public static function start();
    }

    class elimina_orario extends controllo_attività implements i_elimina_orario{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/orario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
            unset($_SESSION['orario']);

            $delete_POST = explode(" ",$_POST['id']);

            $schedule_POST['attivita'] = $delete_POST[0];

            $schedule_POST['data_attivita'] = $delete_POST[1];
            $old_date = $schedule_POST['data_attivita'];
            $new_date = strtr($old_date, '/', '-');
            $schedule_POST['data_attivita'] = date("Y-m-d", strtotime($new_date));

            $schedule_POST['ora_inizio'] = $delete_POST[2];
            
            $schedule = new orario($schedule_POST);

            $schedule->delete();

            $_SESSION['message'] = "Orario Annullato";
            vista_attività::call_controller('ricerca_orario');
        }
    }
