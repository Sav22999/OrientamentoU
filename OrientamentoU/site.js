function load()
{
    hide_menu_mobile()
    var pos=window.scrollY;
    if(pos>90)
    {
        document.getElementById("superiore").style.position="fixed";
        document.getElementById("superiore").style.top="0px";
    }
    else
    {
        document.getElementById("superiore").style.position="absolute";
        document.getElementById("superiore").style.top="90px";
    }
    var lar=$("#superiore").width();
    if(lar<800)
    {
        //modalità mobile
        $("#menu").fadeOut("slow");
        $("#icona").fadeOut("slow");
        $("#menu_mobile").fadeIn("slow");
        document.getElementById("body_ttt").style.marginLeft="0%";
        document.getElementById("body_ttt").style.marginRight="0%";
            document.getElementById("div_login").style.top="1%";
            document.getElementById("div_login").style.bottom="1%";
        document.getElementById("div_login").style.left="1%";
        document.getElementById("div_login").style.right="1%";
    }
    else
    {
        if(lar<1000)
        {
            //modalità tablet
            $("#icona").fadeOut("slow");
            $("#menu").fadeIn("slow");
            $("#menu_mobile").fadeOut("slow");
            document.getElementById("body_ttt").style.marginLeft="5%";
            document.getElementById("body_ttt").style.marginRight="5%";
            document.getElementById("div_login").style.top="10%";
            document.getElementById("div_login").style.bottom="10%";
            document.getElementById("div_login").style.left="1%";
            document.getElementById("div_login").style.right="1%";
        }
        else
        {
            //modalità desktop
            $("#menu").fadeIn("slow");
            if(pos>90) $("#icona").fadeIn("slow");
            else $("#icona").fadeOut("slow");
            $("#menu_mobile").fadeOut("slow");
            document.getElementById("body_ttt").style.marginLeft="10%";
            document.getElementById("body_ttt").style.marginRight="10%";
            document.getElementById("div_login").style.top="15%";
            document.getElementById("div_login").style.bottom="15%";
            document.getElementById("div_login").style.left="20%";
            document.getElementById("div_login").style.right="20%";
        }
    }
}

function show_menu_mobile()
{
    $("#menu_mobile_panel").fadeIn("slow");
}

function hide_menu_mobile()
{
    $("#menu_mobile_panel").fadeOut("slow");
}

function loading()
{
	$("#loading").fadeOut("slow");
}

function segui_universita(uni, utente)
{
    //tramite AJAX aggiunge/rimuove utente all'universita (di id == uni)
    if(document.getElementById("segui_universita_bottone").value=="Segui questa Università" || document.getElementById("segui_universita_bottone").value=="Follow this University")
    {
        //aggiunge utente
        var xmlhttp=new XMLHttpRequest;
        xmlhttp.onreadystatechange = function()
        {
            if(this.readyState==4 && this.status==200)
            {
                if(this.responseText=="true") document.getElementById("segui_universita_bottone").value="Smetti di seguire questa Università";
            }
        };
        xmlhttp.open("GET","http://localhost/OrientamentoU/universita/newsletter.php?uni="+uni+"&user="+utente+"&type=add",true);
        xmlhttp.send();
    }
    else
    {
        //rimuove utente
        var xmlhttp=new XMLHttpRequest;
        xmlhttp.onreadystatechange = function()
        {
            if(this.readyState==4 && this.status==200)
            {
                if(this.responseText=="true") document.getElementById("segui_universita_bottone").value="Segui questa Università";
            }
        };
        xmlhttp.open("GET","http://localhost/OrientamentoU/universita/newsletter.php?uni="+uni+"&user="+utente+"&type=remove",true);
        xmlhttp.send();
    }
}

function hover_regione(r, w, h, t, l)
{
    leave_regione();
    document.getElementById("regione_hover_img").style.width=w+"px";
    document.getElementById("regione_hover_img").style.height=h+"px";
    document.getElementById("regione_hover_img").style.backgroundImage="url('http://localhost/OrientamentoU/img/regioni/"+r+".png')";
    document.getElementById("regione_hover_img").style.top=t+"px";
    document.getElementById("regione_hover_img").style.left=l+"px";
    document.getElementById("regione_hover_img").style.opacity="1";
    document.getElementById("regione_hover_img").style.transform="scale(1.2)";
    
    document.getElementById("regione_hover_img").setAttribute("onclick","location.href='http://localhost/OrientamentoU/universita/reg/?r="+r+"'")
}
function leave_regione()
{
    document.getElementById("regione_hover_img").style.transform="scale(1)";
    document.getElementById("regione_hover_img").style.opacity="0";
}

