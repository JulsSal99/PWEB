<!DOCTYPE html>
<html>
    <head>
        <title>MeetupPlanner - Crea Riunione</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/CREAriun.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"]; include "../common/NAVBar.php"; 
        include '../common/DBquery.php';?>

        <?php if (CREAriun_AUTH($mail)==false){die(
                '<div class="DIVbox MAINtitle">Non sei direttore, chiedi il permesso </div>');
            }
        ?>

        <div class="DIVbox MAINtitle">
            <h1>Crea Riunione:</h1>
            <p style = "margin-bottom: 0px; font-size:140%;">Crea la tua riunione e invita chi vuoi!</p>
        </div>

        
        <div class="DIVbox" style="text-align: left">
        <form method="GET" action="../Backend/CREAriun.php?">
        <table class="registrazione"> 
		<tr>
			<td>Tema: </td>
            <td><input type = "text" name = "Tema" ID="Tema" onkeyup="EnableDisable(), ValidateThemeTEXT()" />
            <P id="ALERTtheme" hidden=true></P></td>
        </tr><tr>
        <td>Luogo: </td>
        <td><select name="Luogo" ID="Luogo" onchange="EnableDisable()">
            <option disabled selected value> -- scegli un luogo -- </option>
            <?php $res2 = ELENCOriun_Sala(); 
                if ($res2 != NULL){
                    while($row2 = $res2->fetch_assoc()) {
                        echo '<option value="' . $row2['ID_Sala'] . '">' . $row2['nome_Dipartimento'] . ", " . $row2['nome'].  '</option>';
                    }
                }
            ?>
		</select></td>
        </tr><tr>
            <td>Data: </td>
            <td><input type="date" name="Data" id="Data" onchange="EnableDisable(), ValidateDateTEXT()" value="">
            <P id="ALERTdate" hidden=true></P></td>
        </tr><tr>
            <td>Ora: </td>
			<td><input type="time" style="width: 46%" value="" ID = "orario_inizio" name="orario_inizio" onchange="EnableDisable()">
                <input type="time" style="width: 46%" value="" ID = "orario_fine" name="orario_fine" onchange="EnableDisable()">
            </td>
        </tr><tr>
        <td colspan="2">
            <input class=BTNreg id="btnSubmit" type="submit" disabled="disabled" name = "OK" onclick="CHKEmail()">
        </td></tr>
        </table>
        </form></div>

        <br><br><br><br><br><br>
        <?php include "../common/footer.html"; ?>
    </body>
    
    <script src="../JS/CREAriun.JS"></script>
</html>