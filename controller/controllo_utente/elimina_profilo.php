<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_utente.php";

    interface i_elimina_profilo{
        public static function start();
    }

    class elimina_profilo extends controllo_utente implements i_elimina_profilo{
        public static function start(){
            session_start();
            $user_data = $_SESSION["utente"];
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite.php";


            $user = new utente;
            //rimuove l'utente
            $user->delete_user($user_data["id"]);

            //rimuove l'immagine di profilo
            self::delete_img($user_data["id"]);
            
            $_SESSION['message'] = "Il profilo è stato eliminato con successo!";
            //notifica l'eliminazione
            vista_ospite::render('login');
        }

        private static function delete_img($id){
            $deleted_img = $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/img/profile_picture/$id.jpg";
            if(file_exists($deleted_img)){
                unlink($deleted_img);
            }
        }
    }
?>