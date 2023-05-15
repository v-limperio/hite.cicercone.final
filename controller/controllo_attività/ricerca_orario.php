<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_ricerca_orario{
        public static function start();
    }


    class ricerca_orario extends controllo_attività implements i_ricerca_orario{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/orario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
            unset($_SESSION['orario']);

            //Isola l'attività selezionata
            if(isset($_POST['id'])){
                $array = array_filter($_SESSION['attività'], function($selected_activity){
                    return ($selected_activity['id'] == $_POST['id']);
                });
            }

            foreach($array as $key => $value){
                $_SESSION['riproponi'] = $array[$key];
            }

            $schedule_POST['attivita'] = $_SESSION['riproponi']['id'];

            $schedule = new orario($schedule_POST);
            $result = $schedule->get();

            if(!$result){
                $_SESSION['warning'] = "L'attività selezionata non dispone ancora di un orario, puoi quindi inserirne uno.";
                vista_attività::render('orario');
            }
            else{
                $_SESSION['orario'] = json_decode($result, true);
                vista_attività::render('orario');
            }

        }
    }

?>