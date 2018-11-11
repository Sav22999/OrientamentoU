<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                Aggiungi • Corso
            </div>
            <div id="body_ttt">
                <div id="body_add_admin">
                    <?php if($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10"){ ?>
                    <font id="msg_note"></font>
                    <input type="text" placeholder="Nome" class="admin_txtbox" id="nome" />
                    <input type="text" placeholder="Codice" class="admin_txtbox" id="codice" />
                    <select class="admin_txtbox" id="tipo">
                        <option value="">-Selezionare Tipo di corso-</option>
                        <option value="triennale">Triennale</option>
                        <option value="magistrale">Magistrale</option>
                        <option value="ciclo unico">Ciclo unico</option>
                        <option value="dottorato di ricerca">Dottorato di ricerca</option>
                    </select>
                    <textarea placeholder="Note" class="admin_txtbox" id="note"></textarea>

                    <input type="button" value="Aggiungi" class="admin_btt" onclick="add_new('corsi')" />
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>