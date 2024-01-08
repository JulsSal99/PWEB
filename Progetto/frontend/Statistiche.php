<!-- ------------------------------
-----------STATISTICHE-------------
------------------------------- -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MeetupPlanner - Statistiche Riunione</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/SALEriun.css">
        <link rel="stylesheet" type="text/css" href="../CSS/statistiche.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"];  include "../common/NAVBar.php"; 
        include '../common/DBquery.php';?>

        <div class="DIVbox MAINtitle">
            <h1>Statistiche:</h1>
            <p style = "margin-bottom: 20px; font-size:140%;">Vedi le riunioni importanti nella tua azienda!</p>
        </div>
        <div class="DIVbox">
        <h3>Riunioni passate con più presenze:</h3>
        </table>
        
        
        <?php
            echo '<div class="DIVbox">';
            
            $res = Statistiche($mail);
            if ($res != NULL){
                echo '<table class="tableTITLE"><tr>
                <td>ID</td>
                <td>tema</td>
                <td>data</td>
                <td>inizio</td>
                <td>fine</td>
                <td>creatore</td>
                <td>N°persone</td></tr>
                ';
                while($row = $res->fetch_assoc()) {
                        echo "<tr style='font-weight:normal;'><td>" . 
                        $row['ID_Riunione'] . "</td><td>" . 
                        $row['tema'] . " </td><td>" . 
                        date('d-m-Y', strtotime($row['data'])) . " </td><td>" . 
                        date("H:i", strtotime($row['orario_inizio'])) . " </td><td>" . 
                        date("H:i", strtotime($row['orario_fine'])) . " </td><td>" . 
                        $row['email_creator'] . "</td><td>".
                        $row['COUNT(*)'] . "</td></tr>";
                }
            } else {
                echo '<h2>Non ci sono riunioni con un numero di partecipanti maggiori del tuo dipartimento.</h2>';
            }
            echo '</table></div>';
        ?>

        </div>
    </body>
    
    <script src="../JS/ELENCOriun_CERCAtema.JS"></script>
</html>