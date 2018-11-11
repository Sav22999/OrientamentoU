<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(5)">
        <div id="body">
            <div id="titolo">
                Aggiungi • DipCor
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
                        function assegna_id_dip(id_dip)
                        {
                            document.getElementById("id_dip").value=id_dip;
                        }
                        function assegna_id_cor(id_cor)
                        {
                            document.getElementById("id_cor").value=id_cor;
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
                    <input type="text" class="admin_txtbox" id="id_dip" placeholder="Id Dipartimento (READ ONLY) -> Usare la 'select'" readonly />
                    <select class="admin_txtbox" onchange="assegna_id_dip(this.value)" id="id_dip_select">
                        <option value="">-Selezionare Dipartimento-</option>
                        <?php
                            $c=new mysqli("localhost","root","","orientamento");
                            $c->set_charset("utf8");

                            $sql="SELECT * FROM dipartimenti";
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
                    <input type="text" class="admin_txtbox" id="id_cor" placeholder="Id Corso (READ ONLY) -> Usare la 'select'" readonly />
                    <select class="admin_txtbox" onchange="assegna_id_cor(this.value)" id="id_cor_select">
                        <option value="">-Selezionare Corso-</option>
                        <?php
                            $c=new mysqli("localhost","root","","orientamento");
                            $c->set_charset("utf8");

                            $sql="SELECT * FROM corsi";
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
                    <input type="text" list="suggerimenti" class="admin_txtbox" value="Italiano" placeholder="Lingua" id="lingua">
                    <datalist id="suggerimenti">
                        <option value="Italiano" />
                        <option value="English" />
                    </datalist>

                    <input type="button" value="Aggiungi" class="admin_btt" onclick="add_new('dipcor')" />
                    <?php }else{ echo "Permessi NON sufficienti."; } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>