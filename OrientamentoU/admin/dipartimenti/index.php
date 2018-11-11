<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                Aggiungi • Dipartimento
            </div>
            <div id="body_ttt">
                <div id="body_add_admin">
                    <?php if($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10"){ ?>
                    <font id="msg_note"></font>
                    <input type="text" placeholder="Nome" class="admin_txtbox" id="nome" />
                    <input type="text" placeholder="Sigla" class="admin_txtbox" id="sigla" />
                    <textarea placeholder="Note" class="admin_txtbox" id="note"></textarea>

                    <input type="button" value="Aggiungi" class="admin_btt" onclick="add_new('dipa')" />
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>