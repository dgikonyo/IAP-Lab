$(document).ready(function(){
    $('#btn-place-order').click(function(event){
        event.preventDefault();//if called, the default action of event will not be triggered

        //recieve all variable
        var name_of_food=$('#name_of_food').val();
        var number_of_units=$('#number_of_units').val();
        var unit_price=$('#unit_price').val();
        var order_status=$('#status').val();

        //remember you will communicate with the api if you have the api
        //you go to the API system and generate your API key
        //we now build a http post request and we send it using ajax

        $.ajax({
            url:"http://localhost/btc3205/lab/api/v1/orders/index.php",
            type:"post",
            data: {name_of_food:name_of_food,number_of_units:number_of_units,unit_price:unit_price,order_status:order_status},
            headers:{
                'Authorization':'Basic --replace with API key--'
            },
            success:function (data){
                alert(data['message']);
            },
            error:function(){
                alert('An error occurred');
            }

        });
    });
});