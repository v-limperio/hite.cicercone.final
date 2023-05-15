<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_modifica_tappa{
        public static function start();
    }

    class modifica_tappa extends controllo_attività implements i_modifica_tappa{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/itinerario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";

            $activity = $_SESSION['selected_activity']['id'];

            foreach($_POST as $field => $value){
                $new_lap[$field] = $value;
            }
           
            $root = new itinerario($activity);

            $root->set_lap($new_lap);
            
            if(isset($_SESSION["error"])){
                $_SESSION['error'] = "La tappa è stata già inserita";
                vista_attività::render('itinerario');
            }
            else{
                $_SESSION["message"] = "La tappa è stata modificata con successo";
                vista_attività::call_controller('visualizza_itinerario');
            }
            
            
        }

    }
?>