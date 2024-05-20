function goToIndex() {
    window.location.href = "../index.php";
}

function login(tipoUtente){
    //prendo e controllo se i campi sono compilati
    let email = $("#email").val();
    let pass = $("#password").val();
    if(email == "" || pass == ""){
        alert("Compila tutti i campi!");
    }
    //vado avanti
    else{
        //crypta password
        let pswMD5 = CryptoJS.MD5(pass).toString();
        //richiesta ajax
        $.get("../ajax/checkLogin.php", { email: email, pass: pswMD5,userType: tipoUtente }, function (data) {
            //controllo se effettua il json parse
                if (data["message"] == "admin"){
                   window.location.href="paginaAdmin.php";
                }else{
                    window.location.href="paginaUtente.php";
                }
               

        }, 'json');
    }
}

function logout(){
    window.location.href="logout.php";
}