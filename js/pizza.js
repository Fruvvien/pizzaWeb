
$(document).ready(function(){
    pizzaPage();

});

function pizzaPage(){


    $.ajax({
        url:"Action.php",
        type:"POST",
        data:{action: "pizzaAction"},


        success: function(response){
            let arrayParse= JSON.parse(response);
            let pizzak="";
            arrayParse.forEach(datas => {
                pizzak+=
                "<div class='card text-white mb-2 '>"+                    
                    "<div class='card-body'>" +
                        "<div> <h4>"+datas.pnev+"</h4></div>"+
                        "<img id='pizzaImg' src='./"+datas.url+datas.filename+"."+datas.filetype+"'>"+
                    "</div>"+
                    
                    "<button id='cardButton' onclick='orderFunction("+datas.pazon+","+datas.par+")' >"+datas.par+"FT"+"</button>"+
                "</div>"
            });
            document.getElementById("pizza").innerHTML=pizzak;
        },
        error: function(xhr, error, errorMessage){

        }

    })

}

function orderFunction(pizzaId, pizzaAr){
    let pizzaDatas={
        pizzaId: pizzaId,

        pizzaAr: pizzaAr

    }
    
    
        $.ajax({
            url:"Action.php",
            type:"POST",
            data:{action: "order", pizzaKey: pizzaDatas},

            success: function(response){
                console.log(response);
                
                let result = JSON.parse(response);
                if(result){
                    alert("Sikeres kosárba helyezés");
                    
                }else{
                    alert("Nem sikerült kosárba helyezni");
                }

            },
            error: function(xhr, error, errorMessage){

            },
        })
        
        $.ajax({
            url:"Action.php",
            type:"POST",
            data:{action: "count"},
        
            success: function(response){
           
                document.getElementById("counting").innerHTML=response;
               
        
            },
            error: function(xhr, error, errorMessage){
        
            },
        })


}


