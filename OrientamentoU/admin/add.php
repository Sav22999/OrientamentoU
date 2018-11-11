<?php
if(isset($_GET["type"]))
{
    if($_GET["type"]=="rsms")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $c->query("INSERT INTO rettori(id,universita,nome,cognome,anno_inizio_carica) VALUES(NULL,'".$_POST["uni"]."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["nome"]))."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["cognome"]))."','".$_POST["data"]."')");
        
        $c->query("INSERT INTO immagini_slide(id,universita,url,link) VALUES(NULL,'".$_POST["uni"]."','".$_POST["urli"]."','".$_POST["link"]."')");
        
        $c->query("INSERT INTO mappa(id,universita,url) VALUES(NULL,'".$_POST["uni"]."','".$_POST["urlm"]."')");
        
        $c->query("INSERT INTO storia_universita(id,universita,testo) VALUES(NULL,'".$_POST["uni"]."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["storia"]))."')");
        
        echo "true";
    }
    else if($_GET["type"]=="uni")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $c->query("INSERT INTO universita(id,nome,sigla,citta,indirizzo,sitoweb,note,grandezza_ateneo,valutazione,fonte_valutazione) VALUES(NULL,'".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["nome"]))."','".$_POST["sigla"]."','".$_POST["citta"]."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["indirizzo"]))."','".$_POST["sito"]."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["note"]))."','".$_POST["grandezza"]."','".$_POST["valutazione"]."','".$_POST["fonte"]."')");
        
        echo "true";
    }
    else if($_GET["type"]=="dipa")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $c->query("INSERT INTO dipartimenti(id,nome,sigla,note) VALUES(NULL,'".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["nome"]))."','".$_POST["sigla"]."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["note"]))."')");
        
        echo "true";
    }
    else if($_GET["type"]=="unidip")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $c->query("INSERT INTO unidip(id_pk,universita,dipartimento) VALUES(NULL,'".$_POST["uni"]."','".$_POST["dip"]."')");
        
        echo "true";
    }
    else if($_GET["type"]=="corsi")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $c->query("INSERT INTO corsi(id,nome,codice,tipo,note) VALUES(NULL,'".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["nome"]))."','".$_POST["codice"]."','".$_POST["tipo"]."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["note"]))."')");
        
        echo "true";
    }
    else if($_GET["type"]=="dipcor")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $c->query("INSERT INTO dipcor(id,universita,dipartimento,corso,lingua) VALUES(NULL,'".$_POST["uni"]."','".$_POST["dip"]."','".$_POST["cor"]."','".$_POST["lingua"]."')");
        
        echo "true";
    }
}
?>