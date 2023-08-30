let loginEventListener= document.getElementById("loginEventListener");

loginEventListener.addEventListener("button", (e) =>{

    let email=document.getElementById("email").value;
    let password=document.getElementById("password").value;

    if(email != "", password != ""){
        let allDatas={
            email: email,
            passw: password
        }
    }


    $.ajax({

        url:"AdminAction.php",
        type:"POST",
        data:{action: "login"},
        

        success: function(response){
            if(response){

            }
        }

    })



})