function menu_sel(num)
{
    document.getElementsByClassName("bottone")[num].style.backgroundColor="#EEEEEE";
    document.getElementsByClassName("bottone")[num].style.color="#8B0000";
    
    document.getElementsByClassName("voci_menu_mobile")[num].style.backgroundColor="#EEEEEE";
    document.getElementsByClassName("voci_menu_mobile")[num].style.color="#8B0000";
}

function nascondi_login()
{
    $("#sfondo_nero").fadeOut("fast");
    $("#div_login").fadeOut("slow");
}

function mostra_login(k, id, lingua)
{
    $("#sfondo_nero").fadeIn("fast");
    $("#div_login").fadeIn("slow");
    $("#nonregistrato").show();
    $("#registrati").hide();
    $("#registrato").show();
    $("#recuperopassword").hide();
    $(".campo_login:eq(0)").focus();
    if(id!="")
    {
        var messaggio_mostra_uni="Mostrale";
        if(lingua=="en") messaggio_mostra_uni="Show them";
        document.getElementById("tutte_universita_account").innerHTML='<input type="button" name="login" value="'+messaggio_mostra_uni+'" class="login_button" onclick="update_universita(\''+id+'\', \''+lingua+'\')" />';
    }
    if(k==1)
    {
        $("#nonregistrato").hide();
        $("#registrati").show();
        $("#nome").focus();
    }
    if(k==2)
    {
        $("#registrato").hide();
        $("#recuperopassword").show();
        $("#recuperopassword .campo_login:eq(0)").focus();
    }
}

$(window).resize(function(){load();chiudi();});
$(window).scroll(function(){load();});

