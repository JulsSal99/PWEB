function ValidateName() { 
    var $Nome = document.getElementById("Nome").value;
    var name=  "^[a-zA-Z\\s]*$";
    if($Nome.match(name) && $Nome.length>2 && $Nome.length<20) { 
        return true;
    } else { 
        return false;
    }
}
function ValidateNameTEXT(){
    if (ValidateName() == false){
        document.getElementById("ALERTname").innerHTML = "nome sbagliato";
        document.getElementById("ALERTname").hidden = false;
    } else {
        document.getElementById("ALERTname").innerHTML = "";
        document.getElementById("ALERTname").hidden = true;
    }
}


function ValidateSurname() { 
    var $Cognome = document.getElementById("Cognome").value;
    var surname=  "^[a-zA-Z\\s]*$";
    if($Cognome.match(surname) && $Cognome.length>2 && $Cognome.length<20) { 
        return true;
    } else { 
        return false;
    }
}
function ValidateSurnameTEXT(){
    if (ValidateSurname() == false){
        document.getElementById("ALERTsurname").innerHTML = "cognome sbagliato";
        document.getElementById("ALERTsurname").hidden = false;
    } else {
        document.getElementById("ALERTsurname").innerHTML = "";
        document.getElementById("ALERTsurname").hidden = true;
    }
}