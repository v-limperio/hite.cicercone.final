<?php
foreach ($_SESSION['risultato'] as $result) {
?>
  <div class="row line">
    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
      <?php
      echo $result['attivita']['titolo'];
      ?>
    </div>
    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
      <?php
      $old_date = $result['data_attivita'];
      $new_date = strtr($old_date, '/', '-');
      $result['data_attivita'] = date("d-m-Y", strtotime($new_date));
      echo $result["data_attivita"];
      ?>
    </div>
    <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $result['ora_inizio'] ?></div>
    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
      <?php
      if ($result['ora_termine'] == null) {
        echo "Non definita";
      } else {
        echo $result['ora_termine'];
      }
      ?>
    </div>

    <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
      <form method="POST" action="action/call_visualizza_attività.php">
        <button class="btn btn-primary btn-md" value="">
          Visualizza Attività
        </button>
        <input type="hidden" name="id" value="<?php echo $result['attivita']['id'] ?>">
        <input type="hidden" name="arrayDate" value="<?php echo $result['attivita']['id']  . " " . $result['data_attivita'] . " " . $result['ora_inizio'] . " " . $result['ora_termine'] ?>">
      </form>
    </div>

    <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
      <form method="POST" action="action/call_richiesta_partecipazione.php">
        <button class="btn btn-outline-primary btn-md" value="">
          Inoltra Richiesta
        </button>
        <input type="hidden" name="id" value="<?php echo $result['attivita']['id']  . " " . $result['data_attivita'] . " " . $result['ora_inizio'] . " " . $result['ora_termine'] ." ". $result['attivita']['cicerone']?>">
      </form>
    </div>


  </div>
<?php
}
?>