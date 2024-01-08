<?php
include "../Backend/DBconnect.php";

//-------------------------------------------------------------
//-----------------------About.php-----------------------------
//-------------------------------------------------------------

function About1($mail){
include "../Backend/DBconnect.php";
$query1 = "SELECT * FROM dipendente WHERE email='$mail';";
$res = $cid->query($query1)
    Or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error) . "</p>";
//echo "La query è stata eseguita";

if ($res->num_rows > 0) {
    // output data of each row
    while($row = $res->fetch_assoc()) {
      return $row;
    }
  } else {
    echo "0 results";
  }
unset($res);
}

function Profilo1($Nome, $Cognome,$Data_nascita,$Email){
include "../Backend/DBconnect.php";
$query2 = "UPDATE `dipendente` 
SET `Nome` = '$Nome', 
`Cognome` = '$Cognome',
`Data_nascita` = '$Data_nascita'

WHERE `dipendente`.`Email` = '$Email'";
$res = $cid->query($query2)
  Or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
  . ": " . $cid->error) . "</p>";
//echo "La query è stata eseguita";

unset($res);
}

//!!!!!!!!!!!usato anche da ELENCOriunioni
//!!!!!!!!!!!usato anche da ELENCOriunioni
//!!!!!!!!!!!usato anche da ELENCOriunioni
function MAINRiunioni($mail, $data){
  include "../Backend/DBconnect.php";
  $query = "SELECT *
  FROM (invitato RIGHT JOIN (sala_riunione NATURAL JOIN riunione) ON invitato.ID_Riunione = riunione.ID_Riunione)
  WHERE ( ( (riunione.email_creator = '$mail') 
            OR ((invitato.accettazione='1' OR invitato.accettazione IS NULL) AND (invitato.email = '$mail'))
            ) 
          AND (riunione.data >= '$data') ) GROUP BY riunione.ID_Riunione
  ORDER BY riunione.data, riunione.orario_inizio;";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error. $query) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}
function MAINRiunioni2($mail, $data){
  include "../Backend/DBconnect.php";
  $query = "SELECT *
  FROM invitato LEFT JOIN (sala_riunione NATURAL JOIN riunione) ON invitato.ID_Riunione = riunione.ID_Riunione
  WHERE ( ( (riunione.email_creator != '$mail') 
            AND ((invitato.accettazione IS NULL) AND (invitato.email = '$mail'))
          )
        AND (riunione.data >= '$data') ) GROUP BY riunione.ID_Riunione
  ORDER BY riunione.data, riunione.orario_inizio;";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error. $query) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}

function MAINCalendar($mail, $mese, $anno){
  include "../Backend/DBconnect.php";
  $query3 = "SELECT riunione.data
  FROM (invitato RIGHT JOIN (sala_riunione NATURAL JOIN riunione) ON invitato.ID_Riunione = riunione.ID_Riunione)
  WHERE ( ( (riunione.email_creator = '$mail') OR ((accettazione='1') AND (email = '$mail')) ) 
  AND ((MONTH(riunione.data) = '$mese') AND (YEAR(riunione.data) = '$anno')) ) 
  ORDER BY riunione.data, riunione.orario_inizio;";
  $res = $cid->query($query3)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}



function SALAriun($data){
  include "../Backend/DBconnect.php";
  $query = "SELECT sala_riunione.*, riunione.*, dipartimento.Indirizzo
  FROM (sala_riunione LEFT JOIN riunione ON  riunione.ID_Sala = sala_riunione.ID_Sala) 
  INNER JOIN dipartimento ON sala_riunione.nome_Dipartimento = dipartimento.Nome
  WHERE ((riunione.data >= $data) OR (riunione.data IS NULL)) 
  ORDER BY riunione.ID_Riunione, sala_riunione.nome";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}
function SALAriun2($data){
  include "../Backend/DBconnect.php";
  $query = "SELECT sala_riunione.*, riunione.*, dipartimento.Indirizzo
  FROM (sala_riunione LEFT JOIN riunione ON  riunione.ID_Sala = sala_riunione.ID_Sala) 
  INNER JOIN dipartimento ON sala_riunione.nome_Dipartimento = dipartimento.Nome
  WHERE ((riunione.data >= $data) OR (riunione.data IS NULL)) 
  ORDER BY nome_Dipartimento, sala_riunione.nome, riunione.data DESC, riunione.orario_inizio DESC, riunione.ID_Riunione";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}

function SALAriun_Users($dip){
  include "../Backend/DBconnect.php";
  $query = "SELECT dipendente.nome, dipendente.cognome, dipendente.Email, dipendente.email_auth, dipendente.data_auth 
  FROM dipendente 
  WHERE nome_Dipartimento = '$dip' 
  ORDER BY dipendente.nome, dipendente.cognome";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}

function SALAriun_IS_Dir($mail){
  include "../Backend/DBconnect.php";
  $query = "SELECT *
  FROM dipendente 
  WHERE dipendente.Email = '$mail' AND dipendente.Ruolo = 'direttore'";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return true;
  } else {
    return false;
  }
  unset($res);
}

//cerca i dipartimenti
function SALAriun_DIP(){
  include "../Backend/DBconnect.php";
  $query = "SELECT dipartimento.Nome
  FROM `dipartimento`";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}

function SALAriun_DEL($mail){
  include "../Backend/DBconnect.php";
  $query = "DELETE FROM `dipendente` WHERE `dipendente`.`Email` = $mail";
  $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
}

function SALAriun_CERCA($YEAR, $MONTH_i, $MONTH_f){
  include "../Backend/DBconnect.php";
  $query = "SELECT * FROM `riunione` 
  WHERE ( YEAR(riunione.data) = '$YEAR'
          AND (MONTH(riunione.data) >= '$MONTH_i' AND MONTH(riunione.data) <= '$MONTH_f')
          )";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  if ($res->num_rows > 0) {
    return $res;
  }
  unset($res);
}



//-------------------------------------------------------------
//-----------------------Inviti.php----------------------------
//-------------------------------------------------------------

function INVITI_nuovi($mail, $data_i, $orario_i, $accettazione){
  include "../Backend/DBconnect.php";
  if ($accettazione != 'NULL'){
  $query = "SELECT * 
    FROM `invitato` LEFT JOIN riunione ON invitato.ID_Riunione = riunione.ID_Riunione 
    WHERE invitato.email = '$mail' AND invitato.Accettazione = '$accettazione' AND (riunione.data > '$data_i' OR (riunione.data = '$data_i' AND riunione.orario_inizio >= '$orario_i'))
    ORDER BY `data` DESC, `orario_inizio` DESC";
  } else {
    $query = "SELECT * 
    FROM `invitato` LEFT JOIN riunione ON invitato.ID_Riunione = riunione.ID_Riunione 
    WHERE invitato.email = '$mail' AND (invitato.Accettazione IS NULL) AND (riunione.data > '$data_i' OR (riunione.data = '$data_i' AND riunione.orario_inizio >= '$orario_i'))
    ORDER BY `data` DESC, `orario_inizio` DESC";
  }
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  if ($res->num_rows > 0) {
    return $res;
  }
  unset($res);
}

//non permette solo di accettare ma anche rifiutare. Non gestisce il NULL
function INVITI_accetta($mail, $ID_Riunione, $accettazione, $motivazione){
  include "../Backend/DBconnect.php";
  $query = "UPDATE `invitato` SET `Accettazione` = '$accettazione', `motivazione` = '$motivazione'
  WHERE `invitato`.`Email` = '$mail' AND `invitato`.`ID_Riunione` = '$ID_Riunione'";
  $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
}


//restituisce true se ci sono altre riunioni accettate in quel range di orario
function INVITI_CHKdate($mail, $data, $orario_i, $orario_f){
  include "../Backend/DBconnect.php";
  $query = "SELECT * 
    FROM `invitato` LEFT JOIN riunione ON invitato.ID_Riunione = riunione.ID_Riunione 
    WHERE invitato.email = '$mail' 
      AND (invitato.Accettazione = '1')
      AND (riunione.data = '$data' 
        AND ((riunione.orario_inizio >= '$orario_i' AND riunione.orario_inizio <= '$orario_f')
        OR ((riunione.orario_fine >= '$orario_i' AND riunione.orario_fine <= '$orario_f'))))";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return false;
  } else {
    return true;
  }
  unset($res);
}

function INVITI_cancella($mail, $ID_Riunione){
  include "../Backend/DBconnect.php";
  $query = "UPDATE `invitato` SET `Accettazione` = NULL, `motivazione` = ''
  WHERE `invitato`.`email` = $mail AND `invitato`.`ID_Riunione` = $ID_Riunione";
  $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
}

function ELENCORiun_OLD($mail, $data){
  include "../Backend/DBconnect.php";
  $query = "SELECT *
  FROM (invitato RIGHT JOIN (sala_riunione NATURAL JOIN riunione) ON invitato.ID_Riunione = riunione.ID_Riunione)
  WHERE ( ( (riunione.email_creator = '$mail') OR ((invitato.accettazione='1' OR invitato.accettazione IS NULL) AND (invitato.email = '$mail')) ) 
  AND (riunione.data <= '$data') ) GROUP BY riunione.ID_Riunione
  ORDER BY riunione.data DESC, riunione.orario_inizio DESC;";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return $res;
  }
  unset($res);
}
function ELENCOriun_Sala(){
  include "../Backend/DBconnect.php";
  $query = "SELECT nome, ID_Sala, nome_Dipartimento FROM `sala_riunione`  
  ORDER BY  `sala_riunione`.`nome_Dipartimento`, `sala_riunione`.`nome` ASC";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  if ($res->num_rows > 0) {
    return $res;
  }
  unset($res);
}
function ELENCOriun_MOD($ID, $sala, $tema, $data, $orario_inizio, $orario_fine){
  include "../Backend/DBconnect.php";
  $query = "UPDATE `riunione` 
  SET `tema` = '$tema', `data` = '$data', `orario_inizio` = '$orario_inizio', `orario_fine` = '$orario_fine', `ID_Sala` = '$sala'
  WHERE `riunione`.`ID_Riunione` = $ID";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  if ($res->num_rows > 0) {
    return $res;
  }
  unset($res);
}
function ELENCOriun_CHK($sala, $data, $orario_inizio, $orario_fine){
  include "../Backend/DBconnect.php";
  $query = "SELECT * 
    FROM riunione
    WHERE (riunione.data = '$data' AND riunione.ID_Sala = '$sala'
        AND ((riunione.orario_inizio >= '$orario_inizio' AND riunione.orario_inizio <= '$orario_fine')
        OR (riunione.orario_inizio < '$orario_inizio' AND '$orario_fine' < riunione.orario_fine)
        OR ('$orario_inizio' < riunione.orario_inizio AND riunione.orario_fine < '$orario_fine')))";
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

function ELENCOriun_tema(){
  include "../Backend/DBconnect.php";
  $query = "SELECT tema FROM `riunione` GROUP BY riunione.tema 
  ORDER BY `riunione`.`tema`  DESC ";
  $res = $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error . $query) . "</p>";
if ($res->num_rows > 0) {
  return $res;
}
unset($res);
}

