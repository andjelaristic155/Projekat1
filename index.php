<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Gradski prevoz</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  
</head>
<body>
    <script src="./fontawesome/js/all.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
<?php
  require_once('funkcije.php');
  session_start();
  pocetnaProvera();
    
?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="karte.html" >Karte</a>
        </li>
        

           


      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="prijava.php" >Prijavi se</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    
<br><br><br>

<section id="hero-section">
    <div class="container hero-container" >
      <br><br>
        <div id="naslov" style="text-align:center; "><h1>Rezervacija autobuskih karata gradskog prevoza</h1></div>
    
<br><br>
    <div>
        <img src="slike/slika1.jpg" alt="" style="width:100%; height:500px;">
    </div>
<br><br>
    <div style="text-align:center; "><h2>Dobrodošli u sistem za online kupovinu karata gradskog prevoza</h2></div>
<br><br>
    <div id="text" style="font-size: large; margin-bottom: 100px;"><p>Dobrodošli na platformu koja vam omogućava brzu i jednostavnu kupovinu karata za gradski prevoz. Bez čekanja u redovima i bez potrebe za odlaskom na prodajna mesta – sve što vam je potrebno dostupno je na samo nekoliko klikova.

        Naša aplikacija omogućava kupovinu dnevnih i mesečnih karata za različite zone, uz pregled vaših rezervacija i potpunu kontrolu nad kupljenim kartama. Bilo da putujete svakodnevno ili povremeno, ovde možete pronaći kartu koja odgovara vašim potrebama.

        <br>Registrujte se ili se prijavite i obezbedite svoju kartu brzo, sigurno i jednostavno.</p></div>


</div>
</section>
    

    
    
</body>
</html>