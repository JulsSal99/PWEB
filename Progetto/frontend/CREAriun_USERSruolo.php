<!DOCTYPE html>
<html>
    <head>
        <title>MeetupPlanner - Crea Riunione</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/CREAriun.css">
        <link rel="stylesheet" type="text/css" href="../CSS/CREAriun_USERS.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); $mail = $_SESSION["logged"]; include "../Backend/PAGEcheck.php"; include "../common/NAVBar.php"; 
        include '../common/DBquery.php';?>

        <?php if (isset($_GET["ID_R"])){}else{die;}
            if (CREAriun_AUTH($mail)==false){die(
                '<div class="DIVbox MAINtitle NEWpageTITLE">Non sei autorizzato, chiedi il permesso </div>');}
            if (ELENCOriun_IScreator($_GET["ID_R"], $mail)==false){die(
                '<div class="DIVbox MAINtitle NEWpageTITLE">Non sei il creatore</div>');}
        ?> 

        <div class="DIVbox MAINtitle NEWpageTITLE">
            <h1>Riunione creata!:</h1>
            <p style = "margin-bottom: 0px; font-size:140%;">Invita alla riunione:</p>
        </div>

        <div class="DIVbox NEWpage " style="text-align: left">

        <form method="GET" action="CREAriun_USERS.php?">
            <p style="display: inline; margin-left: 20px;">ordina per: </p>
            <input class=BTNreg type="submit"value="luogo" style="width:100px; margin-top: 10px; margin-bottom: 20px;" id="btnSubmitR" type="button">
            <input class=BTNreg value="categoria" style="width:100px; margin-top: 10px; margin-bottom: 20px;" id="btnSubmitR" type="button" disabled="disabled">
            <input type="text" name = "ID_R" value ="<?php echo $_GET['ID_R'];?>" style="visibility:hidden;">
        </form>

        <!--<table class="registrazione"> -->
            <?php 
            $res = CREAriun_UsersCAT();
            $ruol_prev = "";
            if ($res != NULL){
                while($row = $res->fetch_assoc()) {
                    if ($row["Email"] != $mail){
                        $Ruolo = "'".$row["Ruolo"].$row["tipo_impiegato"]."'";
                        if ($ruol_prev == ""){ //primo dipartimento
                            echo '<details><summary>
                            <input type="checkbox" class="UsersDIPinput" id='.$Ruolo.' value="" onclick="DIPchk('.$Ruolo.'), Numero()" />'
                            .$row["Ruolo"].
                            '</summary><table>';
                        } else if ($Ruolo != $ruol_prev){ //non è il primo dipartimento e è cambiato il dipartimento
                            echo '</table></details><details><summary>
                            <input type="checkbox" class="UsersDIPinput" id='.$Ruolo.' value="" onclick="DIPchk('.$Ruolo.'), Numero()" />
                            '; if ($row["Ruolo"] == 'direttore'){ echo $row["Ruolo"];
                                } else if ($row["tipo_impiegato"] == NULL){ echo "impiegato";
                                } else {echo $row["tipo_impiegato"];};
                            echo '</summary><table>';
                        }
                        echo '<tr><td class="UsersTD"><input type="checkbox" id="'.$row["Email"].'" value="" onclick="Numero()" /></td>';
                        echo "<td>".$row["Nome"]." ".$row["Cognome"]."</td></tr>";
                        $ruol_prev = $Ruolo;
                    }
                }
                echo "</tr></table></details>";
            }
            ?>
            <input class=BTNreg id="btnSubmit" type="submit" style ="width: 200px; margin-left: 5%" disabled="disabled" name = "OK" onclick=" if (confirm('Sei sicuro? eliminerai anche i precedenti inviti')){invita();}">
        </div>
        <?php include "../common/footer.html"; ?>
    </body>



    <script>
        function Numero(){
            var $TOTnum = <?php echo CREAriun_POSTI($_GET["ID_R"]);?>;
            var $num = 0;
            <?php
            $res = CREAriun_UsersCAT();
            if ($res != NULL){
                while($row = $res->fetch_assoc()) {
                    if ($row["Email"] != $mail){
                        echo 'if((document.getElementById("'.$row["Email"].'")).checked)
                            {';
                        echo '$num++;
                            }                    
                        ';
                    }
                }
            }
            ?>
            if ($TOTnum < $num){
                document.getElementById("btnSubmit").disabled = true;
                alert("Numero massimo superato! (<?php echo CREAriun_POSTI($_GET["ID_R"]);?>)");
            } else if ($num == 0){
                document.getElementById("btnSubmit").disabled = true; 
            }else {
                document.getElementById("btnSubmit").disabled = false;
            }
        }

        function DIPchk($dip){
            <?php
            $res = CREAriun_UsersCAT();
            if ($res != NULL){
                while($row = $res->fetch_assoc()) {
                    if ($row["Email"] != $mail){
                    $Ruolo = "'".$row["Ruolo"].$row["tipo_impiegato"]."'";
                    //gestisco i chkbox dei dipartimenti
                        echo 'if ($dip == '.$Ruolo.'){';
                            echo '
                            if((document.getElementById('.$Ruolo.')).checked){
                                document.getElementById("'.$row["Email"].'").checked = true;
                            }else{document.getElementById("'.$row["Email"].'").checked = false;
                            }
                        }';
                    }
                }
            }
            ?>                
        }
        </script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script rel="javascript" type="text/javascript">
            function invita(){
                var elencoMAIL = [];
                <?php
                $res = CREAriun_UsersCAT();
                if ($res != NULL){
                    while($row = $res->fetch_assoc()) {
                        if ($row["Email"] != $mail){
                            echo 'if((document.getElementById("'.$row["Email"].'")).checked == true)
                                { //se è checkato
                                elencoMAIL.push("'.$row["Email"].'");';
                            echo '}';
                        }
                    }
                }
                ?>
                    $.ajax({
                        
                        url: '../backend/CREAriunINVITI.php',
                        type: 'post',
                        dataType: 'json',
                        data: {ARR: elencoMAIL, ID: <?php echo $_GET["ID_R"]?>},
                        success: function(Success){
                            console.log(Success);
                            alert("Sono stati creati gli inviti");
                            document.getElementById("btnSubmit").hidden = true; 
                            window.open('ELENCOriun.php',"_self");
                        },
                        error: function (data) {
                            console.log(data);
                            alert("Errore");
                        }
                    });
            }
        </script>
</html>