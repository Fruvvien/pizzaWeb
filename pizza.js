
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
                "<div class='card text-white bg-secondary mb-2 '>"+
                "<div style='text-align: center' >"+datas.pnev+"</div>"+
                "<div style='text-align: center' class='card-body'  >" +
                "<img style='background-color: white' id='pizzaImg' src='./"+datas.url+datas.filename+"."+datas.filetype+"'>"+
                "</div>"+
                "<div style='text-align: center' >"+datas.par+"</div>"+
                "</div>"
            });
            document.getElementById("pizza").innerHTML=pizzak;
        },
        error: function(xhr, error, errorMessage){

        }

    })

}