<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MeetupPlanner - Registra utente</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun_REG.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php session_start(); $mail = $_SESSION["logged"]; include "../Backend/PAGEcheck.php"; include "../common/NAVBar.php"; include '../common/DBquery.php';?>
        
        <?php if (CREAriun_AUTH($mail) == false){
            die("non sei autorizzato a creare riunioni.");
        }
        ?>

        <br>
        <ul style="list-style-type: none; margin: -10;  padding: 0;  overflow: hidden;  position:sticky; top: 60px; z-index: 4;">
        <li style="background-color:rgba(105, 200, 255, 0.726); float: left; display: block; height: 60px; width: 60px; text-align: center;"><a style="font-size:30px;" href="SALEriun.php"><</a></li>
        <li style="padding: 14px 16px; 	text-decoration: none; display: inline-block; color: rgba(0, 0, 0, 0.726); text-align: center; font-size:x-large;">Registra un Utente:</li>
        </ul>

        
        <div class="DIVbox">
        <form method="GET" action="../Backend/SALEriun_REG_crea.php?">
        <table class="registrazione"> 
		<tr>
			<td>Nome: </td>
            <td><input type = "text" name = "Nome" ID="Nome" onkeyup="EnableDisable()" />
        </td>
		</tr><tr>
			<td>Cognome: </td>
			<td><input type = "text" name = "Cognome" ID="Cognome" onkeyup="EnableDisable()" />
            </td>
        </tr><tr>
            <td>Email: </td>
			<td><input type = "text" name = "NEWEmail" ID="NEWEmail" onkeyup="EnableDisable(), ValidateEmailTEXT()" />
            <p id="ALERTemail"><p>
            </td>
        </tr><tr>
        <td>Dipartimento: </td>
        <td><select name="Dipartimento" ID="Dipartimento" onchange="EnableDisable()">
            <option disabled selected value> -- scegli un dipartimento -- </option>
            <?php $res = SALAriun_DIP(); 
            if ($res != NULL){
                while($row = $res->fetch_assoc()) {
                    echo '<option value="' . $row['Nome'] . '">' . $row['Nome'] . '</option>';
                }
            }?>
		</select></td>
        </tr><tr>
        <td>Ruolo: </td>
        <td><select name="Ruolo" ID="Ruolo" onchange="EnableDisable(), EnableDisableAUTH()">
            <option disabled selected value> -- scegli un ruolo -- </option>
            <option value="direttore">direttore</option>
            <option value="impiegato semplice">impiegato semplice</option>
            <option value="funzionario">funzionario</option>
            <option value="capo settore">capo settore</option>
		</select></td>
        </tr><tr>
            <td>Compleanno: </td>
            <td><input type="date" name="Compleanno" id="Compleanno" onchange="EnableDisable(), ValidateCompleannoTEXT()" value="">
            <p id="ALERTcompleanno"><p>
            </td>
        </tr><tr>
            <td>autorizzato? </td>
			<td><input class="box" type="checkbox" name="Autorizzato" ID="Autorizzato" value="si" onchange="EnableDisableAUTH()"/>
            <input type="date" name="AUTHdate" id="AUTHdate" disabled="disabled" style="display: none">
            </td>
        </tr><tr></tr><tr>
            <td>Password: </td>
			<td><input type = "text" name = "Password" ID="Password" onkeyup="EnableDisable(), EnableDisableCHKpwd()" />
            </td>
        </tr><tr>
            <td> &nbsp &nbsp &nbsp - &nbsp &nbsp ripeti:</td>
			<td><input type = "text" name = "Password2" ID="Password2" onkeyup="EnableDisable(), EnableDisableCHKpwd()" />
            </td>
        </tr><tr>
            <td style = "padding-bottom:0px;"> </td>
			</td><td style = "padding-bottom:0px;"><p ID="PWDchk">metti due password uguali</p>
            </td>
        </tr><tr>
        <td colspan="2">
            <input class=BTNreg id="btnSubmit" type="submit" disabled="disabled" name = "OK" onclick="CHKEmail()">
        </td></tr>
        </table>
        </form></div>
    </body>
    
    <script src="../JS/SALEriun_REG.JS"></script>

</html>