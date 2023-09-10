$(document).ready(function(){
    courierList();
});

function courierList(){

    $.ajax({

        url:"Action.php",
        type:"POST",
        data:{action: "courierlist"},

        success: function(response){
            let parseData= JSON.parse(response);
            let courierText="";

            parseData.forEach(text => {
                courierText+=
                "<div id='courierList'>"+    
                "<div id='courierName'><h4 >"+text.fnev+"</h4></div>"+
                "<div><h5>Telefon szám: "+text.ftel+"</h5></div>"+
                "</div>" 
                
            });
            document.getElementById("courier").innerHTML=courierText;
        },
        error: function(xhr, status, error){
            
        },


    })
}