<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Dobrodosao Admin</h1>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Gradski prevoz</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="../stylesheet" href="../fontawesome/css/all.min.css">
    <link href="../css/style.css" rel="stylesheet">
  
</head>
<body>
    <script src="../fontawesome/js/all.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="pocetnaAdmin.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rezervacije.php">Rezervacije</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="uredjivanje.php" >
            Uređivanje
          </a>  
        </li>

         <li class="nav-item">
          <a class="nav-link" href="statistika.php" >
            Statistika
          </a>  
        </li>
          
    <li class="nav-item">
          <a class="nav-link" href="logoviPrikaz.php" >
            Prikaz svih prijavljivanja
          </a>  
        </li>

      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../logout.php" onclick="return confirm('Da li ste sigurni da želite da se odjavite?')">Odjavi se</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    
<br><br><br>
<?php
     session_start();
    require_once('../config/config.php');
    require_once('../funkcije.php');
    provera();
    $brkarata="";
    $brKorisnika="";
    
    

    $dbc=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $dbc->set_charset('utf8');
    $rezultat = $dbc->query("SELECT Zona, sum(cena) as suma, COUNT(idKorisnika) as UkupnoKorisnika FROM `karta` JOIN rezervacija r on karta.idKarte=r.idKarte where status='aktivan' GROUP BY Zona;");
    
    $stmt=$dbc->prepare("select count(idKorisnika) as brKorisnika from korisnik where uloga='Korisnik'");
    $stmt->execute();
    $stmt->bind_result($brKorisnika);
    $stmt->fetch();
    $stmt->close();

    $stmt=$dbc->prepare("SELECT count(idKarte) FROM `rezervacija`;");
    $stmt->execute();
    $stmt->bind_result($brkarata);
    $stmt->fetch();
    $stmt->close();
    

  

    

$dbc->close();
?>
<section id="hero-section">
    <div class="container2" style="margin-left:30%;">
        <div id="naslov" style="margin-left:10%;"><h1>Statistika</h1></div>
        <br>
        <form action="" method="POST">
            <div>
                <h4>Ukupan broj korisnika: <label for="" name="brKorisnika"><?php if(isset($brKorisnika)) echo $brKorisnika; ?></label></h4><br>
                <h4>Ukupan broj rezervisanih karata: <label for="" name="brKarata"><?php if(isset($brkarata)) echo $brkarata; ?></label></h4><br>
                <h4>Ukupan broj rezervisanih karata po zoni <label for=""></label></h4><br>
                 <?php while($row=$rezultat->fetch_assoc()):?>
                    <table style="font-size:large; margin-bottom:20px; border:1px solid black;">
                <tr>
                <td style="border:1px solid black; font-weight:bold;">Zona</td>
                <td style="border:1px solid black; font-weight:bold;">Ukupna cena</td>
                <td style="border:1px solid black; font-weight:bold;">Broj korisnika</td>
                </tr>
                <tr>
                <td style="border:1px solid black;"><?=$row['Zona']?></td>
                <td style="border:1px solid black;"><?=$row['suma']?></td>
                <td style="border:1px solid black;"><?=$row['UkupnoKorisnika']?></td>
                </tr>
            </table>
            
            <?php endwhile;
                $rezultat->free(); 
            ?> 



<?php
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $dbc->set_charset("utf8");
$rezultat = $dbc->query("SELECT Trajanje, sum(cena) as UkupnaCena,count(idKorisnika) brKorisnika FROM karta k join rezervacija r on k.idKarte=r.idRezervacije GROUP BY Trajanje;");


    

$dbc->close();

?>
            <h4>Ukupan broj rezervisanih karata po terminu:</h4><br>
            <?php while($row=$rezultat->fetch_assoc()):?>
                    <table style="font-size:large; margin-bottom:20px; border:1px solid black;">
                        <tr style="font-size:large; margin-bottom:20px; border:1px solid black;">
                <td style="border:1px solid black; font-weight:bold;">Trajanje</td>
                <td style="border:1px solid black; font-weight:bold;">Ukupna cena</td>
                <td style="border:1px solid black; font-weight:bold;">Broj korisnika</td>
                </tr>
                <tr>
                <td style="border:1px solid black;"><?=$row['Trajanje']?></td>
                <td style="border:1px solid black;"><?=$row['UkupnaCena']?></td>
                <td style="border:1px solid black;"><?=$row['brKorisnika']?></td>
                </tr>
            </table>
            
            <?php endwhile;
                $rezultat->free(); 
            ?> 
            </div>
        </form>

    <div>
        
    </div>

    

</div>
</div>
</section>
    

    
    
</body>
</html>