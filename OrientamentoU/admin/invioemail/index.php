<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                Invia email • Email normale
            </div>
            <div id="body_ttt">
                <div id="body_add_admin">
                    <?php if($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10"){ ?>
                    <font id="msg_note"></font>
                    <input type="text" class="admin_txtbox" id="oggetto" placeholder="Oggetto" />
                    <textarea placeholder="Messaggio" class="admin_txtbox" id="messaggio"></textarea>

                    <input type="button" value="Invia" class="admin_btt" id="btt_invio_email" onclick="invia_email('tutti')" />
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>