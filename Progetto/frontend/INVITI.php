<!DOCTYPE html>
<html>
    <head>
        <title>MeetupPlanner - Inviti</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/inviti.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"];  include "../common/NAVBar.php"; include "../common/DBquery.php";?>
        <div class="DIVbox MAINtitle">
            <h1>Inviti:</h1>
            <p style = "margin-bottom: 0px; font-size:140%;">Guarda a quali riunioni sei stato invitato e accetta o rifiuta!</p>
        </div>

        <div class="DIVbox" style = "margin-bottom: 2%">
            <h2>Elenco nuovi Inviti:</h2>
            <?php
            $accettazione = 'NULL';
            $res = INVITI_nuovi($mail, date('Y-m-d'), date('h:i:s'), $accettazione);
            if ($res != NULL){
                echo "<table><strong><tr>
                    <td>ID</td>
                    <td>tema</td>
                    <td>data</td>
                    <td>orario</td>
                    <td>creatore</td>
                    <td>accetta</td></tr></strong>";
                while($row = $res->fetch_assoc()) {
                    $ID_Riunione = $row["ID_Riunione"];
                    echo "<tr><td>" . 
                    $row["ID_Riunione"] .
                    "</td><td>" . $row["tema"] . 
                    "</td><td>" . date("d-m-Y", strtotime($row["data"])) . 
                    "</td><td>" . date("h:i", strtotime($row["orario_inizio"])) . " - " . date("h:i", strtotime($row["orario_fine"])) .
                    "</td><td>" . $row["email_creator"] .
                    "</td><td>";
                    echo '<form method="GET" action="../Backend/INVITI_accetta.php?">';
                    if (INVITI_CHKdate($mail, $row["data"], $row["orario_inizio"], $row["orario_fine"])){
                    echo '<button class=BTNreg id="btnSubmit" type="submit" name = "OK" value = ' . "'1'" . ' style ="display: inline">Accetta</button>';
                    } else {
                        echo "c'è un'altra riunione";
                    } 
                    echo '<details style ="margin-right:0;"><summary class = "BTNreg " style ="display: inline; margin-left:0%;" >Rifiuta</summary>';
                    echo '<input type="text" class =INbox id="Motivazione" name="Motivazione" placeholder = "Motivazione">
                    <button id="btnSubmit" type="submit" name = "OK" value = ' . "'0'" . '>Vai!</button></details>
                    <input type = "hidden" name = "Email" value = "' . $mail . '" />
                    <input type = "hidden" name = "ID_R" value = "' . $ID_Riunione . '" /></form>';
                    echo "</td>";
                }
                echo "</tr></table>";
            } else {
                echo "non hai nuovi inviti nuovi";
            }
            ?>
        </div>

        <div class="DIVbox">
            <h2>Accettate/Rifiutate:</h2>
            <?php
            $accettazione = '1';
            $res = INVITI_nuovi($mail, date('Y-m-d'), date('h:i:s'), $accettazione);
            if ($res != NULL){
                echo "<table>";
                echo "<strong><tr>
                <td>ID</td>
                <td>tema</td>
                <td>data</td>
                <td>orario</td>
                <td>creatore</td>
                <td>accetta</td></tr></strong>";
                echo "<tr><td>";
                while($row = $res->fetch_assoc()) {
                    echo "<tr><td>" . 
                    $row["ID_Riunione"] .
                    "</td><td>" . $row["tema"] . 
                    "</td><td>" . date("d-m-Y", strtotime($row["data"])) . 
                    "</td><td>" . date("h:i", strtotime($row["orario_inizio"])) . " - " . date("h:i", strtotime($row["orario_fine"])) .
                    "</td><td>" . $row["email_creator"];
                    $ID_Riunione = $row["ID_Riunione"];
                    echo "</td><td>" . '<a class="DEL" href="../Backend/INVITI_cancella.php?Email=' . "'" . $mail . "'" . '&ID_R=' . "'" . $ID_Riunione . "'" . '">Annulla</a>';
                    echo "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "non hai accettato nessun invito";
            }
            ?>
        </div>

        <div class="DIVbox" style = "margin-bottom: 3%">
            <?php
            $accettazione = '0';
            $res = INVITI_nuovi($mail, date('Y-m-d'), date('h:i:s'), $accettazione);
            if ($res != NULL){
                echo "<table>";
                echo "<strong><tr>
                <td>ID</td>
                <td>tema</td>
                <td>data</td>
                <td>orario</td>
                <td>creatore</td>
                <td>Motivazione</td>
                <td>Rifiuta</td></tr></strong>";
                while($row = $res->fetch_assoc()) {
                    echo "<tr><td>" .
                    $row["ID_Riunione"] .
                    "</td><td>" . $row["tema"] . 
                    "</td><td>" . date("d-m-Y", strtotime($row["data"])) . 
                    "</td><td>" . date("h:i", strtotime($row["orario_inizio"])) . " - " . date("h:i", strtotime($row["orario_fine"])) .
                    "</td><td>" . $row["email_creator"] .
                    "</td><td>" . $row["motivazione"];
                    $ID_Riunione = $row["ID_Riunione"];
                    echo "</td><td>" . '<a class="DEL" href="../Backend/INVITI_cancella.php?Email=' . "'" . $mail . "'" . '&ID_R=' . "'" . $ID_Riunione . "'" . '">Annulla</a>';
                    echo "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "non hai inviti rifiutati";
            }
            ?>
        </div>
        <?php include "../common/footer.html"; ?>
    </body>
</html>