<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php");
    vista_attività::render('modifica_punto_incontro');

?>