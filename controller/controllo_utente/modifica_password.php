<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_modifica_password{
        public static function start();
    }

    class modifica_password extends controllo_utente implements i_modifica_password{
        public static function start(){
            session_start();
            unset($_SESSION["error"]);
            require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php");
            require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_utente.php");
            
            // array che contiene la password 
            $fields = array();

            // Assegna le variabili utilizzate per il controllo
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["oldpassword"] = $_POST["oldpassword"];

            //controlla se la nuova password è uguale a quella precedente
            if($_SESSION["password"] == $_SESSION["oldpassword"]){
                $_SESSION["error"] = "ERRORE: La nuova password è uguale a quella precedente";
                vista_utente::render('modifica_profilo');
            }

            //altrimenti controlla che la password è corretta 
            else{
                $user = new utente;
                $result = $user->get_password($_SESSION['utente']["id"], $_SESSION["oldpassword"]);

                //controlla se la password precedente è inserita correttamente
                if(!$result){
                    $_SESSION["error"] = "ERRORE: La password precedente è errata";
                    vista_utente::render('modifica_profilo');
                }

                else{
                    // Carica la password
                    $fields["psw"] = $_SESSION["password"];

                    $_SESSION['message'] = "Password Modificata con successo!";
                    // infine modifica
                    $user->set_user($_SESSION['utente']["id"], $fields);
                    vista_utente::render('modifica_profilo');
                }
            }
        }
    }
?>
