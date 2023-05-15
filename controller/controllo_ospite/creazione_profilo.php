<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_ospite.php";

    interface i_creazione_profilo{
        public static function start();
    }

    class creazione_profilo extends controllo_ospite implements i_creazione_profilo{
        public static function start(){
            session_start();
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite.php";
 
            $user = new utente;
 
            // array che contiene i dati del profilo inseriti
            $fields = array();
 
            // creazione chiave primaria
            $fields["id"] = self::create_id($user);
 
            //carico email e password
            $fields["email"] = $_SESSION["email"];
            $fields["psw"] = $_SESSION["password"];
 
             // raccolta dati profilo
             foreach($_POST as $field => $value){
                 if($value != ''){
                     $fields[$field] = $value;
                 } 
             }
 
            //Caricamento immagine profilo
            $userfile_name = basename($_FILES['profileimg']['name']);
            $img = self::set_img($fields["id"], $userfile_name);
            
            $fields["imgProfilo"] = $img;

            //creazione utente
            $user->create_user($fields);
            $_SESSION['message'] = "Il profilo è stato creato. Ora puoi eseguire l'accesso.";
            vista_ospite::render('login');
         }
 
        private static function create_id($user){
            $result = true;
            while($result != false){
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $id = substr(str_shuffle($permitted_chars), 0, 5);
                $result = $user->get_user($id);
            }
            return $id;
         }
 
        private static function set_img($id, $image){
            $img = 0;
            if($image != ''){
                $target_dir = $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/img/profile_picture/";
                $userfile_tmp = $_FILES['profileimg']['tmp_name'];
                move_uploaded_file($userfile_tmp, $target_dir . $image);
                rename($target_dir . $image, $target_dir .$id.".jpg");
                $img = 1;
            }
            return $img;
        }
    }
?>