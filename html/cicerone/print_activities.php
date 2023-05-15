<?php $i = 0;
foreach ($_SESSION['attività'] as $activity) {

?>
    <div class="container" style="margin-bottom:8rem;">
        <h1 class="text-center" style="overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;"><?php echo $activity['titolo']; ?></h1>
        <div class="profile_box1">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <!--Box sinistro-->
                    <img src="../../img/activity_picture/<?php if ($activity['img_attivita'] == 1) {
                                                                echo $activity['id'];
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
                            <?php echo $activity['tipologia'] ?>
                        </div>
                    </div>

                    <div class="row line">
                        <div class="col-md-6 col-lg-6">
                            <strong>Indirizzo Incontro</strong>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <?php echo $activity['indirizzo_incontro']; ?>
                        </div>
                    </div>

                    <div class="row line">
                        <div class="col-md-6 col-lg-6">
                            <strong>Lingua Parlata</strong>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <?php 
                            if($activity['lingua_parlata'] == 'it'){
                                echo "Italiana";
                            } elseif($activity['lingua_parlata'] == 'gb'){
                                echo "Inglese";
                            }
                            ?>
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
                    <?php echo  $activity['descrizione'] ?>
                </div>
            </div>

            <div class="row line">
                <div class="col-md-6 col-lg-6">
                    <strong>Punto incontro</strong>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div id="mymap<?php echo $i; ?>" class="leaflet-container leaflet-fade-anim mymap" tabindex="0" style="position: relative;">
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
        <script>
            var lat = <?php echo $activity['incontro_lat']; ?>;
            var lng = <?php echo $activity['incontro_lng']; ?>;
            var map = L.map('mymap<?php echo $i; ++$i;?>').setView([lat, lng], 15);
            var OSM_layer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

            var marker = L.marker();

            L.marker([lat, lng]).addTo(map)

            marker = new L.Marker(e.latlng).addTo(map);
        </script>
        <div class="row line end">

            <div class="col-sm">
                <form method="POST" action="action/call_visualizza_itinerario.php">
                    <input class="btn btn-primary btn-lg" type="submit" name="action" value="Itinerario">
                    <input type="hidden" name="id" value="<?php echo $activity['id'] ?>">
                </form>
            </div>

            <div class="col-sm">
                <form method="POST" action="action/call_ricerca_orario.php">
                    <input class="btn btn-primary btn-lg" type="submit" name="action" value="Gestione Orario">
                    <input type="hidden" name="id" value="<?php echo $activity['id'] ?>">
                </form>
            </div>

            <div class="col-sm">
                <form method="POST" action="pagina_modifica_attività.php">
                    <input class="btn btn-primary btn-lg" type="submit" name="action" value="Modifica">
                    <input type="hidden" name="id" value="<?php echo $activity['id'] ?>">
                </form>

            </div>

            <div class="col-sm">
                <form method="POST" action="../utente/tmp/call_visualizza_valutazioni.php">
                    <input class="btn btn-primary btn-lg" type="submit" name="action" value="Valutazioni">
                    <input type="hidden" name="id" value="<?php echo $activity['id'] ?>">
                </form>
            </div>

            <div class="col-sm">
                <form method="POST" action="action/call_annulla_attività.php">
                    <button type="button" class="btn btn-outline-danger btn-lg" data-toggle="modal" data-target="#delete-modal_<?php echo $activity['id'] ?>">Elimina</button>
                    <input type="hidden" name="id" value="<?php echo $activity['id'] ?>">
            </div>

            <div class="modal fade" id="delete-modal_<?php echo $activity['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class=modal-content>
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-modal-title">Elimina Attività</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Sei sicuro di voler eliminare l'attività: "<?php echo $activity['titolo']; ?>"?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            <button type="submit" class="btn btn-danger">Si confermo!</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

<?php

}
?>