<?php 
    if(isset($_SESSION["error"])){
        echo'<div class="form-group">
            <div class ="alert alert-danger" role="alert">
                '.$_SESSION["error"].'
            </div>
        </div>';
    }
    //Quando ricarichi la pagina l'errore scompare
    unset($_SESSION['error']);

    if(isset($_SESSION["message"])){
        echo'<div class="form-group">
            <div class ="alert alert-primary" role="alert">
                '.$_SESSION["message"].'
            </div>
        </div>';
    }
     //Quando ricarichi la pagina l'errore scompare
     unset($_SESSION['message']);

    if(isset($_SESSION["warning"])){
        echo'<div class="form-group">
            <div class ="alert alert-info" role="alert">
                '.$_SESSION["warning"].'
            </div>
        </div>';
    }
    //Quando ricarichi la pagina l'errore scompare
    unset($_SESSION['warning']);
?>