function ELENCOriun_CERCAtema($tema){
  include "../Backend/DBconnect.php";
  $query = "SELECT * FROM `riunione` WHERE tema = '$tema'  
  ORDER BY `riunione`.`tema`  DESC";
  $res = $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error . $query) . "</p>";
if ($res->num_rows > 0) {
  return $res;
}
unset($res);
}

//usato anche da CREAriun.php
function ELENCOriun_IScreator($ID, $mail){
  include "../Backend/DBconnect.php";
  $query = "SELECT * FROM `riunione` WHERE (`ID_Riunione` = $ID AND email_creator ='$mail')";
  $res = $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error . $query) . "</p>";
if ($res->num_rows > 0) {
  return true;
} else {
  return false;
}
unset($res);
}

function ELENCOriun_InvitatiID($ID_R, $accettazione){
  include "../Backend/DBconnect.php";
  $query = "SELECT * FROM `invitato` LEFT JOIN `dipendente` ON invitato.email=dipendente.Email 
  WHERE (invitato.accettazione = $accettazione AND invitato.ID_Riunione = $ID_R) ORDER BY `dipendente`.`Nome`, dipendente.Cognome ASC";
  $res = $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error . $query) . "</p>";
if ($res->num_rows > 0) {
  return $res;
}
unset($res);
}
function ELENCOriun_InvitatiIDNULL($ID_R){
  include "../Backend/DBconnect.php";
  $query = "SELECT * FROM `invitato` LEFT JOIN `dipendente` ON invitato.email=dipendente.Email 
  WHERE (invitato.accettazione IS NULL AND invitato.ID_Riunione = $ID_R) ORDER BY `dipendente`.`Nome`, dipendente.Cognome ASC";
  $res = $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error . $query) . "</p>";
