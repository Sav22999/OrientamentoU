<?php
    session_start();
    if(!isset($_SESSION["lingua"])) $_SESSION["lingua"]="it";
    if(!isset($_SESSION["permessi"])) $_SESSION["permessi"]="0";

    $id_utente="";//indica l'ID dell'utente ($_SESSION["id_utente"]); mentre $_SESSION["utente"] indica l'USER dell'utente-> viene visualizzato nel submenu.
    if(isset($_SESSION["id"]))
    {
        $id_utente=$_SESSION["id"];
    }
?>
<link href="http://localhost/OrientamentoU/style.css" type="text/css" rel="stylesheet" />
<link rel="icon" href="http://localhost/OrientamentoU/img/icona.png" />
<script src="http://localhost/OrientamentoU/jquery.js"></script>
<script src="http://localhost/OrientamentoU/site.js"></script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.8" />
<style>
#loading
{
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	width:auto;
	height:auto;
	display:block;
	background-color:#EEEEEE;
	z-index:1999;
	transition:0.5s;
	text-align:center;
}
#imm_loading
{
    margin-top:14%;
    height:30%;
    -webkit-animation: spin 5s linear infinite;
    animation: spin 5s linear infinite;
	transition:0.5s;
	text-align:center;
	z-index:2000;
	margin-left: auto;
	margin-right: auto;
}
@-webkit-keyframes spin
{
    0%{transform:rotateX(0deg);}
    100%{transform:rotateX(360deg);}
}
@keyframes spin
{
    0%{transform:rotateX(0deg);}
    100%{transform:rotateX(360deg);}
}
</style>
<div id="loading"><img src="http://localhost/OrientamentoU/img/icona.png" id="imm_loading" /></div>
<script>
	$(window).load(function(){load();/*slide();cambio_forzato(0);*/loading();});
</script>