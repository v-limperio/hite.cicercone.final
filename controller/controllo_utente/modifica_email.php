<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_modifica_email{
        public static function start();
    }

    class modifica_email extends controllo_utente implements i_modifica_email{
        public static function start(){
            session_start();
            unset($_SESSION["error"]);
            
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_utente.php";

            // array che contiene la mail da modificare
            $fields = array();

            // Assegna le variabili utilizzate per il controllo
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["email"] = $_POST["email"];
            
            $user = new utente;
            // controlla la password corretta
            self::check_password($user);

            //passato il controllo convalida la mail se disponibile
            self::is_email_valid($user, $fields);

            //Ora che tutto va bene modifica
            $user->set_user($_SESSION['utente']["id"], $fields); 
            $_SESSION['message'] = "Email modificato con successo!";
            vista_utente::render('modifica_profilo');
        }

        private static function check_password($user){
            $user_data = $_SESSION["utente"];
            
            //controlla se la password inserita è corretta
            $result = $user->get_password($user_data["id"], $_SESSION["password"]);

            //se la password risulta errata
            if(!$result){
               $_SESSION["error"] = "ERRORE: Password Errata !";
               vista_utente::render('modifica_profilo'); die();
            }

            else{
               unset($_SESSION["error"]);
            }
        }

        private static function is_email_valid($user){

            //controlla se la mail è valida
            $result = $user->get_email($_SESSION["email"]);

            if(!$result){
                unset($_SESSION["error"]);
                $_SESSION["utente"]["email"] = $_SESSION["email"];
            }
            
            else{
                $_SESSION["error"] = "ERRORE: Mail già utilizzata!";
                vista_utente::render('modifica_profilo'); die();
            }
        }
    }
?>