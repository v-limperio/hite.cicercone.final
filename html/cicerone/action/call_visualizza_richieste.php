<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_cicerone.php");
    vista_cicerone::call('controllo_richieste', 'visualizza_richieste');
?>