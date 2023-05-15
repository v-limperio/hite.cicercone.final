<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_visualizza_valutazioni{
        public static function start();
    }

    class visualizza_valutazioni extends controllo_utente implements i_visualizza_valutazioni{
        public static function start(){
            session_start();
            $user_data = $_SESSION["utente"];
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/attività.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/valutazione.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_utente.php";

            $activity['attivita'] = $_POST['id'];
            
            $review = new valutazione($activity);

            $result = $review->get();

            if (!$result) {
                $_SESSION['warning'] = "Nessuno valutazione effettuata";
                vista_utente::render('valutazioni');
            } else {
                $reviews_data[] = json_decode($result, true);
    
                $i = 0;
                foreach($reviews_data as $value){
                    while($i < count($value)){
                        $user = new utente;
                        $resultU[$i] = $user->get_user($value[$i]['utente']);
                        $result_activity[$i] = json_decode($resultU[$i], true);
                        echo'<pre>';print_r($result_activity[$i]);echo'</pre>';
                        $value[$i]['utente'] = $result_activity[$i] ;
                        $i++;
                    }
                }
                $_SESSION['valutazione'] = $value;
                vista_utente::render('valutazioni');
            }
    

        }
    }
?>