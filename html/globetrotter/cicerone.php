<?php
session_start();
$user_data = $_SESSION["utente"];
$cicerone_data = $_SESSION['cicerone'];
//echo '<pre>';print_r($_SESSION['risultato']);echo '</pre>';

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/activity.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.css" />
    <link rel="stylesheet" href="../../css/Control.FullScreen.css" />
    <script src="../../js/Control.FullScreen.js"></script>

    <style>
        #mymap {
            height: 250px;
            width: 450px;
            border-radius: 8px 8px 8px 8px;
            box-shadow: 0 0 2px rgba(0, 0, 0, .8);
        }
    </style>

</head>

<body style="background-color: #f8f9fa">
    <!--Navbar-->
    <?php include "nav.php";?>
    <!----fine navbar------>
    <!---Inzio homepage body-->
    <div class=container>
        <a href="richieste.php">
            <-Torna alle tue richieste</a> <h1 class="text-center">Contatti Cicerone</h1>
                <div class="profile_box1">
                    <div class="row">
                        <!--Fine box sinistro-->
                        <!--Box destro-->
                        <div class="col-md-12 col-lg-5 desc">
                            <div class="row line">
                                <div class="col-md-6 col-lg-6">
                                    <strong>Nome</strong>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <?php echo $_SESSION['cicerone']['nome'] ?>
                                </div>
                            </div>

                            <div class="row line">
                                <div class="col-md-6 col-lg-6">
                                    <strong>Cognome</strong>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?php echo $_SESSION['cicerone']['cognome']; ?>
                                </div>
                            </div>

                            <div class="row line">
                                <div class="col-md-6 col-lg-6">
                                    <strong>Email</strong>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?php echo $_SESSION['cicerone']['email'] ?>
                                </div>
                            </div>

                            <div class="row line">
                                <div class="col-md-6 col-lg-6">
                                    <strong>Numero di Telefono</strong>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?php echo $_SESSION['cicerone']['telefono'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                            <form method="POST" action="../utente/segnala_utente.php">
                                <button class="btn btn-danger btn-md edit">
                                    Segnala Utente
                                </button>
                                <input type="hidden" name="index" value="<?php echo $_SESSION['cicerone']['id']  . " " . $_SESSION['cicerone']['nome'] . " " . $_SESSION['cicerone']['cognome'] ." ". $_SESSION['cicerone']['segnalazioni']; ?>">
                            </form>
                        </div>
                        <!--Fine box destro-->

                    </div>

                </div>


                <!---Fine homepage body-->
</body>

</html>