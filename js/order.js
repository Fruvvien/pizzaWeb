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
                        "<ol>"+
                            "<li id='orderRow'>"+
                                "<div >"+text.pnev+"</div>" +
                                "<div >" +text.quantity+"</div>"+
                                "<div >"+text.price+"</div>"+
                            "</li>"
                        "</ol>"
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