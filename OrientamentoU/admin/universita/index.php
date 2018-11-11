<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                Aggiungi • Università
            </div>
            <div id="body_ttt">
                <div id="body_add_admin">
                    <?php if($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10"){ ?>
                    <font id="msg_note"></font>
                    <script>
                        function assegna_citta(citta)
                        {
                            document.getElementById("citta").value=citta;
                        }
                    </script>
                    <input type="text" placeholder="Nome" class="admin_txtbox" id="nome" />
                    <input type="text" placeholder="Sigla" class="admin_txtbox" id="sigla" />
                    <input type="text" class="admin_txtbox" id="citta" placeholder="Id Città (READ ONLY) -> Usare la 'select'" readonly />
                    <select class="admin_txtbox" onchange="assegna_citta(this.value)" id="citta_select">
                        <option value="">-Selezionare Città-</option>
                        <?php
                            $c=new mysqli("localhost","root","","orientamento");
                            $c->set_charset("utf8");

                            $sql="SELECT * FROM province";
                            $r=$c->query($sql);
                            if($r->num_rows>0)
                            {
                                while($riga=$r->fetch_assoc())
                                {
                                    echo '<option value="'.$riga["id"].'">'.$riga["nome"].' ('.$riga["sigla"].') - '.$riga["id"].'</option>';
                                }
                            }
                            $c->close();
                        ?>
                    </select>
                    <input type="text" placeholder="Indirizzo" class="admin_txtbox" id="indirizzo" />
                    <input type="text" placeholder="Sito web" class="admin_txtbox" id="sito" />
                    <textarea placeholder="Note" class="admin_txtbox" id="note"></textarea>
                    <select class="admin_txtbox" id="grandezza">
                        <option value="piccolo">Piccolo</option>
                        <option value="medio">Medio</option>
                        <option value="grande">Grande</option>
                        <option value="mega">Mega</option>
                        <option value="politecnico">Politecnico</option>
                    </select>
                    <input type="text" placeholder="Valutazione (su 5)" class="admin_txtbox" id="valutazione" />
                    <input type="text" list="suggerimenti" class="admin_txtbox" value="Facebook" id="fonte">
                    <datalist id="suggerimenti">
                        <option value="Google" />
                        <option value="Facebook" />
                    </datalist>

                    <input type="button" value="Aggiungi" class="admin_btt" onclick="add_new('uni')" />
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>