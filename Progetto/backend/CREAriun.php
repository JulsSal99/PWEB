<!-- CREA UN UTENTE -->

<?php 
session_start();

//correggo errori formali per DB
$tema = $_GET["Tema"];
$data = $_GET["Data"];
$ID_Sala = $_GET["Luogo"];
$orario_inizio = $_GET["orario_inizio"];
$orario_fine = $_GET["orario_fine"];
$mail = $_SESSION["logged"];

if (CREAriun_CHK($data, $orario_inizio, $orario_fine, $ID_Sala)){
    echo '<script type="text/javascript">alert("sala già occupata");history.go(-1);</script>';
} else {
    CREAriun($tema, $data, $orario_inizio, $orario_fine, $ID_Sala, $mail);
    $ID_R = CERCAriun($tema, $data, $orario_inizio, $orario_fine, $ID_Sala, $mail);
    if ($ID_R != false){
      header("Location: ../Frontend/CREAriun_USERS.php?ID_R=$ID_R");
    }
}




function CREAriun_CHK($data, $orario_inizio, $orario_fine, $ID_Sala){
    include "../Backend/DBconnect.php";
    $query = "SELECT * 
    FROM riunione
    WHERE (riunione.data = '$data' AND riunione.ID_Sala = '$ID_Sala'
        AND ((riunione.orario_inizio >= '$orario_inizio' AND riunione.orario_inizio <= '$orario_fine')
        OR (riunione.orario_inizio <= '$orario_inizio' AND '$orario_fine' <= riunione.orario_fine)
        OR ('$orario_inizio' <= riunione.orario_inizio AND riunione.orario_fine <= '$orario_fine')))";
    $res = $cid->query($query)
      or die("<p>Impossibile eseguire query.</p>"
      . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error . $query) . "</p>";
    //echo "La query è stata eseguita";
    if ($res->num_rows > 0) {
      // output data of each row
      return true;
    } else {
      return false;
    }
    unset($res);
}

function CREAriun($tema, $data, $orario_inizio, $orario_fine, $ID_Sala, $mail){
  include "../Backend/DBconnect.php";
  $query = "INSERT INTO `riunione` (`tema`, `data`, `orario_inizio`, `orario_fine`, `email_creator`, `ID_Sala`) 
  VALUES ('$tema', '$data', '$orario_inizio', '$orario_fine', '$mail', '$ID_Sala')";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  //echo "La query è stata eseguita";
  unset($res);
}

function CERCAriun($tema, $data, $orario_inizio, $orario_fine, $ID_Sala, $mail){
  include "../Backend/DBconnect.php";
  $query2 = "SELECT ID_Riunione FROM `riunione` 
  WHERE (`tema` = '$tema' AND `data` = '$data' AND `orario_inizio` = '$orario_inizio' AND `orario_fine` = '$orario_fine' AND `email_creator` = '$mail' AND `ID_Sala` = '$ID_Sala')";
  $res2 = $cid->query($query2)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query2) . "</p>";
  //echo "La query è stata eseguita";
  if ($res2->num_rows > 0) {
    // output data of each row
    if ($res2 != NULL){
      while($row2 = $res2->fetch_assoc()) {
        return $row2['ID_Riunione'];
      }
    }
  } else {
    return false;
  }
  unset($res2);
}

?>