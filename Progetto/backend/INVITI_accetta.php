<!-- CREA UN UTENTE -->

<?php 
session_start();

//passo dati al DB
include "../common/DBquery.php";
INVITI_accetta(
    $_GET["Email"],
    $_GET["ID_R"],
    $_GET["OK"],
    $_GET["Motivazione"]
    );
header("Location: ../Frontend/INVITI.php");
?>