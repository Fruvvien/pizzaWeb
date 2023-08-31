$(document).ready(function() {
    sessionExist();

});


function sessionExist(){
     
    $.ajax({

        url:"Action.php",
        type:"POST",
        data: {action: "sessionExist"},

        success: function(response){
            let result= JSON.parse(response);
      
            if(result["sessionIsNotExist"]){
                if(result["usertype"]){
                    document.getElementById("adminNav").style.display="block";
                    document.getElementById("loginEventListener").style.display="none";
                }else{
                    document.getElementById("user").style.display="block";
                    document.getElementById("loginEventListener").style.display="none";
                }
            }else{
                document.getElementById("loginEventListener").style.display="block";
                document.getElementById("user").style.display="none";
                document.getElementById("adminNav").style.display="none";
            }
           
        },
        error: function(xhr, status, error){

        }

    })
}

let logoutSessionUser=document.getElementById("logoutUser");

logoutSessionUser.addEventListener("click", (e) =>{
    $.ajax({
        url:"Action.php",
        type:"POST",
        data: {action: "logoutUser"},

        success: function(response){
           if(response){
            document.getElementById("loginEventListener").style.display="block";
            document.getElementById("user").style.display="none";
            document.getElementById("adminNav").style.display="none";
           }
        },
        error: function(xhr, status, error){

        }

    });
});

let logoutSessionAdmin=document.getElementById("logoutAdmin");

logoutSessionAdmin.addEventListener("click", (e) =>{
    $.ajax({
        url:"Action.php",
        type:"POST",
        data: {action: "logoutAdmin"},

        success: function(response){
           if(response){
            document.getElementById("loginEventListener").style.display="block";
            document.getElementById("user").style.display="none";
            document.getElementById("adminNav").style.display="none";
           }
        },
        error: function(xhr, status, error){

        }

    });
})
    
