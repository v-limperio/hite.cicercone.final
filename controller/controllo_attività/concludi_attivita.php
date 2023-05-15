<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_concludi_attivita{
        public static function start();
    }

    class concludi_attivita extends controllo_attività implements i_concludi_attivita{
        public static function start(){
            session_start();
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/orario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";

            self::print_log($_SESSION['orario'][$_POST['index']]);

            $schedule_data['attivita'] = $_SESSION['orario'][$_POST['index']]['attivita'];
            $schedule_data['data_attivita'] = $_SESSION['orario'][$_POST['index']]['data_attivita'];
            $schedule_data['ora_inizio'] = $_SESSION['orario'][$_POST['index']]['ora_inizio'];

            $schedule = new orario($schedule_data);
            $schedule->complete();

            $_SESSION['orario'][$_POST['index']]['stato'] = "conclusa";

            vista_attività::render('orario');
        }

        public static function print_log($log)
        {
            echo '<pre>';
            print_r($log);
            echo '</pre>';
        }
    }



?>