<?php
foreach ($_SESSION['itinerario'] as $root) {
?>
  <div class="row line">
    <div class="col-12 col-sm-6 col-md-6 col-lg-6"><?php echo $root['nome_luogo'] ?></div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-6"><?php echo $root['descrizione'] ?></div>
  </div>
<?php
}
?>