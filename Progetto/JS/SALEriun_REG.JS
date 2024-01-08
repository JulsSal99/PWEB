function ValidateEmail(){
    $mail = document.getElementById("NEWEmail").value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($mail)){
        return true;
    } else {
        return false;
    }
}

function ValidateEmailTEXT(){
    if (ValidateEmail() == false){
        document.getElementById("ALERTemail").innerHTML = "Mail sbagliata";
        document.getElementById("ALERTemail").hidden = false;
    } else {
        document.getElementById("ALERTemail").innerHTML = "";
        document.getElementById("ALERTemail").hidden = true;
    }
}

function ValidateCompleanno(){
    $Compleanno = document.getElementById("Compleanno").value;

    var $dateEntered = new Date($Compleanno); 
    var $currentDate = new Date();
    if (($dateEntered.getFullYear()) < ($currentDate.getFullYear()-18)){
        return true;
    } else {
        return false;
    }
}

function ValidateCompleannoTEXT(){
    if (ValidateCompleanno() == false){
        document.getElementById("ALERTcompleanno").innerHTML = "Non sei maggiorenne";
        document.getElementById("ALERTcompleanno").hidden = false;
    } else {
        document.getElementById("ALERTcompleanno").innerHTML = "";
        document.getElementById("ALERTcompleanno").hidden = true;
    }
}

var $Dipartimento = 0;
var $Ruolo = 0;
function EnableDisableCHOICE(){
    var $Ruolo = 1; var $Dipartimento = 1;
}
function EnableDisableAUTH(){
    var AUTHdate = document.getElementById("Autorizzato").checked;
    if (AUTHdate == true){
        document.getElementById("AUTHdate").disabled = false;
        document.getElementById("AUTHdate").style.display = "block";
    } else {
        document.getElementById("AUTHdate").disabled = true;
        document.getElementById("AUTHdate").style.display = "none";
    }
    if (document.getElementById("Ruolo").value == "direttore"){
        document.getElementById("AUTHdate").disabled = true;
        document.getElementById("AUTHdate").style.display = "none"
        document.getElementById("Autorizzato").disabled = true;
    } else {
        document.getElementById("Autorizzato").disabled = false;
    }
}
function EnableDisableCHKpwd(){
    var $Password = document.getElementById("Password").value;
    var $Password2 = document.getElementById("Password2").value;
    var btnSubmitPWD = document.getElementById("btnSubmitPWD");
    if (CheckPassword()!=true){
        document.getElementById("PWDchk").innerHTML='carattere o lunghezza(7-16) non valida';
    } else if ($Password != "" && $Password2 != "" && $Password == $Password2){
        document.getElementById("PWDchk").innerHTML='';
    } else { document.getElementById("PWDchk").innerHTML='le password sono diverse' }
} 
function EnableDisable() {
    var $Nome = document.getElementById("Nome").value;
    var $Cognome = document.getElementById("Cognome").value;
    var $Compleanno = document.getElementById("Compleanno").value;
    var $NEWEmail = document.getElementById("NEWEmail").value;
    var $Ruolo = document.getElementById("Ruolo").value;
    var $Dipartimento = document.getElementById("Dipartimento").value;
    var $Password = document.getElementById("Password").value;
    var $Password2 = document.getElementById("Password2").value;

    //Reference the Button.
    var btnSubmit = document.getElementById("btnSubmit");
    if ($Nome != "" 
    && $Cognome != ""
    && $Compleanno != "" && (ValidateCompleanno() == true)
    && $NEWEmail != ""
    && $Ruolo != "" && $Dipartimento != "" 
    && $Password != "" && $Password2 != "" && ($Password == $Password2) && (CheckPassword() == true) && (ValidateEmail() == true)
    ) {
        btnSubmit.disabled = false;
    } else {
        btnSubmit.disabled = true;
    }
};

function CheckPassword() { 
    var $Password = document.getElementById("Password").value;
    var passw=  /^[A-Za-z]\w{6,14}$/;
    if($Password.match(passw)) { 
        return true;
    } else { 
        return false;
    }
}