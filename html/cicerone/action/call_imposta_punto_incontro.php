<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_attività.php");
    vista_attività::call_controller('imposta_punto_incontro');

?>