
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../utente/homepage.php"><img class="title" src="../../img/cicerOne.png" width="100px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--Collapse-->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <!--Dropdown Icon-->
        <ul class="nav navbar-nav ml-auto">
        <li class="nav-item">
                <a class="nav-link" id="info" href="infocicer.php">Cos'è CicerOne?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="who" href="chisiamo.php">Chi siamo?</a>
            </li>
        <li class="nav-item">
            <a class="nav-link" id="crea_attività" href="crea_attivita.php">Crea Attività</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="le_mie_attività" href="action/call_ricerca_attivita.php">Le mie attività</a>
        </li> 
            <li class="nav-item dropdown" style="cursor: pointer;">
                <a class="nav-link dropdown-toggle" herf="#" id="userdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-user" ></i>
                    <?php 
                        echo $user_data["nome"];
                    ?> 
                 </a>
                <!--Dropdown Menu-->
                
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userdropdown" role="menu">
                    <a class="dropdown-item" href="../utente/pagina_profilo.php">Visualizza Profilo</a>
                    <a class="dropdown-item" href="../utente/modifica_profilo.php">Modifica Profilo</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../utente/tmp/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>