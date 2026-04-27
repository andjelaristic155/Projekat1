<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Gradski prevoz</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link href="./css/style.css" rel="stylesheet">
  
</head>
<body>
    <script src="./fontawesome/js/all.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>



<?php
    //Pokretanje sesije
    session_start();
    //Poziv kunfiguracionog fajla i funkcionalnosti
    require_once('config/config.php');
    require_once('funkcije.php');

    //Povezivanje sa bazom
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($dbc, 'utf8');
    if(!$dbc){
        die("Greska pri konekciji: ".mysqli_connect_error());
    }

    mysqli_set_charset($dbc,'utf8');

        if (isset($_POST['posalji'])) {
            //Ispitivanje da li su svi podaci uneti
            if (empty($_POST['ime']) || empty($_POST['prezime']) || empty($_POST['email']) ||
                empty($_POST['pass1']) || empty($_POST['pass2'])) {
                $greska="Niste uneli sve potrebne informacije";
                 
             }
             else{

             //Uzimanje podataka iz POST zahteva i uklanjanje praznih karaktera(razmaka) 
            $im=trim($_POST['ime']);
            $pr=trim($_POST['prezime']);
            $em=trim($_POST['email']);
            $pass1=trim($_POST['pass1']);
            $pass2=trim($_POST['pass2']);

            //Provear validacije email adrese
            if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
                $greska="Vaš email nije validan";
                
            }

            //provera lozinke i potvrde za lozinku
            elseif($pass1!==$pass2){
                $greska="Lozinke se ne slažu";
                
            }

            else{
            //Obrada specijalnih znakova 
            $im=mysqli_real_escape_string($dbc,$im);
            $pr=mysqli_real_escape_string($dbc,$pr);
            $em=mysqli_real_escape_string($dbc,$em);
            $pass1=mysqli_real_escape_string($dbc,$pass1);

            //Priprema select upita za proveru email adrese da li vec postoji
            $q="Select email from Korisnik where email='$em'";
            $rez=mysqli_query($dbc,$q);
            $broj=mysqli_num_rows($rez);
            //Ispis greske ako vec postoji
            if(($broj===1)){
                $greska="Vec postoji korisnik sa tim emailom";
                
            }
            else{
            //Priprema Insert upita za ubacivanje novog korisnika
            $upit="INSERT INTO korisnik(Ime,Prezime,Email,Sifra,Uloga)
                    VALUES('$im','$pr','$em',SHA2('$pass1',512),'Korisnik')";

            $rezultat=mysqli_query($dbc,$upit);
            //Uspesna registracija
            if($rezultat){
                
                $greska="Uspešno ste se registrovali";
                
            }
            //Poruka o neuspeloj registraciji
            else{
                $greska="Sistemska greška! Registracija trenutno nije moguća";
            }
            //Zatvaranje konekcije i oslobadjanje resursa
            mysqli_free_result($rez);
           
            mysqli_close($dbc);
            }
            }
             }
            $em=trim($_POST['email']);
            $pas=trim($_POST['pass1']);
            
            //Priprema select upita nakon registracije za automatsku prijavu korisnika
            $upit="Select idKorisnika,ime,uloga from Korisnik where email=? and sifra=SHA2(?,512)";
            $stmt=mysqli_prepare($dbc,$upit);

            if($stmt){

                mysqli_stmt_bind_param($stmt,"ss", $em, $pas);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)===1){
                    mysqli_stmt_bind_result($stmt,$id,$ime,$uloga);
                    
                    mysqli_stmt_fetch($stmt);
                    echo $id;
                    //Postavljanje sesije
                    $_SESSION['id']=$id;
                    $_SESSION['ime']=$ime;
                    $_SESSION['uloga']=$uloga;
                    //Postavljanje cookies-a ako korisnik cekira checkBox "zapamti"
                    if(isset($_POST['zapamti'])){
                        setcookie("email",$em,time()+60*60,"/");
                    }
                    
                    //priprema podataka za log.txt
                        $date = date("d.m.Y H:i:s");
                    $string="$date     $id    $ime    $uloga\n";
                    //Upis u log.txt
                    CuvanjeLog($string);
                    //Prebacivanje na koriisnicki deo
                    header("Location: korisnik/pocetnaKorisnik.php");
                    
                  
                    

                }
            }
                mysqli_stmt_close($stmt);
        }

?>








    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="karte.html" style="color:black;">Karte</a>
        </li>
       

          


      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="prijava.html" style="color:black;">Prijavi se</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    
<br><br><br>

<section id="hero-section">
    <div class="container">
        <br><br>
        <h1 id="naslov">Registrujte se</h1>
        <br>
        <hr>
        <form action="" method="POST" style="margin-top:30px;margin-bottom:30px;">
        <div>Unesite ime: <input type="text" name="ime" id=""></div><br>
        <div>Unesite prezime: <input type="text" name="prezime" id=""></div><br>
        <div>Unesite email: <input type="email" name="email" id=""></div><br>
        <div>Unesite lozinku: <input type="password" name="pass1" id=""></div><br>
        <div>Potvrdite lozinku: <input type="password" name="pass2" id=""></div><br>

        <input type="submit" value="Registruj se" name="posalji">
            <br>
         <label>
        <?php if(isset($greska)) echo $greska; ?>
        </label><br>
        </form>
        <hr>

        

    </div>



      
</section>
    


    
    
</body>
</html>