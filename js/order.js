$(document).ready(function() {
    orderList();
});


function orderList(){
    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "orderPage"},

        success: function(response){ 
            let pageList="";
            if(response){
                let orderBag = JSON.parse(response);
                orderBag.forEach(text=> {
                    pageList+=
                    "<div class='main'>"+
                            "<button class='button' onclick='delteFunction("+text.cart_id+")'><img class='buttonImg' src='./img/DeleteButton.png'></button>"+
                            "<img class='img' id='pizzaImg' src='./"+text.url+text.filename+"."+text.filetype+"'>"+
                            "<div class='pizzaName' >"+text.pnev+"</div>" +
                            "<div class='pizzaQuantity'>" +text.quantity+"</div>"+
                            "<div class='pizzaPrice' >"+text.price+"</div>"+
                    "</div>"
                });
                document.getElementById("orders").innerHTML=pageList;
            }else{
                pageList="üres az orderbag";
                document.getElementById("orders").innerHTML=pageList;
            }
           


        },
        error: function(xhr, error, errorMessage){

        }
    })
}