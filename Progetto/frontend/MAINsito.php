<!-------------------------------------------------
//-----------------MAINsito.php--------------------
//------Pagina principale del sito in cui ---------
//-------si può avere una vista generale-----------
//------------------------------------------------->
<!DOCTYPE html>

<html>
    <head>
        <title>MeetupPlanner - Home</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/MAINsito.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"]; include "../common/NAVBar.php"; ?>
        <p style = "margin-top: 4%"> </p>
        <div class="DIVbox" ID = "MAINLeft">
            <h1><b>Benvenuto su Meetup Planner</b></h1>
            <p style = "margin-bottom: 0px; font-size:140%;">Organizza e crea in modo semplice ed intuitivo la tua riunione!</p>
        </div>

        <?php include "MAINsito_calendar.php"; ?>
        
        <div class="DIVbox" ID = "MAINLeft" style = "padding-right: 1%">
            <h2>Eventi</h2>
            <div style="text-align:left; height: 250px; overflow-x: hidden; padding-left: 2%;">
            <?php
            $res = MAINRiunioni($mail, date("Y/m/d"));
            $CHKinviti = 0;
            if ($res != NULL){
                while($row = $res->fetch_assoc()) {
                    if ((   (date("Y/m/d", strtotime($row["data"])) > date("Y/m/d")) || 
                        (   (date("Y/m/d", strtotime($row["data"])) == date("Y/m/d")) &&
                        (date('H:i', strtotime($row["orario_inizio"])) >= (date('H:i')))))
                        && (($row["Accettazione"] != 1 && ($row["email"] != $mail)) || 
                            ($row["Accettazione"] == 1 && ($row["email"] == $mail))))  { //viene fatto un controllo se il contatto è il creatore (mail invitato assente) o se è presente e ha accettato
                            echo "<p>";
                            if (date("Y", strtotime($row["data"])) == date("Y")){
                                echo (date("m/d", strtotime($row["data"])));
                            } else {
                                echo (date("Y/m/d", strtotime($row["data"])));
                            }
                            echo " &nbsp"; echo date('H:i', strtotime($row["orario_inizio"]));
                            echo ' &nbsp - &nbsp <b>' . $row["nome"] . '</b>, <b>' . $row["nome_Dipartimento"] . '</b><br></p>';
                            $CHKinviti = 1;
                        }
                }
            } if ($CHKinviti == 0){ echo 'Non hai Eventi'; }
            ?>
            </div>
        </div>

        <div class="DIVbox" ID = "MAINRight" style = "padding-right: 1%">
            <h2>Inviti</h2>
            <div style="text-align:left; height: 250px; overflow-x: hidden; padding-left: 2%;">
            <?php
            $res = MAINRiunioni2($mail, date("Y/m/d"));
            $CHKinviti = 0;
            if ($res != NULL){
                while($row = $res->fetch_assoc()) {
                    if ((   (date("Y/m/d", strtotime($row["data"])) > date("Y/m/d")) || 
                    (   (date("Y/m/d", strtotime($row["data"])) == date("Y/m/d")) &&
                    (date('H:i', strtotime($row["orario_inizio"])) >= (date('H:i')))))
                    && ($row["Accettazione"] != 1 && $row["Accettazione"] == NULL && ($row["email"] == $mail))){
                            echo "<p>";
                            if (date("Y", strtotime($row["data"])) == date("Y")){
                                echo (date("m/d", strtotime($row["data"])));
                            } else {
                                echo (date("d/m/Y", strtotime($row["data"])));
                            }
                            echo " &nbsp"; echo date('H:i', strtotime($row["orario_inizio"]));
                            echo ' &nbsp - &nbsp <b>' . $row["nome"] . '</b>, <b>' . $row["nome_Dipartimento"] . '</b><br></p>';
                            $CHKinviti = 1;
                        }
                }
            } if ($CHKinviti == 0){ echo 'Non hai inviti'; }
            ?>
            </div>
        </div>

        <div class="DIVbox" ID = "MAINLeft" style = "padding-right: 1%">
            <h2>News</h2>
            <div style="text-align:left; height: 150px; overflow-x: hidden; padding-left: 2%;">
            <?php include "News.txt";?>  
            </div>
        </div>

        <?php include "../common/footer.html"; ?>
    </body>
</html>