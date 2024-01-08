<!-- CREA UN UTENTE -->

<?php 
session_start();

//correggo errori formali per DB
$email_auth = "NULL";
$data_auth = "NULL";
$Data_proclamazione = "NULL";
$tipo_impiegato = 'NULL';
if ($_GET["Ruolo"] != "direttore"){
    $ruolo = "impiegato";
    if ($_GET["Ruolo"] != "impiegato"){
    $tipo_impiegato = "'" . $_GET["Ruolo"] . "'";}
} else {
    $ruolo = "direttore";
    $Data_proclamazione = "'" . date("Y/m/d") . "'";
}
if (isset($_GET["Autorizzato"])){
    if ($_GET["Autorizzato"] == "si"){
        $email_auth = $_SESSION["logged"];
        if (isset($email_auth)){
            $email_auth = "'" . $email_auth . "'";
        }
        if ($_GET["AUTHdate"] == NULL){
            echo $_GET["AUTHdate"];
        }else {
            $data_auth = "'" . $_GET["AUTHdate"] . "'";
        }
    }
}

//passo dati al DB
$password = $_GET['Password'];
if (isset($_GET['Password2'])){
    $password = "'" . $_GET['Password2'] . "'";
}
if (SALAriun_MAILchk($_GET["NEWEmail"]) != true){
    echo '<script type="text/javascript">alert("La mail già esiste");history.go(-1);</script>';
} else {
    $err = SALAriun_REG(
        $_GET["NEWEmail"]
        ,$_GET["Nome"]
        ,$_GET["Cognome"]
        ,$ruolo
        ,$tipo_impiegato
        ,$_GET["Compleanno"]
        ,$Data_proclamazione
        ,$_GET["Dipartimento"]
        ,$email_auth
        ,$data_auth
        ,$password
        );
    if ($err=='1062'){
        echo '<script type="text/javascript">alert("La mail già esiste");history.go(-1);</script>';
    } else {
    header("Location: ../Frontend/SALEriun.php");
    }
}

function SALAriun_REG($Email, $Nome, $Cognome, $Ruolo, $tipo_impiegato, $Data_nascita, $Data_proclamazione, $nome_Dipartimento, $email_auth, $data_auth, $pass){
    include "../Backend/DBconnect.php";
    $query = "INSERT INTO `dipendente` 
    (`Email`, `Nome`, `Cognome`, `Ruolo`, `tipo_impiegato`, `Data_nascita`, `Data_proclamazione`, `nome_Dipartimento`, `email_auth`, `data_auth`, `password`) 
    VALUES ('$Email', '$Nome', '$Cognome', '$Ruolo', $tipo_impiegato, '$Data_nascita', $Data_proclamazione, '$nome_Dipartimento', $email_auth, $data_auth, $pass);";
    $res = $cid->query($query);
    $err = $cid ->errno;
    if($err=='1062') {
      return $err;
    } else if ($err!='0') {
      die("<p>Impossibile eseguire query.</p>"
      . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error  . "  - - -- - " . $query) . "</p>";
    }
    unset($res);
}

function SALAriun_MAILchk($Email){
    include "../Backend/DBconnect.php";
    $query = "SELECT * FROM `dipendente` WHERE `Email` = '$Email';";
    $res = $cid->query($query) or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error  . "  - - -- - " . $query) . "</p>";
    if ($res->num_rows > 0) {
        return false;
    } else {
        return true;
    }
    unset($res);
}
?>
