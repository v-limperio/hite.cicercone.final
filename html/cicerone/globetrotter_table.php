<?php
 $i = 0;
foreach ($_SESSION['richieste'] as $globetrotter) {
   
?>
    <div class="row line">
        <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $globetrotter['partecipante']['nome'] ?></div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $globetrotter['partecipante']['cognome'] ?></div>
        <?php
        if ($globetrotter['accettazione'] == 0) {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo "Pendente" ?></div>
        <?php
        } else {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo "Accettata" ?></div>
        <?php
        }
        ?>

        <?php
        if ($globetrotter['accettazione'] == 0) {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="action/call_accetta_richiesta.php">
                    <button class="btn btn-success btn-md edit">
                        Accetta Richiesta
                    </button>
                    <input type="hidden" name="id" value="<?php echo $i; ?>">
                </form>
            </div>

            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="action/call_rifiuta_richiesta.php">
                    <button class="btn btn-danger btn-md edit">
                        Rifiuta Richiesta
                    </button>
                    <input type="hidden" name="id" value="<?php echo $i?>">
                </form>
            </div>
        <?php
        } else {
        ?>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
                <form method="POST" action="action/call_rifiuta_richiesta.php">
                    <button class="btn btn-danger btn-md edit">
                        Rifiuta Richiesta
                    </button>
                    <input type="hidden" name="id" value="<?php echo $i?>">
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