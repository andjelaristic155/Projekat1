<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Gradski prevoz</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link href="../css/style.css" rel="stylesheet">
  
</head>
<body>
    <script src="../fontawesome/js/all.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="pocetnaKorisnik.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rezervacija.php" style="color:black;">Rezervacija</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mojeRezervacije.php" style="color:black;">
            Moje rezervacije
          </a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../karte.html" style="color:black;">
            Karte
          </a>
          
        </li>
</ul>

           
      <ul class="navbar-nav">
        <li class="nav-item" >
            <a class="nav-link" href="../logout.php" onclick="return confirm('Da li ste sigurni da želite da se odjavite?')" style="color:black;">Odjavi se</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    
<br><br><br>


    
<?php
     require_once('../funkcije.php');
    require_once('../config/config.php');
    session_start();
    provera();
    $korisnik_id = $_SESSION['id'];
    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $dbc->set_charset("utf8");

    $stmt=$dbc->prepare("select CONCAT(ime, ' ', prezime) AS PunoIme,Uloga,email from korisnik where idKorisnika=?");
    $stmt->bind_param("i", $korisnik_id);
    $stmt->execute();
    
    $stmt->bind_result($prikaz,$uloga,$email);
    $stmt->fetch();
    $stmt->close();
    $greska="";

?>
    

    
<section id="hero-section">
    <div class="container" style="text-align:center;">
        <br>
        <div id="naslov"><h1>Pocetna Korisnik</h1></div>
        <div id="prikaziPoruku"></div>
        <br>
        <form >
        <div style="text-align:left; margin-left:35%;">
            <h3>Ime i prezime: <label for="" class="podaci"><?php if(isset($prikaz)) echo $prikaz; ?></label></h3>
            <h3>Uloga: <label for="" class="podaci"><?php if(isset($uloga)) echo $uloga; ?></label></h3>
            <h3>Email: <label for="" class="podaci"><?php if(isset($email)) echo $email; ?></label></h3>
        </div>
        <br>
        
            <p class="d-inline-flex gap-1">
  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Promeni lozinku:
  </a>
  
</p>
<div class="collapse" id="collapseExample" >
  <div class="card card-body" id="forma">
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


<div>
    <p class="d-inline-flex gap-1">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapsePodaci" role="button" aria-expanded="false" aria-controls="collapsePodaci">
            Promeni podatke
        </a>
    </p>

    <div class="collapse" id="collapsePodaci">
        <div class="card card-body" id="forma1">

            <h4>Unesite ime: <input type="text" name="ime" id="ime"></h4>
            <div id="imeError" class="text-danger"></div>

            <h4>Unesite prezime: <input type="text" name="prezime" id="prezime"></h4>
            <div id="prezimeError" class="text-danger"></div>

            <h4>Unesite email adresu: <input type="email" name="email1" id="email1"></h4>
            <div id="email1Error" class="text-danger"></div>

            <input type="button" value="Promenite podatke" onClick="izmeniPodatke()">
        </div>
    </div>
</div>



    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../ajax/ajax.js"></script>
    <script src="../ajax/ajax2.js"></script>
</form>

</div>
</section>
    

    
    
</body>
</html>