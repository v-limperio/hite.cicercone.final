<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/controller/controllo_attività.php";

interface i_modifica_punto_incontro
{
    public static function start();
}

class modifica_punto_incontro extends controllo_attività implements i_modifica_punto_incontro
{
    public static function start()
    {
        require_once $_SERVER["DOCUMENT_ROOT"]."/hite.cicerone.io/model/attività.php";
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php";
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_attività/ricerca_attività.php";

        $_SESSION['modifica_incontro']['incontro_lat'] = $_POST['lat'];
        $_SESSION['modifica_incontro']['incontro_lng'] = $_POST['lng'];
        $_SESSION['modifica_incontro']['indirizzo_incontro'] = $_POST['indirizzo'];

        $activity = new attività;
        $activity->set_meeting_point($_SESSION['modifica']['id'], $_SESSION['modifica_incontro']);
        if(!$activity){
            $_SESSION['error']="Punto d'incontro non valido";
        }else{
            $_SESSION['message']="punto d'incontro modificato con successo";
            $_SESSION['modifica']['incontro_lat']= $_SESSION['modifica_incontro']['incontro_lat'];
            $_SESSION['modifica']['incontro_lng']= $_SESSION['modifica_incontro']['incontro_lng'];
            $_SESSION['modifica']['indirizzo_incontro']= $_SESSION['modifica_incontro']['indirizzo_incontro'];
            vista_attività::render('pagina_modifica_attività');
        }



    }
}