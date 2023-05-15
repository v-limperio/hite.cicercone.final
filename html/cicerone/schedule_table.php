<?php
$i = 0;
$now = new DateTime();
foreach ($_SESSION['orario'] as $schedule) {
?>
  <div class="row line">
    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
      <?php
      $old_date = $schedule['data_attivita'];
      $new_date = strtr($old_date, '/', '-');
      $data_attivita = date("d-m-Y", strtotime($new_date));
      echo $data_attivita;
      ?>
    </div>
    <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $schedule['ora_inizio'] ?></div>
    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
      <?php
      if ($schedule['ora_termine'] == null) {
        echo "Non definita";
      } else {
        echo $schedule['ora_termine'];
      }
      ?>
    </div>

    <?php if ($schedule['stato'] == "conclusa") { ?>
      <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo "Conclusa" ?></div>
    <?php } else{ ?>


    <?php
    if (($now->format("Y-m-d") > $schedule['data_attivita']) OR ($now->format("Y-m-d") == $schedule['data_attivita'] AND $now->format("H:i:s") >= $schedule['ora_inizio'])) {
    ?>
      <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
        <form method="POST" action="action/call_elenco_presenze.php">
          <button class="btn btn-primary btn-md" value="">
            Presenze
          </button>
          <input type="hidden" name="index" value="<?php echo $i ?>">
        </form>
      </div>
    <?php
    } else {
    ?>

      <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
        <form method="POST" action="action/call_visualizza_richieste.php">
          <button class="btn btn-primary btn-md" value="">
            Elenco Richieste
          </button>
          <input type="hidden" name="id" value="<?php echo $schedule['attivita'] . " " . $schedule['data_attivita'] . " " . $schedule['ora_inizio'] ?>">
        </form>
      </div>

      <?php
      if ($schedule['chiusura_richieste'] == 0) {
      ?>

        <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
          <form method="POST" action="action/call_chiudi_richieste.php">
            <button class="btn btn-primary btn-md" value="">
              Chiudi Richieste
            </button>
            <input type="hidden" name="index" value="<?php echo $i ?>">
          </form>
        </div>

      <?php
      } else {
      ?>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
          <form method="POST" action="action/call_apri_richieste.php">
            <button class="btn btn-primary btn-md" value="">
              Apri Richieste
            </button>
            <input type="hidden" name="index" value="<?php echo $i ?>">
          </form>
        </div>


      <?php
      }
      
      ?>



      <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
        <form method="POST" action="action/call_elimina_orario.php">
          <button class="btn btn-danger btn-md edit">
            <i class="far fa-trash-alt">
            </i>
          </button>
          <input type="hidden" name="id" value="<?php echo $schedule['attivita'] . " " . $schedule['data_attivita'] . " " . $schedule['ora_inizio'] ?>">
        </form>
      </div>
    <?php
    }
  }
    ?>


  </div>
<?php
  $i++;
}
?>