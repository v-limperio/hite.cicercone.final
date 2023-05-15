<?php
$i = 0;
foreach ($_SESSION['richieste'] as $request) {
?>
    <div class="row line">
        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <?php
            echo $request['attivita']['titolo'];
            ?>
        </div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <?php
            $old_date = $request['data_attivita'];
            $new_date = strtr($old_date, '/', '-');
            $result['data_attivita'] = date("d-m-Y", strtotime($new_date));
            echo $request["data_attivita"];
            ?>
        </div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $request['ora_inizio'] ?></div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <?php
            if ($request['ora_termine'] == null) {
                echo "Non definita";
            } else {
                echo $request['ora_termine'];
            }
            ?>
        </div>

        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <?php
            if ($request['accettazione'] == 0) {
                echo "Pendente";
            } else {
                echo "Accettata";
            }
            ?>

        </div>

        <?php
        if ($request['accettazione'] == 1) {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="action/call_contatti_cicerone.php">
                    <button class="btn btn-primary btn-md" value="">
                        Contatta Cicerone
                    </button>
                    <input type="hidden" name="id" value="<?php echo $i ?>">
                </form>
            </div>

            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="punto_incontro.php">
                    <button class="btn btn-primary btn-md" value="">
                        Mostra Punto Incontro
                    </button>
                    <input type="hidden" name="titolo" value="<?php echo $request['attivita']['titolo'] ?>">
                    <input type="hidden" name="lat" value="<?php echo $request['attivita']['incontro_lat'] ?>">
                    <input type="hidden" name="lng" value="<?php echo  $request['attivita']['incontro_lng'] ?>">
                </form>
            </div>

        <?php
        }
        ?>
        <?php
        if ($request['presenza'] == 1) {
        ?>
            
        <?php
        }
        ?>



        <?php
        if (new DateTime() < new DateTime($request['data_attivita'])) {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="action/call_rifiuta_richiesta.php">
                    <button class="btn btn-outline-danger btn-md" value="">
                        Annulla Richiesta
                    </button>
                    <input type="hidden" name="id" value="<?php echo $request['attivita']['id'] . " " . $request['data_attivita'] . " " . $request['ora_inizio'] ?>">
                </form>
            </div>
        <?php
        }
        ?>

    </div>
<?php
    $i++;
}
?>