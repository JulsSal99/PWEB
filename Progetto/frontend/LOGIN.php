<!-------------------------------------------------
//-------------------login.php---------------------
//--------Pagina di login in cui si crea-----------
//---------cookie e controllano accessi------------
//------------------------------------------------->

<?php
    function checkErrorLogin(){
        if (isset($_GET["errore"])){
            if ($_GET["errore"]=='password')  echo $_GET["login"];
            else echo "";
        } else return "";
    }
?>

<html>

	<head>
		<title>MeetupPlanner - Login</title>
		<link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <link rel="stylesheet" type="text/css" href="../CSS/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	
	<body>
		<body>

        <ul style="list-style-type: none; margin: -10;  padding: 0;  overflow: hidden;  position:static; ">
        <li style="float: left; display: block;"><a href="login.php">Home</a></li>
        <li style="padding: 14px 16px; 	text-decoration: none; display: inline-block; color: rgba(0, 0, 0, 0.726); text-align: center; font-size:x-large;">MeetupPlanner</li>
        </ul>
		
        <!-- <h1 style = "color: rgba(0, 0, 0, 0)">|</h1> -->
		<p class="form">
            <form method="POST" action="../Backend/LOGINcheck.php">
                <table class="insert, login" style ="display: flex; flex-wrap: wrap;"> 
                    <tr>
                        <td colspan="6"> Per accedere devi digitare username e password e quindi premere LOGIN </td>
                    </tr>
                    <tr>
                        <td ID="td_text">user mail: </td>
                        <td><input class="inBOX inBOXlogin" type = "text" name = "email" value="<?php checkErrorLogin();?>"></td>
                        
                        <td>password: </td>
                        <td><input class="inBOX inBOXlogin" type = "password" name = "pwd" value=""></td>
                        <!-- value è il valore di default -->
                        <td style="width:10%"></br></td>
                        <td ID="big800"><input class=clkBOX type= "submit" value= "Login"/></td>
                        <!--<td style="padding-left: 9%;"><input type = "reset" value = "Cancella"/></td>-->
                    </tr><tr>
                        <td ID="small800" style="width:10%"></br></td>
                        <td ID="small800"><input class=clkBOX type= "submit" value= "Login"/></td>
                        <!--<td style="padding-left: 9%;"><input type = "reset" value = "Cancella"/></td>-->
                    </tr>
                    <tr><td></br></td></tr>
                    <tr>
                        <!-- se sto entrando con un parametro errore -->
                        <td colspan="6" class="errore">
                            <?php
                                if (isset($_GET["errore"])){
                                    if ($_GET["errore"]=="vuoto")
                                        echo "<h3 class=centered>un valore è vuoto</h2>";
                                    else if ($_GET["errore"]=="email")
                                        echo "<h3 class=centered>la email non esiste</h2>";
                                    else if ($_GET["errore"]=="password")
                                        echo "<h3 class=centered>password sbagliata</h2>";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
		</p>
	</body>
</html>