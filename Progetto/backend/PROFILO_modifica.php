<!-- MODIFICA IL PROFILO -->

<?php 
session_start();
include "../common/DBquery.php";
Profilo1(
    $_GET["Nome"]
    ,$_GET["Cognome"]
    ,$_GET["Compleanno"]
    ,$_SESSION["logged"]
    );
header("Location: ../Frontend/profilo.php")
?>