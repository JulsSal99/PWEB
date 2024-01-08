<!-- CREA UN UTENTE -->

<?php 
session_start();
include "../common/DBquery.php";

//correggo errori formali per DB
$data_auth = "NULL";
$email_auth = $_SESSION["logged"];
if ($_GET["AUTHdate"] == NULL){
    echo $_GET["AUTHdate"];
} else {
    $data_auth = "'" . $_GET["AUTHdate"] . "'";
}



//passo dati al DB
SALAriun_AUTH(
    $_GET["Email"]
    ,$data_auth
    ,$email_auth
    );
header("Location: ../Frontend/SALEriun.php");

function SALAriun_AUTH($mail, $data_auth, $mail_auth){
    include "../Backend/DBconnect.php";
    $query = "UPDATE `dipendente` SET `data_auth` = $data_auth, `email_auth` = '$mail_auth' WHERE `dipendente`.`Email` = '$mail'";
    $cid->query($query)
      or die("<p>Impossibile eseguire query.</p>"
      . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
  }
?>