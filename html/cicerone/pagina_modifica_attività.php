<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hite.cicerone.io/view/vista_ospite.php";

session_start();
if (!isset($_SESSION["utente"])) {
    vista_ospite::render('login');
}
clearstatcache();
$user_data = $_SESSION["utente"];

if (isset($_POST['id'])) {
    $array = array_filter($_SESSION['attività'], function ($selected_activity) {
        return ($selected_activity['id'] == $_POST['id']);
    });

    foreach ($array as $key => $value) {
        $_SESSION['modifica'] = $array[$key];
    }
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script>

    </script>

</head>

<body style="background-color: #f8f9fa">
    <?php
    include('nav.php');
    ?>
    <div class="container container-fluid">
        <a href="action/call_ricerca_attivita.php">
            <- Torna alla Gestione Attività</a> <h2 class="text-center">Modifica Attività: <?php echo $_SESSION['modifica']['titolo'] ?></h2>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <form method="POST" action="action/call_modifica_attivita.php" enctype="multipart/form-data">
                            <?php require_once("../log/error.php"); ?>
                            <div class="row">
                                <div class="col-md-1 col-lg-1">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <h6>Inserisci l'immagine di anteprima</h6>
                                    <div class="form-group">
                                        <div class="avatar-upload">
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url('../../img/activity_picture/<?php if ($_SESSION['modifica']['img_attivita'] == 1) echo $_SESSION['modifica']['id'] . ".jpg"; else echo "background.jpg" ?>')"></div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input class="avatar-input" type="file" id="imageUpload" accept=".png, .jpg, jpeg" name="activityimg" />
                                                <label class="fas" for="imageUpload"></label>
                                            </div>
                                            <script language="Javascript" type="text/javascript">
                                                function readURL(input) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            $('#imagePreview').attr('style', 'background-image: url(' + e.target.result + ')');

                                                        };
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }
                                                $("#imageUpload").change(function() {
                                                    readURL(this);
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4">

                                    <div class="form-group row">
                                        <label class="control-label">Titolo attività</label>
                                        <input class="form-control form-control-sm" type="text" name="titolo" placeholder="<?php echo $_SESSION['modifica']['titolo'] ?>">
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label"></label>
                                            <select required class="form-control form-control-sm" selected="<?php echo $_SESSION['modifica']['tipologia'] ?>" name="tipologia">
                                                <option selected disabled>Tipologia..</option>
                                                <option>Giro Turistico</option>
                                                <option>Tour Gastronimico</option>
                                                <option>Vita Notturna</option>
                                                <option>Evento Speciale</option>
                                                <option>Spettacoli</option>
                                                <option>Arte</option>
                                                <option>Altro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label">Città</label>

                                            <input class="form-control form-control-sm"" list=" cities" name="citta" placeholder="<?php echo $_SESSION['modifica']['citta'] ?>">
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
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-5">
                                    <label class="control-label">Descrizione</label>
                                    <textarea class="form-control form-control-lg" name="descrizione" placeholder="" required><?php echo $_SESSION['modifica']['descrizione'] ?></textarea>
                                </div>
                                <div class="col-sm-5 col-md-4 col-lg-2 offset-md-2">
                                    <label class="control-label">Lingua Parlata</label>
                                    <div class="form-group">
                                        <select class="js-example-templating form-control form-control-sm" name="lingua_parlata" id="select">
                                            <option value="it">Italiano</option>
                                            <option value="gb">Inglese</option>
                                        </select>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            function setCurrency(currency) {
                                                if (!currency.id) {
                                                    return currency.text;
                                                }
                                                var $currency = $('<span class="flag-icon flag-icon-' + currency.element.value + '"></span><span>  ' + currency.text + '</span>');
                                                return $currency;
                                            };
                                            $("#select").select2({
                                                templateResult: setCurrency,
                                                templateSelection: setCurrency,
                                                minimumResultsForSearch: Infinity
                                            });
                                        })
                                    </script>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group" style="margin:auto;">
                                    <input style="margin-top:1rem" type="submit" class="btn btn-primary btn-block btn-lg" value="Modifica Attività" />
                                </div>
                        </form>

                        <div class="form-group" style="margin:auto;">
                            <form action="action/call_view_modifica_incontro.php">
                                <input hidden name="id" value="<?php echo $_SESSION['modifica']['id'] ?>">
                                <input style="margin-top:1rem" type="submit" class="btn btn-outline-primary btn-block btn-lg" value="Modifica Punto Incontro" />
                            </form>
                        </div>

                    </div>

                </div>
    </div>
    </div>

</body>

</html>