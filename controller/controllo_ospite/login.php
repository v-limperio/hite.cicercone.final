<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/controller/controllo_ospite.php";

interface i_login
{
    public static function start();
}

class login extends controllo_ospite implements i_login
{
    public static function start()
    {
        session_start();

        require_once($_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/model/utente.php");
        require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_ospite.php";
        require_once($_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_utente.php");

        $_SESSION["email"] = $_POST["email"];
        $_SESSION["password"] = $_POST["password"];

        if (empty($_SESSION["email"]) || empty($_SESSION["password"])) {
            $_SESSION["error"] = "Errore: Non è stato inserito nulla";
            vista_ospite::render('login');
        }

        $user = new utente;
        $auth = $user->get_auth($_SESSION["email"], $_SESSION["password"]);

        if (!$auth) {
            $_SESSION['error'] = "ERRORE: Credenziali errate!";
            vista_ospite::render('login');
        } else {
            $_SESSION["utente"] = json_decode($auth, true);

            if ($_SESSION['utente']['segnalazioni'] > 10) {
                $_SESSION['error'] = "ERRORE: Impossibile procedere per le eccessive segnalazioni";
                vista_ospite::render('login');
            } else {


                if (isset($_SESSION["error"])) {
                    unset($_SESSION["error"]);
                }

                vista_utente::render('homepage');
            }
        }
    }
}
