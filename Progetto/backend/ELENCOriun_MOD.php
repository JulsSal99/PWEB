<!-- CREA UN UTENTE -->

<?php 
session_start();
include "../common/DBquery.php";

//correggo errori formali per DB
$ID = $_GET["ID"];
if ($_GET["Sala"] == ""){
        $sala = $_GET["s_OLD"];
    } else {  $sala = $_GET["Sala"];  }
if ($_GET["tema"] == ""){
        $tema = $_GET["t_OLD"];
    } else {  $tema = $_GET["tema"];  }
if ($_GET["data"] == ""){
        $data = $_GET["d_OLD"];
    } else {  $data = $_GET["data"];  }
if ($_GET["orario_inizio"] == ""){
        $orario_inizio = $_GET["o1_OLD"];
    } else {  $orario_inizio = $_GET["orario_inizio"];  }
if ($_GET["orario_fine"] == ""){
        $orario_fine = $_GET["o2_OLD"];
    } else {  $orario_fine = $_GET["orario_fine"];  }

if (ELENCOriun_CHK($sala, $data, $orario_inizio, $orario_fine, $ID)){
    echo '<script type="text/javascript">alert("data già occupata");history.go(-1);</script>';
} else {
    //passo dati al DB
    $err = ELENCOriun_MOD(
        $ID,
        $sala,
        $tema,
        $data,
        $orario_inizio,
        $orario_fine
        );
    header("Location: ../Frontend/ELENCOriun.php");
}
?>