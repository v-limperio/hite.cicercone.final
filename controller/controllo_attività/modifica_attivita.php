<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/controller/controllo_attività.php";

interface i_modifica_attivita
{
    public static function start();
}

class modifica_attivita extends controllo_attività implements i_modifica_attivita
{
    public static function start()
    {
        session_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/model/attività.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_attività.php";

        // array che contiene i dati del profilo inseriti da modificare
        $fields = array();

        // carica la nuova immagine di profilo
        $img = 0;
        $activityfile_name = $_FILES['activityimg']['name'];
        $img = self::set_img($_SESSION["modifica"]["id"], $activityfile_name);

        // Ciclo per caricare i dati inseriti all'interno dell'array fields
        foreach ($_POST as $field => $value) {
            if ($value != '') {
                $fields[$field] = $value;
            }
        }
        print_r($fields);
        echo $img;
        if ($img != 0) {
            $fields["img_attivita"] = $img;

            // Modifica la sessione per l'immagine
            $_SESSION["modifica"]["img_attivita"] = $fields["img_attivita"];
            $activity = new attività;
            $activity->set_activity($_SESSION["modifica"]["id"], $fields);
        }
        $activity = new attività;

        //modifica i parametri della sessione utente per poterli visualizzare
        foreach ($_POST as $field => $value) {
            if ($value != '') {
                $_SESSION["modifica"][$field] = $value;
            }
        }

        $activity->set_activity($_SESSION["modifica"]["id"], $fields);
        $_SESSION['message']="Attività modificata con successo!";
        vista_attività::render('pagina_modifica_attività');

        vista_attività::render('pagina_modifica_attività');
    }

    private function set_img($id, $image)
    {
        if ($image != '') {
            echo $image;
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/img/activity_picture/";
            $userfile_tmp = $_FILES['activityimg']['tmp_name'];
            move_uploaded_file($userfile_tmp, $target_dir . $image);
            rename($target_dir . $image, $target_dir . $id . ".jpg");
            $img = 1;
        }
        return $img;
    }
}
