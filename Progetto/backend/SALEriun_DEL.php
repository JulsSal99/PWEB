<!-- CANCELLA UN UTENTE -->

<?php 
session_start();
include "../common/DBquery.php";

//passo dati al DB
SALAriun_DEL($_GET["Email"]);
header("Location: ../Frontend/SALEriun.php")
?>