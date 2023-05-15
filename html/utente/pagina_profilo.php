<?php 
    session_start(); 
    $user_data = $_SESSION["utente"]; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/profile.css" />
    <link href="../../css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body style="background-color: #f8f9fa">
<!--Navbar-->
<?php include "nav.php" ?>
<!---------->
<!--Visualizza Profilo-->
<div class="container">
    <div class="profile_box">
        <div class="row">
            <div class="col-md-4 col-lg-4 item">
                <!--Box sinistro-->
                <div class="rounded-circle img" style="background-image: url('../../img/profile_picture/<?php if($user_data["imgProfilo"] == 1) echo $user_data["id"].".jpg"; else echo "avatar.jpg";?>')">
                </div>
                <!--Tabella per nome e cognome-->
                <div class="row">
                    <div class="col-12 name">
                        <strong><?php echo $user_data["nome"];?></strong></div>
                </div>
                <div class="row">
                    <div class="col-12 name">
                        <strong><?php echo $user_data["cognome"];?></strong></div>
                </div>
                <!------------------------------>
                <!--Tabella voti---------------->
                    <!------------------------------>
            </div>
            <!--Fine box sinistro-->
            <!--Box destro-->
            <div class="col-md-7 col-lg-7 desc">
                <div class="row line">
                    <div class="col-md-6 col-lg-6">
                        <strong>Data di nascita</strong>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <?php
                            $old_date = $user_data["dataNascita"];
                            $newDate = date("d-m-Y", strtotime($old_date));
                            echo $newDate;
                        ?>
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-6 col-lg-6">
                        <strong>Città</strong>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <?php echo $user_data["citta"];?>
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-6 col-lg-6">
                        <strong>Nazione</strong>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <?php echo $user_data["nazione"];?>
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-6 col-lg-6">
                        <strong>Numero di telefono</strong>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <?php echo
                        $user_data["telefono"];
                        ?>
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-6 col-lg-6">
                        <strong>Sesso</strong>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <?php
                        if($user_data["sesso"] == 'M'){
                            echo "Maschile";
                        }
                        else{
                            echo "Femminile";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!--Fine box destro-->
        </div>
        </div>
    </div>
</div>
</body>
</html>
