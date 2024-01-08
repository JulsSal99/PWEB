<!-- CREA UN UTENTE -->

<?php 
session_start();

//passo dati al DB
include "../common/DBquery.php";
INVITI_cancella(
    $_GET["Email"],
    $_GET["ID_R"]
    );
header("Location: ../Frontend/INVITI.php");
?>