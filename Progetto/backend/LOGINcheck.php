<!---- controlla mail e PWD----
------------nel login --------->

<?php

session_start();

    $mail = $_POST["email"];
    include "../Backend/DB_LOGINcheck.php";

    //print_r($_POST);
    $password = $_POST["pwd"];
    if (($mail == "" && $password == "")||($mail != "" && $password == "")||($mail == "" && $password =! "")){
        $parameter = "Location: ../Frontend/login.php?errore=vuoto";
        header($parameter);
    
    } else if ($DBmail != $mail || $password!=$DBPWD){
        if ($DBmail != $mail){
            $parameter = "Location: ../Frontend/login.php?errore=email&login=$mail";
        }
        else if ($password!=$DBPWD){
            $parameter = "Location: ../Frontend/login.php?errore=password&login=$mail";
        }
        //echo $parameter;
        header($parameter);

    // Utente non riconosciuto
    session_destroy();

    } else {

        $_SESSION["logged"]=$mail;
        $_SESSION["password"] = $DBPWD;
        $_SESSION["logged_TIME"]=time();
?><?php
        header("Location: ../Frontend/MAINsito.php");
    }
?>