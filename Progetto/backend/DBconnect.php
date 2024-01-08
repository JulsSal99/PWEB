<?php
include "../common/CredenzialiDB.php";

$cid = new mysqli($hostname, $username, $password, $db);

if($cid->connect_errno)
{
    die('Errore connessione (' . $cid->connecterrno . ')' . $cid->connect_error); }
    else { //echo 'Connesso. ' . $cid->host_info . "\n";
    }
?>