<?php 
session_start();
CREAriunINVITI_DEL($_POST['ID']);

foreach ($_POST['ARR'] as $persona){
  CREAriunINVITI($persona, $_POST['ID']);
}

function CREAriunINVITI_DEL($ID){
  include "../Backend/DBconnect.php";
  $query = "DELETE FROM `invitato` WHERE ID_Riunione=$ID";
  $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
}

function CREAriunINVITI($pers, $ID){
    include "../Backend/DBconnect.php";
    $query = "INSERT INTO invitato (ID_Riunione, email, accettazione) VALUES ($ID, '$pers', NULL)";
    $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
      . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
}

$Response = array('Success' => true);
echo json_encode($Response);
?>