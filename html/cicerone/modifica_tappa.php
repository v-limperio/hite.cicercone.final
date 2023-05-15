<?php 
session_start();
//Filtra l'attività in base all'id selezionato
$user_data = $_SESSION['utente'];

$_SESSION['modifica_tappa'] = explode("-", $_POST['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="cache-control" content="no-cache">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>CicerOne</title>
    <link href="../../css/all.css" rel="stylesheet">
    <link href="../../css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/crea_attività.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">    
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f8f9fa">

<?php 
    include('nav.php');
?>
    <div class="container container-fluid">         
        <h2 class="text-center">Modifica la tappa <?php echo $_SESSION['modifica_tappa'][0]?></h2>
        <a href="action/call_visualizza_itinerario.php"><-Visualizza Itinerario</a>   
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <form method="POST" action="action/call_modifica_tappa.php" enctype="multipart/form-data">
                    <?php require_once("../log/error.php"); ?>
                    <div class="row">
                        <div class="col-md-1 col-lg-1">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-3 col-lg-3">
                            <label class="control-label">Modifica il nome del luogo</label>
                            <input class="form-control form-control-sm" type="text" name="nome_luogo" value="<?php echo $_SESSION['modifica_tappa'][0] ?>" required>
                        </div>        
                    </div>

                    <div class="row">
                        <div class="col-sm-5 col-md-12 col-lg-12">
                            <label class="control-label">Modifica Descrizione</label>
                            <textarea class="form-control form-control-lg" name="descrizione" style="font-size: medium;"required><?php echo $_SESSION['modifica_tappa'][1]  ?></textarea>
                        </div>        
                    </div>

                    <div class="row">
                        <div class="form-group" style="margin:auto;">
                        <input style="margin-top:1rem"type="submit" class="btn btn-primary btn-block btn-lg" value="Modifica Tappa"/>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




</body>