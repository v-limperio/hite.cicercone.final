<!DOCTYPE html>
<?php 
    session_start();
 ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/all.css" />
    <link rel="stylesheet" href="../../css/fontawesome.min.css"/>
    <link rel="stylesheet" href="../../css/signup.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
    <body style="background-color: #f8f9fa">
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <a class="navbar-brand" href="signin.php"><img class="title" src="../../img/cicerOne.png" width="100px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            </div>
        </nav>
    <div class="container">
        <form method="POST" style="max-width:700px" action="tmp/creazione_profilo.php" enctype="multipart/form-data">
            <h2>Creazione Profilo</h2>
            <div class="row">
                <div class="form-group" style="margin:auto;">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input class="avatar-input" type="file" id="imageUpload" accept=".png, .jpg, .jpeg" name="profileimg"/>
                            <label class="fas" for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('../../img/profile_picture/avatar.jpg')">
                            </div>
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
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Email:</label>
                    <input class="form-control" type="text" name="email" value="<?php echo $_SESSION["email"];?>" disabled>
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Password:</label>
                    <input class="form-control" type="password" name="psw" value="<?php echo $_SESSION["password"];?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Nome:</label>
                    <input class="form-control" type="text" name="nome" required>
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Cognome:</label>
                    <input class="form-control" type="text" name="cognome" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Telefono:</label>
                    <input class="form-control" type="text" name="telefono" required>
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Data di nascita:</label>
                    <input class="form-control date" type="date" name="dataNascita" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Città:</label>
                    <input class="form-control" type="text" name="citta" required>
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Nazione:</label>
                    <input class="form-control" type="text"name="nazione" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Sesso:</label><br>
                    <label class="radio-inline">
                        <input type="radio" name="sesso" value="M">M
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sesso" value="F">F
                    </label>
                </div>
                <!--<div class="form-group col-sm-6">
                    <label class="control-label">Immagine profilo:</label>
                    <div class="file-loading">
                        <input id="avatar-2" name="avatar-2" type="file" required>
                    </div>
                    <small>Scegli file < 1500 KB</small>
                </div>-->
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit" value="Registrati"/>
            </div>
        </form>
    </div>


</body>
</html>
