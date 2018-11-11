<?php
if(isset($_GET["type"]) && isset($_GET["user"]) && isset($_GET["uni"]))
{
    if($_GET["type"]=="add")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->query("INSERT INTO uniute(id_pk,utente,universita) VALUES(NULL,'".$_GET["user"]."','".$_GET["uni"]."')");
        echo "true";
    }
    else if($_GET["type"]=="remove")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->query("DELETE FROM uniute WHERE utente='".$_GET["user"]."' AND universita='".$_GET["uni"]."'");
        echo "true";
    }
}
?>