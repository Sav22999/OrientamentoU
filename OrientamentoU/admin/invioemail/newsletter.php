<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                Invia email • Newsletter
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
                    Sono mostrate solo le Università seguite da almeno un utente.<br>
                    <input type="text" class="admin_txtbox" id="id_uni" placeholder="Id Università (READ ONLY) -> usare la 'select'" readonly />
                    <select class="admin_txtbox" onchange="assegna_id_uni(this.value)" id="id_uni_select">
                        <option value="">-Selezionare Università-</option>
                        <?php
                            $c=new mysqli("localhost","root","","orientamento");
                            $c->set_charset("utf8");

                            $sql="SELECT universita.* FROM universita INNER JOIN uniute ON universita.id=uniute.universita";
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
                    <textarea placeholder="Messaggio" class="admin_txtbox" id="messaggio"></textarea>

                    <input type="button" value="Invia" class="admin_btt" id="btt_invio_email" onclick="invia_email('universita')" />
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>