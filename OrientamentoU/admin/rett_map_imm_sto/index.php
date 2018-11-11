<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                Aggiungi • Rettore, Slide, Mappa e Storia
            </div>
            <div id="body_ttt">
                <div id="body_add_admin">
                    <?php if($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10"){ ?>
                    <font id="msg_note"></font>
                    <script>
                        function assegna_id_uni(id_uni)
                        {
                            document.getElementById("id_uni").value=id_uni;
                        }
                    </script>
                    <input type="text" class="admin_txtbox" id="id_uni" placeholder="Id Università (READ ONLY) -> Usare la 'select'" readonly />
                    <select class="admin_txtbox" onchange="assegna_id_uni(this.value)" id="id_uni_select">
                        <option value="">-Selezionare Università-</option>
                        <?php
                            $c=new mysqli("localhost","root","","orientamento");
                            $c->set_charset("utf8");

                            $sql="SELECT * FROM universita";
                            $r=$c->query($sql);
                            if($r->num_rows>0)
                            {
                                while($riga=$r->fetch_assoc())
                                {
                                    echo '<option value="'.$riga["id"].'">'.$riga["id"].' - '.$riga["nome"].'</option>';
                                }
                            }
                            $c->close();
                        ?>
                    </select>
                    <h1>Rettore</h1>
                    <input type="text" placeholder="Nome" class="admin_txtbox" id="nome" />
                    <input type="text" placeholder="Cognome" class="admin_txtbox" id="cognome" />
                    <input type="date" placeholder="Data inizio carica" class="admin_txtbox" id="data" />
                    <h1>Slide</h1>
                    <input type="text" placeholder="URL immagine" class="admin_txtbox" id="urli" value="http://localhost/OrientamentoU/img/1.jpg" />
                    <input type="text" placeholder="Link" class="admin_txtbox" id="link" />
                    <h1>Mappa</h1>
                    <input type="text" placeholder="URL mappa" class="admin_txtbox" id="urlm" value="http://localhost/OrientamentoU/img/_mappa.jpg" />
                    <h1>Storia</h1>
                    <textarea placeholder="Testo" class="admin_txtbox" id="storia"></textarea>

                    <input type="button" value="Aggiungi" class="admin_btt" onclick="add_new('rsms')" />
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>