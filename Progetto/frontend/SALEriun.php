<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MeetupPlanner - Dipartimenti</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun_REG.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"]; include "../common/NAVBar.php"; include "../common/DBquery.php";?>

        <div class="DIVbox MAINtitle">
            <h1>Dipartimenti:</h1>
            <p style = "margin-bottom: 0px; font-size:140%;">Dai un'occhiata agli utenti e gli eventi nei vari dipartimenti!</p>
        </div>
        <?php
        //permette di registrare un utente
        
        if (SALAriun_IS_Dir($mail)==true){
            echo '
            <div class="DIVbox MAINtitle MAINtitleREG">
            <p class = "pREG" style = "margin-bottom: 0px; margin-top: 3%; font-size:140%;">Registra un nuovo utente!</p>
            <a href="SALEriun_REG.php">
                <input class="BTNreg" type="submit" value = "Registra!"/>
            </a>
            </div>
            ';
        };
        ?>
        
        <?php
        $row = About1($mail);
        $res = SALAriun2(date("Y/m/d"));
        $prevDIP = '';
        $prevSALA = '';
        $RIUNapri = 0; //1 è aperto il section della riunione. 0 è chiuso 
        if ($res != NULL){
            while($row = $res->fetch_assoc()) {
                // chiude la tendina dell'elenco riunioni. Permette di unire le riunioni nella stessa sala
                if (($row['ID_Sala'] != $prevSALA) && ($RIUNapri == 1)){
                    echo "</table></details>";
                    $RIUNapri = 0;
                }
                
                // chiude la finestra del dipartimento precedente 
                if (($row['nome_Dipartimento'] != $prevDIP) && ($prevDIP != '')){ 
                    echo "</div>"; }
                
                // apre la finestra del nuovo dipartimento. Permette di unire utenti e riunioni nello stesso dipartimento
                if ($row['nome_Dipartimento'] != $prevDIP) {
                    echo '<div class="DIVbox">' 
                    . "<div class='Title'><h1>" . $row['nome_Dipartimento']
                    . "</h1>" . $row['Indirizzo'] . "</div>"; 
                    $prevDIP = $row['nome_Dipartimento'];

                    //mostra i contatti nel dipartimento
                    $RESusers = SALAriun_Users($row['nome_Dipartimento']);
                    if ($RESusers != NULL){
                        echo "<details><summary class = 'BTNutenti'>Utenti</summary><table class='elenco'>";
                        while($ROWusers = $RESusers->fetch_assoc()) {
                            echo "<tr><td>  " . $ROWusers["nome"] . " " . $ROWusers["cognome"];
                            //se la mail loggata dell'utente è direttore, ma è diversa dall'utente selezionato
                            if (SALAriun_IS_Dir($mail)==true && $ROWusers["Email"] != $mail){
                                $ROWusersEMAIL = $ROWusers["Email"];
                                echo '</td><td>' . 

                                // TASTO ELIMINA
                                '<a class=BTNreg onclick="return confirm_click();" href="../Backend/SALEriun_DEL.php?Email=' . "'" . $ROWusersEMAIL . "'" . '">ELIMINA</a>';
                                
                                //TASTO AUTORIZZA
                                if (SALAriun_IS_Dir($ROWusers["Email"])!=true){
                                //se NON è un direttore
                                    if ($ROWusers["email_auth"] != NULL && $ROWusers["data_auth"] > date("Y-m-d")){
                                        echo "</td><td>autorizzato dal " . date("d-m-Y", strtotime($ROWusers["data_auth"]));
                                    } else if ($ROWusers["email_auth"] != NULL){
                                        echo "</td><td><a>Autorizzato</a></td><td>"; 
                                    } else if ($ROWusers["email_auth"] == NULL){
                                    echo "</td><td>" . 
                                    '<form method="GET" action="../Backend/SALEriun_AUTH.php?" style ="display: inline">
                                    <details style ="margin-right:0;"><summary class = "BTNutenti " style ="display: inline; width: max-content; margin-left:0%; background-color:white;" >Autorizza</summary>
                                    <input type="date" name="AUTHdate" id="AUTHdate" style ="display: inline; margin-left:3%">
                                    <input class=BTNreg id="btnSubmit" type="submit" name = "OK" style ="display: inline; margin-left:3%">
                                    <input type = "hidden" name = "Email" value = "' . $ROWusersEMAIL . '" /></details></form>';
                                    }
                                //se è un direttore
                                } else if (SALAriun_IS_Dir($ROWusers["Email"])==true){
                                    echo "</td><td><a>Direttore</a></td><td>"; 
                                }
                            }
                            echo "</td></tr>";
                        }
                        echo "</table></details>";
                    } else {
                        echo "<p>nessun dipendente</p>";
                    }  
                }
                
                // mostra la nuova sala
                //if ($row['ID_Sala'] == $prevSALA)
                if (($RIUNapri != 1)){
                    echo "<div class='Title Sala'><h2>sala <b>'" . $row['nome'] . "'</b> con &nbsp" . 
                    $row['n_posti'] . " posti";
                    if (!empty($row['n_tavoli'])){
                        if ($row['n_tavoli'] == 1){    echo " e 1" . " tavolo";
                        } else { echo " e " . $row['n_tavoli'] . "  tavoli"; }
                    }
                    $row['n_tavoli'] . " tavoli";
                    if (empty($row['n_computer']) && empty($row['n_proiettori']) && empty($row['n_lavagne'])){
                    } else {
                        echo ", ";
                        if (!empty($row['n_computer'])){
                            echo " " . $row['n_computer'] . " computer";
                        }

                        if (!empty($row['n_proiettori'])){

                            if (!empty($row['n_computer']) && !empty($row['n_lavagne'])){
                                echo ",";
                            } else if (!empty($row['n_computer'])){
                                echo " e";
                            }

                            if ($row['n_proiettori'] == 1){ echo " 1" . " proiettore";
                            } else { echo " " . $row['n_proiettori'] . " proiettori"; }
                        }

                        if (!empty($row['n_lavagne'])){

                            if (!empty($row['n_computer']) || !empty($row['n_lavagne'])){
                                echo " e";
                            }

                            if ($row['n_lavagne'] == 1){    echo " 1a" . " lavagna";
                            } else { echo " " . $row['n_lavagne'] . "  lavagne"; }
                        }
                    }
                    echo ".</h2></div>"; 
                    $prevSALA = $row['ID_Sala']; }

                // mostra le riunioni
                if (($row['ID_Riunione'] != NULL) && ($RIUNapri != 1)){  //quando c'è una riunione e non è già aperto il section
                    echo "<details><summary>Visualizza riunioni</summary>";
                    echo '<table class="elenco elencoRiunioni"><tr>
                    <td>ID</td>
                    <td>tema</td>
                    <td>data</td>
                    <td>inizio</td>
                    <td>fine</td>
                    <td>creatore</td></tr>';
                    $RIUNapri = 1; 
                }               
                if ($row['ID_Riunione'] != NULL) {
                    echo "<tr style='font-weight:normal;'><td>" . 
                    $row['ID_Riunione'] . "</td><td>" . 
                    $row['tema'] . " </td><td>" . 
                    date("d-m-Y", strtotime($row["data"])) . " </td><td>" . 
                    date("H:i", strtotime($row['orario_inizio'])) . " </td><td>" . 
                    date("H:i", strtotime($row['orario_fine'])) . " </td><td>" . 
                    $row['email_creator'] . ". </td></tr>";
                }
            }
            if ($RIUNapri == 1){
                echo "</table></details>";
            }
            echo "</div>";
        }
        ?>
        <?php include "../common/footer.html"; ?>
    </body>
    <script type="text/javascript">
        function confirm_click()
        {
        return confirm("Sei sicuro ?");
        }
    </script>
</html>