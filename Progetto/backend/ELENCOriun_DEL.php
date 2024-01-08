<!-- CREA UN UTENTE -->


<?php 
session_start();

$ID = $_GET["ID"];
ELENCOriun_DELinv($ID);
ELENCOriun_DELriun($ID);

function ELENCOriun_DELinv($ID){
    include "../Backend/DBconnect.php";
    $query = "DELETE FROM `invitato` WHERE `invitato`.`ID_Riunione` = $ID";
    $cid->query($query)
      or die("<p>Impossibile eseguire query.</p>"
      . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
}
function ELENCOriun_DELriun($ID){
    include "../Backend/DBconnect.php";
    $query = "DELETE FROM `riunione` WHERE `riunione`.`ID_Riunione` = $ID";
    $cid->query($query)
      or die("<p>Impossibile eseguire query.</p>"
      . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
}

header("Location: ../Frontend/ELENCOriun.php");
?>