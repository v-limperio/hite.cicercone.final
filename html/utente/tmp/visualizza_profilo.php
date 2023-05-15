<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite/signin.php");
    if(isset($_SESSION['utente'])) {
        require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_utente/pagina_profilo.php");
        $result = pagina_profilo::call_controller_function();
    }
    else{
        require_once($_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite/signin.php");
        signin::render('login');
    }
?>