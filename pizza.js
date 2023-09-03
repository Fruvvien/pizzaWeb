$(document).ready(function(){
    pizzaPage();

});

function pizzaPage(){


    $.ajax({
        url:"Action.php",
        type:"POST",
        data:{action: "pizzaAction"},


        success: function(response){

        },
        error: function(xhr, error, errorMessage){

        }

    })

}