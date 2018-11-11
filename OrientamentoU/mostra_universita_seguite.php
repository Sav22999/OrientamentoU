<?php
$stringa="";
$c=new mysqli("localhost","root","","orientamento");
$c->set_charset("utf8");
$r=$c->query("SELECT uniute.*, universita.nome FROM uniute INNER JOIN universita ON universita.id=uniute.universita WHERE utente='".$_GET["id"]."'");
if($r->num_rows>0)
{
    //echo "<small>(Aggiornare la pagina per aggiornare la lista)</small><br>";
    while($riga=$r->fetch_assoc())
    {
        $stringa.='<input type="button" class="tutte_universita_btt" onclick="location.href=\'http://localhost/OrientamentoU/universita/?uni='.$riga["universita"].'\'" value="'.$riga["nome"].'" />';
    }
}else
    echo "false";
$c->close();

echo $stringa;
?>