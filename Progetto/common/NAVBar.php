<!-- Guarda se il tasto "Esci" ha impostato Esci e quindi elimina il cookie della sessione -->
<?php
    if (isset($_GET["Esci"]))
        {
            Esci($_GET['Esci']);
        }

    function Esci($res){
        session_destroy();
        unset($_SESSION["logon"]);
        header("Location: login.php");
        exit();
        echo $res;
    }
?>
<?php
    function isAUTH($mail){
    include "../Backend/DBconnect.php";
    $query = "SELECT * 
    FROM dipendente
    WHERE (email = '$mail' AND Ruolo = 'impiegato' AND email_auth IS NULL)";
    $res = $cid->query($query)
        or die("<p>Impossibile eseguire query.</p>"
        . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error . $query) . "</p>";
    //echo "La query è stata eseguita";
    if ($res->num_rows > 0) {
        // output data of each row
        return false;
    } else {
        return true;
    }
    unset($res);
    }
?>


<!-- elenco files -->
<?php
    $Home = "MAINsito.php";
    $Sale_riunioni = "SALEriun.php";
    $Crea_riunione = "CREAriun.php";
    $Elenco_riunioni = "ELENCOriun.php";
    $Inviti = "Inviti.php";
    $About = "About.php";
    $Profilo = "profilo.php";
    $Statistiche = "Statistiche.php";
?>

<!-- LAYER DI BLUR -->
<ul style = "background-image: repeating-radial-gradient(white, rgba(100, 100, 100, 0.7) 30%); opacity: .7; filter: blur(7px); ">
    <li><a>"</a></li>
</ul>
<ul style = "z-index: 5">
    <li><a href=<?php echo $Home;?>>Home</a></li>
    <div ID="big580">
        <li><a href=<?php echo $Sale_riunioni;?>>Dipartimenti</a></li>
        <li class="dropdown" style ="border-right: 1px solid #bbb;">
            <a href="javascript:void(0)" class="dropbtn">Riunioni</a>
            <div class="dropdown-content">
                <?php
                if (isAUTH($mail) == true) {
                    echo "<a href=". $Crea_riunione. ">Crea riunione</a>";
                }
                ?>
                <a href=<?php echo $Elenco_riunioni;?>>Elenco Riunioni</a>
                <a href=<?php echo $Inviti;?>>Inviti</a>
            </div>
        </li>
        <li><a href=<?php echo $Statistiche;?>>Statistiche</a></li>
    </div>
    <div ID="small580"><li class="dropdown" style ="border-right: 1px solid #bbb;">
        <a class="dropbtn">Riunioni</a>
        <div class="dropdown-content">
            <a href=<?php echo $Sale_riunioni;?>>Dipartimenti</a>
            <?php
                if (isAUTH($mail) == true) {
                    echo "<a href=". $Crea_riunione. ">Crea riunione</a>";
                }
            ?>
            <a href=<?php echo $Elenco_riunioni;?>>Elenco Riunioni</a>
            <a href=<?php echo $Inviti;?>>Inviti</a>
            <a href=<?php echo $Statistiche;?>>Statistiche</a>
        </div>
    </li></div>
    <li style="float:right"><a class="active" href=<?php echo $About;?>>About</a></li>
    <div ID="big800"><li class="dropdown" style="float:right">
        <a href=<?php echo $Profilo;?> class="dropbtn" href="#user">Benvenuto <?php echo $mail;?></a>
        <div class="dropdown-content">
            <a href="?Esci=1" class="active">Esci</a>
        </div>
    </li></div>
    <div ID="small800"><li class="dropdown" style="float:right;">
        <a class="dropbtn">Profilo</a>
        <div class="dropdown-content">
            <a href=<?php echo $Profilo;?>> <img src="../Immagini/empty-profile.png" style="width: 15px; height: 15px">  profilo</a>
            <a href="?Esci=1" class="active">Esci</a>
        </div>
    </li></div>
</ul>


<!--BUG della barra. Aggiunge uno spazio vuoto sotto di essa-->

<h1 style = "color: rgba(0, 0, 0, 0)">|</h1>