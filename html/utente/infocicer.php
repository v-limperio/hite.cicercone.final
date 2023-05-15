<?php
session_start();
$user_data = $_SESSION["utente"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/login.css" />
    <link rel="stylesheet" href="../../css/infocicer.css" />
    <link href="../../css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#info').addClass("disabled");
        });
    </script>
</head>
<body style="background-color: #f8f9fa">
   <!--Navbar-->
   <?php include "nav.php"?>

    <div class="container" style="background-color: #FFFFFF">
        <div class="row">
            <div class="col-lg-6">
                <h1>CicerOne™</h1>
                <p>CicerOne è una piattaforma di riferimento per la creazione di attività a scopo turistico da parte dei ciceroni, alle quali i globetrotter interessati possono fare richiesta di partecipazione che sarà in seguito accettata o rifiutata dal cicerone che l’ha creata.</p>
                <h2>I nostri obiettivi:</h2>
                <li>Favorire il low cost travelling</li>
                <li>Regalarsi un’esperienza di viaggio poco standardizzata e scarsamente conformista</li>
                <li>Incentivare gli incontri interculturali</li>
                <li>Conoscere un luogo a 360° evitando le attrazioni ed attività mainstream</li>
            </div>

            <div class="col-lg-6">
                <img src="../../img/background.jpg" class="infbg">
            </div>
        </div>

    <!--Footer-->
    <footer class="footer">
        <div class="row">
            <div class="col-lg-3">
                <img src="../../img/cicerOne.png" class="imgfooter">
            </div>
            <div class="col-lg-2 offset-lg-5">
                <br><br><strong>Support: </strong><br> support@cicerone.it
            </div>

            <div class="col-lg-2">
                <br><strong>Indirizzo:</strong>
		        <br>Via Alcide De Gasperi, 1<br>
		        Taranto, TA, 74123<br>
                099 888 707 123<br>
            </div>
        </div>
    </footer>

</body>
</html>