<?php
session_start();
$user_data = $_SESSION["utente"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />

    <!-- Load Leaflet from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>


    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.3.2/dist/esri-leaflet.js" integrity="sha512-6LVib9wGnqVKIClCduEwsCub7iauLXpwrd5njR2J507m3A2a4HXJDLMiSZzjcksag3UluIfuW1KzuWVI5n/cuQ==" crossorigin=""></script>


    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.css" integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.js" integrity="sha512-8twnXcrOGP3WfMvjB0jS5pNigFuIWj4ALwWEgxhZ+mxvjF5/FBPVd5uAxqT8dd2kUmTVK9+yQJ4CmTmSg/sXAQ==" crossorigin=""></script>

    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/punto_incontro.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/Control.FullScreen.css" />
    <link rel="stylesheet" href="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../../js/Control.FullScreen.js"></script>
    <script>
        $(document).ready(function() {
            $('#le_mie_richieste').addClass("disabled");
        });
    </script>

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

<body>
    <?php include("nav.php");

    ?>
    
    <div class="container">
    <a href="action/call_visualizza_richieste.php">
            <-Le mie richieste</a>
        <h3 class="text-center">Punto di incontro dell'attività "<?php echo $_POST['titolo'] ?>"</h3>

        <!-- contenitore della mappa -->
        <div class="row" id="maprow">
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
    <script>
        var lat = <?php echo $_POST['lat']; ?>;
        var lng = <?php echo $_POST['lng']; ?>;
        var map = L.map('mymap').setView([lat, lng], 15);
        var OSM_layer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker();

        L.marker([lat, lng]).addTo(map);
    </script>


</body>

</html>