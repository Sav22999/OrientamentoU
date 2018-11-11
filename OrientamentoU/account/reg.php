<html>
    <head>
        <title>Account</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body>
        <div id="body">
            <div id="titolo">
                Account • <?php if($_SESSION["lingua"]=="en"){ ?>Sign up<?php }else{ ?>Registrazione<?php } ?>
            </div>
            <div id="body_ttt">
                <div id="contenuto">
                    <?php
                    if(isset($_POST["signup"]))
                    {
                        $codicegenerato="V".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65)."".chr(mt_rand(0,24)+65);
                        //prima lettera è una V perchè deve *V*erificare
                        $verifica=false;
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $sql="SELECT * FROM utenti WHERE email='".$_POST["email"]."'";
                        $r=$c->query($sql);
                        if(!$r->num_rows>0)
                        {
                            $sql="INSERT INTO utenti(id, nome, cognome, email, password, permessi, data, lingua, codice, verificato, bloccato) VALUES(NULL, '".$_POST["nome"]."', '".$_POST["cognome"]."', '".$_POST["email"]."', '".(md5("[sm]").md5($_POST["psw"]))."', 0, '".$_POST["data"]."', '".$_POST["lang"]."', '".$codicegenerato."', 'no', 'no')";
                            $c->query($sql);

                            $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$_POST["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'Verificare l’account con codice segreto',
                            'E’ necessario verificare l’account prima di poter accedere al sito <i>OrientamentoU</i>.
                            <br>
                            Per favore inserisci il seguente codice per terminare correttamente la verifica:
                            <br>
                            <br>
                            <center><font class=codice>".$codicegenerato."</font></center>', 'no')";
                            $c->query($sql);
                            $verifica=true;
                            //VERIFICARE CHE LA PRIMA LETTERA DEL CODICE SIA "V"
                        }else
                        {
                            $riga=$r->fetch_assoc();
                            if($riga["verificato"]=="si") echo "Email già utilizzata. Se non ricordi la password è possibile ripristinarla premendo il pulsante sottostante.<br>";
                            else $verifica=true;
                        }
                        $c->close();

                        if($verifica)
                        {
                            ?>
                            <form method="post" action="">
                                Inserire il codice ricevuto per email (notare, utilizzare il servizio <a href="http://localhost/OrientamentoU/email/">Em@il by SM</a> che simula un client mail, questo poichè in localhost non possono essere utilizzati i servizi di Mail server).
                                <br>Quindi recandosi su Em@il by SM sarà sufficiente immettere l'indirizzo di posta elettronica e verranno mostrati tutti i messaggi relativi a quella casella postale.
                                <input type="text" class="campo_login" name="code" placeholder="Codice" required />
                                <br/>
                                <input type="submit" class="login_button" name="verifica" value="Completa" />
                            </form>
                            <?php
                        }
                    }
                    else if(isset($_POST["verifica"]))
                    {
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $sql="SELECT * FROM utenti WHERE codice='".$_POST["code"]."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            $riga=$r->fetch_assoc();
                            $sql="UPDATE utenti SET verificato='si', codice='' WHERE codice='".$_POST["code"]."'";
                            $c->query($sql);
                            echo "Account verificato correttamente.<br/>Ora potrai accedere con le credenziali che hai utilizzato nella registrazione.";

                            $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$riga["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'BENVENUTO in OrientamentoU',
                            'Complimenti!<br>Ora fai parte di <i>OrientamentoU</i>, il sito che ti permette di decidere con tutta tranquillità la tua Università ed il tuo corso di studi.<br>Grazie, dal team di OrientamentoU.', 'no')";
                            $c->query($sql);
                        }
                        else
                        {
                            echo "Codice di conferma errato! Riprovare.";
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