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
   
    require_once('funkcije.php');
    require_once('config/config.php');
    session_start();
    pocetnaProvera();

?>





    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php" style="color:black;">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="karte.html" style="color:black;">Karte</a>
        </li>
        

          


      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="prijava.php" style="color:black;">Prijavi se</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    
<br><br><br>

<section id="hero-section">
    <div class="container">
        <br><br>
        <h1 id="naslov">Prijavite se</h1>
        <br>
        <hr>
        <form id="loginForma" style="font-size:large; margin-top:30px; margin-bottom:30px;">

        <div>Unesite email:
            <input type="email" name="email" id="email">
        </div>
        <div id="emailErr"></div>
    <br>
        <div>Unesite lozinku:
            <input type="password" name="pass" id="pass">
        </div>
        <div id="passErr"></div>
<br>
        <input type="checkbox" name="zapamti" id="zapamti"> Zapamti
<br><br>
        <input type="button" value="Prijavi se" id="posalji">



        </form>
        <div id="poruka" name="poruka"></div>
        <hr>

        <div>Niste prijavljeni? <a href="registracija.php">Registruj se</a></div>

    </div>
 


</section>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="ajax/ajax.js"></script>
      
    
</body>
</html>