<?php
$i = 0;
foreach ($_SESSION['valutazione'] as $review) {
?>
    <div class="row line">
        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <?php
            echo $review['attivita']['titolo'];
            ?>
        </div>

        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <?php
            if(!isset($review['voto']) or $review['voto'] == -1){
                echo "Nessun Voto";
            }else {
                if($review['voto'] == 0){
                    echo "Negativa";
                }
                else{
                    echo "Positiva";
                }
            }
            ?>
        </div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2">
            <?php 
                if(!isset($review['recensione']) or $review['recensione'] == 'NULL'){
                    echo "Nessuna Recensione";
                } 
                else{
                    echo $review['recensione'];
                }
            ?>
        
        </div>

        <?php 
            if((!isset($review['voto']) AND !isset($review['recensione'])) OR ($review['voto'] == -1 AND $review['recensione'] == 'NULL')){
        ?>

<div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
            <form method="POST" action="inserisci_valutazione.php">
                <button class="btn btn-primary btn-md" value="">
                    Inserisci
                </button>
                <input type="hidden" name="id" value="<?php echo $i ?>">
            </form>
        </div>

        <?php 
            } else{
        ?>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
            <form method="POST" action="modifica_valutazione.php">
                <button class="btn btn-primary btn-md" value="">
                    Modifica
                </button>
                <input type="hidden" name="id" value="<?php echo $i ?>">
            </form>
        </div>



        <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
            <form method="POST" action="action/call_elimina_valutazione.php">
                <button class="btn btn-danger btn-md" value="">
                    Elimina
                </button>
                <input type="hidden" name="id" value="<?php echo $i ?>">
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