<?php
if(isset($_POST["id"]))
{
    $c=new mysqli("localhost","root","","orientamento");
    $c->set_charset("utf8");

    $sql="UPDATE mail SET letta='si' WHERE id='".$_POST["id"]."'";
    $c->query($sql);
    $c->close();
    
    echo "true";
}
?>