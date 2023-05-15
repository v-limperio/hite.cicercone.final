<?php
session_start();
$user_data = $_SESSION["utente"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="icona.gif" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/activity.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#le_mie_attività').addClass("disabled");
        });
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.css" />
    <link rel="stylesheet" href="../../css/Control.FullScreen.css" />
    <script src="../../js/Control.FullScreen.js"></script>

    <style>
        .mymap {
            height: 18rem;
            width: 80%;
            border-radius: 8px 8px 8px 8px;
            box-shadow: 0 0 2px rgba(0, 0, 0, .8);
            margin: auto;
        }
    </style>
</head>

<body style="background-color: #f8f9fa">
    <!--Navbar-->
    <?php
    include('nav.php');
    ?>
    <!----fine navbar------>
    <!---Inzio homepage body-->
    <h2 style="margin-left:10%;"><strong>Attività disponibili</strong></h2>
    <div class=container>

        <?php
        include "../log/error.php";

        if (isset($_SESSION['attività'])) {
            require_once "print_activities.php";
        }
        ?>
    </div>

    <!---Fine homepage body-->
</body>

</html>