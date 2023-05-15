<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/controller/controllo_attività.php";

interface i_inserisci_orario
{
    public static function start();
}

class inserisci_orario extends controllo_attività implements i_inserisci_orario
{
    public static function start()
    {
        session_start();
        $now = new DateTime();
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/orario.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_attività.php";
        unset($_SESSION['orario']);

        
        $schedule_POST['attivita'] = $_SESSION['riproponi']['id'];

        foreach ($_POST as $field => $value) {
            $schedule_POST[$field] = $value;
        }

        $_SESSION['orario'] = $schedule_POST;

        $old_date = $schedule_POST['data_attivita'];
        $new_date = strtr($old_date, '/', '-');
        $schedule_POST['data_attivita'] = date("Y-m-d", strtotime($new_date));

        self::print_log($now->format("Y-m-d"));
        self::print_log($now->format("H:i:s"));
        self::print_log($schedule_POST['data_attivita']);
        self::print_log($old_date);


        if ($now->format("Y-m-d") > $schedule_POST['data_attivita']) {
            $_SESSION['error'] = "Errore: La data è già passata.";
            vista_attività::call_controller('ricerca_orario');
            // se la ricerca risulta fuori orario
        } elseif ($now->format("H:i:s") >= $schedule_POST['ora_inizio'] and  $now->format("Y-m-d") == $schedule_POST['data_attivita']) {
            $_SESSION['error'] = "Errore: L'orario è già passato.";
            vista_attività::call_controller('ricerca_orario');
        } else {

            $schedule = new orario($schedule_POST);

            $schedule->create();

            if (isset($_SESSION['error'])) {
                unset($_SESSION['orario']);
                $_SESSION['error'] = "Errore: L'orario inserito risulta già presente per l'attività selezionata";
                vista_attività::call_controller('ricerca_orario');
            } else {
                $_SESSION['message'] = "L'orario è stato impostato con successo";
                vista_attività::call_controller('ricerca_orario');
            }
        }
    }
    public static function print_log($log)
    {
        echo '<pre>';
        print_r($log);
        echo '</pre>';
    }
}
