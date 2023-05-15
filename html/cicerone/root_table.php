<?php 
foreach($_SESSION['itinerario'] as $root){
    $i = 0; 
?>
  <div class="row line">
    <div  class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $root['nome_luogo']?></div>
    <div class="col-4 col-sm-4 col-md-2 col-lg-2"><?php echo $root['descrizione']?></div>

    <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
      <form method="POST" action="modifica_tappa.php">
        <button class="btn btn-primary btn-md edit">
        <i class="fas fa-pencil-alt" aria-hidden="true">
        </i>
      </button>
        <input type="hidden" name="id" value="<?php echo $root['nome_luogo']."-".$root['descrizione']?>">
      </form>
    </div>
  
    <div class="col-4 col-sm-4 col-md-2 col-lg-2 offset-1 offset-md-0">
      <form method="POST" action="action/call_elimina_tappa.php">
        <button class="btn btn-danger btn-md edit">
        <i class="far fa-trash-alt">
        </i>
      </button>
        <input type="hidden" name="id" value="<?php echo $root['nome_luogo']."-".$root['descrizione']?>">
      </form>
    </div>

  </div>
<?php
}
?>