<?php
$i = 0;
foreach ($_SESSION['presenze'] as $globetrotter) {
?>
    <div class="row line">
        <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $globetrotter['partecipante']['nome'] ?></div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $globetrotter['partecipante']['cognome'] ?></div>
        <?php
        if ($_SESSION['presenze'][$i]['presenza'] == 0) {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo "Non definita" ?></div>
        <?php
        } else {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo "Presente" ?></div>
        <?php
        }
        ?>

        <?php
        if ($_SESSION['presenze'][$i]['presenza'] == 0) {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="action/call_segna_presenza.php">
                    <button class="btn btn-success btn-md edit">
                        Segna Presenza
                    </button>
                    <input type="hidden" name="index" value="<?php echo $i; ?>">
                </form>
            </div>

            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="action/call_segna_assenza.php">
                    <button class="btn btn-danger btn-md edit">
                        Segna Assenza
                    </button>
                    <input type="hidden" name="index" value="<?php echo $i; ?>">
                </form>
            </div>

        <?php
        } else {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="../utente/segnala_utente.php">
                    <button class="btn btn-danger btn-md edit">
                        Segnala Utente
                    </button>
                    <input type="hidden" name="index" value="<?php echo $globetrotter['partecipante']['id']  . " " . $globetrotter['partecipante']['nome'] . " " . $globetrotter['partecipante']['cognome'] ." ". $globetrotter['partecipante']['segnalazioni']?>">
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