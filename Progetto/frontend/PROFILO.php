<!-------------------------------------------------
//------------------profilo.php--------------------
//------Pagina con tutti i dati del profilo--------
//--------e la possibilità di modificarli----------
//------------------------------------------------->

<!DOCTYPE html>
<html>
    <head>
        <title>MeetupPlanner - Profilo</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/profilo.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"];  include "../common/NAVBar.php";
        include '../common/DBquery.php';
        
        $row = About1($mail);
        ?>

        <div class = "DIVbox">
        <h1>Info personali</h1>
        </div>
        <div class = "DIVbox">
            <table class ="title">
                <tr>
                    <td><strong>Informazioni utente</strong></td>
                    <td><a class="button, prof_BOTT" href="#popup1">Modifica profilo</a>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td><div class ="BORDEREDbox">
                        <?php $foto = $row["Foto"]?>
                        <a class="button, prof_BOTT" href="#popup2">
                        <img id="currentPhoto" src="<?php echo '../Immagini/'.$row["Foto"]?>" onerror="this.onerror=null; this.src='../Immagini/empty-profile.png'" 
                        width="150px" height="150px"></a>
                    </div></td>
                    <td width="99%">
                    <!--<a class="clkBOX_White" href="#popup2">Modifica immagine</a>-->
                    <h1>Ciao &nbsp<?php echo $row["Nome"]; echo " "; echo $row["Cognome"] ?></h1></td>
                </tr>
                <tr>
                    <td colspan="3"><p>Email: <?php echo $row["Email"] . " "?></p></td>
                </tr>
                <tr>
                    <td colspan="2"><p>Data di nascita: <?php echo $row["Data_nascita"]?></p></td>
                </tr>
            </table>
        </div>
        
        <div class = "DIVbox">
            <table class ="title">
                <tr>
                    <td><strong>Informazioni di ufficio</strong></td>
                </tr>
            </table>
            <table>
                <tr>
                    <?php if ($row["Ruolo"]=="direttore"){
                        echo "<td><p>Ruolo: &nbsp&nbsp direttore</p></td>";
                        echo "<td><p>Data di proclamazione: "; echo $row["Data_proclamazione"] . "</p></td>";
                    } else {
                        //autorizzazione
                        echo "<td><p>Ruolo: &nbsp&nbsp"; echo $row["tipo_impiegato"] . "</p></td>";
                        if ($row["data_auth"]!=NULL){
                            echo "<td><p>Autorizzato a creare le riunioni da <b>"; echo $row["email_auth"]; 
                            echo "</b> il <b>"; echo $row["data_auth"]; echo "</b>.</td>";
                        } else {
                            echo "<td>Non sei autorizzato a creare le riunioni.</td>";
                        }
                    }?>
                </tr>
                <tr>
                    <td colspan="2"><p>Nome del dipartimento in cui si trova: <?php echo "&nbsp&nbsp" . $row["nome_Dipartimento"]?></p></td>
                </tr>
            </table>
        </div>

<!------------->
<!-- overlay -->
        <!-- MODIFICA PROFILO UTENTE -->
        <div id="popup1" class="overlay"> 
            <div class="popup">
                <h2>Informazioni utente</h2>
                <a class="close" href="#">×</a>
                <div><form method="GET" action="../Backend/profilo_modifica.php?">
                        <table class="insert">
                            <tr><td ID="small1000">Nome: </td></tr>
                            <tr>
                                <td ID="big1000">Nome: </td>
                                <td><input class="inBOX" type="text" name = "Nome" id="Nome" onkeyup="EnableDisable(), ValidateNameTEXT()" value="<?php  echo $row["Nome"];?>" />
                                <P id="ALERTname" hidden=true></P></td>
                            </tr><tr><td ID="small1000">Cognome: </td></tr>
                            <tr>
                                <td ID="big1000">Cognome: </td>
                                <td><input class="inBOX" type="text" name = "Cognome" id="Cognome" onkeyup="EnableDisable(), ValidateSurnameTEXT()" value="<?php  echo $row["Cognome"];?>" />
                                <P id="ALERTsurname" hidden=true></P></td>
                            </tr><tr><td ID="small1000">Compleanno: </td></tr>
                            <tr>
                                <td ID="big1000">Compleanno: </td>
                                <td><input class="inBOX" type="date" name = "Compleanno" id="Compleanno" onchange="EnableDisable()" value="<?php  echo $row["Data_nascita"];?>" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class=clkBOX id="btnSubmit" type="submit" disabled="disabled" name = "OK">
                                    <input class=clkBOX_White type = "reset" value = "Cancella"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODIFICA IMMAGINE UTENTE -->
        <div>
            <div id="popup2" class="overlay"> 
                <div class="popup popup2">
                    <h2>Cambia immagine:</h2>
                    <a class="close" href="#">×</a>
                    <div>
                        <form action='../Backend/PROFILO_IMG.php' method='POST' enctype='multipart/form-data'>
                            <table class="insert">
                                <tr>
                                </tr><tr>
                                    <td><input style="color: transparent; display:block" type="File" accept="image/*" name = "File" id="File" onchange="EnableDisableIMG()"/>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class=clkBOX_White value="Carica" name="Submit1" id="btnSubmit2" type="submit" disabled = true>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../common/footer.html"; ?>
    </body>

    <script type="text/javascript">
        function EnableDisable() {
            var $Nome = document.getElementById("Nome").value;
            var $Cognome = document.getElementById("Cognome").value;
            var $Compleanno = document.getElementById("Compleanno").value;
            //Reference the Button.
            var btnSubmit = document.getElementById("btnSubmit");
            if (($Nome != "<?php  echo $row["Nome"];?>" 
            || $Cognome != "<?php  echo $row["Cognome"];?>"
            || $Compleanno != "<?php  echo $row["Data_nascita"];?>") && ValidateName() && ValidateSurname()) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        };

        function EnableDisableIMG() {
            var $File = document.getElementById("File").value; 
            if ($File != ""){
                document.getElementById("btnSubmit2").disabled = false;
            } else {
                document.getElementById("btnSubmit2").disabled = true;
            }
        }
    </script>
    <script src="../JS/Profilo.JS"></script>
</html>