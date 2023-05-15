<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="../../css/chisiamo.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#who').addClass("disabled");
        });
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.css" />

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
    <?php include "nav_bar.php" ?>
    <div class="container">
        <h1 style="text-align: center; color: #505e6c">Team CicerOne</h1>

        <div class="row">

            <div class="col-lg-4">
                <div class="span4">
                    <aside>
                        <h4>Mettiti in contatto con noi: </h4>
                        <ul>
                            <li><label><strong>Telefono: </strong></label>
                                <p> 099 888 707 123 </p>
                            </li>
                            <li><label><strong>Email commerciale: </strong></label>
                                <p> cicerone@localhost.it </p>
                            </li>
                            <li><label><strong>Indirizzo: </strong></label>
                                <p> 1 Via De Gasperi Alcide, Taranto, TA 74123 </p>
                            </li>
                        </ul>
                    </aside>
                </div>
            </div>



            <div class="col-lg-8">
                <!-- contenitore della mappa -->
                <div id="mymap" class="leaflet-container leaflet-fade-anim mymap" tabindex="0" style="position: relative;">
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
            var map = L.map('mymap').setView([40.527086, 17.283743], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker();

            L.marker([40.527086, 17.283743]).addTo(map)
        </script>


        <div class="row" style="margin-top:2rem;">
            <div class="figure col-lg-1">
                <img src="../../img/vittorio.jpg" class="figure-img img-fluid rounded" alt="foto di Vittorio">
            </div>
            <div class="col-lg-2">
                <p><b>Vittorio L'imperio</b><br>Abile programmatore in PHP, C++, #C, HTML.<br>Esperto Back-End.</p>
            </div>
            <div class="figure col-lg-1">
                <img src="../../img/marco.jpg" class="figure-img img-fluid rounded" alt="foto di Marco">
            </div>
            <div class="col-lg-2">
                <p><b>Marco Carone</b><br>Abile programmatore in PHP, C++, #C, HTML.<br>Esperto Debugger.</p>
            </div>
            <div class="figure col-lg-1">
                <img src="../../img/pierluigi.jpg" class="figure-img img-fluid rounded" alt="foto di Pierluigi">
            </div>
            <div class="col-lg-2">
                <p><b>Pierluigi Bemportato</b><br>Abile programmatore in PHP, C++, #C, HTML.<br>Esperto Front-End.</p>
            </div>
            <div class="figure col-lg-1">
                <img src="../../img/andrea.jpg" class="figure-img img-fluid rounded" alt="foto di Andrea">
            </div>
            <div class="col-lg-2">
                <p><b>Andrea De Felice</b><br> Abile programmatore in PHP, C++, #C, HTML.</p>
            </div>
        </div>
    </div>

</body>

</html>