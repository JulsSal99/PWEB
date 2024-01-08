<?php
        session_start();
        $info = pathinfo($_FILES['File']['name']);
                        $ext = $info['extension']; // get the extension of the file
                        $newname = sprintf("profileimg%s.%s", time(), $ext);
                        //$newname = "newname.".$ext; 

                        $target = '../immagini/'.$newname;
                        move_uploaded_file( $_FILES['File']['tmp_name'], $target);

        ADD_IMG($newname, $_SESSION["logged"]);

        function ADD_IMG($name, $mail){
        include "../Backend/DBconnect.php";
        $query2 = "UPDATE `dipendente` SET `Foto` = '$name' WHERE `dipendente`.`Email` = '$mail'";
        $res = $cid->query($query2)
          or die("<p>Impossibile eseguire query.</p>"
          . "<p>Codice errore " . $cid->errno
          . ": " . $cid->error) . "</p>";
        //echo "La query è stata eseguita";
        
        unset($res);
        }
        header("Location: ../Frontend/PROFILO.php");
?>