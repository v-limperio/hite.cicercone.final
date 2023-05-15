<?php 
    session_start(); 
    clearstatcache();
    $user_data = $_SESSION["utente"]; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="cache-control" content="no-cache">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link href="../../css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/modify.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script language="Javascript" type="text/javascript">
        //Controllo password confermata
        function testpass(sign){
            if (sign.password.value != sign.ctrlpassword.value) {

                alert("La password inserita non coincide con la prima!")

                sign.ctrlpassword.value=""
                sign.password.value=""
                sign.password.select()
                return false

            }
            return true
        }
    </script>
</head>
<body style="background-color: #f8f9fa">
<!--Navbar-->
<?php include "nav.php" ?>
<!---------->
<!---Form modifica---->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                <h2 class="text-center">Modifica Profilo</h2>
                <form method="POST" action="tmp/modifica_profilo.php" enctype="multipart/form-data">

                    <?php require_once("../log/error.php"); ?>
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input class="avatar-input" type="file" id="imageUpload" accept=".png, .jpg, jpeg" name="profileimg"/>
                                    <label class="fas" for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url('../../img/profile_picture/<?php if($user_data["imgProfilo"] == 1) echo $user_data["id"].".jpg"; else echo "avatar.jpg"?>')"></div>
                                </div>
                                <script language="Javascript" type="text/javascript">
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function(e) {
                                                $('#imagePreview').attr('style', 'background-image: url('+e.target.result+')');

                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                    $("#imageUpload").change(function() { readURL(this);});
                                </script>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-8">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label">Nome:</label>
                                    <input class="form-control" type="text" name="nome" placeholder="<?php echo $user_data["nome"];?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label">Cognome:</label>
                                    <input class="form-control" type="text" name="cognome" placeholder="<?php echo $user_data["cognome"];?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label">Telefono:</label>
                                    <input class="form-control" type="text" name="telefono" placeholder="<?php echo $user_data["telefono"];?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label">Data di nascita:</label>
                                    <input class="form-control date" type="date" name="dataNascita" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label">Città:</label>
                                    <input class="form-control" type="text" name="citta" placeholder="<?php echo $user_data["citta"];?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label">Nazione:</label>
                                    <input class="form-control" type="text"name="nazione" placeholder="<?php echo $user_data["nazione"];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" value="Modifica il profilo"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-lg-4">
                <?php include("modifica_account.php"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php include('elimina_profilo.php');?>
            </div>
        </div>

<!-------------------->
</body>
</html>

