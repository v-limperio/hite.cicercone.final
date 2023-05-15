<?php session_start();
$now = new DateTime();
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/ico" href="../../img/cicerone.ico" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/login.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#login').addClass("disabled");
        });
    </script>
</head>
<body style="background-color: #f8f9fa">
    <?php include "nav_bar.php"?>
    <div class="container">
        <form method="post" action="tmp/login.php">
            <h2>Login</h2>
            <?php 
              require_once("../log/error.php");
            ?>
            <div class="form-group"><input type="email" name="email" placeholder="Email" class="form-control" required/></div>
            <div class="form-group"><input type="password" name="password" placeholder="Password" class="form-control" required/></div>
            <div class="form-group" style="text-align: right">
            <a href="password_dimenticata.php">Password dimenticata</a></div>
            <div class="form-group"><input type="submit" class="btn btn-primary btn-block" value="Accedi"></div>
        </form>
    </div>
</body>
</html>
