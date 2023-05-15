<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_modifica_profilo{
        public static function start();
    }

    class modifica_profilo extends controllo_utente implements i_modifica_profilo{
        public static function start(){
            session_start();
            $user_data = $_SESSION["utente"];
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_utente.php";

            // array che contiene i dati del profilo inseriti da modificare
            $fields = array();
            
            // carica la nuova immagine di profilo
            $img = 0;
            $userfile_name = $_FILES['profileimg']['name'];
            $img = self::set_img($user_data["id"], $userfile_name);

            // Ciclo per caricare i dati inseriti all'interno dell'array fields
            foreach($_POST as $field => $value){
                if($value != ''){
                    $fields[$field] = $value;
                }
            }
            
            // controlla se la scheda è non è stata compilata per niente
            if(count($fields) == 0 AND $img == 0){
                $_SESSION["error"] = "ERRORE: La scheda di modifica non è stata compilata";
                vista_utente::render('modifica_profilo');
            }

            // controlla se è stata caricata unicamente l'immagine di profilo
            elseif(count($fields) == 0 AND $img != 0){
                $fields["imgProfilo"] = $img;

                // Modifica la sessione per l'immagine
                $_SESSION["utente"]["imgProfilo"] = $fields["imgProfilo"];

                $user = new utente;
                $user->set_user($user_data["id"], $fields);
                vista_utente::render('modifica_profilo');
            }

            //altrimenti modifica
            else{
                $user = new utente;

                //modifica i parametri della sessione utente per poterli visualizzare
                foreach($_POST as $field => $value){
                    if($value != ''){
                        $_SESSION["utente"][$field] = $value;
                    }
                }

                $_SESSION['message'] = "Profilo Modificato con successo!";
                $user->set_user($user_data["id"], $fields);
                vista_utente::render('modifica_profilo');
            }
        }

        private function set_img($id, $image){
            if($image != ''){
                $target_dir = $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/img/profile_picture/";
                $userfile_tmp = $_FILES['profileimg']['tmp_name'];
                move_uploaded_file($userfile_tmp, $target_dir . $image);
                rename($target_dir . $image, $target_dir . $id.".jpg");
                $img = 1;
            }
        return $img;
        }
    }

?>