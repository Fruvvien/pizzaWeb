
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
                    
                    "<button id='cardButton' onclick='orderFunction("+datas.pazon+","+datas.pnev+","+datas.par+")' >"+datas.par+"FT"+"</button>"+
                "</div>"
            });
            document.getElementById("pizza").innerHTML=pizzak;
        },
        error: function(xhr, error, errorMessage){

        }

    })

}

function orderFunction(pizzaId, pizzaName, pizzaAr){
    let pizzaDatas={
        pizzaId: pizzaId,
        pizzaName: pizzaName,
        pizzaAr: pizzaAr

    }
    console.log(pizzaDatas);
        $.ajax({
            url:"Action.php",
            type:"POST",
            data:{action: "order", pizzaKey: pizzaDatas},

            success: function(response){
                
               /*  let result = JSON.parse(response);
                if(result["success"]){
                    alert("Sikeres kosárba helyezés");
                }else{
                    alert("Nem sikerült kosárba helyezni");
                    console.log(result["errorMessage"]);
                } */
                
            },
            error: function(xhr, error, errorMessage){

            },
        })


}