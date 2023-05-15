<?php 
class controllo_valutazione{

    public static function inserisci_valutazione(){
        session_start();
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/valutazione.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/attività.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";

        $review_data['utente'] = $_SESSION['utente']['id'];
        $review_data['attivita'] = $_SESSION['activity_review'];

        if($_POST['voto'] == "Positiva"){
            $review_data['voto'] = '1';
        }
        else{
            $review_data['voto'] = '0';
        }

        $review_data['recensione'] = $_POST['recensione'];    
        self::print_log($review_data);
        
        $review = new valutazione($review_data);
        $review->set();

        $_SESSION['message'] = "L'attività è stata valutata con successo!";
        self::elenco_valutazioni();        
    }

    public static function modifica_valutazione(){
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/valutazione.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/attività.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";

        $review_data['utente'] = $_SESSION['utente']['id'];
        $review_data['attivita'] = $_SESSION['activity_review'];
        $review_data['recensione'] = $_POST['recensione'];

        if(isset($_POST['voto'])){
            if($_POST['voto'] == "Positiva"){
                $review_data['voto'] = '1';
            }
            else{
                $review_data['voto'] = '0';
            }
        }
        self::print_log($_POST['voto']);


        $review = new valutazione($review_data);
        $review->set();

        $_SESSION['message'] = "La valutazione è stata modificata con successo!";
        self::elenco_valutazioni(); 
    }

    public static function elimina_valutazione(){
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/valutazione.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/attività.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";

        $review_data['utente'] = $_SESSION['utente']['id'];
        $review_data['attivita'] = $_SESSION['valutazione'][$_POST['id']]['attivita']['id'];

        $review = new valutazione($review_data);
        $review->delete();

        $_SESSION['message'] = "La valutazione è stata eliminata con successo!";
        self::elenco_valutazioni(); 
    }


    public static function elenco_valutazioni(){
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_globetrotter.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/valutazione.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/hite.cicerone.io/model/attività.php";

        $review_data['utente'] = $_SESSION['utente']['id'];

        $review = new valutazione($review_data);

        $result = $review->get();

        if (!$result) {
            $_SESSION['warning'] = "Nessuna valutazione effettuata";
            vista_globetrotter::render('valutazioni');
        } else {
            $reviews_data[] = json_decode($result, true);

            $i = 0;
            foreach($reviews_data as $value){
                while($i < count($value)){
                    $activity = new attività;
                    $resultA[$i] = $activity->get_activity_by_id($value[$i]['attivita']);
                    $result_activity[$i] = json_decode($resultA[$i], true);
                    $value[$i]['attivita'] = $result_activity[$i] ;
                    self::print_log($value);
                    $i++;
                }
            }
            $_SESSION['valutazione'] = $value;
            vista_globetrotter::render('valutazioni');
        }
    }


    public static function print_log($log)
    {
        echo '<pre>';
        print_r($log);
        echo '</pre>';
    }
}
