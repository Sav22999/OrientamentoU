<div id="superiore">
    <div id="icona">
        <img src="./img/scritta.png" />
    </div><div id="voci">
        <?php
        if($accesso)
        {
            echo '<input type="button" class="button_menu" value="Aggiorna" onclick="location.href=\'http://localhost/OrientamentoU/email/?email='.$_GET["email"].'\'" /><input type="button" class="button_menu" value="Esci" onclick="location.href=\'http://localhost/OrientamentoU/email/\'" />';
        }
        ?>
    </div>
</div>