<?php
interface i_controllo_presenze
{
}

class controllo_presenze implements i_controllo_presenze
{
    public static function elenco_presenze()
    {
        session_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_cicerone.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/utente.php";

        $_SESSION['date_presenze'] = $_SESSION['orario'][$_POST['index']];

        $request_data['attivita'] = $_SESSION['orario'][$_POST['index']]['attivita'];
        $request_data['data_attivita'] = $_SESSION['orario'][$_POST['index']]['data_attivita'];
        $request_data['ora_inizio'] = $_SESSION['orario'][$_POST['index']]['ora_inizio'];
        $request_data['accettazione'] = '1';


        $request = new richiesta($request_data);

        $result = $request->get();

        if (!$result) {
            $_SESSION['warning'] = "Nessuno ha fatto ancora richiesta";
            vista_cicerone::render('presenze');
        } else {
            $globetrotter_data[] = json_decode($result, true);

            $i = 0;
            foreach ($globetrotter_data as $globetrotter) {
                while ($i < count($globetrotter)) {
                    $user = new utente;
                    $resultU[$i] = $user->get_user($globetrotter[$i]['partecipante']);
                    $result_user[$i] = json_decode($resultU[$i], true);
                    $globetrotter[$i]['partecipante'] = $result_user[$i];
                    self::print_log($result_user);

                    $i++;
                }
            }
            $_SESSION['presenze'] = $globetrotter;
            vista_cicerone::render('presenze');
        }
    }


    public static function segna_presenza(){

        session_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_cicerone.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/valutazione.php";

        $request_data['partecipante'] = $_SESSION['presenze'][$_POST['index']]['partecipante']['id'];
        $request_data['attivita'] = $_SESSION['presenze'][$_POST['index']]['attivita'];
        $request_data['data_attivita'] = $_SESSION['presenze'][$_POST['index']]['data_attivita'];
        $request_data['ora_inizio'] = $_SESSION['presenze'][$_POST['index']]['ora_inizio'];

        $request = new richiesta($request_data);
        $request->set_attendance();

        $review_data['utente'] = $request_data['partecipante'];
        $review_data['attivita'] = $request_data['attivita'];

        $review = new valutazione($review_data);
        $review->create();

        unset($_SESSION['error']);

        $_SESSION['presenze'][$_POST['index']]['presenza'] = 1;
        $_SESSION['message'] = "Presenza segnata";

        vista_cicerone::render('presenze');
    }


    public static function segna_assenza(){

        session_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_cicerone.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";


        $request_data['partecipante'] = $_SESSION['presenze'][$_POST['index']]['partecipante']['id'];
        $request_data['attivita'] = $_SESSION['presenze'][$_POST['index']]['attivita'];
        $request_data['data_attivita'] = $_SESSION['presenze'][$_POST['index']]['data_attivita'];
        $request_data['ora_inizio'] = $_SESSION['presenze'][$_POST['index']]['ora_inizio'];

        $request = new richiesta($request_data);
        $request->refuse();

        unset($_SESSION['presenze'][$_POST['index']]);
        $_SESSION['message'] = "Assenza segnata";

        vista_cicerone::render('presenze');
    }

    
    public static function print_log($log)
    {
        echo '<pre>';
        print_r($log);
        echo '</pre>';
    }
}
