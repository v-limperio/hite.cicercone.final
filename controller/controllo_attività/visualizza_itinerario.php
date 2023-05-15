<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_visualizza_itinerario{
        public static function start();
    }

    class visualizza_itinerario extends controllo_attività implements i_visualizza_itinerario{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/itinerario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";

            if (isset($_POST['id'])) {
                $array = array_filter($_SESSION['attività'], function ($selected_activity) {
                    return ($selected_activity['id'] == $_POST['id']);
                });
    
                foreach ($array as $key => $value) {
                    $_SESSION['selected_activity'] = $array[$key];
                }
            }

            $activity = $_SESSION['selected_activity']['id'];
            $root = new itinerario($activity);

            $result = $root->get();

            if(!$result){
                $_SESSION['warning'] = "L'itinerario risulta vuoto, puoi inseirire una tappa col pulsante";
                vista_attività::render('itinerario');
            }
            else{
                $_SESSION['itinerario'] = json_decode($result, true);
                vista_attività::render('itinerario');
            }
        }
        
    }

?>