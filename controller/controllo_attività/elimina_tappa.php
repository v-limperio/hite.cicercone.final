<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_elimina_tappa{
        public static function start();
    }

    class elimina_tappa extends controllo_attività implements i_elimina_tappa{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/itinerario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
            unset($_SESSION['data']);

            $data = $_POST['id'];
            $field = explode('-',$data);
            $activity = $_SESSION['selected_activity']['id'];
            $lap['nome_luogo'] = $field[0];
            $lap['descrizione'] = $field[1];

            $root = new itinerario($activity);
            $root->remove_lap($lap);

            $_SESSION['message'] = "Tappa eliminata";

            vista_attività::call_controller('visualizza_itinerario');
            
        }
    }
?>