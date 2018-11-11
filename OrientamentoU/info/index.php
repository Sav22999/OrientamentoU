<html>
    <head>
        <title>Informazioni | OrientamentoU</title>
        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/header.php"); ?>
    </head>

    <body onload="menu_sel(1)">
        <div id="body">
            <div id="titolo">
                <?php if($_SESSION["lingua"]=="en"){ ?>Information<?php }else{ ?>Informazioni<?php } ?>
            </div>
            <div id="body_ttt">
                <div id="contenuto">
                    <?php if($_SESSION["lingua"]=="en"){ //inglese ?>
                    
                    OrientamentoU is a project realised by Saverio Morelli for the "Area di Progetto dell'a.s. 2017/2018".
                    <br/>
                    Its mode of operation is very easy and fast.
                    <br/>
                    It's possible to choose a region and it will be shown every university based in that region.
                    <br/>
                    It's also possibile to choose from the section "All Universities" directly the favourite university.
                    <br/>
                    After choosing a university it's possible read and know some data about it:
                    <ul>
                        <li>Read the university history</li>
                        <li>See some images of the building</li>
                        <li>Visit the official web site</li>
                        <li>See every department within the university</li>
                        <li>Know possible alumni of that university</li>
                        <li>Know the dean</li>
                        <li>Know hoe to reach the university thanks to a map and a list of public transportation</li>
                        <li>Know all services that university has</li>
                    </ul>
                    Choosing a department it's possibile know every degree course, divided them to tipologies (bachelor(3 and 5 years), master, PhD).
                    <br/>
                    Choosing a degree course it's possibile, then, know subjects, exams and teachers about that course.<sup>*</sup>
                    <br/><br/>
                    <sup>*</sup>This function could be not available for every degree course.
                    
                    <?php }else{ //italiano ?>
                    
                    OrientamentoU è un progetto realizzato da Saverio Morelli per l'Area di Progetto dell'a.s. 2017/2018.
                    <br/>
                    Il funzionamento di OrientamentoU è molto semplice ed immediato.
                    <br/>
                    E' possibile scegliere una regione e verranno mostrate le università con sede in quella regione.
                    <br/>
                    E' possibile anche scegliere dalla sezione "Tutte le Università" direttamente l'Università che si preferisce.
                    <br/>
                    Dopo aver scelto una Università è possibile leggere alcuni dati ad essa correlati:
                    <ul>
                        <li>Leggere la storia dell'università</li>
                        <li>Vedere alcune immagini della struttura</li>
                        <li>Visitare il sito</li>
                        <li>Vedere tutti i dipartimenti presenti nell'Università</li>
                        <li>Conoscere eventuali alunni noti laureatisi in quella Università</li>
                        <li>Conoscere il rettore</li>
                        <li>Sapere come raggiungere la struttura attraverso una mappa e attraverso un'elenco di trasporti pubblici</li>
                        <li>Conoscere tutti i servizi che l'Università mette a disposizione</li>
                    </ul>
                    Scegliendo un dipartimento è possibile conoscere tutti i corsi di laurea, suddivisi per tipologia (triennale, magistrale, ciclo unico, dottorato).
                    <br/>
                    Scegliendo un corso è possibile, poi, conoscere le materie, gli esami ed i docenti relativi a quel determinato corso.<sup>*</sup>
                    <br/><br/>
                    <sup>*</sup>Questa funzione potrebbe essere non disponibile per tutti i corsi.
                    
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php include_once($_SERVER ['DOCUMENT_ROOT']."/OrientamentoU/menu.php"); ?>
    </body>
</html>