<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_ospite.php";

    interface i_registrazione{
        public static function start();
    }

    class registrazione extends controllo_ospite implements i_registrazione{
        public static function start(){
            session_start();
            require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php");
            require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite.php");
            
            //prelevo email e password
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["password"] = $_POST["password"];

            //controllo se la mail è già utilizzata
            $user = new utente;
            $result = $user->get_email($_SESSION["email"]);

            //Se la mail non risulta utilizzata
            if(!$result){
                vista_ospite::render('crea_profilo');
            }

            //...altrimenti
            else{
                $_SESSION["error"] = "ERRORE: Mail già utilizzata";
                vista_ospite::render('registrazione');
            }
        }
    }
?>