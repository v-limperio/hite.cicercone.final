<?php session_start();?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/recuperopsw.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script language="Javascript" type="text/javascript">
    //Controllo password

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
   <?php include "nav_bar.php"?>
    <div class="container">
        <h3>Email inviata a <?php echo $_SESSION["email"];?></h2>
        <h4>Controlla la tua casella di posta elettronica, riceverai una email con un codice che ti permetterà di reimpostare la tua password.</h3>
    
        <form action='tmp/reimposta_password.php' method="post" onsubmit="return testpass(this)">

        <?php include("../log/error.php")?>

        <h2>Reimposta password</h2>
            <div class="form-group"><input type="text" name="codice_inserito" placeholder="Codice" class="form-control" required/></div>
            <div class="form-group"><input type="password" name="password" placeholder="Nuova password" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno 8 caratteri di cui un numero, una maiuscola e una minuscola!"/></div>
            <div class="form-group"><input type="password" name="ctrlpassword" placeholder="Conferma password" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno 8 caratteri di cui un numero, una maiuscola e una minuscola!"/></div>
            <div class="form-group"  style="text-align: right" >
                <div class="form-group" > <input type="submit" class="btn btn-primary btn-block" value="Conferma">
                </div>
            </div>
        </form>
    </div>


</body>
</html>
