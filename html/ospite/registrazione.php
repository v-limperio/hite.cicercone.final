<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/signup.css" />
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

    <script>
        $(document).ready(function(){
            $('#signup').addClass("disabled");
        });
    </script>

</head>
<body style="background-color: #f8f9fa">
   <!--Navbar-->
   <?php include "nav_bar.php"?>
    <!---------->
    <!---Form Registrazione-->
    <div class="container">
            <form method="POST" action="tmp/registrazione.php" name="sign" onsubmit="return testpass(this)">
                <h2>Registrazione</h2>
                <?php 
                   require_once("../log/error.php");
                ?>
                <div class="form-group">
                    <input class="form-control" name="email" placeholder="Email" type="email" required/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="password" placeholder="Password" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno 8 caratteri di cui un numero, una maiuscola e una minuscola!"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="ctrlpassword" placeholder="Conferma Password" type="password" required/>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" required type="checkbox"/>
                            "Accetto i termini e le condizioni."
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary btn-block" type="submit" value="Registrati"/>
                </div>
            </form>
    </div>
</body>
</html>
