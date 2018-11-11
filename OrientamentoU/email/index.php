<html>
    <head>
        <title>Email by SM</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/email/header.php"); ?>
    </head>

    <body>
        <div id="body">
            <?php
            $accesso=false;
            $errore=false;
            if(isset($_GET["email"]))
            {
                $c=new mysqli("localhost","root","","orientamento");
                $c->set_charset("utf8");

                $sql="SELECT * FROM utenti WHERE email='".$_GET["email"]."'";
                $r=$c->query($sql);
                if($r->num_rows>0)
                {
                    $accesso=true;
                }else $errore=true;
                $c->close();
            }
            if(!$accesso)
            {
            ?>
                <div id="login">
                    <form method="get" action="">
                        <?php if($errore) echo "<font class='errore'>Errore: Email non corretta!</font><br><br>"; ?>
                        <input type="email" class="txtbox" placeholder="Email" name="email" required />
                        <br/>
                        <br/>
                        <input type="submit" class="bttbox" value="Accedi" />
                    </form>
                </div>
            <?php
            }
            else
            {
            ?>
                <div id="logged"><?php echo $_GET["email"]; ?></div>
                <center><small>Per aprire una email fare doppio clic sulla stessa.<br>Le email bianche sono NON LETTE, quelle azzurre sono GIA' LETTE</small></center>
                <?php
                    $c=new mysqli("localhost","root","","orientamento");
                    $c->set_charset("utf8");

                    $sql="SELECT * FROM mail WHERE email='".$_GET["email"]."' ORDER BY data DESC";
                    $r=$c->query($sql);
                    if($r->num_rows>0)
                    {
                        $cont=0;
                        while($riga=$r->fetch_assoc())
                        {
                            ?>
                            <div class="messaggio" <?php if($riga["letta"]=="si"){ echo "id='letto'"; } ?> ondblclick="espandi('<?php echo $cont; ?>');lettura_mail('<?php echo $riga["id"]."','".$cont; ?>');">
                                <?php echo $riga["data"]." • Oggetto: <b>".$riga["oggetto"]."</b>"; ?>
                                <div class="espanso" style="display:none;"><?php echo "<br>Mittente: ".$riga["email_da"]."<hr>".$riga["messaggio"]; ?></div>
                            </div>
                            <?php
                            $cont++;
                        }
                    }else{ echo "Non è disponibile alcuna mail!"; }
                    $c->close();
                ?>
            <?php
            }
            ?>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/email/menu.php"); ?>
    </body>
</html>