if ($res->num_rows > 0) {
  return $res;
}
unset($res);
}

function CREAriun_Users(){
  include "../Backend/DBconnect.php";
  $query = "SELECT * FROM `dipendente` ORDER BY nome_Dipartimento, Ruolo, Nome, Cognome ASC";
  $res = $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error . $query) . "</p>";
if ($res->num_rows > 0) {
  return $res;
}
unset($res);
}
function CREAriun_UsersCAT(){
  include "../Backend/DBconnect.php";
  $query = "SELECT * FROM `dipendente` ORDER BY Ruolo, tipo_impiegato, Nome, Cognome ASC";
  $res = $cid->query($query)
  or die("<p>Impossibile eseguire query.</p>"
  . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error . $query) . "</p>";
if ($res->num_rows > 0) {
  return $res;
}
unset($res);
}

function CREAriun_AUTH($mail){
  include "../Backend/DBconnect.php";
  $query = "SELECT * 
    FROM dipendente
    WHERE (email = '$mail' AND Ruolo = 'impiegato' AND email_auth IS NULL)";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
    // output data of each row
    return false;
  } else {
    return true;
  }
  unset($res);
}
function CREAriun_POSTI($ID){
  include "../Backend/DBconnect.php";
  $query = "SELECT n_posti FROM `sala_riunione` RIGHT JOIN riunione ON riunione.ID_Sala = sala_riunione.ID_Sala WHERE ID_Riunione = $ID";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
      if ($res != NULL){
        while($row = $res->fetch_assoc()) {
          $ris = $row["n_posti"];
        }
      return $ris;
    } else {
      return;
    }
    unset($res);
  }
}

function Statistiche($mail){
  include "../Backend/DBconnect.php";
  $data = date("Y-m-d");
  $query = "SELECT *, COUNT(*) 
  FROM `invitato` LEFT JOIN (riunione LEFT JOIN sala_riunione ON riunione.ID_Sala = sala_riunione.ID_Sala) ON invitato.ID_Riunione = riunione.ID_Riunione
  WHERE (`invitato`.`Accettazione` = 1 AND riunione.data<'$data') GROUP BY invitato.ID_Riunione 
  HAVING COUNT(*) > (SELECT COUNT(*) FROM `dipendente`
  WHERE (dipendente.nome_Dipartimento = (SELECT nome_Dipartimento FROM dipendente WHERE Email = '$mail')))";
  $res = $cid->query($query)
    or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error . $query) . "</p>";
  //echo "La query è stata eseguita";
  if ($res->num_rows > 0) {
      return $res;
    }
    unset($res);
}
?>