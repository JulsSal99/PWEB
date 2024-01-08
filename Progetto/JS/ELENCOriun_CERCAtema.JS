function EnableDisable() {
    var $tema = document.getElementById("tema");

    if ($tema.value != ""){
        btnSubmit.disabled = false;
    }
}