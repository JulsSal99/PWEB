function EnableDisable() {
    var $Sala = document.getElementById("Sala").value;
    var $tema = document.getElementById("tema").value;
    var $data = document.getElementById("data").value;
    var $orario_inizio = document.getElementById("orario_inizio").value;
    var $orario_fine = document.getElementById("orario_fine").value;
    
    if (
        $tema != "" || ($data != "" && ValidateDate()==true) || 
        ($orario_inizio != "" && $orario_fine != "" && ($orario_inizio < $orario_fine)) ||
        $Sala != ""
    ){
        document.getElementById("btnSubmit").style.visibility = "visible";
    } else {
        document.getElementById("btnSubmit").style.visibility = "hidden";
    }
}

function ValidateDate(){
    $Data = document.getElementById("data").value;

    var $dateEntered = new Date($Data); 
    var $currentDate = new Date();
    if (($dateEntered) > ($currentDate)){
        return true;
    } else {
        return false;
    }
}
function ValidateTime(){
    $Data = document.getElementById("data").value;

    var $dateEntered = new Date($Data); 
    var $currentDate = new Date();
    if (($dateEntered) > ($currentDate)){
        return true;
    } else {
        return false;
    }
}