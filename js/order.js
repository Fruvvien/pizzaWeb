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
                            "<div class='pizzaQuantity'>" +text.quantity+"<button class='quantityChanger' onclick='quantityPluss("+text.cart_id+","+text.product_id+","+text.quantity+","+text.price+","+text.cart_items_id+")' >+</button>"+"<button onclick='quantityMinus("+text.cart_id+","+text.product_id+","+text.quantity+","+text.price+","+text.cart_items_id+")' class='quantityChanger'>-</button>"+"</div>"+
                            "<div class='pizzaPrice' >"+text.price+"</div>"+
                            
                    "</div>"
                    

                });
                pageList+= "<div class= 'buttonDiv'>"+
                            
                            "<button class= 'payButton' onclick='deleteFromCart("+result["cartId"][0].cart_id+")'>"+"Fizetendő ár: "+result["totalPrice"][0].total_price+"FT"+ "</button>"+
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
                deleteFromCart(cartId)
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

function deleteFromCart(cartId){
    $.ajax({
        url: "Action.php",
        type: "POST",
        data: {action: "deleteFromCart", cartIdKey: cartId},

        success: function(response){
            if(response){
                console.log(response)
                window.location.href="http://localhost/pizzaWeb/?page=pizza";
            }else{
                
            }
           
        },
        error: function(xhr, error, errorMessage){

        },




    })
}

function finalPricePlus(cartId, price){
    cartIdAndPrice = {
        cartId : cartId,
        price: price
    }
    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "finalPricePlus", cartIdAndPrice: cartIdAndPrice},

        success: function(response){
            if(response){
                location.reload();
                 
            }
        },
        error: function(xhr, error, errorMessage){
            console.log("nem sikerült");
            
        },


    })

}

function finalPriceMinus(cartId, price){
    cartIdAndPrice = {
        cartId : cartId,
        price: price
    }
    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "finalPriceMinus", cartIdAndPrice: cartIdAndPrice},

        success: function(response){
            if(response){
                location.reload();
                 
            }
        },
        error: function(xhr, error, errorMessage){
            console.log("nem sikerült");
            
        },


    })
}

function clearTheBag(cartItemId){
   
    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "clearTheBag", cartItemId: cartItemId},
       
        
        success: function(response){
            if(response){
                
               
                location.reload();
                
                
            }
        },
        error: function(xhr, error, errorMessage){

        },


    })
}


function quantityPluss(cartId, productId,quantity, price, cartItemId){

    
    allId={
        cartId: cartId,
        productId: productId,
        quantity:quantity,
        price: price
    
    }


    console.log(allId);
    
    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "quantityPlus", allData: allId},

        success: function(response){
            if(response){
                
                finalPricePlus(cartId, price);
                console.log(cartId, price);
                
                location.reload();
                
                
            }
        },
        error: function(xhr, error, errorMessage){

        },


    })
}

function deleteFromCartItemsWithWhere(cartId){
    $.ajax({
        url: "Action.php",
        type: "POST",
        data: {action: "deleteFromCartItemsWithWhere", cartItemId: cartId},

        success: function(response){
            if(response){
                
               
            }else{
                
            }
           
        },
        error: function(xhr, error, errorMessage){

        },




    })
}

function quantityMinus(cartId, productId,quantity, price,cartItemId){
    
    allId={
        cartId: cartId,
        productId: productId,
        quantity: quantity,
        price: price
        
    }
   
    $.ajax({
        url:"Action.php",
        type:"POST",
        data:{action: "quantityMinus", allData: allId},

        success: function(response){
            if(response){
                    if(quantity > 0){
                        finalPriceMinus(cartId, price)
                    }
                    
                    clearTheBag(cartItemId)
                    deleteFromCartItemsWithWhere(cartId)
                
                console.log(cartItemId);
            
                
               
               
                
            }
            
        },
        error: function(xhr, error, errorMessage){

        },

    })
        
}