function izmeniPodatke(){
    var ime=$("#ime").val();
    var prezime=$("#prezime").val();
    var email1=$("#email1").val();
     if(!validacija2(ime,prezime,email1)){
        return false;
    }

    $.ajax({
        url:"../ajax/promenaPodatka.php",
        method:"post",
        data:{ime:ime,prezime:prezime,email1:email1},
        dataType:"text",
        success:function(response){
            $("#forma1").html(response);
        }
    });
}

function validacija2(ime,prezime,email1){
     var x=true;
    $("#email1Error").html("");
    $("#imeError").html("");
    $("#prezimeError").html("");
    
    if(ime==""){
        $("#imeError").html("Unesite ime");
        x=false;
    }
    if(prezime==""){
        $("#prezimeError").html("Unesite prezime");
        x=false;
    }

    if(email1==""){
        $("#email1Error").html("Unesite email adresu");
        x=false;
    }
    return x;
}