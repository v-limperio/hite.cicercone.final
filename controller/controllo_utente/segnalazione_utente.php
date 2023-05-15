<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_segnalazione_utente{
        public static function start();
    }

    class segnalazione_utente extends controllo_utente implements i_segnalazione_utente{
        public static function start(){
            session_start();
            $user_data = $_SESSION["utente"];
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/segnalazione.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_utente.php";

            $report_data['segnalatore'] = $user_data['id'];
            $report_data['segnalato'] = $_SESSION['segnala']['id'];
            $report_data['causa'] = $_POST['causa'];
            $report_data['descrizione_causa'] = $_POST['descrizione_causa'];
            
           
            $user_report['segnalazioni'] =  $_SESSION['segnala']['segnalazioni'] + 1;
            $report = new segnalazione($report_data);
            $report->create();
            
           
            if(isset($_SESSION['error'])){
                $_SESSION['error'] = "ERRORE: Hai già segnalato questo utente";
                vista_utente::render('segnala_utente');
            }
            else{
                $user = new utente;
                $user->set_user($report_data['segnalato'], $user_report);
                $_SESSION['message'] = "Segnalazione Effettuata";
                vista_utente::render('homepage');
            }
        }
    }
?>