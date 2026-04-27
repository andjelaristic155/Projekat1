function Izmeni(){
    var email=$("#email").val();
    var pass=$("#pass").val();
    var pass1=$("#pass1").val();
    var pass2=$("#pass2").val();

    if(!validacija(email,pass,pass1,pass2)){
        return false;
    }

    $.ajax({
        url:"../ajax/promenaLozinke.php",
        method:"post",
        data:{email:email,pass:pass,pass1:pass1,pass2:pass2},
        dataType:"text",
        success:function(response){
            $("#forma").html(response);
        }
    });
}

function validacija(email,pass,pass1,pass2){
    var x=true;
    $("#emailError").html("");
    $("#passError").html("");
    $("#pass1Error").html("");
    $("#pass2Error").html("");
    if(email==""){
        $("#emailError").html("Unesite email adresu");
        x=false;
    }

    if(pass==""){
        $("#passError").html("Unesite lozinku");
        x=false;
    }
    if(pass1==""){
        $("#pass1Error").html("Unesite novu lozinku");
        x=false;
    }
    if(pass2==""){
        $("#pass2Error").html("Unesite da potvrdite novu lozinku");
        x=false;
    }
    return x;
}






$("#posalji").click(function(){

    var email=$("#email").val();
    var pass=$("#pass").val();

    if(!valid(email,pass)){
        return;
    }

    $.ajax({
    url:"ajax/prijava.php",
    method:"POST",
    data:{
        email:email,
        pass:pass
    },
    dataType:"text",

    success:function(response){
          response = JSON.parse(response);
        if(response.status=="ok"){

            if(response.uloga=="Admin"){
                window.location.href="admin/pocetnaAdmin.php";
            }
            else{
                window.location.href="korisnik/pocetnaKorisnik.php";
            }

        }
         else{
              $("#poruka").html(
             "<div style='color:red'>" + response.poruka + "</div>"
         );
        }

    }

    });

});


function valid(email,pass){

    var x=true;

    $("#emailErr").html("");
    $("#passErr").html("");

    if(email==""){
        $("#emailErr").html("Niste uneli email adresu");
        x=false;
    }

    if(pass==""){
        $("#passErr").html("Niste uneli lozinku");
        x=false;
    }

    return x;
}



