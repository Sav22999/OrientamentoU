<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body>
        <div id="body">
            <div id="titolo">
                <?php
                if(isset($_GET["r"]) && $_GET["r"]!="")
                {
                    $c=new mysqli("localhost","root","","orientamento");
                    $c->set_charset("utf8");

                    $sql="SELECT nome FROM regioni WHERE sigla='".$_GET["r"]."'";
                    $r=$c->query($sql);
                    if($r->num_rows>0)
                    {
                        $riga=$r->fetch_assoc();
                        echo $riga["nome"];
                    }
                    $c->close();
                }else
                    echo "Università";
                ?>
            </div>
            <div id="body_ttt"></div>
            <div id="contenuto" style="padding:0px;">
                <?php
                if(isset($_GET["r"]) && $_GET["r"]!="")
                {
					if($_SESSION["lingua"]=="en"){$vedi_universita="See this University";}else{$vedi_universita="Vedi questa Università";}
                    $c=new mysqli("localhost","root","","orientamento");
                    $c->set_charset("utf8");

                    $sql="SELECT universita.nome, universita.id, universita.valutazione, universita.fonte_valutazione, immagini_slide.url FROM immagini_slide, universita INNER JOIN province ON universita.citta=province.id AND province.regione='".$_GET["r"]."' WHERE universita.id=immagini_slide.universita ORDER BY universita.valutazione DESC";
                    $r=$c->query($sql);
                    if($r->num_rows>0)
                    {
                        while($riga=$r->fetch_assoc())
                        {
                            echo '<div class="immagine_universita_regione" style="background-image:url(\''.$riga["url"].'\')"><font class="nome_universita">'.$riga["nome"].'</font><br/><font class="valutazione_universita_regione">Valutata '.$riga["valutazione"].'/5 stelle (su '.$riga["fonte_valutazione"].')</font><br/><input type="button" value="> '.$vedi_universita.'" onclick="location.href=\'http://localhost/OrientamentoU/universita/?uni='.$riga["id"].'\'" class="vedi_universita_button" /></div>';
                        }
                    }
                    else
                    {
                        echo 'Non sono presenti Università per questa regione.';
                    }
                    $c->close();
                }else
                    echo '<meta http-equiv="refresh" content="0;URL=http://localhost/OrientamentoU/">';
                ?>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>