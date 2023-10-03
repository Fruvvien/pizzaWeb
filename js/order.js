$(document).ready(function() {
/*     totalPrice();
 */
    orderList();
});
/* function totalPrice(){
    $.ajax({
        
        url:"Action.php",
        type:"POST",
        data:{action: "totalPriceAction"},

        success: function(response){
            if(response){
                let totalPrice = JSON.parse(response);
                orderList(totalPrice);
            }
        },
        error: function(xhr, error, errorMessage){

        }

    })
} */

function orderList(){
    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "orderPage"},

        success: function(response){ 
            let pageList="";
            if(response ){
                let result = JSON.parse(response);
                
                result["order"].forEach(text=> {
                    pageList+=
                    "<div class='main'>"+
                            "<button class='button' onclick='deleteFunction("+text.cart_items_id+","+text.cart_id+","+text.price+","+text.quantity+")'><img class='buttonImg' src='./img/DeleteButton.png'></button>"+
                            "<img class='img' id='pizzaImg' src='./"+text.url+text.filename+"."+text.filetype+"'>"+
                            "<div class='pizzaName' >"+text.pnev+"</div>" +
                            "<div class='pizzaQuantity'>" +text.quantity+"</div>"+
                            "<div class='pizzaPrice' >"+text.price+"</div>"+
                            
                    "</div>"
                    

                });
                pageList+= "<div class= 'buttonDiv'>"+
                            "<button class= 'payButton'>"+result["totalPrice"][0].total_price+ "</button>"+
                            "</div>";
                
                
                document.getElementById("orders").innerHTML = pageList;
            }else{
                pageList="üres az orderbag";
                document.getElementById("orders").innerHTML=pageList;
            }
           


        },
        error: function(xhr, error, errorMessage){

        }
    })
}




function deleteFunction(id, cartId, price, quantity){
    
    $.ajax({
        url: "Action.php",
        type:"POST",
        data: {action: "deleteFunctionButton", cartItemKey: id},

        success: function(response){
            if(response){
                updateCart(cartId, price, quantity);
            }
        },
        error: function(xhr, error, errorMessage){

        }

    })
}

function updateCart(cartId, price, quantity){
    
    $.ajax({
        url: "Action.php",
        type:"POST",
        data: {action: "updateCart", cartKey: cartId, cartItemPrice: price, quantityKey: quantity},

        success: function(response){
            if(response){
               
                location.reload();
            }
        },
        error: function(xhr, error, errorMessage){

        }

    })
}