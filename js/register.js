let registerAddEventListener = document.getElementById("register");

registerAddEventListener.addEventListener("submit", (e) =>{
    e.preventDefault();

    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let allDatasRegister
    if(username != "", email != "", password != ""){
        allDatasRegister={
            username: username,
            email: email,
            password: password,
        }
    
    }



    $.ajax({
        url: "Action.php",
        type: "POST",
        data: {action: "register", allRegisterDataKey: allDatasRegister},

        success: function(response){
            if(response){
                window.location.href="http://localhost/feladatok/pizzaWeb/?";
            }else{
                alert("Sikertelen regisztráció");
                console.log(response);
            }
            
        },
        error: function(xhr, errorMessage, error){

        }
    })
})