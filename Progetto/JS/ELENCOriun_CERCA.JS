function EnableDisable() {
    var $Giorno = document.getElementById("Giorno");
    var $Settimana = document.getElementById("Settimana");
    var $Mese = document.getElementById("Mese");
    var $Anno = document.getElementById("Anno");
    var btnSubmit = document.getElementById("btnSubmit");

    if ($Anno.value != ""){
        $Mese.removeAttribute("disabled");
        btnSubmit.disabled = false;
    }
    if ($Mese.value != ""){
        $Settimana.removeAttribute("disabled");
        $Giorno.removeAttribute("disabled");
    }
    if ($Giorno.value != ""){
        $Settimana.disabled="disabled";
    }
    if ($Settimana.value != ""){
        $Giorno.disabled="disabled";
    }

    if ($Mese.value == 2){
        document.getElementById("29").style.visibility = "hidden";
        document.getElementById("30").style.visibility = "hidden";
        document.getElementById("31").style.visibility = "hidden";
    } else if ($Mese.value == 4 || $Mese.value == 6 || $Mese.value == 9 || $Mese.value == 11) {
        document.getElementById("29").style.visibility = "visible";
        document.getElementById("30").style.visibility = "visible";
        document.getElementById("31").style.visibility = "hidden";
    } else {
        document.getElementById("29").style.visibility = "visible";
        document.getElementById("30").style.visibility = "visible";
        document.getElementById("31").style.visibility = "visible";
    }
};
