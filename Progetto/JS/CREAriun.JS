        var $Dipartimento = 0;
        var $Ruolo = 0;

        function EnableDisable() {
            var $Tema = document.getElementById("Tema").value;
            var $Data = document.getElementById("Data").value;
            var $Luogo = document.getElementById("Luogo").value;
            var $orario_inizio = document.getElementById("orario_inizio").value;
            var $orario_fine = document.getElementById("orario_fine").value;

            //Reference the Button.
            var btnSubmit = document.getElementById("btnSubmit");
            if ($Tema != "" && (ValidateTheme()==true)
            && $Data != ""
            && (ValidateDate()==true)
            && $Luogo != ""
            && $orario_inizio != "" && $orario_fine != "" && (ValidateHOUR()==true)) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        };

        function ValidateDate(){
            $Data = document.getElementById("Data").value;
            var $dateEntered = new Date($Data); 
            var $currentDate = new Date();
            $currentDate.setSeconds($currentDate.getSeconds() - 10);
            const dateFormat = /^\d{4}\-\d{2}\-\d{2}$/;
            if ((($currentDate < $dateEntered) || ($dateEntered.getDate() === $currentDate.getDate() 
            && $dateEntered.getMonth() === $currentDate.getMonth() 
            && $dateEntered.getFullYear() === $currentDate.getFullYear())) && ($Data.match(dateFormat))){
                return true;
            } else {
                return false;
            }
        }
        function ValidateDateTEXT(){
            if (ValidateDate() == false){
                document.getElementById("ALERTdate").innerHTML = "Data non valida";
                document.getElementById("ALERTdate").hidden = false;
            } else {
                document.getElementById("ALERTdate").innerHTML = "";
                document.getElementById("ALERTdate").hidden = true;
            }
        }

        function ValidateTheme() { 
            var $Tema = document.getElementById("Tema").value;
            var theme=  "^[a-zA-Z0-9\\s]*$";
            if($Tema.match(theme) && $Tema.length>2 && $Tema.length<30) { 
                return true;
            } else { 
                return false;
            }
        }
        function ValidateThemeTEXT() { 
            if (ValidateTheme() == false){
                document.getElementById("ALERTtheme").innerHTML = "tema non valido";
                document.getElementById("ALERTtheme").hidden = false;
            } else {
                document.getElementById("ALERTtheme").innerHTML = "";
                document.getElementById("ALERTtheme").hidden = true;
            }
        }

        function ValidateHOUR(){
            $Data = document.getElementById("Data").value;
            var $dateEntered = new Date($Data); 
            var $currentDate = new Date();
            $orario_inizio = document.getElementById("orario_inizio").value;
            $orario_fine = document.getElementById("orario_fine").value;

            if (($orario_inizio < $orario_fine) && ($dateEntered > $currentDate)){
                return true;
            } else if ($dateEntered.getDate() === $currentDate.getDate() 
            && $dateEntered.getMonth() === $currentDate.getMonth() 
            && $dateEntered.getFullYear() === $currentDate.getFullYear() 
            && $orario_inizio>(new Date().getHours() + ":" + new Date().getMinutes()) 
            && $orario_inizio < $orario_fine){
                return true;
            } else {
                return false;
            }
        }