<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_inserisci_tappa{
        public static function start();
    }

    class inserisci_tappa extends controllo_attività implements i_inserisci_tappa{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/itinerario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";

            $activity = $_SESSION['selected_activity']['id'];

            foreach($_POST as $field => $value){
                $new_lap[$field] = $value;
            }
           
            $root = new itinerario($activity);

            $root->add_lap($new_lap);
            
            if(isset($_SESSION["error"])){
                $_SESSION["error"] = "La stessa tappa non può essere inserita";
                vista_attività::render('inserisci_tappa');
            }
            else{
                $_SESSION["message"] = "La tappa è stata inserita con successo";
                vista_attività::render('inserisci_tappa');
            }
            
            
        }

    }
?>