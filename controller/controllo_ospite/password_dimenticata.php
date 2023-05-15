<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/controller/controllo_ospite.php";
    interface i_password_dimenticata{
        public static function start();
    }
    class password_dimenticata extends controllo_ospite implements i_password_dimenticata{
        public static function start(){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/model/utente.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/view/vista_ospite.php";
            session_start();
            $_SESSION["email"] = $_POST["email"];
            
            $user = new utente;
            $result=$user->get_email($_SESSION["email"]);
            $user_data = json_decode($result, true);

            if(!$result){
                $_SESSION["error"] = "ERRORE: Non esiste una email registrata con questo account";
                vista_ospite::render("password_dimenticata");
            }
            
            else{
                // ti prelevi l'id dell'utente dalle tuple 
                $_SESSION["id"] = $user_data["id"];

                $_SESSION["codice"] = self::generaStringa();
                $codice = $_SESSION["codice"]; 


                // definisco mittente e destinatario della mail
                $nome_mittente = "cicerone";
                $mail_mittente = "cicerone@localhost.it";
                $mail_destinatario = $_SESSION["email"];

                // definisco il subject ed il body della mail
                $mail_oggetto = "Codice ripristino password CicerOne";
                $mail_corpo = <<<HTML
                <html>
                <head>
                    <style>
                        body {
                            text-align: center;
                            margin-top: 25px;
                            
                        }
                        h2, h4 {
                            font-family: arial;
                            color: darkslategray;
                        }
                        h1 {
                            font-family: arial;
                        }
                    </style>
                </head>
                <body>
                    <img src="https://i.ibb.co/9Z69vzZ/cicerOne.png" alt="cicerOne" width="190" height="100">
                    <h2>Codice di recupero password:</h2>
                    <h1>$codice</h1>
                    <h4>Non fornire il codice a nessuno al di fuori dell'apposita sezione sul sito CicerOne™.<br>
                        Se non hai richiesto questo codice, ignora semplicemente questo messaggio.</h4>
                    
                </body>
            </html>
            HTML;

                // aggiusto un po' le intestazioni della mail
                // E' in questa sezione che deve essere definito il mittente (From)
                // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
                $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
                $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
                $mail_headers .= "X-Mailer: PHP/" . phpversion();
                $mail_headers .= "MINE-Version: 1.0\r\n";
                $mail_headers .= "content-type: text/html; charset=utf-8";



                if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers)){
                    vista_ospite::render("mail_inviata");
                }
                else {
                    $_SESSION['error']= "Email non inviata. Riprovare!";
                    vista_ospite::render("password_dimenticata");
                }
            }

        }

        private static function generaStringa(){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $stringaRandom = substr(str_shuffle($permitted_chars), 0, 8);
            return $stringaRandom;
        }  
    }
?>