function add_new(type)
{
    if(type=="rsms")
    {
        var uni=document.getElementById("id_uni").value;
        var nome=document.getElementById("nome").value;
        var cognome=document.getElementById("cognome").value;
        var data=document.getElementById("data").value;
        var urli=document.getElementById("urli").value;
        var link=document.getElementById("link").value;
        var urlm=document.getElementById("urlm").value;
        var storia=document.getElementById("storia").value;
        if(uni!="" && nome!="" && cognome!="" && data!="" && urli!="" && link!="" && urlm!="" && storia!="")
        {
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('uni', uni);
            post.append('nome', nome);
            post.append('cognome', cognome);
            post.append('data', data);
            post.append('urli', urli);
            post.append('link', link);
            post.append('urlm', urlm);
            post.append('storia', storia);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/add.php?type=rsms",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INSERIMENTO RIUSCITO: OK<br/>";
                        document.getElementById("id_uni").value="";
                        document.getElementById("id_uni_select").value="";
                        document.getElementById("nome").value="";
                        document.getElementById("cognome").value="";
                        document.getElementById("data").value="";
                        document.getElementById("urli").value="http://localhost/OrientamentoU/img/1.jpg";
                        document.getElementById("link").value="";
                        document.getElementById("urlm").value="http://localhost/OrientamentoU/img/_mappa.jpg";
                        document.getElementById("storia").value="";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
    else if(type=="uni")
    {
        var nome=document.getElementById("nome").value;
        var sigla=document.getElementById("sigla").value;
        var citta=document.getElementById("citta").value;
        var indirizzo=document.getElementById("indirizzo").value;
        var sito=document.getElementById("sito").value;
        var note=document.getElementById("note").value;
        var grandezza=document.getElementById("grandezza").value;
        var valutazione=document.getElementById("valutazione").value;
        var fonte=document.getElementById("fonte").value;
        if(nome!="" && sigla!="" && citta!="" && indirizzo!="" && sito!="" && grandezza!="" && valutazione!="" && fonte!="")
        {
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('nome', nome);
            post.append('sigla', sigla);
            post.append('citta', citta);
            post.append('indirizzo', indirizzo);
            post.append('sito', sito);
            post.append('note', note);
            post.append('grandezza', grandezza);
            post.append('valutazione', valutazione);
            post.append('fonte', fonte);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/add.php?type=uni",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INSERIMENTO RIUSCITO: OK<br/>";
                        document.getElementById("nome").value="";
                        document.getElementById("sigla").value="";
                        document.getElementById("citta").value="";
                        document.getElementById("citta_select").value="";
                        document.getElementById("indirizzo").value="";
                        document.getElementById("sito").value="";
                        document.getElementById("note").value="";
                        document.getElementById("grandezza").value="medio";
                        document.getElementById("valutazione").value="";
                        document.getElementById("fonte").value="Google";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
    else if(type=="dipa")
    {
        var nome=document.getElementById("nome").value;
        var sigla=document.getElementById("sigla").value;
        var note=document.getElementById("note").value;
        if(nome!="" && sigla!="")
        {
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('nome', nome);
            post.append('sigla', sigla);
            post.append('note', note);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/add.php?type=dipa",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INSERIMENTO RIUSCITO: OK<br/>";
                        document.getElementById("nome").value="";
                        document.getElementById("sigla").value="";
                        document.getElementById("note").value="";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
    else if(type=="unidip")
    {
        var uni=document.getElementById("id_uni").value;
        var dip=document.getElementById("id_dip").value;
        if(uni!="" && dip!="")
        {
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('uni', uni);
            post.append('dip', dip);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/add.php?type=unidip",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INSERIMENTO RIUSCITO: OK<br/>";
                        //document.getElementById("id_uni").value="";
                        //document.getElementById("id_uni_select").value="";
                        document.getElementById("id_dip").value="";
                        document.getElementById("id_dip_select").value="";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
    else if(type=="corsi")
    {
        var nome=document.getElementById("nome").value;
        var codice=document.getElementById("codice").value;
        var tipo=document.getElementById("tipo").value;
        var note=document.getElementById("note").value;
        if(nome!="" && codice!="" && tipo!="")
        {
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('nome', nome);
            post.append('codice', codice);
            post.append('tipo', tipo);
            post.append('note', note);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/add.php?type=corsi",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INSERIMENTO RIUSCITO: OK<br/>";
                        document.getElementById("nome").value="";
                        document.getElementById("codice").value="";
                        document.getElementById("tipo").value="";
                        document.getElementById("note").value="";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
    else if(type=="dipcor")
    {
        var uni=document.getElementById("id_uni").value;
        var dip=document.getElementById("id_dip").value;
        var cor=document.getElementById("id_cor").value;
        var lingua=document.getElementById("lingua").value;
        if(uni!="" && dip!="" && cor!="" && lingua!="")
        {
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('uni', uni);
            post.append('dip', dip);
            post.append('cor', cor);
            post.append('lingua', lingua);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/add.php?type=dipcor",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INSERIMENTO RIUSCITO: OK<br/>";
                        document.getElementById("id_cor").value="";
                        document.getElementById("id_cor_select").value="";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
}

function invia_email(utenti)
{
    if(utenti=="tutti")
    {
        var messaggio=document.getElementById("messaggio").value;
        var oggetto=document.getElementById("oggetto").value;
        if(oggetto!="" && messaggio!="")
        {
            document.getElementById("msg_note").innerHTML="INVIO EMAIL: CARICAMENTO...<br/>";
            document.getElementById("oggetto").disabled=true;
            document.getElementById("messaggio").disabled=true;
            document.getElementById("btt_invio_email").style.display="none";
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('M', messaggio);
            post.append('O', oggetto);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/send.php?type=tutti",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INVIO EMAIL: OK<br/>";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                    document.getElementById("oggetto").disabled=false;
                    document.getElementById("messaggio").disabled=false;
                    document.getElementById("btt_invio_email").style.display="inline-block";
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
    else if(utenti="universita")
    {
        var messaggio=document.getElementById("messaggio").value;
        var uni=document.getElementById("id_uni").value;
        if(uni!="" && messaggio!="")
        {
            document.getElementById("msg_note").innerHTML="INVIO EMAIL: CARICAMENTO...<br/>";
            document.getElementById("messaggio").disabled=true;
            document.getElementById("id_uni").disabled=true;
            document.getElementById("id_uni_select").disabled=true;
            document.getElementById("btt_invio_email").style.display="none";
            var xmlhttp=new XMLHttpRequest;
            var post = new FormData();
            post.append('M', messaggio);
            post.append('U', uni);
            xmlhttp.open("POST","http://localhost/OrientamentoU/admin/send.php?type=universita",true);
            xmlhttp.onload = function()
            {
                if(this.readyState==4 && this.status==200)
                {
                    if(this.responseText=="true")
                    {
                        document.getElementById("msg_note").innerHTML="INVIO EMAIL: OK<br/>";
                    }
                    else document.getElementById("msg_note").innerHTML="Errore: 001.<br/>";
                    //alert(this.responseText);
                    document.getElementById("messaggio").disabled=false;
                    document.getElementById("id_uni").disabled=false;
                    document.getElementById("id_uni_select").disabled=false;
                    document.getElementById("btt_invio_email").style.display="inline-block";
                }else document.getElementById("msg_note").innerHTML="Errore: 002.<br/>";
            };
            xmlhttp.send(post);
        }else document.getElementById("msg_note").innerHTML="Errore: 003.<br/>";
    }
}

function update_universita(id,lang)
{
    if(lang=="en") document.getElementById("tutte_universita_account").innerHTML="Loading...";
    else document.getElementById("tutte_universita_account").innerHTML="Caricamento in corso...";
    var xmlhttp=new XMLHttpRequest;
    var post = new FormData();
    xmlhttp.open("GET","http://localhost/OrientamentoU/mostra_universita_seguite.php?id="+id,true);
    xmlhttp.onload = function()
    {
        if(this.readyState==4 && this.status==200)
        {
            if(this.responseText!="false")
            {
                document.getElementById("tutte_universita_account").innerHTML=this.responseText;
            }
            else document.getElementById("tutte_universita_account").innerHTML="Non stai seguendo alcuna università.";
            //alert(this.responseText);
        }else document.getElementById("tutte_universita_account").innerHTML="Errore inaspettato (ACC001).";
    };
    xmlhttp.send(post);
}

function cerca_per(type)
{
    if(type=="uni")
    {
        document.getElementById("cerca_per_uni").style.backgroundColor="#8B0000";
        document.getElementById("cerca_per_uni").style.color="white";
        
        document.getElementById("cerca_per_dip").style.backgroundColor="white";
        document.getElementById("cerca_per_dip").style.color="#8B0000";
        document.getElementById("cerca_per_cor").style.backgroundColor="white";
        document.getElementById("cerca_per_cor").style.color="#8B0000";
        
        document.getElementById("cerca_per_filtro").value="uni";
    }
    else if(type=="dip")
    {
        document.getElementById("cerca_per_uni").style.backgroundColor="white";
        document.getElementById("cerca_per_uni").style.color="#8B0000";
        
        document.getElementById("cerca_per_dip").style.backgroundColor="#8B0000";
        document.getElementById("cerca_per_dip").style.color="white";
        
        document.getElementById("cerca_per_cor").style.backgroundColor="white";
        document.getElementById("cerca_per_cor").style.color="#8B0000";
        
        document.getElementById("cerca_per_filtro").value="dip";
    }
    else if(type=="cor")
    {
        document.getElementById("cerca_per_uni").style.backgroundColor="white";
        document.getElementById("cerca_per_uni").style.color="#8B0000";
        document.getElementById("cerca_per_dip").style.backgroundColor="white";
        document.getElementById("cerca_per_dip").style.color="#8B0000";
        
        document.getElementById("cerca_per_cor").style.backgroundColor="#8B0000";
        document.getElementById("cerca_per_cor").style.color="white";
        
        document.getElementById("cerca_per_filtro").value="cor";
    }
}

function ordina_per(type)
{
    if(type=="az")
    {
        document.getElementById("az").style.backgroundColor="whitesmoke";
        document.getElementById("az").style.color="#8B0000";
        
        document.getElementById("za").style.backgroundColor="#8B0000";
        document.getElementById("za").style.color="whitesmoke";
        document.getElementById("51").style.backgroundColor="#8B0000";
        document.getElementById("51").style.color="whitesmoke";
        document.getElementById("15").style.backgroundColor="#8B0000";
        document.getElementById("15").style.color="whitesmoke";
    }
    else if(type=="za")
    {
        document.getElementById("az").style.backgroundColor="#8B0000";
        document.getElementById("az").style.color="whitesmoke";
        
        document.getElementById("za").style.backgroundColor="whitesmoke";
        document.getElementById("za").style.color="#8B0000";
        
        document.getElementById("51").style.backgroundColor="#8B0000";
        document.getElementById("51").style.color="whitesmoke";
        document.getElementById("15").style.backgroundColor="#8B0000";
        document.getElementById("15").style.color="whitesmoke";
    }
    else if(type=="51")
    {
        document.getElementById("az").style.backgroundColor="#8B0000";
        document.getElementById("az").style.color="whitesmoke";        
        document.getElementById("za").style.backgroundColor="#8B0000";
        document.getElementById("za").style.color="whitesmoke";
        
        document.getElementById("51").style.backgroundColor="whitesmoke";
        document.getElementById("51").style.color="#8B0000";
        
        document.getElementById("15").style.backgroundColor="#8B0000";
        document.getElementById("15").style.color="whitesmoke";
    }
    else if(type=="15")
    {
        document.getElementById("az").style.backgroundColor="#8B0000";
        document.getElementById("az").style.color="whitesmoke";        
        document.getElementById("za").style.backgroundColor="#8B0000";
        document.getElementById("za").style.color="whitesmoke";
        document.getElementById("51").style.backgroundColor="#8B0000";
        document.getElementById("51").style.color="whitesmoke";
        
        document.getElementById("15").style.backgroundColor="whitesmoke";
        document.getElementById("15").style.color="#8B0000";
    }
}

function mostra_nascondi_ordina_per_panel()
{
    $("#uni_ordina_per_panel").fadeToggle("slow");
}