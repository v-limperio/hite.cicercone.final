<?php
$i = 0;
foreach ($_SESSION['valutazione'] as $review) {
?>
    <?php
    if ($review['voto'] != -1) {
    ?>
        <div class="row line">
            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                <?php
                echo $review['utente']['nome'];
                ?>
            </div>

            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                <?php
                echo $review['utente']['cognome'];
                ?>
            </div>

            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                <?php
                    if ($review['voto'] == 0) {
                        echo "Negativa";
                    } else {
                        echo "Positiva";
                    }
                ?>
            </div>
            <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                <?php
                echo $review['recensione'];
                ?>

            </div>
        </div>
<?php
    }
    $i++;
}
?>