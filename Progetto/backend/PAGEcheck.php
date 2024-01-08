<?php
//----------------------------------------------------
//------leggero controllo se ci sono stati------------
//--accessi malevoli vedendo se la variabile Session--
//---è buona e crea anche un timer per la sessione----
//----------------------------------------------------

//TEMPO IN SECONDI PRIMA CHE SCADA LA PAGINA
$TIMEOUT = (60*60); 

if(isset($_SESSION['logged_TIME']) && ($_SESSION['logged_TIME'] < (time()-$TIMEOUT))){
        //aspetta 5 secondi e POI ridireziona a login.php
        header( "refresh:5;url=../Frontend/login.php"); 
        session_destroy(); //elimino tutte le variabili compreso: unset($_SESSION["logon"]); unset($_SESSION["logged_TIME"]);
        
        ini_set('display_errors', 0); // disable error display
        ini_set('log_errors', 0); // disable error logging
        die("<h2>Tempo scaduto. Rieffettua il Login.<br></h2><h3>Verrai ridirezionato al login</h3>");
        }

//controllo accessi malevoli da link esterni
if(isset($_SESSION["logged"]) && isset($_SESSION["password"])){ } else { 
    header( "refresh:3;url=../Frontend/login.php");
    session_destroy(); 

    ini_set('display_errors', 0); // disable error display
    ini_set('log_errors', 0); // disable error logging
    die("<h2>Sembra che tu abbia usato un link sbagliato. In caso contrario, contatta il tuo Amministratore.<br></h2>
    <h3>Verrai ridirezionato al login</h3>");
}

if(DBmailcheck($_SESSION["logged"], $_SESSION["password"])!=true){
    header( "refresh:3;url=../Frontend/login.php");
    session_destroy(); 

    ini_set('display_errors', 0); // disable error display
    ini_set('log_errors', 0); // disable error logging
    die("<h2>Sembra che tu abbia usato un link sbagliato. In caso contrario, contatta il tuo Amministratore.<br></h2>
    <h3>Verrai ridirezionato al login</h3>");
}

function DBmailcheck($mail, $pwd){
        include "../Backend/DBconnect.php";
        $query1 = "SELECT * FROM dipendente WHERE (email='$mail' AND dipendente.password='$pwd');";
        $res = $cid->query($query1)
            Or die("<p>Impossibile eseguire query.</p>"
            . "<p>Codice errore " . $cid->errno
            . ": " . $cid->error) . "</p>";
        //echo "La query è stata eseguita";
    if ($res->num_rows > 0) {
        // output data of each row  
            return true;
    } else {
        die($pwd);
            return false;
    }
    unset($res);
    }
?>

