<!DOCTYPE html>
<html>
    <head>
        <title>MeetupPlanner - About</title>
        <link rel="stylesheet" type="text/css" href="../CSS/sito.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php session_start(); include "../Backend/PAGEcheck.php"; $mail = $_SESSION["logged"];  include "../common/NAVBar.php"; ?>
        <div class="DIVbox" style="text-align: left">
        <?php include "About.txt";?>
        </div>
        <?php include "../common/footer.html";?>
    </body>

</html>