<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_globetrotter.php");
    vista_globetrotter::call('controllo_valutazione','elimina_valutazione');
?>