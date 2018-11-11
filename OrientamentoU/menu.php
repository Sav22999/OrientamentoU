<?php
if(!isset($_SESSION["lingua"])) $_SESSION["lingua"]="it";
?>
<div id="logo"><img src="http://localhost/OrientamentoU/img/logo.png" /></div>
<div id="superiore">
    <center>
        <div id="menu">
            <div id="icona"><img src="http://localhost/OrientamentoU/img/icona_white.png" /></div>
            <div id="superiore_menu_completo">
                <input type="button" value="Home" onclick="location.href='http://localhost/OrientamentoU/'" class="bottone" /><input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Information<?php }else{ ?>Informazioni<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/info/'" class="bottone" /><input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>All universities<?php }else{ ?>Tutte le università<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/universita/'" class="bottone" /><input type="button" value="<?php if(isset($_SESSION["id"]) && isset($_SESSION["email"])) {echo "Account";} else {echo "Login";}  ?>" onclick="mostra_login(0, '<?php echo $id_utente; ?>', '<?php echo $_SESSION["lingua"]; ?>')" class="bottone" /><input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Search<?php }else{ ?>Cerca<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/search/'" class="bottone" /><?php if(isset($_SESSION["permessi"]) && ($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10")){ ?><input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Admin<?php }else{ ?>Admin<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/admin/'" class="bottone" /><?php } ?>
            </div>
        </div>
        <div id="menu_mobile">
            <input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Menu<?php }else{ ?>Menù<?php } ?>" onclick="show_menu_mobile()" id="show_menu" />
        </div>
    </center>
</div>
<div id="menu_mobile_panel">
    <input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Close menu<?php }else{ ?>Chiudi menù<?php } ?>" onclick="hide_menu_mobile()" id="hide_menu" />
    <hr style="background-color:whitesmoke;margin:0px;" />
    <input type="button" value="Home" onclick="location.href='http://localhost/OrientamentoU/'" class="voci_menu_mobile" />
    <br>
    <input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Information<?php }else{ ?>Informazioni<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/info/'" class="voci_menu_mobile" />
    <br>
    <input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>All universities<?php }else{ ?>Tutte le università<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/universita/'" class="voci_menu_mobile" />
    <br>
    <input type="button" value="<?php if(isset($_SESSION["id"]) && isset($_SESSION["email"])) {echo "Account";} else {echo "Login";}  ?>" onclick="hide_menu_mobile();mostra_login(0, '<?php echo $id_utente; ?>', '<?php echo $_SESSION["lingua"]; ?>')" class="voci_menu_mobile" />
    <br>
    <input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Search<?php }else{ ?>Cerca<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/search/'" class="voci_menu_mobile" />
    <br>
    <?php if(isset($_SESSION["permessi"]) && ($_SESSION["permessi"]=="3" || $_SESSION["permessi"]=="10")){ ?><input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Admin<?php }else{ ?>Admin<?php } ?>" onclick="location.href='http://localhost/OrientamentoU/admin/'" class="voci_menu_mobile" /><?php } ?>
</div>

<?php if($_SESSION["lingua"]=="en"){ //inglese ?>

<?php }else{ //italiano ?>

<?php } ?>

<?php if($_SESSION["lingua"]=="en"){ ?><?php }else{ ?><?php } ?>

<div id="sfondo_nero" onclick="nascondi_login()"></div>
<div id="div_login">
    <input type="button" id="chiudi_login" value="" onclick="nascondi_login()">
    <table id="table_accedi_registrati">
        <?php if(!isset($_SESSION["email"])){ ?>
        <tr>
            <td>
                <div id="registrato">
                    <h1><?php if($_SESSION["lingua"]=="en"){ ?>Log in<?php }else{ ?>Accedi<?php } ?></h1>
                    <form action="http://localhost/OrientamentoU/account/log.php" method="post">
                        <input type="email" name="email" placeholder="Email" class="campo_login" required />
                        <br/>
                        <input type="password" name="psw" placeholder="Password" class="campo_login" minlength="8" maxlength="30" autocomplete="off" required />
                        <br/>
                        <input type="submit" name="login" value="<?php if($_SESSION["lingua"]=="en"){ ?>Login<?php }else{ ?>Accedi<?php } ?>" class="login_button" />
                    </form>
                    <a onclick="mostra_login(2, '<?php echo $id_utente; ?>', '<?php echo $_SESSION["lingua"]; ?>')"><?php if($_SESSION["lingua"]=="en"){ ?>Have you forgotten your password?<?php }else{ ?>Hai dimenticato la password?<?php } ?></a>
                </div>
                <div id="recuperopassword">
                    <h1><?php if($_SESSION["lingua"]=="en"){ ?>Reset password<?php }else{ ?>Recupera password<?php } ?></h1>
                    <form action="http://localhost/OrientamentoU/account/rpa.php" method="post">
                        <input type="email" name="email" placeholder="Email" class="campo_login" required />
                        <br/>
                        <input type="submit" name="recovery" value="<?php if($_SESSION["lingua"]=="en"){ ?>Confirm the password reset<?php }else{ ?>Conferma recupero password<?php } ?>" class="login_button" />
                    </form>
                </div>
            </td>
            <td style="border-left:2px solid #8B0000;">
                <div id="nonregistrato">
                    <h1><?php if($_SESSION["lingua"]=="en"){ ?>Aren't you still signed up?<?php }else{ ?>Non sei ancora registrato?<?php } ?></h1>
                    <input type="submit" value="<?php if($_SESSION["lingua"]=="en"){ ?>Sign up now!<?php }else{ ?>Registrati subito<?php } ?>" onclick="mostra_login(1, '<?php echo $id_utente; ?>', '<?php echo $_SESSION["lingua"]; ?>')" class="login_button" />
                </div>
                <div id="registrati">
                    <h1 id="h1titolo"><?php if($_SESSION["lingua"]=="en"){ ?>Sign up<?php }else{ ?>Registrazione<?php } ?></h1>
                    <form action="http://localhost/OrientamentoU/account/reg.php" method="post">
                        <input type="text" placeholder="<?php if($_SESSION["lingua"]=="en"){ ?>First name<?php }else{ ?>Nome<?php } ?>" name="nome" id="nome" class="campo_login" max="50" required />
                        <br/>
                        <input type="text" placeholder="<?php if($_SESSION["lingua"]=="en"){ ?>Last name<?php }else{ ?>Cognome<?php } ?>" name="cognome" class="campo_login" max="50" required />
                        <br/>
                        <input type="date" placeholder="AAAA-MM-GG" name="data" class="campo_login" required />
                        <br/>
                        <input type="email" placeholder="Email" name="email" class="campo_login" required />
                        <br/>
                        <input type="password" placeholder="Password" name="psw" class="campo_login" minlength="8" maxlength="30" required />
                        <br/>
                        <?php if($_SESSION["lingua"]=="en"){ ?>Language<?php }else{ ?>Lingua<?php } ?>:
                        <br/>
                        <select name="lang" class="campo_login" required>
                            <option value="it" <?php if(!$_SESSION["lingua"]=="en"){ ?>selected<?php } ?>>Italiano</option>
                            <option value="en" <?php if($_SESSION["lingua"]=="en"){ ?>selected<?php } ?>>English</option>
                        </select>
                        <br/>
                        <input type="submit" name="signup" value="<?php if($_SESSION["lingua"]=="en"){ ?>Finish sign up<?php }else{ ?>Completa registrazione<?php } ?>" class="login_button" />
                    </form>
                </div>
            </td>
        </tr>
        <?php }else{ ?>
        <tr>
            <td>
                <div id="gestioneaccount">
                    <h1><?php if($_SESSION["lingua"]=="en"){ ?>Manage your account<?php }else{ ?>Gestione account<?php } ?></h1>
                    <label class="label_login"><?php if($_SESSION["lingua"]=="en"){ ?>First name<?php }else{ ?>Nome<?php } ?>: <?php echo $_SESSION["nome"]; ?></label>
                    <br>
                    <label class="label_login"><?php if($_SESSION["lingua"]=="en"){ ?>Last name<?php }else{ ?>Cognome<?php } ?>: <?php echo $_SESSION["cognome"]; ?></label>
                    <br><br>
                    <label class="label_login">Em@il: <?php echo $_SESSION["email"]; ?></label>
                    <br><br>                    
                    <hr/>
                    <br>
                    <input type="button" name="login" value="<?php if($_SESSION["lingua"]=="en"){ ?>Log out<?php }else{ ?>Disconnetti<?php } ?>" class="login_button" onclick="location.href='http://localhost/OrientamentoU/account/log.php?logout'" />
                    <form action="http://localhost/OrientamentoU/account/log.php" method="post">
                        <input type="submit" value="<?php if($_SESSION["lingua"]=="en"){ ?>Close your account definitely<?php }else{ ?>Chiudi account definitivamente<?php } ?>" class="login_button" name="close" />
                    </form>
                </div>
            </td>
            <td style="border-left:2px solid #8B0000;">
                <div id="impostazioniaccount">
                    <h1><?php if($_SESSION["lingua"]=="en"){ ?>Settings<?php }else{ ?>Impostazioni<?php } ?></h1>
                    <input type="button" value="<?php if($_SESSION["lingua"]=="en"){ ?>Modify password<?php }else{ ?>Modifica password<?php } ?>" class="login_button" onclick="location.href='http://localhost/OrientamentoU/account/log.php?newpassword'" />
                    <br><br>
                    <hr>
                    <h1><?php if($_SESSION["lingua"]=="en"){ ?>Universities followed<?php }else{ ?>Università seguite<?php } ?></h1>
                    <div id="tutte_universita_account">
                        <input type="button" name="login" value="<?php if($_SESSION["lingua"]=="en"){ ?>Show them<?php }else{ ?>Mostrale<?php } ?>" class="login_button" onclick="update_universita('<?php echo $id_utente; ?>', '<?php echo $_SESSION["lingua"]; ?>')" />
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>