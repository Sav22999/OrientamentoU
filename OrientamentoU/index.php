<html>
    <head>
        <title>OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>
    
    <body onload="menu_sel(0);">
        <div id="body">
            <div id="body_ttt"></div>
            <div id="contenuto">
                <?php if(isset($_GET["lingua"])) if($_GET["lingua"]=="it" || $_GET["lingua"]=="en") $_SESSION["lingua"]=$_GET["lingua"]; ?>
                <?php if($_SESSION["lingua"]=="en"){ ?>
                <center>
                    <h1 class="home">ALL UNIVERSITIES</h1>
                    <h1 class="home" id="meno">OF ITALY IN AN UNIQUE PLACE</h1>
                    <h1 class="home" id="sceglilatua">
                        <font class="word">C</font><font class="word">H</font><font class="word">O</font><font class="word">O</font><font class="word">S</font><font class="word">E</font> <font class="word">Y</font><font class="word">O</font><font class="word">U</font><font class="word">R</font><font class="word">S</font><font class="word">!</font>
                    </h1>
                </center>
                <?php }else{ ?>
                <center>
                    <h1 class="home">TUTTE LE UNIVERSITA'</h1>
                    <h1 class="home" id="meno">D'ITALIA IN UN UNICO POSTO</h1>
                    <h1 class="home" id="sceglilatua">
                        <font class="word">S</font><font class="word">C</font><font class="word">E</font><font class="word">G</font><font class="word">L</font><font class="word">I</font> <font class="word">L</font><font class="word">A</font> <font class="word">T</font><font class="word">U</font><font class="word">A</font><font class="word">!</font>
                    </h1>
                </center>
                <?php } ?>
            </div>
            <div id="div_italia">
                <div id="darkred">
                    <center>
                        <?php if($_SESSION["lingua"]=="en"){ ?>This web site is constantly updated.<br/>Some Universities could be still not completed.<?php }else{ ?>Il sito è in costante aggiornamento.<br/>Alcune Università potrebbero risultare ancora incomplete.<?php } ?>
                    </center>
                </div>
                <div id="whitesmoke">
                    <center>
                        <?php if($_SESSION["lingua"]=="en"){ ?>See the web site in another language:<?php }else{ ?>Visualizza il sito in un'altra lingua:<?php } ?>
                        <br>
                        <input type="button" onclick="location.href='./?lingua=it'" id="italiano_lingua" value="Italiano" /><input type="button" onclick="location.href='./?lingua=en'" id="inglese_lingua" value="English" />
                    </center>
                </div>
                <div id="lightblue">
                    <center>
                        <?php if($_SESSION["lingua"]=="en"){ ?>Access to "Em@il by SM", the emulator of a client email<?php }else{ ?>Accedi a "Em@il by SM" l'emulatore di un client email<?php } ?>
                        <br>
                        <input type="button" onclick="location.href='./email/'" id="email_by_sm" value="Em@il by SM" />
                    </center>
                </div>
                <div id="darkred">
                    <center>
                        <video src="http://localhost/OrientamentoU/video/presentazione.mp4" width="80%" height="auto" style="border-radius:20px;" loop controls></video>
                    </center>
                </div>
                <div id="mappa_italia_div">
                    <img id="img_italia" src="http://localhost/OrientamentoU/img/italia_vuota.png" alt="" usemap="#mappa_italia" />
                    <img src="http://localhost/OrientamentoU/img/italia.png" alt="Italia" />
                    <!----Per poter creare l'effetto di "selezione" della regione è stata utilizzata una immagine BIANCA superiore con la "map", nel secondo livello c'è la regione e come sfondo c'è la mappa dell'italia---->
                    <div onmouseout="leave_regione()" id="regione_hover_img" onclick=""></div>
                    <map name="mappa_italia">
                    <?php
                        $c=new mysqli("localhost","root","","orientamento");
                        $c->set_charset("utf8");

                        $sql="SELECT * FROM regioni";
                        $r=$c->query($sql);
                        if($r->num_rows>0)
                        {
                            while($riga=$r->fetch_assoc())
                            {
                                echo '<area onmouseover="hover_regione(\''.$riga["sigla"].'\', \''.$riga["w"].'\', \''.$riga["h"].'\', \''.$riga["t"].'\', \''.$riga["l"].'\')" title="'.$riga["nome"].'" onmouseout="leave_regione()" shape="poly" coords="'.$riga["coords"].'" href="http://localhost/OrientamentoU/universita/reg/?r='.$riga["sigla"].'" />';
                            }
                        }
                        $c->close();
                    ?>
                    </map>
                </div>
                <div id="darkred">
                    <center>
                        <?php if($_SESSION["lingua"]=="en"){ ?>This web site is realised by Saverio Morelli<?php }else{ ?>Sito web realizzato da Saverio Morelli<?php } ?>
                    </center>
                </div>
            </div>
            
            <style>
                .home
                {
                    display:none;
                    font-size:100px;
                }
                #meno
                {
                    font-size:40px;
                }
                #div_italia, .word
                {
                    display:none;
                }
                #img_italia
                {
                    position:absolute;
                    top:0px;
                    z-index:110;
                    width:480px;
                    height:600px;
                }
            </style>
            <script>
                $(document).ready(function()
                {
                    $(".home:eq(0)").delay(2000).fadeIn();
                    $(".home:eq(1)").delay(3000).fadeIn();
                    $(".home:eq(2)").delay(4000).fadeIn();
                    var tempo=0;
                    for(var i=0;i<12;i+=1)
                    {
                        $(".word:eq("+i+")").delay(4000+tempo).fadeIn();
                        tempo+=150;
                    }
                    $("#div_italia").delay(5650).fadeIn();
                });
            </script>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>