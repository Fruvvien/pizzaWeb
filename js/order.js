$(document).ready(function() {
    orderList();
});


function orderList(){
    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "orderPage"},

        success: function(response){ 
            let orderBag = JSON.parse(response);
            let pageList="";

            orderBag.forEach(text=> {
                pageList+=
                "<div>"+
                    "<div>"+
                        "<div>"+text.pnev+" "+text.quantity+" "+text.price+"</div>"+
                        
                    "</div>"
                "</div>"
            });
            document.getElementById("orders").innerHTML=pageList


        },
        error: function(xhr, error, errorMessage){

        }
    })
}