<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body>
        <div id="body">
            <?php
            $tutte_universita=false;
            if(isset($_GET["uni"]) && $_GET["uni"]!="")
            {
                $c=new mysqli("localhost","root","","orientamento");
                $c->set_charset("utf8");
                $sql="SELECT nome FROM universita WHERE id='".$_GET["uni"]."'";
                $r=$c->query($sql);
                if($r->num_rows>0)
                {
                    $id_universita=$_GET["uni"];
                    $id_dip="";
                    if(isset($_GET["dip"])) $id_dip=$_GET["dip"];
                    $id_corso="";
                    if(isset($_GET["cor"])) $id_corso=$_GET["cor"];
                    $nome_universita="";
                    $nome_dipartimento="";
                    $codice_corso="";
                    $nome_corso="";
                    $nslide=0;
                    $id_regione="";
                    //connesione al database


                    $sql="SELECT province.regione FROM province INNER JOIN universita ON province.id=universita.citta AND universita.id='".$_GET["uni"]."'";
                    $r=$c->query($sql);
                    if($r->num_rows>0)
                    {
                        $riga=$r->fetch_assoc();
                        $id_regione=$riga["regione"];
                    }

                    $sql="SELECT * FROM universita WHERE id='".$id_universita."'";
                    $r=$c->query($sql);
                    if($r->num_rows>0)
                    {
                        $riga=$r->fetch_assoc();
                        $nome_universita=$riga["nome"];
                    }

                    if(isset($_GET["dip"]))
                    {
                        $sql="SELECT * FROM dipartimenti WHERE id='".$_GET["dip"]."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            $riga=$r->fetch_assoc();
                            $nome_dipartimento=$riga["nome"];
                        }

                        if(isset($_GET["cor"]))
                        {
                            $sql="SELECT * FROM corsi WHERE id='".$_GET["cor"]."'";
                            $r=$c->query($sql);
                            if($r->num_rows>0)
                            {
                                $riga=$r->fetch_assoc();
                                $nome_corso=$riga["nome"];
                                $codice_corso=$riga["codice"];
                            }
                        }
                    }
                ?>
                <div id="titolo" style="border-bottom:0px;box-shadow:0px 0px 10px darkred;">
                    <?php if($_SESSION["lingua"]=="en"){$dip_it_en="Department";}else{$dip_it_en="Dipartimento";} ?>
                    <?php if($_SESSION["lingua"]=="en"){$cor_it_en="Course";}else{$cor_it_en="Corso";} ?>
                    <?php echo $nome_universita; ?>
                    <?php echo $nome_dipartimento!="" ? "<br/><small><small><i>".$dip_it_en.":</i> ".$nome_dipartimento."</small></small>" : false; ?>
                    <?php echo $nome_corso!="" ? "<br/><small><small><small><i>".$cor_it_en.":</i> ".$nome_corso." (".$codice_corso.")</small></small></small>" : false; ?>
                </div>

                <?php
                    echo '<div id="body_ttt">';
                        $sql="SELECT nome FROM regioni WHERE sigla='".$id_regione."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                        ?>
                            <div id="universita_in_regione">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>This University is in the follow region<?php }else{ ?>Questa Università si trova nella seguente regione<?php } ?></h1>
                                <p class="contenuto">
                                    <?php echo $r->fetch_assoc()["nome"]; ?>
                                </p>
                            </div>
                        <?php
                        }
                    
                    
                $sql="SELECT * FROM immagini_slide WHERE universita='".$id_universita."'";
                $r=$c->query($sql);
                $nslide=$r->num_rows;
                $url_slide="";
                $url_imm="";
                if($r->num_rows>0)
                {
                    $riga=$r->fetch_assoc();
                    $url_imm=$riga["url"];
                    $url_slide="onclick=\"location.href='".$riga["link"]."'\"";
                ?>
                    <div id="immagini_slide">
                        <?php
                        if($_SESSION["lingua"]=="en"){$vai_al_sito="Visit University official web site";}else{$vai_al_sito="Vai al sito dell'Università";}
                        echo '
                        <script>
                            document.getElementById("immagini_slide").style.backgroundImage="url(\"'.$url_imm.'\")";;
                        </script>
                        <input type="button" class="bottone" id="vai_al_sito" value="'.$vai_al_sito.'" '.$url_slide.' />
                        ';
                        ?>
                    </div>
                <?php
                }
                ?>


                        <?php
                        $id_universita=$_GET["uni"];
                        $nome_universita="";
                        $sql="SELECT * FROM storia_universita WHERE universita='".$id_universita."' AND testo_".$_SESSION["lingua"]."!=''";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                        ?>
                            <div id="storia_universita">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>University history<?php }else{ ?>Storia dell'Università<?php } ?></h1>
                                <p class="contenuto">
                                    <?php
                                    $riga=$r->fetch_assoc();
                                    if($_SESSION["lingua"]=="en")
                                    {
                                        echo $riga["testo_en"];
                                    }else
                                    {
                                        echo $riga["testo_it"];
                                    }
                                    ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>

                <?php
                if(!isset($_GET["dip"]) && !isset($_GET["cor"]))
                {
                ?>
                    <div id="dipartimenti">
                        <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Departments<?php }else{ ?>Dipartimenti<?php } ?></h1>
                        <p class="contenuto">
                    <?php
                    $sql="SELECT * FROM unidip INNER JOIN dipartimenti ON unidip.universita='".$id_universita."' AND unidip.dipartimento=dipartimenti.id";
                    $r=$c->query($sql);
                    $dipartimenti=array();
                    $id_dipartimenti=array();
                        if($r->num_rows>0)
                        {
                        ?>
                            <?php
                            while($riga=$r->fetch_assoc())
                            {
                                echo '<input type="button" class="bottone_sezione" value="'.ucwords(mb_strtolower($riga["nome"],'UTF-8')).'" onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$riga["id"].'\'" />';
                            }
                            ?>
                        <?php
                        }
                        else
                        {
                            if($_SESSION["lingua"]=="en")
                            {
                                echo 'We are so sorry. There is not availability any departments for this University.<br>Follow it to receive updates.';
                            }
                            else
                            {
                                echo 'Siamo spiacenti. Non è disponibile ancora alcun dipartimento per questa Università.<br>Seguila per poter ricevere aggiornamenti.';
                            }
                        }
                        ?>
                        </p>
                    </div>
                <?php
                }
                if(isset($_GET["dip"]) && !isset($_GET["cor"]))
                {
                ?>
                        <?php
                        $sql="SELECT * FROM corsi INNER JOIN dipcor ON corsi.id=dipcor.corso AND dipcor.dipartimento='".$_GET["dip"]."' AND dipcor.universita='".$_GET["uni"]."' AND corsi.tipo='triennale'";
                        $r=$c->query($sql);
                        $corsi=array();
                        $id_corsi=array();
                        if($r->num_rows>0)
                        {
                            ?>
                            <div id="corsi">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Degree course (Bachelor 3 years)<?php }else{ ?>Corsi (triennale)<?php } ?></h1>
                                <p class="contenuto">
                            <?php
                            while($riga=$r->fetch_assoc())
                            {
                                $lingua="";
                                if($riga["lingua"]!="Italiano") $lingua=" - ".$riga["lingua"];
                                echo '<input type="button" class="bottone_sezione" value="'.ucwords(mb_strtolower($riga["nome"],'UTF-8')).' ('.$riga["codice"].')'.$lingua.'" onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'" />';
                                //onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'"
                            }
                            ?>
                                </p>
                            </div>       
                        <?php
                        }
                        ?>

                        <?php
                        $sql="SELECT * FROM corsi INNER JOIN dipcor ON corsi.id=dipcor.corso AND dipcor.dipartimento='".$_GET["dip"]."' AND dipcor.universita='".$_GET["uni"]."' AND corsi.tipo='magistrale'";
                        $r=$c->query($sql);
                        $corsi=array();
                        $id_corsi=array();
                        if($r->num_rows>0)
                        {
                            ?>
                            <div id="corsi">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Degree course (Master)<?php }else{ ?>Corsi (magistrale)<?php } ?></h1>
                                <p class="contenuto">
                            <?php
                            while($riga=$r->fetch_assoc())
                            {
                                $lingua="";
                                if($riga["lingua"]!="Italiano") $lingua=" - ".$riga["lingua"];
                                echo '<input type="button" class="bottone_sezione" value="'.ucwords(mb_strtolower($riga["nome"],'UTF-8')).' ('.$riga["codice"].')'.$lingua.'" onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'" />';
                                //onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'"
                            }?>
                                </p>
                            </div>       
                        <?php
                        }
                        ?>

                        <?php
                        $sql="SELECT * FROM corsi INNER JOIN dipcor ON corsi.id=dipcor.corso AND dipcor.dipartimento='".$_GET["dip"]."' AND dipcor.universita='".$_GET["uni"]."' AND corsi.tipo='ciclo unico'";
                        $r=$c->query($sql);
                        $corsi=array();
                        $id_corsi=array();
                        if($r->num_rows>0)
                        {
                            ?>
                            <div id="corsi">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Degree course (Bachelor 5 years)<?php }else{ ?>Corsi (ciclo unico)<?php } ?></h1>
                                <p class="contenuto">
                            <?php
                            while($riga=$r->fetch_assoc())
                            {
                                $lingua="";
                                if($riga["lingua"]!="Italiano") $lingua=" - ".$riga["lingua"];
                                echo '<input type="button" class="bottone_sezione" value="'.ucwords(mb_strtolower($riga["nome"],'UTF-8')).' ('.$riga["codice"].')'.$lingua.'" onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'" />';
                                //onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'"
                            }?>
                                </p>
                            </div>       
                        <?php
                        }
                        ?>

                        <?php
                        $sql="SELECT * FROM corsi INNER JOIN dipcor ON corsi.id=dipcor.corso AND dipcor.dipartimento='".$_GET["dip"]."' AND dipcor.universita='".$_GET["uni"]."' AND corsi.tipo='dottorato di ricerca'";
                        $r=$c->query($sql);
                        $corsi=array();
                        $id_corsi=array();
                        if($r->num_rows>0)
                        {
                            ?>
                            <div id="corsi">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>PhD<?php }else{ ?>Dottorati di ricerca<?php } ?></h1>
                                <p class="contenuto">
                            <?php
                            while($riga=$r->fetch_assoc())
                            {
                                $lingua="";
                                if($riga["lingua"]!="Italiano") $lingua=" - ".$riga["lingua"];
                                echo '<input type="button" class="bottone_sezione" value="'.ucwords(mb_strtolower($riga["nome"],'UTF-8')).''.$lingua.'" onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'" />';
                                //onclick="location.href=\'.\?uni='.$_GET["uni"].'&dip='.$_GET["dip"].'&cor='.$riga["id"].'\'"
                            }?>
                                </p>
                            </div>       
                        <?php
                        }
                        ?>
                <?php
                }
                /**/
                if(isset($_GET["cor"]))
                {
                ?>
                        <div id="materie_esami">
                            <?php
                            $sql="SELECT materie.* FROM materie INNER JOIN cormat ON materie.id=cormat.materia WHERE cormat.corso='".$_GET["cor"]."'";
                            $r=$c->query($sql);
                            if($r->num_rows>0)
                            {
                            ?>
                            <div id="materie">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Subjects<?php }else{ ?>Materie<?php } ?></h1>
                                <p class="contenuto">
                                    <?php
                                    while($riga=$r->fetch_assoc())
                                    {
                                        $freq_obb="";
                                        if($riga["frequenza_obbligatoria"]=="si") $freq_obb=" (F.O.&sup1;)";
                                        echo '<input type="button" class="bottone_sezione" value="'.$riga["nome"].''.$freq_obb.' - '.$riga["anno"].' anno">';
                                    }
                                    echo "&sup1; Frequenza Obbligatoria";
                                    ?>
                                </p>
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            $sql="SELECT esami.*, materie.nome FROM esami INNER JOIN (materie INNER JOIN cormat ON materie.id=cormat.materia) ON esami.materia=materie.id WHERE cormat.corso='".$_GET["cor"]."'";
                            $r=$c->query($sql);
                            if($r->num_rows>0)
                            {
                            ?>
                            <div id="esami">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Exams<?php }else{ ?>Esami<?php } ?></h1>
                                <p class="contenuto">
                                    <?php
                                    while($riga=$r->fetch_assoc())
                                    {
                                        $obb=" - Facolt.";
                                        if($riga["obbligatorio"]=="si") $obb=" - Obblig.";
                                        echo '<input type="button" class="bottone_sezione" value="'.$riga["nome"].$obb.' - '.$riga["cfu"].' CFU" >';
                                    }
                                    ?>
                                    </p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                <?php
                }
                /**/
                ?>

                        <?php
                        $sql="SELECT * FROM servizi WHERE universita='".$id_universita."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                        ?>
                        <div id="servizi">
                            <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Services<?php }else{ ?>Servizi<?php } ?></h1>
                            <p class="contenuto">
                                <?php
                                while($riga=$r->fetch_assoc())
                                {
                                    echo '<input type="button" class="bottone_sezione" value="'.$riga["nome"].'">';
                                }
                                ?>
                            </p>
                        </div>
                        <?php
                        }
                        ?>

                    <?php
                    $id_universita=$_GET["uni"];
                    $nome_universita="";
                    $sql="SELECT * FROM mappa WHERE universita='".$id_universita."'";
                    $r=$c->query($sql);
                    $nslide=$r->num_rows;
                    if($r->num_rows>0)
                    {
                    ?>
                    <div id="mappa">
                        <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Location<?php }else{ ?>Posizione<?php } ?></h1>
                            <?php
                            while($riga=$r->fetch_assoc())
                            {
                                echo '
                                <script>
                                    document.getElementById("mappa").style.backgroundImage="url(\"'.$riga["url"].'\")";;
                                </script>
                                ';
                            }
                            ?>
                    </div>
                    <?php
                    }
                    ?>

                <div id="come_arrivare_docenti">
                            <?php
                            $sql="SELECT * FROM come_arrivare WHERE universita='".$id_universita."'";
                            $r=$c->query($sql);
                            if($r->num_rows>0)
                            {
                            ?>
                            <div id="come_arrivare">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>How to arrive<?php }else{ ?>Come arrivare<?php } ?></h1>
                                <p class="contenuto">
                                    <?php
                                    while($riga=$r->fetch_assoc())
                                    {
                                        echo '<input type="button" class="bottone_sezione" value="'.$riga["mezzo"].'">';
                                    }
                                    ?>
                                </p>
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if(isset($_GET["cor"]))
                            {
                                $sql="SELECT docenti.* FROM docenti INNER JOIN cordoc ON docenti.id=cordoc.docente WHERE docenti.universita='".$id_universita."' AND cordoc.corso='".$_GET["cor"]."'";
                                $r=$c->query($sql);
                                if($r->num_rows>0)
                                {
                                ?>
                                <div id="docenti">
                                    <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Teacher<?php }else{ ?>Docenti<?php } ?></h1>
                                    <p class="contenuto">
                                        <?php
                                        while($riga=$r->fetch_assoc())
                                        {
                                            echo '<input type="button" class="bottone_sezione" value="Prof. '.$riga["nome"].' '.$riga["cognome"].'">';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <?php
                                }
                                else
                                {
                                    echo'
                                    <script>
                                        document.getElementById("come_arrivare").style.width="100%";
                                        document.getElementById("come_arrivare").style.clear="both";
                                    </script>
                                    ';
                                }
                            }
                            else
                            {
                                echo'
                                    <script>
                                        document.getElementById("come_arrivare").style.width="100%";
                                        document.getElementById("come_arrivare").style.clear="both";
                                    </script>
                                    ';
                            }
                            ?>
                </div>

                        <?php
                        $sql="SELECT * FROM rettori WHERE universita='".$id_universita."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                        ?>
                        <div id="rettore">
                            <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Dean<?php }else{ ?>Rettore<?php } ?></h1>
                            <p class="contenuto">
                                <?php
                                $riga=$r->fetch_assoc();
                                $anno_inizio="";
                                if($riga["anno_inizio_carica"]!="") $anno_inizio=" (dal ".$riga["anno_inizio_carica"].")";
                                echo '<input type="button" class="bottone_sezione" value="'.$riga["nome"].' '.$riga["cognome"].$anno_inizio.'">';
                                ?>
                            </p>
                        </div>
                        <?php
                        }
                        ?>

                        <?php
                        $sql="SELECT * FROM alunni_noti WHERE universita='".$id_universita."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                        ?>
                            <div id="alunni_noti">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Known alumni<?php }else{ ?>Alunni noti<?php } ?></h1>
                                <p class="contenuto">
                                <?php
                                while($riga=$r->fetch_assoc())
                                {
                                    echo '<input type="button" class="bottone_sezione" value="'.$riga["nome"].' '.$riga["cognome"].' ('.$riga["professioni"].')" onclick="window.open(\'https://www.google.it/search?q='.$riga["nome"].' '.$riga["cognome"].' ('.$riga["professioni"].')\')">';
                                }
                                ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>


                        <?php
                        $sql="SELECT universita.nome, universita.id FROM province INNER JOIN universita ON universita.citta=province.id AND province.regione='".$id_regione."' AND universita.id!='".$_GET["uni"]."'";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                        ?>
                            <div id="potrebbe_interessarti_anche">
                                <h1 class="titolo"><?php if($_SESSION["lingua"]=="en"){ ?>You could also be interested in... <?php }else{ ?>Potrebbe anche interessarti...<?php } ?></h1>
                                <p class="contenuto">
                                <?php
                                while($riga=$r->fetch_assoc())
                                {
                                    echo '<input type="button" class="bottone_sezione" value="'.$riga["nome"].'" onclick="location.href=\'\\?uni='.$riga["id"].'\'">';
                                }
                                ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>

                <div id="newsletter_universita">
                    <h1 class="titolo">
                        <?php if($_SESSION["lingua"]=="en"){ ?>Get news and updates about this University: you will receive, via email, every update.<?php }else{ ?>Ricevi notizie ed aggiornamenti riguardanti questa Universit&#224;: riceverai, tramite email, ogni aggiornamento.<?php } ?>
                        <br/>
                        <?php
                        if($_SESSION["lingua"]=="en"){$stringa_newsletter_universita="Follow this University";}else{$stringa_newsletter_universita="Segui questa Universit&#224;";}
                        if($id_utente!="")
                        {
                            $r=$c->query("SELECT * FROM uniute WHERE universita='".$_GET["uni"]."' AND utente='".$id_utente."'");
                            if($r->num_rows>0)
                                if($_SESSION["lingua"]=="en"){$stringa_newsletter_universita="Unfollow this University";}else{$stringa_newsletter_universita="Smetti di seguire questa Universit&#224;";}
                            ?>
                            <input type="button" value="<?php echo $stringa_newsletter_universita; ?>" id="segui_universita_bottone" onclick="segui_universita('<?php echo $_GET["uni"]; ?>','<?php echo $id_utente; ?>')" />
                            <?php
                        }else
                        {
                            if($_SESSION["lingua"]=="en"){echo "To follow a University is necessary <a onclick='mostra_login(0, '".$id_utente."', '".$_SESSION["lingua"]."')'>login</a>.<br/>Aren't you still signed up? <a onclick='mostra_login(1, '".$id_utente."', '".$_SESSION["lingua"]."')'>Do it now</a>!";}else{echo "Per poter seguire una Universit&#224; &#232; necessario effettuare il <a onclick='mostra_login(0, '".$id_utente."', '".$_SESSION["lingua"]."')'>login</a>.<br/>Se non sei ancora registrato <a onclick='mostra_login(1, '".$id_utente."', '".$_SESSION["lingua"]."')'>fallo subito</a>.";}
                        }
                        ?>
                    </h1>
                </div>
                <?php
                    $c->close();

                    echo '</div>';
                }else $tutte_universita=true;
            }
            else $tutte_universita="true";
            
            if($tutte_universita)
            {
                echo '<div id="body_ttt"></div>';
				$c=new mysqli("localhost","root","","orientamento");
                $c->set_charset("utf8");
				$sql="SELECT id, nome FROM universita ORDER BY sigla";
				$r=$c->query($sql);
				if($r->num_rows>0)
				{
				?>
                <div id="titolo">
                    <?php if($_SESSION["lingua"]=="en"){ ?>Universities<?php }else{ ?>Università<?php } ?>
                    <input type="button" onclick="mostra_nascondi_ordina_per_panel()" id="uni_ordina_per" value="<?php if($_SESSION["lingua"]=="en"){ ?>Order by<?php }else{ ?>Ordina per<?php } ?>" />
                    <div id="uni_ordina_per_panel">
                        <input type="button" onclick="ordina_per('az');location.href='./?ordina=az';" id="az" class="uni_ordina_per_voce" value="<?php if($_SESSION["lingua"]=="en"){ ?>Name A-Z<?php }else{ ?>Nome A-Z<?php } ?>" />
                        <input type="button" onclick="ordina_per('za');location.href='./?ordina=za';" id="za" class="uni_ordina_per_voce" value="<?php if($_SESSION["lingua"]=="en"){ ?>Name Z-A<?php }else{ ?>Nome Z-A<?php } ?>" />
                        <input type="button" onclick="ordina_per('51');location.href='./?ordina=51';" id="51" class="uni_ordina_per_voce" value="<?php if($_SESSION["lingua"]=="en"){ ?>Evaluation 5-1<?php }else{ ?>Valutazione 5-1<?php } ?>" />
                        <input type="button" onclick="ordina_per('15');location.href='./?ordina=15';" id="15" class="uni_ordina_per_voce" value="<?php if($_SESSION["lingua"]=="en"){ ?>Evaluation 1-5<?php }else{ ?>Valutazione 1-5<?php } ?>" />
                    </div>    
                </div>
                <?php
                    $sql="";
                    if(isset($_GET["ordina"]))
                    {
                        if($_GET["ordina"]=="az")
                        {
                            echo "<script>ordina_per('az')</script>";
                            $sql="SELECT universita.nome, universita.id, universita.valutazione, universita.fonte_valutazione, immagini_slide.url FROM immagini_slide, universita WHERE universita.id=immagini_slide.universita ORDER BY universita.nome ASC";
                        }
                        else if($_GET["ordina"]=="za")
                        {
                            echo "<script>ordina_per('za')</script>";
                            $sql="SELECT universita.nome, universita.id, universita.valutazione, universita.fonte_valutazione, immagini_slide.url FROM immagini_slide, universita WHERE universita.id=immagini_slide.universita ORDER BY universita.nome DESC";
                        }
                        else if($_GET["ordina"]=="51")
                        {
                            echo "<script>ordina_per('51')</script>";
                            $sql="SELECT universita.nome, universita.id, universita.valutazione, universita.fonte_valutazione, immagini_slide.url FROM immagini_slide, universita WHERE universita.id=immagini_slide.universita ORDER BY universita.valutazione DESC";
                        }
                        else if($_GET["ordina"]=="15")
                        {
                            echo "<script>ordina_per('15')</script>";
                            $sql="SELECT universita.nome, universita.id, universita.valutazione, universita.fonte_valutazione, immagini_slide.url FROM immagini_slide, universita WHERE universita.id=immagini_slide.universita ORDER BY universita.valutazione ASC";
                        }
                    }else
                    {
                        echo "<script>ordina_per('51')</script>";
                        $sql="SELECT universita.nome, universita.id, universita.valutazione, universita.fonte_valutazione, immagini_slide.url FROM immagini_slide, universita WHERE universita.id=immagini_slide.universita ORDER BY universita.valutazione DESC";
                    }
                ?>
				<div id="contenuto" style="padding:0px;">
                    <?php
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            while($riga=$r->fetch_assoc())
                            {
                                if($_SESSION["lingua"]=="en"){$valutazione="Evaluated";}else{$valutazione="Valutata";}
                                if($_SESSION["lingua"]=="en"){$stelle="stars";}else{$stelle="stelle";}
                                if($_SESSION["lingua"]=="en"){$vedi_universita="See this University";}else{$vedi_universita="Vedi questa Università";}
                                echo '<div class="immagine_universita_regione" style="background-image:url(\''.$riga["url"].'\')"><font class="nome_universita">'.$riga["nome"].'</font><br/><font class="valutazione_universita_regione">'.$valutazione.' '.$riga["valutazione"].'/5 '.$stelle.' (su '.$riga["fonte_valutazione"].')</font><br/><input type="button" value="> '.$vedi_universita.'" onclick="location.href=\'http://localhost/OrientamentoU/universita/?uni='.$riga["id"].'\'" class="vedi_universita_button" /></div>';
                            }
                        }
                        $c->close();
                    ?>
                </div>
				<?php
				}
            }
            ?>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
        <?php if(!isset($_GET["uni"])) echo '<script>menu_sel(2);</script>'; ?>
    </body>
</html>