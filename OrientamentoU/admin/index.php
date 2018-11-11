<html>
    <head>
        <title>Admin | OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                <?php if($_SESSION["lingua"]=="en"){ ?>Admin • Reserved area<?php }else{ ?>Admin • Area riservata<?php } ?>
            </div>
            <div id="body_ttt">
                <div id="contenuto">
                    <?php if($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10"){ ?>
                    <?php if($_SESSION["lingua"]=="en"){ //inglese ?>
                    This area is available just in Italian language, because that is for the administration and it's <b>not</b> for normal users.<hr>
                    <?php } ?>
                    <?php if($_SESSION["permessi"]=="10"){ ?>
                    <h2>Gestione email e newsletter</h2>
                    <input type="button" value="Invia email a TUTTI gli utenti (normale email)" class="admin_btt" onclick="location.href='/OrientamentoU/admin/invioemail/'" />
                    <br>
                    <input type="button" value="Invia email agli utenti che seguono una determinata Università (newsletter)" class="admin_btt" onclick="location.href='/OrientamentoU/admin/invioemail/newsletter.php'" />
                    <hr>
                    <?php } ?>
                    <h2>Gestione delle Università:</h2>
                    <input type="button" value="Aggiungi nuova Università" class="admin_btt" onclick="location.href='/OrientamentoU/admin/universita/'" />
                    <br>
                    <input type="button" value="Aggiungi nuovo Dipartimento" class="admin_btt" onclick="location.href='/OrientamentoU/admin/dipartimenti/'" />
                    <br>
                    <input type="button" value="Aggiungi nuovo Corso di studio" class="admin_btt" onclick="location.href='/OrientamentoU/admin/corsi/'" />
                    <br>
                    <input type="button" value="Aggiungi relazione Università->Dipartimento" class="admin_btt" onclick="location.href='/OrientamentoU/admin/unidip/'" />
                    <br>
                    <input type="button" value="Aggiungi relazione Dipartimento->Corso" class="admin_btt" onclick="location.href='/OrientamentoU/admin/dipcor/'" />
                    <br>
                    <input type="button" value="Aggiunti Rettore, Mappa, Immagine slide e Storia di un'Università" class="admin_btt" onclick="location.href='/OrientamentoU/admin/rett_map_imm_sto/'" />
                    <br>
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>