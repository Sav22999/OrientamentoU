<html>
    <head>
        <title>Account</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body>
        <div id="body">
            <div id="titolo">
                Account • Login
            </div>
            <div id="body_ttt">
                <div id="contenuto">
                    <?php
                    if(isset($_POST["login"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $sql="SELECT * FROM utenti WHERE email='".$_POST["email"]."' AND password='".(md5("[sm]").md5($_POST["psw"]))."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            $riga=$r->fetch_assoc();
                            if($riga["verificato"]=="si" && $riga["bloccato"]=="no")
                            {
                                //verificato e non bloccato
                                $_SESSION["id"]=$riga["id"];
                                $_SESSION["email"]=$riga["email"];
                                $_SESSION["permessi"]=$riga["permessi"];
                                $_SESSION["lingua"]=$riga["lingua"];
                                
                                $_SESSION["nome"]=$riga["nome"];
                                $_SESSION["cognome"]=$riga["cognome"];

                                $sql="INSERT INTO log_login(id, utente, data) VALUES(NULL, '".$_SESSION["id"]."', '".date("Y-m-d h:i:s")."')";
                                $c->query($sql);

                                echo "Bentornato, <br>".$riga["nome"]." ".$riga["cognome"].".<br><br>Ora potrai seguire tutti gli aggiornamenti delle università che preferisci e gestirle direttamente nella sezione \"Account\".";
                            }else if($riga["verificato"]=="no")
                            {
                                //non verificato-->da verificare

                                $sql="SELECT codice FROM utenti WHERE email='".$_POST["email"]."'";
                                $r2=$c->query($sql); 
                                $codicegenerato=$r2->fetch_assoc()["codice"];
                                $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$_POST["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'Verificare l’account con codice segreto',
                                'E’ necessario verificare l’account prima di poter accedere al sito <i>OrientamentoU</i>.
                                <br>
                                Per favore inserisci il seguente codice per terminare correttamente la verifica:
                                <br>
                                <br>
                                <center><font class=\\'codice\\'>".$codicegenerato."</font></center>', 'no')";
                                $c->query($sql);
                                echo "Questo account non è stato ancora verificato.<br>";
                                ?>
                                <form method="post" action="./reg.php">
                                    Inserire il codice ricevuto per email (notare, utilizzare il servizio <a href="http://localhost/OrientamentoU/email/">Em@il by SM</a> che simula un client mail, questo poichè in localhost non possono essere utilizzati i servizi di Mail server).
                                    <br>Quindi recandosi su Em@il by SM sarà sufficiente immettere l'indirizzo di posta elettronica e verranno mostrati tutti i messaggi relativi a quella casella postale.
                                    <input type="text" class="campo_login" name="code" placeholder="Codice" required />
                                    <br/>
                                    <input type="submit" class="login_button" name="verifica" value="Completa" />
                                </form>
                                <?php
                            }else if($riga["bloccato"]=="si")
                            {
                                //bloccato-->da sbloccare
                                echo "Questo account è stato bloccato.<br>E' possibile riattivarlo premendo il pulsante sottostante.<br>";
                                ?>
                                <form method="post" action="./log.php">
                                    <input type="submit" class="login_button" name="riattiva" value="Riattiva account" />
                                    <input type="text" class="campo_login" name="email" value="<?php echo $_POST["email"]; ?>" hidden />
                                </form>
                                <?php
                            }
                        }else
                        {
                            echo "Email o password errati.<br>";
                        }
                        $c->close();
                    }
                    else if(isset($_POST["riattiva"]))
                    {
                        $codicegenerato="A".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65);
                        //la prima lettera è una A perchè deve ri*A*ttivare
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");
                        $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$_POST["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'Riattivare l’account con codice segreto',
                        'E’ stata effettuata la richiesta per riattivare l’account per poter accedere al sito <i>OrientamentoU</i>.
                        <br>
                        Per favore inserisci il seguente codice per terminare correttamente la riattivazione ed iniziare ad utilizzare nuovamente tutte le funzioni esclusive degli utenti:
                        <br>
                        <br>
                        <center><font class=codice>".$codicegenerato."</font></center>', 'no')";
                        $c->query($sql);
                        $sql="UPDATE utenti SET codice='".$codicegenerato."' WHERE email='".$_POST["email"]."'";
                        $c->query($sql);

                        ?>
                        <form method="post" action="">
                            Inserire il codice ricevuto per email (notare, utilizzare il servizio <a href="http://localhost/OrientamentoU/email/">Em@il by SM</a> che simula un client mail, questo poichè in localhost non possono essere utilizzati i servizi di Mail server).
                            <br>Quindi recandosi su Em@il by SM sarà sufficiente immettere l'indirizzo di posta elettronica e verranno mostrati tutti i messaggi relativi a quella casella postale.
                            <input type="text" class="campo_login" name="code" placeholder="Codice" required />
                            <br/>
                            <input type="submit" class="login_button" name="verifica_riattiva" value="Riattiva" />
                        </form>
                        <?php
                        //VERIFICARE CHE LA PRIMA LETTERA DEL CODICE SIA "A"
                    }
                    else if(isset($_POST["verifica_riattiva"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $_POST["code"];

                        $sql="SELECT * FROM utenti WHERE codice='".$_POST["code"]."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            $riga=$r->fetch_assoc();
                            $sql="UPDATE utenti SET bloccato='no', codice='' WHERE codice='".$_POST["code"]."'";
                            $c->query($sql);
                            echo "Account riattivato correttamente.<br/>Ora potrai accedere nuovamente a OrientamentoU utilizzando le credenziali inserite durante la registrazione.";

                            $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$riga["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'ACCOUT RIATTIVATO su OrientamentoU',
                            'Complimenti!<br>Ora fai nuovamente parte di <i>OrientamentoU</i>, il sito che ti permette di decidere con tutta tranquillità la tua Università ed il tuo corso di studi.<br>Grazie, dal team di OrientamentoU.', 'no')";
                            $c->query($sql);
                        }
                        else
                        {
                            echo "Codice di riattivazione errato! Riprovare.";
                        }
                        $c->close();
                    }
                    else if(isset($_POST["close"]) && isset($_SESSION["email"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $sql="UPDATE utenti SET bloccato='si', codice='' WHERE email='".$_SESSION["email"]."'";
                        $c->query($sql);
                        echo "Account bloccato correttamente.<br/>Ci dispiace che il servizio non ti abbia soddisfatto.<br/>Ricorda che potrai tornare quando vuoi, effettuando il login con le credenziali, quindi seguendo la procedura di 'riattivazione account' indicata.";

                        $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$_SESSION["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'ACCOUT CHIUSO su OrientamentoU',
                        'Hai correttamente bloccato/chiuso il tuo account su <i>OrientamentoU</i>.<br>Potrai riattivarlo in seguito accedendo con le stesse credenziali ed effettuando la procedura di riattivazione.', 'no')";
                        $c->query($sql);

                        $c->close();

                        session_unset();
                        session_destroy();
                    }
                    else if(isset($_GET["newpassword"]) && !isset($_POST["check_newpassword"]))
                    {
                        if(isset($_SESSION["email"]))
                        {
                            ?>
                        <h1>Modifica della password</h1>
                        <form method="post" action="">
                            Inserire la password attuale:
                            <br>
                            <input type="password" class="campo_login" name="oldpsw" placeholder="Password" minlength="8" maxlength="30" required />
                            <br/>
                            Digita la nuova password:
                            <br>
                            <input type="password" class="campo_login" name="psw" placeholder="New password" minlength="8" maxlength="30" required />
                            <br/>
                            <input type="submit" class="login_button" name="check_newpassword" value="Conferma modifica password" />
                        </form>
                        <?php
                        }
                    }
                    else if(isset($_POST["check_newpassword"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $sql="SELECT * FROM utenti WHERE password='".md5("[sm]").md5($_POST["oldpsw"])."' AND email='".$_SESSION["email"]."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            $riga=$r->fetch_assoc();
                            $sql="UPDATE utenti SET password='".(md5("[sm]").md5($_POST["psw"]))."' WHERE password='".md5("[sm]").md5($_POST["oldpsw"])."' AND email='".$_SESSION["email"]."'";
                            $c->query($sql);
                            echo "Password modificata correttamente.<br/>Ora dovrai accedere a OrientamentoU utilizzando la nuova password inserita.";

                            $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$riga["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'Password modificata correttamente',
                            'Perfetto.<br>Hai modificato la password su <i>OrientamentoU</i> correttamente.<br>Per accedere al tuo profilo dovrai utilizzare la nuova password.', 'no')";
                            $c->query($sql);
                        }
                        else
                        {
                            echo "Password errata. Riprovare, per favore.";
                        }
                        $c->close();
                    }
                    else
                        echo '<meta http-equiv="refresh" content="0;URL=http://localhost/OrientamentoU/">';

                    if(isset($_GET["logout"]))
                    {
                        session_unset();
                        session_destroy();
                        $_SESSION["lingua"]="it";
                        echo "Disconnessione in corso...";
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>