<?php 
class controllo_richieste
{
    public static function visualizza_richieste(){
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_cicerone.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/utente.php";
        unset($_SESSION['richieste']);

        $schedulePOST = explode(" ", $_POST['id']);
        $schedule_data['attivita'] = $schedulePOST[0];
        $schedule_data['data_attivita'] = self::change_date_format($schedulePOST[1], "Y-m-d");
        $schedule_data['ora_inizio'] = $schedulePOST[2];

        $_SESSION['date_richieste'] = $schedule_data;

        $request = new richiesta($schedule_data);

        $result = $request->get();

        if(!$result){
            $_SESSION['warning'] = "Nessuno ha fatto ancora richiesta";
            vista_cicerone::render('richieste');
        }
        else{
            $globetrotter_data[] = json_decode($result,true);
            
            $i=0;
            foreach($globetrotter_data as $globetrotter){
                while($i < count($globetrotter)){
                    $user = new utente;
                    $resultU[$i] = $user->get_user($globetrotter[$i]['partecipante']);
                    $result_user[$i] = json_decode($resultU[$i], true);
                    $globetrotter[$i]['partecipante'] = $result_user[$i];
                    self::print_log($result_user);

                    $i++;

                }
            }
            $_SESSION['richieste'] = $globetrotter;
            vista_cicerone::render('richieste');
        }
    }

    public static function accetta_richiesta(){
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_cicerone.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";

        $_SESSION['richieste'][$_POST['id']]['accettazione'] = 1;
        self::print_log($_SESSION['richieste']);

        $request_data['partecipante'] = $_SESSION['richieste'][$_POST['id']]['partecipante']['id'];
        $request_data['attivita'] = $_SESSION['richieste'][$_POST['id']]['attivita'];
        $request_data['data_attivita'] = $_SESSION['richieste'][$_POST['id']]['data_attivita'];
        $request_data['ora_inizio'] = $_SESSION['richieste'][$_POST['id']]['ora_inizio'];

        $request = new richiesta($request_data);
        $request->accept();

        $_SESSION['message'] = "Richiesta Accettata";
        vista_cicerone::render('richieste');
    }

    public static function rifiuta_richiesta(){
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_cicerone.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/richiesta.php";

        $request_data['partecipante'] = $_SESSION['richieste'][$_POST['id']]['partecipante']['id'];
        $request_data['attivita'] = $_SESSION['richieste'][$_POST['id']]['attivita'];
        $request_data['data_attivita'] = $_SESSION['richieste'][$_POST['id']]['data_attivita'];
        $request_data['ora_inizio'] = $_SESSION['richieste'][$_POST['id']]['ora_inizio'];

        $request = new richiesta($request_data);
        $request->refuse();

        if($_POST['id'] != 0){
            unset($_SESSION['richieste'][$_POST['id']]);
        }
        else{
            unset($_SESSION['richieste']);
        }

        $_SESSION['message'] = "Richiesta Rifiutata";
        vista_cicerone::render('richieste');
    }

    private static function change_date_format($date, $format){
        $old_date = $date;
        $new_date = strtr($old_date, '/', '-');
        $final_date = date($format, strtotime($new_date));
        return $final_date;
    }

    public static function print_log($log)
    {
        echo '<pre>';
        print_r($log);
        echo '</pre>';
    }

}
