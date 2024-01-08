<!DOCTYPE html>
<html>
    <head>
        <title>MeetupPlanner - Elenco Riunioni</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/ELENCOriun.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            #NUM{
                padding-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"]; include "../common/NAVBar.php"; 
        include '../common/DBquery.php';?>
        <div class="DIVbox MAINtitle">
            <h1>Elenco Riunioni:</h1>
            <p style = "margin-bottom: 0px; font-size:140%;">Dai un'occhiata alle tue riunioni e modifica!</p>
        </div>

        <?php
                echo '
                <div class="DIVbox MAINtitle MAINtitleCERCA">
                    <p class = "pREG" style = "margin-bottom: 0px; margin-top: 3%; font-size:140%;">Cerca una Riunione!</p>
                    <a href="ELENCOriun_CERCAdata.php">
                        <input class="BTNreg" type="submit" value = "Cerca data" style = "width: 120px; padding: 5px; margin-top: 4%;"/>
                    </a>
                    <a href="ELENCOriun_CERCAtema.php">
                        <input class="BTNreg" type="submit" value = "Cerca tema" style = "width: 120px; margin-left: 5px; padding: 5px; margin-top: 4%;"/>
                    </a>
                </div>
                ';
        ?>

        <div class="DIVbox" style="text-align: left">
            <p style = "margin-left: 4%; font-size:140%;">Nuove riunioni:</p>
            <?php
            
            $res = MAINRiunioni($mail, date("Y/m/d"));
            $CHKinviti = 0;
            if ($res != NULL){
                echo '<table><tr>
                    <td ID=NUM>ID</td>
                    <td>Luogo</td>
                    <td>tema</td>
                    <td ID=NUM>data</td>
                    <td ID=NUM>ora</td>
                    <td>creatore</td>
                    <td ID=NUM>n°posti</td>
                    <td ID=NUM>n°tavoli</td>
                    <td>strumentazione</td>
                    </tr>';
                while($row = $res->fetch_assoc()) {  //Avere gli elementi nel database
                    if ((   (date("Y/m/d", strtotime($row["data"])) > date("Y/m/d")) || 
                        (   (date("Y/m/d", strtotime($row["data"])) == date("Y/m/d")) &&
                        (date('H:i', strtotime($row["orario_inizio"])) >= (date('H:i')))))
                        && ((ELENCOriun_IScreator($row["ID_Riunione"], $mail)==true) || 
                            ($row["Accettazione"] == 1 && (ELENCOriun_IScreator($row["ID_Riunione"], $mail)!=true)))) { //viene fatto un controllo se il contatto è il creatore (mail invitato assente) o se è presente e ha accettato
                            
                            if ($row["email_creator"] == $mail){
                                echo '<tr><form method="GET" action="../Backend/ELENCOriun_MOD.php?" style ="display: inline">';
                            } else {
                                echo '<tr>';
                            }
                            echo "<td ID=NUM>" . $row["ID_Riunione"] ."</td>";

                            if ($row["email_creator"] == $mail){ 
                                echo "<td ID=Luogo>
                                <details>
                                    <summary>" . $row["nome"]. "(".$row["ID_Sala"].")".  ", ". $row["nome_Dipartimento"] . "</summary>";
                                    echo '<select name="Sala" ID="Sala" onchange="EnableDisable()">';
                                    echo '<option disabled selected value> -- scegli una sala -- </option>';
                                    $res2 = ELENCOriun_Sala(); 
                                    if ($res != NULL){
                                        while($row2 = $res2->fetch_assoc()) {
                                            echo '<option value="' . $row2['ID_Sala'] . '">' . $row2['nome'] . ", " . $row2['nome_Dipartimento'].  '</option>';
                                        }
                                    }
                                    echo "</select>";
                                echo "</details>";
                            } else {
                                echo "<td ID=Luogo>" . $row["nome"]. "(".$row["ID_Sala"].")".  ", ". $row["nome_Dipartimento"] ."</td>";
                            }

                            if ($row["email_creator"] == $mail){ 
                                echo "<td>
                                <details>
                                    <summary>" . $row["tema"] . "</summary>";
                                    echo '<input type = "text" ID = "tema" name ="tema" onkeyup="EnableDisable()">';
                                echo "</details>";
                            } else {
                                echo "</td><td>" . $row["tema"];
                            }
                            
                            if ($row["email_creator"] == $mail){ 
                                echo "</td><td ID=NUM>
                                <details>
                                    <summary>"; 
                                        if (date("Y", strtotime($row["data"]))==date("Y")){
                                            echo date("d-m", strtotime($row["data"]));
                                        }else{
                                            echo date("d-m-Y", strtotime($row["data"]));
                                        } echo "</summary>";
                                    echo '<input type = "date" value="" name = "data" ID = "data" onchange="EnableDisable()">';
                                echo "</details>";
                            } else {
                                echo "</td><td>"; 
                                if (date("Y", strtotime($row["data"]))==date("Y")){
                                    echo date("d-m", strtotime($row["data"]));
                                }else{
                                    echo date("d-m-Y", strtotime($row["data"]));
                                }
                            }

                            if ($row["email_creator"] == $mail){ 
                                echo "</td><td ID=NUM>
                                <details>
                                    <summary>" . date('H:i', strtotime($row["orario_inizio"])) ."-". date('H:i', strtotime($row["orario_fine"])) . "</summary>";
                                    echo '<input type="time" value="" ID = "orario_inizio" name="orario_inizio" onchange="EnableDisable()">';
                                    echo '<input type="time" value="" ID = "orario_fine" name="orario_fine" onchange="EnableDisable()">';
                                echo "</details>";
                            } else {
                                echo "</td><td ID=NUM>" . date('H:i', strtotime($row["orario_inizio"])) ."-". date('H:i', strtotime($row["orario_fine"])) ."</td>";
                            }
                            
                            
                            echo "<td>" . $row["email_creator"] ."</td>" .
                            
                            "<td ID=NUM>" . $row["n_posti"] ."</td>" .
                            
                            "<td ID=NUM>" . $row["n_tavoli"] ."</td>" .
                            
                            "<td>";
                            if (empty($row['n_computer']) && empty($row['n_proiettori']) && empty($row['n_lavagne'])){
                            } else {
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
                            echo "</td>";

                            if ($row["email_creator"] == $mail){
                                echo '<td><input id="btnSubmit" class="BTNreg" type="submit" name = "OK" style="font-size: smaller; visibility:hidden; width:45px; height: 40px">
                                </td>';
                                
                                //passo i valori precedenti nella FORM
                                echo '<input type = "hidden" name = "ID" value = "' . $row["ID_Riunione"] . '" />
                                <input type = "hidden" name = "s_OLD" value = "' . $row["ID_Sala"] . '" />
                                <input type = "hidden" name = "t_OLD" value = "' . $row["tema"] . '" />
                                <input type = "hidden" name = "d_OLD" value = "' . $row["data"] . '" />
                                <input type = "hidden" name = "o1_OLD" value = "' . $row["orario_inizio"] . '" />
                                <input type = "hidden" name = "o2_OLD" value = "' . $row["orario_fine"] . '" />
                                </form>
                                <td><a href="../Backend/ELENCOriun_DEL.php?ID=' . $row["ID_Riunione"] . '">
                                    <input class="BTNreg" type="submit" value = "Cancella" style = "font-size: smaller; width: 70px; margin-top: 4%; height: 40px"
                                    onclick="return confirm(' . "'Vuoi veramente eliminare?'". ');"/>
                                </a></td>
                                <td><a href="../Frontend/ELENCOriun_Invitati.php?ID_R=' . $row["ID_Riunione"] . '">
                                    <input class="BTNreg" type="submit" value = "Invitati" style = "font-size: smaller; width: 50px; margin-top: 4%; height: 40px"
                                    onclick=""/>
                                </a></td></tr>';
                            } else {
                                echo "</tr>";
                            }
                            $CHKinviti = 1;
                        }
                }
                echo '</table>';
            } if ($CHKinviti == 0){ echo '<p style = "margin-left: 4%;">Non hai Eventi</p>'; }
        ?>
        </div>

        <div class="DIVbox" style="text-align: left">
            <p style = "margin-left: 4%; font-size:140%;">Vecchie riunioni:</p>
            <?php
            $res = ELENCOriun_OLD($mail, date("Y/m/d"));
            $CHKinviti = 0;
            if ($res != NULL){
                echo '<table><tr>
                    <td ID=NUM>ID</td>
                    <td>Luogo</td>
                    <td>tema</td>
                    <td ID=NUM>data</td>
                    <td ID=NUM>ora</td>
                    <td>creatore</td>
                    <td ID=NUM>n°posti</td>
                    <td ID=NUM>n°tavoli</td>
                    <td>strumentazione</td>
                    </tr>';
                while($row = $res->fetch_assoc()) {  //Avere gli elementi nel database
                    if ((   (date("Y/m/d", strtotime($row["data"])) < date("Y/m/d")) || 
                        (   (date("Y/m/d", strtotime($row["data"])) == date("Y/m/d")) &&
                        (date('H:i', strtotime($row["orario_inizio"])) <= (date('H:i')))))
                        && ((ELENCOriun_IScreator($row["ID_Riunione"], $mail)) || 
                        ($row["Accettazione"] == 1 && (ELENCOriun_IScreator($row["ID_Riunione"], $mail)!=true)))) { //viene fatto un controllo se il contatto è il creatore (mail invitato assente) o se è presente e ha accettato
                            
                            echo "<tr>
                            <td ID=NUM>" . $row["ID_Riunione"] ."</td>" .
                            "<td ID=Luogo>" . $row["nome"]. "(".$row["ID_Sala"].")".  ", ". $row["nome_Dipartimento"] ."</td>" .
                            "<td>" . $row["tema"] ."</td>" .
                            "<td ID=NUM>" . date("d-m-Y", strtotime($row["data"])) ."</td>" .
                            "<td ID=NUM>" . date('H:i', strtotime($row["orario_inizio"])) ."-". date('H:i', strtotime($row["orario_fine"])) ."</td>" .
                            "<td>" . $row["email_creator"] ."</td>" .
                            "<td ID=NUM>" . $row["n_posti"] ."</td>" .
                            "<td ID=NUM>" . $row["n_tavoli"] ."</td>" .
                            "<td>";
                            if (empty($row['n_computer']) && empty($row['n_proiettori']) && empty($row['n_lavagne'])){
                            } else {
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
                            echo "</td></tr>";
                            $CHKinviti = 1;
                        }
                }
                echo '</table>';
            } if ($CHKinviti == 0){ echo '<p style = "margin-left: 4%;">Non hai Eventi</p>'; }

            ?>
        </div>
        <?php include "../common/footer.html"; ?>
    </body>
    <script src="../JS/ELENCOriun.JS"></script>
</html>