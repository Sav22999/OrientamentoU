<html>
    <head>
        <title>Ricerca</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body>
        <div id="body_ttt"></div>
        <div id="body">
            <?php
            if(isset($_GET["k"]) && $_GET["k"]!="" && isset($_GET["filtro"]))
            {
                echo "<style>#contenuto_ricerca{padding-top:50px;padding-bottom:50px;}#ricerca_sfondonero{height:200px;margin-top:-50px;}#ricerca{padding-top:50px;padding-bottom:40px;}</style>";
            }
            ?>
            <div id="contenuto_ricerca">
                <div id="ricerca">
                    <div id="ricerca_sfondonero"></div>
                    <form action="" method="get">
                        <input type="text" id="txt" name="k" placeholder="<?php if($_SESSION["lingua"]=="en"){ ?>Type something...<?php }else{ ?>Digita qualcosa...<?php } ?>" value="<?php if(isset($_GET["k"])){echo $_GET["k"];} ?>" list="universita_lista" />
                        <input type="submit" id="btt" value="<?php if($_SESSION["lingua"]=="en"){ ?>Search<?php }else{ ?>Cerca<?php } ?>" />
                        <br>
                        <input type="text" name="filtro" value="<?php if(!isset($_GET["filtro"])){echo "uni";} ?>" id="cerca_per_filtro" readonly hidden />
                        <label id="cerca_per_label"><?php if($_SESSION["lingua"]=="en"){ ?>Filter for:<?php }else{ ?>Cerca per:<?php } ?></label> <input type="button" onclick="cerca_per('uni')" id="cerca_per_uni" class="cerca_per" value="<?php if($_SESSION["lingua"]=="en"){ ?>Universities<?php }else{ ?>Università<?php } ?>" /><input type="button" onclick="cerca_per('dip')" id="cerca_per_dip" class="cerca_per" value="<?php if($_SESSION["lingua"]=="en"){ ?>Departments<?php }else{ ?>Dipartimenti<?php } ?>" /><input type="button" onclick="cerca_per('cor')" id="cerca_per_cor" class="cerca_per" value="<?php if($_SESSION["lingua"]=="en"){ ?>Degree courses<?php }else{ ?>Corsi<?php } ?>" />
                        <?php if(isset($_GET["filtro"])){echo "<script>cerca_per('".$_GET["filtro"]."');</script>";} ?>
                    </form>
                </div>
            </div>
            <datalist id="universita_lista">
                <?php
                $c=new mysqli("localhost","root","","orientamento");
                $c->set_charset("utf8");

                $sql="SELECT nome FROM universita";
                $r=$c->query($sql);
                if($r->num_rows>0)
                {
                    while($riga=$r->fetch_assoc())
                    {
                        echo '<option value="'.$riga["nome"].'">';
                    }
                }
                $sql="SELECT nome FROM dipartimenti";
                $r=$c->query($sql);
                if($r->num_rows>0)
                {
                    while($riga=$r->fetch_assoc())
                    {
                        echo '<option value="'.$riga["nome"].'">';
                    }
                }
                $sql="SELECT nome FROM corsi";
                $r=$c->query($sql);
                if($r->num_rows>0)
                {
                    while($riga=$r->fetch_assoc())
                    {
                        echo '<option value="'.$riga["nome"].'">';
                    }
                }
                
                $c->close();
                ?>
            </datalist>
            <?php
            if(isset($_GET["k"]) && $_GET["k"]!="" && isset($_GET["filtro"]))
            {
                $c=new mysqli("localhost","root","","orientamento");
                $c->set_charset("utf8");
                
                $sql="";
                //$sql="SELECT id FROM universita WHERE nome='".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_GET["k"]))."'";
                if($_GET["filtro"]=="uni")
                    $sql="SELECT id, nome
                        FROM universita
                        WHERE nome LIKE '%".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_GET["k"]))."%' OR sigla='".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_GET["k"]))."'";
                else if($_GET["filtro"]=="dip")
                    $sql="SELECT dipartimenti.nome, dipartimenti.id, universita.id AS id_uni, universita.nome AS nome_uni
                        FROM dipartimenti, universita, unidip
                        WHERE dipartimenti.nome LIKE '%".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_GET["k"]))."%' AND dipartimenti.id=unidip.dipartimento AND universita.id=unidip.universita";
                else if($_GET["filtro"]=="cor")
                    $sql="SELECT corsi.id, corsi.nome, dipartimenti.nome AS nome_dip, dipartimenti.id AS id_dip, universita.id AS id_uni, universita.nome AS nome_uni
                    FROM dipartimenti, universita, unidip, corsi, dipcor
                    WHERE universita.id=unidip.universita AND universita.id=dipcor.universita AND unidip.dipartimento=dipartimenti.id AND dipcor.dipartimento=dipartimenti.id AND dipcor.corso=corsi.id AND corsi.nome LIKE '%".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_GET["k"]))."%'";
                $r=$c->query($sql);
                if($r->num_rows==1)
                {
                    while($riga=$r->fetch_assoc())
                    {
                        if($_GET["filtro"]=="uni")
                        {echo '<meta http-equiv="refresh" content="0;URL=http://localhost/OrientamentoU/universita/?uni='.$riga["id"].'">';}
                        else if($_GET["filtro"]=="dip")
                        {echo '<meta http-equiv="refresh" content="0;URL=http://localhost/OrientamentoU/universita/?uni='.$riga["id_uni"].'&dip='.$riga["id"].'">';}
                        else if($_GET["filtro"]=="cor")
                        {echo '<meta http-equiv="refresh" content="0;URL=http://localhost/OrientamentoU/universita/?uni='.$riga["id_uni"].'&dip='.$riga["id_dip"].'&cor='.$riga["id"].'">';}
                    }
                }else if($r->num_rows>=1)
                {
                    echo '<div id="contenuto">';
                        while($riga=$r->fetch_assoc())
                        {
                            if($_GET["filtro"]=="uni")
                            {
                            ?>
                            <input type="button" id="risultato" onclick="location.href='http://localhost/OrientamentoU/universita/?uni=<?php echo $riga["id"]; ?>'" value='<?php echo str_replace("[[__[[apostrofo]]__]]","’",str_replace("'","[[__[[apostrofo]]__]]",$riga["nome"])); ?>' />
                            <?php
                            }
                            else if($_GET["filtro"]=="dip")
                            {
                            ?>
                            <input type="button" id="risultato" onclick="location.href='http://localhost/OrientamentoU/universita/?uni=<?php echo $riga["id_uni"]; ?>&dip=<?php echo $riga["id"]; ?>'" value='<?php echo str_replace("[[__[[apostrofo]]__]]","’",str_replace("'","[[__[[apostrofo]]__]]",$riga["nome"])); ?> • (<?php if($_SESSION["lingua"]=="en"){ ?>University<?php }else{ ?>Università<?php } ?>: <?php echo str_replace("[[__[[apostrofo]]__]]","’",str_replace("'","[[__[[apostrofo]]__]]",$riga["nome_uni"])); ?>)' />
                            <?php
                            }
                            else if($_GET["filtro"]=="cor")
                            {
                            ?>
                            <input type="button" id="risultato" onclick="location.href='http://localhost/OrientamentoU/universita/?uni=<?php echo $riga["id_uni"]; ?>&dip=<?php echo $riga["id_dip"]; ?>&cor=<?php echo $riga["id"]; ?>'" value='<?php echo str_replace("[[__[[apostrofo]]__]]","’",str_replace("'","[[__[[apostrofo]]__]]",$riga["nome"])); ?> • (<?php if($_SESSION["lingua"]=="en"){ ?>University<?php }else{ ?>Università<?php } ?>: <?php echo str_replace("[[__[[apostrofo]]__]]","’",str_replace("'","[[__[[apostrofo]]__]]",$riga["nome_uni"])); ?> • <?php if($_SESSION["lingua"]=="en"){ ?>Department<?php }else{ ?>Dipartimento<?php } ?>: <?php echo str_replace("[[__[[apostrofo]]__]]","’",str_replace("'","[[__[[apostrofo]]__]]",$riga["nome_dip"])); ?>)' />
                            <?php
                            }
                        }
                    echo "</div>";
                }else
                {
                    echo '<div id="contenuto">';
                    if($_SESSION["lingua"]=="en")
                    {
                        echo "The search returns nothing.";
                    }
                    else
                    {
                        echo "Nessun risultato corrisponde alla ricerca.";
                    }
                    echo '</div>';
                }
                $c->close();
            }
            ?>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
        <script>menu_sel(4);</script>
    </body>
</html>