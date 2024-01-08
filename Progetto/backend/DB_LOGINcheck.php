<?php
include "../Backend/DBconnect.php";

//-------------------------------------------------------------
//--------------------CHECKlogin.php---------------------------
//-------------------------------------------------------------
$query = "SELECT email, password FROM dipendente WHERE email='$mail';";
$res = $cid->query($query)
    Or die("<p>Impossibile eseguire query.</p>"
    . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error) . "</p>";
//echo "La query è stata eseguita";


//cicla finchè ci sono righe. A NULL, l'ultima, si ferma
while ($row = $res->fetch_row()){
    $DBmail=$row[0];
    $DBPWD=$row[1];
}
unset($res);