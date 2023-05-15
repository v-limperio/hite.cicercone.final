<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_chiudi_richieste{
        public static function start();
    }

    class chiudi_richieste extends controllo_attività implements i_chiudi_richieste{
        public static function start(){
            session_start();
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/orario.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";

            unset($_SESSION['orario'][$_POST['index']]['chiusura_richieste']);
            unset($_SESSION['orario'][$_POST['index']]['stato_conclusione']);

            $schedule = new orario($_SESSION['orario'][$_POST['index']]);
            $schedule->close();

            $_SESSION['orario'][$_POST['index']]['chiusura_richieste'] = 1;
            $_SESSION['orario'][$_POST['index']]['stato'] = 'creata';

            $_SESSION['message'] = "Chiuse le richieste per l'orario selezionato.";

            vista_attività::render('orario');

        }
    }


?>