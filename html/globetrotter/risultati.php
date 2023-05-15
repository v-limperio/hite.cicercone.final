<?php
    session_start();
    $user_data = $_SESSION['utente'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="icona.gif" />
        <title>CicerOne</title>
        <link rel="stylesheet" href="../../css/all.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../css/activity.css">
        <link rel="stylesheet" href="../../css/searchbar.css">
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #f8f9fa">
        <?php 
            include "nav.php";
        ?>

        <div class="container">
        <div class="row form-wrapper">

            <!----ricerca per luogo------>
            <form method="POST" class="form-inline" style="width:100%" action="../globetrotter/action/call_ricerca_attività.php">
                <div class="offset-md-2 offset-lg-2 col-md-4 col-lg-4" style="padding:0;margin-right:0;">    
                    <input class="form-control" style="width:100%" placeholder="Cerca luogo..." list="cities" name="citta" value="<?php echo $_SESSION['search']['citta']; ?>" required>
                    <datalist id="cities">
                        <option value="Agrigento">Agrigento</option>
                        <option value="Alessandria">Alessandria</option>
                        <option value="Ancona">Ancona</option>
                        <option value="Aosta">Aosta</option>
                        <option value="Aquila">Aquila</option>
                        <option value="Arezzo">Arezzo</option>
                        <option value="Ascoli Piceno">Ascoli Piceno</option>
                        <option value="Asti">Asti</option>
                        <option value="Avellino">Avellino</option>
                        <option value="Bari">Bari</option>
                        <option value="Belluno">Belluno</option>
                        <option value="Benevento">Benevento</option>
                        <option value="Bergamo">Bergamo</option>
                        <option value="Biella">Biella</option>
                        <option value="Bologna">Bologna</option>
                        <option value="Bolzano">Bolzano</option>
                        <option value="Brescia">Brescia</option>
                        <option value="Brindisi">Brindisi</option>
                        <option value="Cagliari">Cagliari</option>
                        <option value="Caltanissetta">Caltanissetta</option>
                        <option value="Campobasso">Campobasso</option>
                        <option value="Caserta">Caserta</option>
                        <option value="Catania">Catania</option>
                        <option value="Catanzaro">Catanzaro</option>
                        <option value="Chieti">Chieti</option>
                        <option value="Como">Como</option>
                        <option value="Cosenza">Cosenza</option>
                        <option value="Cremona">Cremona</option>
                        <option value="Crotone">Crotone</option>
                        <option value="Cuneo">Cuneo</option>
                        <option value="Enna">Enna</option>
                        <option value="Ferrara">Ferrara</option>
                        <option value="Firenze">Firenze</option>
                        <option value="Foggia">Foggia</option>
                        <option value="Forlì e Cesena">Forl&igrave; e Cesena</option>
                        <option value="Frosinone">Frosinone</option>
                        <option value="Genova">Genova</option>
                        <option value="Gorizia">Gorizia</option>
                        <option value="Grosseto">Grosseto</option>
                        <option value="Imperia">Imperia</option>
                        <option value="Isernia">Isernia</option>
                        <option value="La Spezia">La Spezia</option>
                        <option value="Latina">Latina</option>
                        <option value="Lecce">Lecce</option>
                        <option value="Lecco">Lecco</option>
                        <option value="Livorno">Livorno</option>
                        <option value="Lodi">Lodi</option>
                        <option value="Lucca">Lucca</option>
                        <option value="Macerata">Macerata</option>
                        <option value="Mantova">Mantova</option>
                        <option value="Massa-Carrara">Massa-Carrara</option>
                        <option value="Matera">Matera</option>
                        <option value="Messina">Messina</option>
                        <option value="Milano">Milano</option>
                        <option value="Modena">Modena</option>
                        <option value="Napoli">Napoli</option>
                        <option value="Novara">Novara</option>
                        <option value="Nuoro">Nuoro</option>
                        <option value="Oristano">Oristano</option>
                        <option value="Padova">Padova</option>
                        <option value="Palermo">Palermo</option>
                        <option value="Parma">Parma</option>
                        <option value="Pavia">Pavia</option>
                        <option value="Perugia">Perugia</option>
                        <option value="Pesaro e Urbino">Pesaro e Urbino</option>
                        <option value="Pescara">Pescara</option>
                        <option value="Piacenza">Piacenza</option>
                        <option value="Pisa">Pisa</option>
                        <option value="Pistoia">Pistoia</option>
                        <option value="Pordenone">Pordenone</option>
                        <option value="Potenza">Potenza</option>
                        <option value="Prato">Prato</option>
                        <option value="Ragusa">Ragusa</option>
                        <option value="Ravenna">Ravenna</option>
                        <option value="Reggio Calabria">Reggio Calabria</option>
                        <option value="Reggio Emilia">Reggio Emilia</option>
                        <option value="Rieti">Rieti</option>
                        <option value="Rimini">Rimini</option>
                        <option value="Roma">Roma</option>
                        <option value="Rovigo">Rovigo</option>
                        <option value="Salerno">Salerno</option>
                        <option value="Sassari">Sassari</option>
                        <option value="Savona">Savona</option>
                        <option value="Siena">Siena</option>
                        <option value="Siracusa">Siracusa</option>
                        <option value="Sondrio">Sondrio</option>
                        <option value="Taranto">Taranto</option>
                        <option value="Teramo">Teramo</option>
                        <option value="Terni">Terni</option>
                        <option value="Torino">Torino</option>
                        <option value="Trapani">Trapani</option>
                        <option value="Trento">Trento</option>
                        <option value="Treviso">Treviso</option>
                        <option value="Trieste">Trieste</option>
                        <option value="Udine">Udine</option>
                        <option value="Varese">Varese</option>
                        <option value="Venezia">Venezia</option>
                        <option value="Verbano-Cusio-Ossola">Verbano-Cusio-Ossola</option>
                        <option value="Vercelli">Vercelli</option>
                        <option value="Verona">Verona</option>
                        <option value="Vibo Valentia">Vibo Valentia</option>
                        <option value="Vicenza">Vicenza</option>
                        <option value="Viterbo">Viterbo</option>
                    </datalist>
                    </div>
                    <!----ricerca per data------>
                <div class="col-md-2 col-lg-2" style="padding:0;margin:0;">  
                    <input style="cursor:pointer;width:100%;background-color:white" placeholder="Cerca data..." readonly type="text" class="form-control" id="datepicker" name="data_attivita" value="<?php echo $_SESSION['search']['data']; ?>">
                    <script src="../../js/moment.js"></script>
                    <script src="../../js/pikaday.js"></script>
                    <script>
                        var picker = new Pikaday({
                            field: document.getElementById('datepicker'),
                            trigger: document.getElementById('picker'),
                            firstDay: 1,
                            bound: true,
                            i18n: {
                                previousMonth: 'Mese precedente',
                                nextMonth: 'Mese successivo',
                                months: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                                weekdays: ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'],
                                weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab']
                            },
                            format: 'DD/MM/YYYY',
                            toString(date, format) {
                                // you should do formatting based on the passed format,
                                // but we will just return 'D/M/YYYY' for simplicity
                                const day = date.getDate();
                                const month = date.getMonth() + 1;
                                const year = date.getFullYear();
                                return `${day}/${month}/${year}`;
                            },
                            parse(dateString, format) {
                                // dateString is the result of `toString` method
                                const parts = dateString.split('/');
                                const day = parseInt(parts[0], 10);
                                const month = parseInt(parts[1], 10) - 1;
                                const year = parseInt(parts[2], 10);
                                return new Date(year, month, day);
                            },
                            onSelect: function() {
                                var date = document.createTextNode(this.getMoment().format('DD/MM/YYYY'));
                                console.log(date);
                            }
                        });
                    </script>
                </div>
                <div class="col-sm-2 col-md-2" style="padding:0;margin:0;">  
                    <button type="submit" class="btn btn-primary">Cerca</button>
                </div>
            </form> 
        </div>
            <h2 class="text-center">Risultati</h2>
  
            <?php include "../log/error.php"; ?>
            
            <div class="row line">
                <div class="col-4 col-sm-4 col-md-2 col-lg-2"><strong>Titolo</strong></div>
                <div class="col-4 col-sm-4 col-md-2 col-lg-2"><strong>Data</strong></div>
                <div class="col-4 col-sm-4 col-md-2 col-lg-2"><strong>Ora Inizio</strong></div>
                <div class="col-4 col-sm-4 col-md-2 col-lg-2"><strong>Ora Termine</strong></div>
            </div>
            <?php
            if(isset($_SESSION['risultato'])){
                require "result_table.php";
            }
            ?>
        </div>

    </body>
</html>