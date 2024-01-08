<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MeetupPlanner - Cerca Riunione</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun.css">
        <link rel="stylesheet" type="text/css" href="../CSS/ELENCOriun_CERCA.css">
        <link rel="stylesheet" type="text/css" href="../CSS/ELENCOriun_CERCAtema.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); $mail = $_SESSION["logged"]; include "../Backend/PAGEcheck.php"; include "../common/NAVBar.php"; 
        include '../common/DBquery.php';?>

        <br>
        <ul style="list-style-type: none; margin: -10;  padding: 0;  overflow: hidden;  position:sticky; top: 60px; z-index: 4;">
        <li style="background-color:rgba(105, 200, 255, 0.726); float: left; display: block; height: 60px; width: 60px; text-align: center;"><a style="font-size:30px;" href="ELENCOriun.php"><</a></li>
        <li style="padding: 14px 16px; 	text-decoration: none; display: inline-block; color: rgba(0, 0, 0, 0.726); text-align: center; font-size:x-large;">Cerca una Riunione:</li>
        </ul>

      
        <div class="DIVbox">
        <form method="GET" action="ELENCOriun_CERCAtema.php?">
        <table class="registrazione"> 
        <tr><h3>Inserisci il tema :</h3></tr>
		<tr>
        <td>tema: <br>
        <select name="tema" ID="tema" onchange="EnableDisable()">
            <option disabled selected value> -- scegli un tema -- </option>
            <?php
            $ris = ELENCOriun_tema();
            if ($ris != NULL){
                while($row = $ris->fetch_assoc()) {
                    
                    echo '<option value="'
                    . $row["tema"] . '">' . $row["tema"]
                    . "</option>";
                }
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
        $count = 0;
        if (isset($_GET["tema"])){
            echo '<div class="DIVbox">';
            
            $res = ELENCOriun_CERCAtema($_GET["tema"]);
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
                        echo "<tr style='font-weight:normal;'><td>" . 
                        $row['ID_Riunione'] . "</td><td>" . 
                        $row['tema'] . " </td><td>" . 
                        $row['data'] . " </td><td>" . 
                        date("H:i", strtotime($row['orario_inizio'])) . " </td><td>" . 
                        date("H:i", strtotime($row['orario_fine'])) . " </td><td>" . 
                        $row['email_creator'] . ". </td></tr>";
                        $count++;
                }
            }
            echo '<tr><p style="text-align:left; margin-left: 1.5%; margin-bottom: 0px;">ci sono <b>'.$count.'</b> riunioni con questo tema</p></tr>'.'</table></div>';
        }
        ?>

    </body>
    
    <script src="../JS/ELENCOriun_CERCAtema.JS"></script>
</html>