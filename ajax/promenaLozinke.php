<?php
    session_start();
    $poruka="";
    $greska="";
    $korisnik_id = $_SESSION['id'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass2'];

    require_once('../funkcije.php');
    require_once('../config/config.php');
    
    
    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $dbc->set_charset("utf8");
    if($pass1!==$pass2){
            $greska="Nova lozinka i potvrda za novu lozinku nisu iste";
        }
    else{
        $korisnik_id = $_SESSION['id'];
        
    $stmt=mysqli_prepare($dbc,"SELECT idKorisnika FROM korisnik WHERE idKorisnika=? AND sifra=SHA2(?,512)");
             mysqli_stmt_bind_param($stmt,"is",$korisnik_id,$pass);
             mysqli_stmt_execute($stmt);
             mysqli_stmt_store_result($stmt);

             if(mysqli_stmt_num_rows($stmt)==1){

                 //promena lozinke
                $stmt=mysqli_prepare($dbc,"UPDATE korisnik SET sifra=SHA2(?,512) WHERE idKorisnika=?");
                mysqli_stmt_bind_param($stmt,"si",$pass1,$korisnik_id);
                 mysqli_stmt_execute($stmt);

                $poruka="Lozinka uspešno promenjena";
            }
             else{
                 $greska="Stara lozinka nije tačna";
             }
    }

?>

<script>
    <?php if(!empty($poruka)) {?>
    
        $("#prikaziPoruku").html("<div><?=$poruka?></div>");
        <?php
        }
        if(!empty($greska)){?>
            $("#prikaziPoruku").html("<div><?=$greska?></div>");
        <?php
        }
        ?>
</script>


<script src="../fontawesome/js/all.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
<div class="collapse" id="collapseExample" id="forma">
  <div class="card card-body">
    <h4>Unesite email: <input type="email" name="email" id="email"></h4>
    <div id="emailError"></div>
    <h4>Unesite staru lozinku: <input type="password" name="pass" id="pass"></h4>
    <div id="passError"></div>
    <h4>Unesite novu lozinku: <input type="password" name="pass1" id="pass1"></h4>
    <div id="pass1Error"></div>
    <h4>Potvrdite novu lozinku: <input type="password" name="pass2" id="pass2"></h4>
    <div id="pass2Error"></div>
    <input type="button" value="Promenite lozinku"  id="izmeni" onClick="Izmeni()">
    
</div>
        </div>