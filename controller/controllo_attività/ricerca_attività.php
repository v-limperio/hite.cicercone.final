<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_ricerca_attività{
        public static function start();
    }

    class ricerca_attività extends controllo_attività implements i_ricerca_attività{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/attività.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
            
            unset($_SESSION['attività']);

            //assegno i dati interessati
            $activity_data = array();
            $activity_data["cicerone"] = $_SESSION["utente"]["id"];

            $activity = new attività;

            //ricerca le attività non concluse (il bool indica lo stato della conclusione)
            $activities = $activity->get_activity_by_cicerone($activity_data);

            if(!$activities){
                $_SESSION['warning'] = "Nessuna attività rilevata.";
                vista_attività::render('le_mie_attivita');
            }
            else{
                $_SESSION['attività'] = json_decode($activities, true);
                vista_attività::render('le_mie_attivita');
            }
        }
    }
?>