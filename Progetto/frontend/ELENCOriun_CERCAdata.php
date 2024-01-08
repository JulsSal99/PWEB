<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MeetupPlanner - Cerca Riunione</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun.css">
        <link rel="stylesheet" type="text/css" href="../CSS/ELENCOriun_CERCA.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); $mail = $_SESSION["logged"]; include "../Backend/PAGEcheck.php"; include "../common/NAVBar.php"; 
        include("../common/weekOfMonth.php"); include "../common/DBquery.php";?>

        <br>
        <ul style="list-style-type: none; margin: -10;  padding: 0;  overflow: hidden;  position:sticky; top: 60px; z-index: 4;">
        <li style="background-color:rgba(105, 200, 255, 0.726); float: left; display: block; height: 60px; width: 60px; text-align: center;"><a style="font-size:30px;" href="ELENCOriun.php"><</a></li>
        <li style="padding: 14px 16px; 	text-decoration: none; display: inline-block; color: rgba(0, 0, 0, 0.726); text-align: center; font-size:x-large;">Cerca una Riunione:</li>
        </ul>

      
        <div class="DIVbox">
        <form method="GET" action="ELENCOriun_CERCAdata.php?">
        <table class="registrazione"> 
        <tr><h3>Inserisci Anno, Mese, Settimana o Giorno (ps. puoi mettere anche solo Anno o Mese) :</h3></tr>
		<tr>
        <td>Anno: <br>
        <select name="Anno" ID="Anno" onchange="EnableDisable()">
            <option disabled selected value> -- scegli un anno -- </option>
            <?php 
            for ($i=2000; $i<=2040; $i++){
                echo '<option value="'
                . $i . '">' . $i
                . "</option>";
            }
            ?>
		</select></td>
        <td>Mese: <br>
        <select name="Mese" ID="Mese" disabled = "disabled" onchange="EnableDisable()">
            <option disabled selected value> -- scegli un mese -- </option>
            <option value="1">gennaio</option>
            <option value="2">febbraio</option>
            <option value="3">marzo</option>
            <option value="4">aprile</option>
            <option value="5">maggio</option>
            <option value="6">giugno</option>
            <option value="7">luglio</option>
            <option value="8">agosto</option>
            <option value="9">settembre</option>
            <option value="10">ottobre</option>
            <option value="11">novembre</option>
            <option value="12">dicembre</option>
		</select></td>
        <td>Settimana: <br>
        <select name="Settimana" ID="Settimana" disabled = "disabled" onchange="EnableDisable()">
            <option disabled selected value> -- scegli una settimana -- </option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
		</select></td>
        <td>Giorno: <br>
        <select name="Giorno" ID="Giorno" disabled = "disabled" onchange="EnableDisable()">
            <option disabled selected value> -- scegli un giorno -- </option>
            <?php 
            for ($i=1; $i<=31; $i++){
                echo '<option value="'
                . $i . '"';
                if ($i==29){
                    echo 'style = "visibility: visible;" ID = "29"';
                }
                if ($i==30){
                    echo 'style = "visibility: visible;" ID = "30"';
                }
                if ($i==31){
                    echo 'style = "visibility: visible;" ID = "31"';
                }
                echo ">" . $i
                . "</option>";
            }
            ?>
		</select></td>
        </tr><tr>
        <td colspan="2">
            <input class=BTNreg id="btnSubmit" type="submit" disabled="disabled" name = "OK">
        </td></tr>
        </table>
        </form></div>
        
        
        <?php

        if (isset($_GET["Anno"])){
            echo '<div class="DIVbox">';
            $Mese_i = 1;
            $Mese_f = 12;
            if (isset($_GET["Anno"])){
                $Anno = $_GET["Anno"];
            }
            if (isset($_GET["Mese"])){
                $Mese_i = $_GET["Mese"];
                $Mese_f = $_GET["Mese"];
            }
            if (isset($_GET["Settimana"])){
                $Settimana = $_GET["Settimana"];
            }
            if (isset($_GET["Giorno"])){
                $Giorno = $_GET["Giorno"];
            }

            
            $res = SALAriun_CERCA(
                $Anno,
                $Mese_i,
                $Mese_f
                );
            if ($res != NULL){
                echo '<table class="tableTITLE"><tr>
                <td>ID</td>
                <td>tema</td>
                <td>data</td>
                <td>inizio</td>
                <td>fine</td>
                <td>creatore</td></tr>
                ';
                while($row = $res->fetch_assoc()) {
                    if (  (isset($Settimana)== false && isset($Giorno)== false) ||
                            (isset($Settimana) && weekOfMonth($row["data"]) == $Settimana) ||
                            (isset($Giorno))
                        ){
                        echo "<tr style='font-weight:normal;'><td>" . 
                        $row['ID_Riunione'] . "</td><td>" . 
                        $row['tema'] . " </td><td>" . 
                        $row['data'] . " </td><td>" . 
                        date("H:i", strtotime($row['orario_inizio'])) . " </td><td>" . 
                        date("H:i", strtotime($row['orario_fine'])) . " </td><td>" . 
                        $row['email_creator'] . ". </td></tr>";
                    }
                }
            }
            echo '</div>';
        }
        ?>

    </body>
    
    <script src="../JS/ELENCOriun_CERCA.JS"></script>
</html>