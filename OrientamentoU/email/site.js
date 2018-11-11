function load()
{
    /*if(window.scrollY>90)
    {
        document.getElementById("superiore").style.position="fixed";
        document.getElementById("superiore").style.top="0px";
        $("#icona").fadeIn("slow");
    }
    else
    {
        document.getElementById("superiore").style.position="absolute";
        document.getElementById("superiore").style.top="90px";
        $("#icona").fadeOut("slow");
    }*/
}

function loading()
{
	$("#loading").fadeOut("slow");
}

function espandi(elemento)
{
    if(document.getElementsByClassName("espanso")[elemento].style.display=="none")
    {
        document.getElementsByClassName("messaggio")[elemento].style.backgroundPosition="right bottom";
        document.getElementsByClassName("messaggio")[elemento].style.backgroundImage="url('./img/nascondi.png')";
        document.getElementsByClassName("espanso")[elemento].style.display="block";
    }
    else
    {
        document.getElementsByClassName("messaggio")[elemento].style.backgroundPosition="right center";
        document.getElementsByClassName("messaggio")[elemento].style.backgroundImage="url('./img/espandi.png')";
        document.getElementsByClassName("espanso")[elemento].style.display="none";
    }
}

function copia_codice(codice)
{
    document.execCommand(codice);
}

function lettura_mail(id, elemento)
{
    var xmlhttp=new XMLHttpRequest;
    var post = new FormData();
    post.append('id', id);
    xmlhttp.open("POST","./leggimail.php",true);
    xmlhttp.onload = function()
    {
        if(this.readyState==4 && this.status==200)
        {
            if(this.responseText=="true")
            {
                document.getElementsByClassName("messaggio")[elemento].style.backgroundColor="#99DDFF";
            }
        }
    };
    xmlhttp.send(post);
}