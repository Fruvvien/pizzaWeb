
let loginEventListener= document.getElementById("loginEventListener");

loginEventListener.addEventListener("submit", (e) =>{
    
    e.preventDefault();
    
    
    let email=document.getElementById("email").value;
    let password=document.getElementById("password").value;
    let allDatas;
    if(email != "" && password != ""){
        allDatas={
            email: email,
            passw: password
        }
    }else{
        "írjon be adatokat";
    }
    



$.ajax({

    url:"Action.php",
    type:"POST",
    data:{action: "login", allDataKey: allDatas},
        

    success: function(response){
        let result = JSON.parse(response);
        if(result["success"]){
            if(result["loginData"]["user_type"]){
                document.getElementById("adminNav").style.display="block";
                document.getElementById("loginEventListener").style.display="none";
            }else if(!result["loginData"]["user_type"]){
                
                document.getElementById("adminNav").style.display="block";
                document.getElementById("loginEventListener").style.display="none";
            }
        }else{
            console.log(result["errorMessage"]);
        }
        
    },
    error: function(xhr, status, error){

    },

    });

})