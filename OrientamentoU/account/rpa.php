<html>
    <head>
        <title>Account</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body>
        <div id="body">
            <div id="titolo">
                Account • Recupero password
            </div>
            <div id="body_ttt">
                <div id="contenuto">
                    <?php
                    if(isset($_POST["recovery"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $sql="SELECT * FROM utenti WHERE email='".$_POST["email"]."' AND verificato='si' AND bloccato='no'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            $codicegenerato="P".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65);
                            //la prima lettera è una P ri*P*ristino password
                            $c=new mysqli("localhost","root","","orientamento");
                            $c->set_charset("utf8");
                            $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$_POST["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'Ripristino della password',
                            'E’ stata effettuata la richiesta per ripristinare la password dell’account associato a questo indirizzo email su <i>OrientamentoU</i>.
                            <br>
                            Per favore inserisci il seguente codice per terminare correttamente la verifica dell’identità e procedere con il resettatto della password:
                            <br>
                            <br>
                            <center><font class=codice>".$codicegenerato."</font></center>', 'no')";
                            $c->query($sql);
                            $sql="UPDATE utenti SET codice='".$codicegenerato."' WHERE email='".$_POST["email"]."'";
                            $c->query($sql);
                            ?>
                            <form method="post" action="">
                                Stai richiedendo il ripristino della password; per fare ciò è necessario verificare che l'account sia il tuo.
                                <br>
                                Inserire il codice ricevuto per email (notare, utilizzare il servizio <a href="http://localhost/OrientamentoU/email/">Em@il by SM</a> che simula un client mail, questo poichè in localhost non possono essere utilizzati i servizi di Mail server).
                                <br>Quindi recandosi su Em@il by SM sarà sufficiente immettere l'indirizzo di posta elettronica e verranno mostrati tutti i messaggi relativi a quella casella postale.
                                <input type="text" class="campo_login" name="code" placeholder="Codice" required />
                                <input type="text" class="campo_login" name="email" value="<?php echo $_POST["email"]; ?>" required readonly hidden />
                                <br/>
                                <input type="submit" class="login_button" name="verifica_recupero" value="Resetta password" />
                            </form>
                            <?php
                        }
                        else
                            echo "Errore. Non esiste alcun account con questa email.<br>Accertati di aver inserito tutti i caratteri correttamente.";
                    }
                    else if(isset($_POST["verifica_recupero"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $_POST["code"];

                        $sql="SELECT * FROM utenti WHERE codice='".$_POST["code"]."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            ?>
                            <form method="post" action="">
                                Digita la nuova password:
                                <input type="password" class="campo_login" name="psw" placeholder="New password" minlength="8" maxlength="30" required />
                                <input type="text" class="campo_login" name="email" value="<?php echo $_POST["email"]; ?>" required readonly hidden />
                                <input type="text" class="campo_login" name="code" value="<?php echo $_POST["code"]; ?>" required readonly hidden />
                                <br/>
                                <input type="submit" class="login_button" name="set_new_password" value="Imposta nuova password" />
                            </form>
                            <?php
                        }
                        else
                        {
                            echo "Codice di ripristino errato! Riprovare.";
                        }
                        $c->close();
                    }
                    else if(isset($_POST["set_new_password"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $_POST["code"];

                        $sql="SELECT * FROM utenti WHERE codice='".$_POST["code"]."' AND email='".$_POST["email"]."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            $riga=$r->fetch_assoc();
                            $sql="UPDATE utenti SET bloccato='no', codice='', password='".(md5("[sm]").md5($_POST["psw"]))."' WHERE codice='".$_POST["code"]."' AND email='".$_POST["email"]."'";
                            $c->query($sql);
                            echo "Password impostata correttamente.<br/>Ora dovrai accedere a OrientamentoU utilizzando la password inserita.";

                            $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$riga["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'Password resettata correttamente',
                            'Perfetto.<br>Hai resettato la password su <i>OrientamentoU</i> correttamente.<br>Per accedere al tuo profilo dovrai utilizzare la nuova password.', 'no')";
                            $c->query($sql);
                        }
                        else
                        {
                            echo "Qualcosa è andato storto! Riprovare, per favore.";
                        }
                        $c->close();
                    }
                    else
                        echo '<meta http-equiv="refresh" content="0;URL=http://localhost/OrientamentoU/">';
                    ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>