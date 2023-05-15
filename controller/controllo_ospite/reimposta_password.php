<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_ospite.php";
    interface i_reimposta_password{
        public static function start();
    }
    class reimposta_password extends controllo_ospite implements i_reimposta_password{
        public static function start(){
        session_start();
        $fields = array();
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite.php";
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";

        $_SESSION["codice_inserito"] = $_POST["codice_inserito"];
        $_SESSION["password"] = $_POST["password"];
        $_SESSION["ctrlpassword"] = $_POST["ctrlpassword"];


        //Confronto le due password inserite
        if($_SESSION["password"] != $_SESSION["ctrlpassword"]){
            $_SESSION["error"] = "Errore le due password non coincidono";
            vista_ospite::render("mail_inviata");
        }

        //Controllo che il codice generato randomicamente sia uguale a quello digitato
        if($_SESSION["codice"] != $_SESSION["codice_inserito"]){
            $_SESSION["error"] = "Errore il codice di recupero e' errato";
            vista_ospite::render("mail_inviata");
        }
        else{
            $user = new utente;
            $result=$user->get_password($_SESSION["id"], $_SESSION["password"]);
        }
        

        //controllo della password precedente con quella nuova se non e' uguale la modifica
        if(!$result){
            $fields["psw"] = $_SESSION["password"];
            $user->set_user($_SESSION["id"], $fields);
            $_SESSION['message']="Password modificata con successo!";
            vista_ospite::render("login");
        }

        else{
            $_SESSION["error"] = "Errore la password inserita e' uguale a quella precedente";
            vista_ospite::render("mail_inviata");
        }
    }
}
?>