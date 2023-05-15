<?php
session_start();
$user_data = $_SESSION["utente"];
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
    <?php include "nav.php" ?>
    <!----fine navbar------>
    <!---Inzio homepage body-->
    <div class=container style="margin-bottom:8rem;">
        <a href="risultati.php">
            <-Torna ai risultati</a> <h1 class="text-center"><?php echo $_SESSION['visualizza']['titolo']; ?></h1>
                <div class="profile_box1">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <!--Box sinistro-->
                            <img src="../../img/activity_picture/<?php if ($_SESSION['visualizza']['img_attivita'] == 1) {
                                                                        echo $_SESSION['visualizza']['id'];
                                                                    } else {
                                                                        echo 'background';
                                                                    }; ?>.jpg" alt="..." class="img-thumbnail">
                            <!------------------------------>
                        </div>
                        <!--Fine box sinistro-->
                        <!--Box destro-->
                        <div class="col-md-12 col-lg-5 desc">
                            <div class="row line">
                                <div class="col-md-6 col-lg-6">
                                    <strong>Tipologia</strong>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <?php echo $_SESSION['visualizza']['tipologia'] ?>
                                </div>
                            </div>

                            <div class="row line">
                                <div class="col-md-6 col-lg-6">
                                    <strong>Indirizzo Incontro</strong>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?php echo $_SESSION['visualizza']['indirizzo_incontro']; ?>
                                </div>
                            </div>

                            <div class="row line">
                                <div class="col-md-6 col-lg-6">
                                    <strong>Lingua Parlata</strong>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?php echo $_SESSION['visualizza']['lingua_parlata'] ?>
                                </div>
                            </div>

                            <div class="row line">
                        <div class="col-md-6 col-lg-6">
                            <i class="fa fa-thumbs-up"></i>
                            <p><?php echo $_SESSION['visualizza']['votipositivi'];?></p>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <i class="fa fa-thumbs-down"></i>
                            <p><?php echo $_SESSION['visualizza']['votinegativi'];?></p>
                         </div>
                    </div>
                        </div>
                        <!--Fine box destro-->

                    </div>

                    <div class="row line">
                        <div class="col-md-3 col-lg-3">
                            <strong>Descrizione</strong>
                        </div>

                        <div class="col-md-9 col-lg-9">
                            <?php echo  $_SESSION['visualizza']['descrizione'] ?>
                        </div>
                    </div>

                    <div class="row line">
                        <div class="col-md-6 col-lg-6">
                            <strong>Punto incontro</strong>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div id="mymap" class="leaflet-container leaflet-fade-anim" tabindex="0" style="position: relative;">
                                <div class="leaflet-map-pane" style="transform: translate3d(-241px, 0px, 0px);">
                                    <div class="leaflet-tile-pane">
                                        <div class="leaflet-layer">
                                            <div class="leaflet-tile-container"></div>
                                            <div class="leaflet-tile-container leaflet-zoom-animated"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row line">
                    <div class="offset-md-1 col-sm-6 col-md-2 col-lg-2 align-self-end">
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#itinerarioModal" <?php if (!isset($_SESSION['itinerario']))                                                                                                   echo "disabled"; ?>>Itinerario</button>
                    </div>

                    <form method="POST" action="../utente/tmp/call_visualizza_valutazioni.php">
                    <input class="btn btn-primary btn-lg" type="submit" name="action" value="Valutazioni">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['visualizza']['id'] ?>">
                </form>

                </div>
                

                <!--- PER MARCO!!!!! DA USARE PER IL MODAL SE ISSET $_SESSION['itinerario'] TASTO NON CLICCABILE-->

                <div class="modal fade" id="itinerarioModal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Itinerario</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row line">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6"><strong>Luogo</strong></div>
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6"><strong>Descrizione</strong></div>
                                    </div>
                                    <?php include "root_table.php"; ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Chiudi</button>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
    <script>
        var lat = <?php echo $_SESSION['visualizza']['incontro_lat']; ?>;
        var lng = <?php echo $_SESSION['visualizza']['incontro_lng']; ?>;
        var map = L.map('mymap').setView([lat, lng], 15);
        var OSM_layer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        L.marker([lat, lng]).addTo(map)

        marker = new L.Marker(e.latlng).addTo(map);
        map.addLayer(marker);
    </script>

    <!---Fine homepage body-->
</body>

</html>