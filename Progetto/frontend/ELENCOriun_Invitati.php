<!-- ------------------------------
-----------STATISTICHE-------------
------------------------------- -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MeetupPlanner - Invitati Riunione</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun.css">
        <link rel="stylesheet" type="text/css" href="../CSS/ELENCOriun_invitati.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); $mail = $_SESSION["logged"]; include "../Backend/PAGEcheck.php"; include "../common/NAVBar.php"; 
        include '../common/DBquery.php';?>

        <br>
            <ul style="list-style-type: none; margin: -10;  padding: 0;  overflow: hidden;  position:sticky; top: 60px; z-index: 4;">
            <li style="background-color:rgba(105, 200, 255, 0.726); float: left; display: block; height: 60px; width: 60px; text-align: center;"><a style="font-size:30px;" href="ELENCOriun.php"><</a></li>
            <li style="padding: 14px 16px; 	text-decoration: none; display: inline-block; color: rgba(0, 0, 0, 0.726); text-align: center; font-size:x-large;">Invitati:</li>
        </ul>

        <div class="DIVbox MAINtitle" style="margin-bottom: 2px; margin-top: 20px; width: 25%; min-width: 150px; float: right; margin-right: 100px;">
                    <a href="CREAriun_USERS.php?ID_R=<?php echo $_GET["ID_R"];?>" style="padding-bottom: 2px; padding-top: 2px;">
                        <input class="BTNreg" type="submit" value = "Ricrea Inviti"/>
                        <input name = "ID_R" type="text" value = "<?php echo $_GET["ID_R"];?>" hidden= true/>
                    </a>
        </div>
        
        
        <?php
            echo '<div class="DIVbox">';
            $res = ELENCOriun_InvitatiID($_GET["ID_R"], 1);
            echo '<h3>Invitati che hanno accettato:</h3>';
            if ($res != NULL){
                echo '<table class="tableTITLE"><tr>
                <td>nome</td>
                <td>cognome</td>
                <td>email</td>
                ';
                while($row = $res->fetch_assoc()) {
                    if ($row["Accettazione"] == 1){
                        echo "<tr style='font-weight:normal;'><td>" . 
                        $row['Nome'] . "</td><td>" . 
                        $row['Cognome'] . " </td><td>" . 
                        $row['email'] . " </td></tr>";
                    }
                }
            } else {
                echo '<h2>Vuoto.</h2>';
            }
            echo '</table></div>';
        ?>

        <?php
            echo '<div class="DIVbox">';
            $res = ELENCOriun_InvitatiID($_GET["ID_R"], "'" . 0 ."'");
            echo '<h3>Invitati che hanno rifiutato:</h3>';
            if ($res != NULL){
                echo '<table class="tableTITLE"><tr>
                <td>nome</td>
                <td>cognome</td>
                <td>email</td>
                <td>motivazione</td>
                ';
                while($row = $res->fetch_assoc()) {
                    if ($row["Accettazione"] == 0){
                        echo "<tr style='font-weight:normal;'><td>" . 
                        $row['Nome'] . "</td><td>" . 
                        $row['Cognome'] . " </td><td>" . 
                        $row['email'] . " </td><td>" .
                        $row['motivazione'] . " </td></tr>";
                    }
                }
            } else {
                echo '<h2>Vuoto.</h2>';
            }
            echo '</table></div>';
        ?>

        <?php
            echo '<div class="DIVbox">';
            $res = ELENCOriun_InvitatiIDNULL($_GET["ID_R"]);
            echo '<h3>Invitati che non hanno risposto:</h3>';
            if ($res != NULL){
                echo '<table class="tableTITLE"><tr>
                <td>nome</td>
                <td>cognome</td>
                <td>email</td>
                ';
                while($row = $res->fetch_assoc()) {
                    if ($row["Accettazione"] == NULL){
                        echo "<tr style='font-weight:normal;'><td>" . 
                        $row['Nome'] . "</td><td>" . 
                        $row['Cognome'] . " </td><td>" . 
                        $row['email'] . " </td></tr>";
                    }
                }
            } else {
                echo '<h2>Vuoto.</h2>';
            }
            echo '</table></div>';
        ?>

        </div>
    </body>
</html>