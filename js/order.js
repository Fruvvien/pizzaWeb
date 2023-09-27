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
            
            if(response ){
                let orderBag = JSON.parse(response);
                orderBag["queriesOrder"].forEach(text=> {
                    pageList+=
                    "<div class='main'>"+
                            "<button class='button' onclick='deleteFunction("+text.cart_items_id+","+text.cart_id+","+text.price+")'><img class='buttonImg' src='./img/DeleteButton.png'></button>"+
                            "<img class='img' id='pizzaImg' src='./"+text.url+text.filename+"."+text.filetype+"'>"+
                            "<div class='pizzaName' >"+text.pnev+"</div>" +
                            "<div class='pizzaQuantity'>" +text.quantity+"</div>"+
                            "<div class='pizzaPrice' >"+text.price+"</div>"+
                            "<div>"+text.total_price+" </div"+
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


function deleteFunction(id, cartId, price){
    
    $.ajax({
        url: "Action.php",
        type:"POST",
        data: {action: "deleteFunctionButton", cartItemKey: id},

        success: function(response){
            if(response){
                updateCart(id,cartId, price);
            }
        },
        error: function(xhr, error, errorMessage){

        }

    })
}

function updateCart(id,cartId, price){
    console.log(cartId);
    $.ajax({
        url: "Action.php",
        type:"POST",
        data: {action: "updateCart", cartKey: cartId, cartItemKey: id, cartItemPrice: price},

        success: function(response){
            if(response){
               
                location.reload();
            }
        },
        error: function(xhr, error, errorMessage){

        }

    })
}