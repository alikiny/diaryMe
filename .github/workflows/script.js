function modifyInfo(){
    var newName=$('#new-name').val();
    var newEmail=$('#new-email').val();
    var newPassword=$('#new-password').val();
    var newAge=$('#new-age').val();
    var newCountry=$('#new-country').val();
    var newCity=$('#new-city').val();
    var proceed="change-info";



    $.ajax({
        url: 'functions.php',
        method: 'post',
        data:{
            newName,
            newEmail,
            newPassword,
            newAge,
            newCity,
            newCountry,
            proceed
        },
        dataType: 'json',
        success: function(response){
            document.getElementById('updated-data').innerHTML=response[0];
            console.log(response);
            if(response[1]!==""){
                document.getElementById('user-name').innerHTML=response[1];
            }
            if(response[2]!==""){
                document.getElementById('user-email').innerHTML=response[2];
            }
            
            if(response[4]!==""){
                document.getElementById('user-age').innerHTML=response[4];
            }
            if(response[5]!==""){
                document.getElementById('user-country').innerHTML=response[5];
            }
            if(response[6]!==""){
                document.getElementById('user-city').innerHTML=response[6];
            }
           
        },
        error: function(jqXHR, error, errorThrown) {
            if (jqXHR.status && jqXHR.status == 400) {
                alert(jqXHR.responseText);
            } else {
                alert(error+': You havent input any data yet');
            }
        }
    });
}