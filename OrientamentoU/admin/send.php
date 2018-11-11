<?php
if(isset($_GET["type"]))
{
    if($_GET["type"]=="tutti")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $sql="SELECT email FROM utenti WHERE verificato='si' AND bloccato='no'";
        $r=$c->query($sql);
        if($r->num_rows>0)
        {
            while($riga=$r->fetch_assoc())
            {
                //echo $riga["email"];
                $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$riga["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["O"]))."','".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["M"]))."', 'no')";
                $c->query($sql);
            }
        }
        
        echo "true";
    }
    else if($_GET["type"]=="universita")
    {
        $c=new mysqli("localhost","root","","orientamento");
        $c->set_charset("utf8");
        
        $sql="SELECT id, nome FROM universita WHERE id='".$_POST["U"]."'";
        $r=$c->query($sql);
        if($r->num_rows>0)
        {
            $riga=$r->fetch_assoc();
            $universita=str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$riga["nome"]));
        }
        
        $sql="SELECT uniute.*,utenti.email FROM uniute INNER JOIN utenti ON utenti.id=uniute.utente WHERE uniute.universita='".$_POST["U"]."'";
        $r=$c->query($sql);
        if($r->num_rows>0)
        {
            while($riga=$r->fetch_assoc())
            {
                //echo $riga["email"];
                $sql="INSERT INTO mail(id, email, email_da, data, oggetto, messaggio, letta) VALUES(NULL, '".$riga["email"]."', 'noreply@orientamentou.com', '".date("Y-m-d h:i:s")."', 'Newsletter OrientamentoU: ".$universita."',
                '".str_replace("[[__[[apostrofo]]__]]","\'",str_replace("'","[[__[[apostrofo]]__]]",$_POST["M"]))."
                <br><br>
                <small><center>
                Stai ricevendo questa email poichè stai seguendo ".$universita.".
                <br>
                In caso non si voglia più seguirla è necessario accedere al proprio account su OrientamentoU, quindi nella sezione <b><i>Università seguite</i></b> premere su <i>Mostrale</i>, quindi cliccare sulla relativa università e, in basso alla pagina che si aprirà, premere su <b>Smetti di seguire</b>.</center></small>', 'no')";
                $c->query($sql);
            }
        }
        
        echo "true";
    }
}
?>