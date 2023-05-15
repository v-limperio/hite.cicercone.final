<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività.php";

    interface i_creazione_attività{
        public static function start();
    }

    class creazione_attività extends controllo_attività implements i_creazione_attività{
        public static function start(){
            session_start();
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
                
            //genera la chiave primaria
            $_SESSION['crea_attività']['id'] = self::create_id();
            $_SESSION['crea_attività']['cicerone'] = $_SESSION['utente']['id'];
            
            //Memorizza i dati inseriti dal cicerone
            // raccolta dati attività
            foreach($_POST as $field => $value){
                if($value != ''){
                    $_SESSION['crea_attività'][$field] = $value;
                }
            }

            //memorizza l'immagine all'interno del server
            $activityfile_name = basename($_FILES['activityimg']['name']);
            self::set_img($_SESSION['crea_attività']['id'], $activityfile_name);
           

            //passa alla mappa per impostare il punto di incontro
            vista_attività::render('meeting_map');
        }

        private static function create_id(){
            require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/attività.php";
            
            $result = true;
            $activity = new attività;

            while($result != false){
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $id = substr(str_shuffle($permitted_chars), 0, 5);
                $result = $activity->get_activity_by_id($id);
            }

            return $id;
        }

        private static function set_img($id, $image){
            $img = 0;

            if($image != ''){
                $target_dir = $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/img/activity_picture/";
                $userfile_tmp = $_FILES['activityimg']['tmp_name'];
                move_uploaded_file($userfile_tmp, $target_dir . $image);
                rename($target_dir . $image, $target_dir .$id.".jpg");
                $img = 1;
            }

            $_SESSION['crea_attività']['img_attivita'] = $img; 
        }
    }


?>