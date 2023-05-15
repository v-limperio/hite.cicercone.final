 <!--Email Edit-->
 <h2 style="text-align: center">Modifica l'account</h2>
 <form method="POST" id="email" action="tmp/modifica_email.php">
<div class="row text-center">
    <!--prelevo il modal--->
    <?php include("modifica_email.php"); ?>
    <div style="margin:auto">
        <h5>Modifica l'Email</h5>
        <h6><label class="old-mail"><?php echo $user_data["email"];?></label></h6>
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#mail-modal">
            Modifica
        </button>
    </div>
</div>
</form> 
<form method="POST" style="margin-top:37px" id="password"  action="tmp/modifica_password.php" onsubmit="return testpass(this)">
<div class = "row text-center">
    <!--prelevo il modal--->
    <?php include("modifica_password.php"); ?>
    <div style="margin:auto">
        <h5>Modifica la Password</h5>
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#password-modal">
            Modifica
        </button>
    </div>
</div>
</form>
