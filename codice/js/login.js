function goToIndex() {
    window.location.href = "../index.php";
}

function login(tipoUtente){
    //prendo e controllo se i campi sono compilati
    let user = $("#email").val();
    let pass = $("#password").val();
    if(user == "" || pass == ""){
        alert("Compila tutti i campi!");
    }
    //vado avanti
    else{
        //crypta password
        let pswMD5 = CryptoJS.MD5(pass).toString();
        //richiesta ajax
        $.get("../ajax/checkLogin.php", { user: email, pass: pswMD5,userType: tipoUtente }, function (data) {
            //controllo se effettua il json parse
                if (data["status"] == "ok"){
                   
                }
                else if (data["status"] == "ko")
                    alert(data["message"]);

        }, 'json');
    }
}