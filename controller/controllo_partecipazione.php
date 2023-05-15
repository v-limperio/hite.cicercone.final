<?php
interface i_controllo_partecipazione
{
    public static function ricerca_attività();
}

class controllo_partecipazione implements i_controllo_partecipazione
{
    public static function ricerca_attività()
    {
        session_start();
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/attività.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/orario.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_utente.php";

        unset($_SESSION['risultato']);
        if (isset($_SESSION['search'])) {
            unset($_SESSION['search']);
        }

        $activity_POST['citta'] = $_POST['citta'];
        $_SESSION['search']['citta'] =   $activity_POST['citta'];
        $data_POST['data_attivita'] = $_POST['data_attivita'];
        $_SESSION['search']['data'] =   $data_POST['data_attivita'];

        $old_date = $data_POST['data_attivita'];
        $new_date = strtr($old_date, '/', '-');
        $data_POST['data_attivita'] = date("Y-m-d", strtotime($new_date));

        //ricerca per citta
        $activity = new attività;

        $result_activity = $activity->get($activity_POST);

        if (!$result_activity) {
            $_SESSION['error'] = "La città inserita non ha prodotto alcun risultato";
            vista_globetrotter::render('risultati');
        } else {
            $activity_data[] = json_decode($result_activity, true);
            $_SESSION['risultato_attività'] = $activity_data;
            $i = 0;
            foreach ($activity_data as $activity) {
                while ($i < count($activity)) {
                    $schedule_data[$i]['attivita'] = $activity[$i]['id'];
                    $schedule_data[$i]['data_attivita'] = $data_POST['data_attivita'];
                    $schedule_data[$i]['chiusura_richieste'] = '0';
                    $schedule_data[$i]['stato'] = '0';
                    $schedule = new orario($schedule_data[$i]);
                    $result_schedule[$i] = $schedule->get();
                    $risultato[$activity[$i]['id']] = json_decode($result_schedule[$i], true);
                    $i++;
                }
            }
        }
        if (!$risultato) {
            $_SESSION['error'] = "I parametri inseriti non hanno prodotto alcun risultato";
            vista_globetrotter::render('risultati');

        } else {
            $now = new DateTime();
            $i = 0;
            foreach ($risultato as $key => $value) {
                foreach ($value as $subkey => $subvalue) {
                    // se la data è già passata
                    if ($now->format("Y-m-d") > $subvalue['data_attivita']){
                        unset($subvalue);
                    // se la ricerca risulta fuori orario
                    } elseif ($now->format("H:i:s") >= $subvalue['ora_inizio'] AND  $now->format("Y-m-d") == $subvalue['data_attivita']){
                        unset($subvalue);
                    } 
                    else {
                        foreach ($activity_data as $activity) {
                            if ($subvalue['attivita'] = $activity[$i]['id']) {
                                $subvalue['attivita'] = $activity[$i];
                                $result[] = $subvalue;
                            }
                        }
                    }
                }
                $i++;
            }

            self::print_log($result);

            if (!$result) {
                $_SESSION['error'] = "I parametri inseriti non hanno prodotto alcun risultato";
                vista_globetrotter::render('risultati');
            } else {
                $_SESSION['risultato'] = $result;
                vista_globetrotter::render('risultati');
            }
        }
    }

    public static function visualizza_attività()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/itinerario.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";
        unset($_SESSION['itinerario']);
        unset($_SESSION['visualizza']);

        $dateActivity = explode(" ", $_POST['arrayActivity']);
        $_SESSION['richiesta']['attività'] = $dateActivity[0];
        $_SESSION['richiesta']['data'] = $dateActivity[1];
        $_SESSION['richiesta']['ora_inizio'] = $dateActivity[2];
        $_SESSION['richiesta']['ora_termine'] = $dateActivity[3];

        foreach ($_SESSION['risultato_attività'] as $result_activity) {
            $activity = $result_activity;
        }

        self::print_log($activity);

        if (isset($_POST['id'])) {
            $array = array_filter($activity, function ($selected_activity) {
                return ($selected_activity['id'] == $_POST['id']);
            });

            foreach ($array as $key => $value) {
                $_SESSION['visualizza'] = $array[$key];
            }
        }
        self::print_log($_SESSION['visualizza']);

        $activityid = $_SESSION['visualizza']['id'];
        $root = new itinerario($activityid);

        $result_root = $root->get();
        if ($result_root) {
            $_SESSION['itinerario'] = json_decode($result_root, true);
        }

        vista_globetrotter::render('visualizza_attività');
    }

    public static function richiesta_partecipazione()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_utente.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";

        $arrayPOST = explode(" ", $_POST['id']);

        if ($_SESSION['utente']['id'] == $arrayPOST[4]) {
            $_SESSION['error'] = "Errore: Non puoi partecipare ad un'attività da te creata";
            vista_globetrotter::render('risultati');
        } else {

            $requestPOST['partecipante'] = $_SESSION['utente']['id'];
            $requestPOST['attivita'] = $arrayPOST[0];

            $old_date = $arrayPOST[1];
            $new_date = strtr($old_date, '/', '-');
            $requestPOST['data_attivita'] = date("Y-m-d", strtotime($new_date));

            $requestPOST['ora_inizio'] = $arrayPOST[2];
            $requestPOST['ora_termine'] = $arrayPOST[3];

            $request = new richiesta($requestPOST);

            $request->send();

            if (isset($_SESSION['error'])) {

                $_SESSION['error'] = "Errore: Hai già inoltrato una richiesta a questa attività";
                vista_globetrotter::render('risultati');
            } else {
                unset($_SESSION['message']);
                $_SESSION['message'] = "La richiesta pendente è stata inoltrata";
                vista_globetrotter::render('risultati');
            }
        }
    }

    public static function visualizza_richieste()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/attività.php";


        $userPOST['partecipante'] = $_SESSION['utente']['id'];

        $request = new richiesta($userPOST);
        $result = $request->get();

        if (!$result) {
            $_SESSION['warning'] = "Non hai ancora inoltrato nessuna richiesta";
            vista_globetrotter::render('richieste');
        } else {
            $result_request[] = json_decode($result, true);
            $i = 0;

            foreach ($result_request as $request) {
                while ($i < count($request)) {
                    $activity = new attività;
                    $resultA[$i] = $activity->get_activity_by_id($request[$i]['attivita']);

                    $result_activity[$i] = json_decode($resultA[$i], true);
                    $request[$i]['attivita'] = $result_activity[$i];
                    $i++;
                }
            }
            $_SESSION['richieste'] = $request;
            vista_globetrotter::render('richieste');
        }
    }

    public static function rifiuta_richiesta()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";

        $request_data['partecipante'] = $_SESSION['utente']['id'];

        $request_POST = explode(" ", $_POST['id']);

        $request_data['attivita'] = $request_POST[0];
        $request_data['data_attivita'] = $request_POST[1];
        $request_data['ora_inizio'] = $request_POST[2];

        $request = new richiesta($request_data);
        $request->refuse();

        $_SESSION['message'] = "Hai annullato la richiesta";

        self::visualizza_richieste();
    }

    public static function contatti_cicerone()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/utente.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";

        self::print_log($_SESSION['richieste'][$_POST['id']]['attivita']['cicerone']);

        $user = new utente;

        $result = $user->get_user($_SESSION['richieste'][$_POST['id']]['attivita']['cicerone']);

        $_SESSION['cicerone'] = json_decode($result, true);

        vista_globetrotter::render('cicerone');
    }

    public static function print_log($log)
    {
        echo '<pre>';
        print_r($log);
        echo '</pre>';
    }
}
