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
          <a class="nav-link" aria-current="page" href="pocetnaKorisnik.php" style="color:black;">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rezervacija.php" style="color:black;">Rezervacija</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="mojeRezervacije.php" style="color:black;">
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
        <li class="nav-item">
            <a class="nav-link" href="../logout.php" onclick="return confirm('Da li ste sigurni da želite da se odjavite?')" style="color:black;">Odjavi se</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    
<br><br><br>
<section id="hero-section">
    <div class="container">
        <br>
        <div id="naslov" style="text-align:center;"><h1>Rezervacija autobuskih karata gradskog prevoza</h1></div>
    <br>

<?php
     session_start();
    require_once('../config/config.php');
    require_once('../funkcije.php');
    provera();
    
    $korisnik_id = $_SESSION['id'];
   $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $dbc->set_charset("utf8");
    


    $result = $dbc->query("SELECT DatumRezervacije,DatumIsteka,Trajanje,Zona,Cena FROM rezervacija r join karta k on r.idKarte=k.idKarte WHERE idKorisnika=$korisnik_id;");
    


    

$dbc->close();

?>
<form action="" method="POST" >
<table border="1" cellpadding="8" style="margin-left:30%; ">
    <tr>
        
        <th>Zona</th>
        <th>Trajanje</th>
        <th>Cena</th>
        <th>Datum rezervacije</th>
        <th>Datum isteka rezervacije</th>
    </tr>


    <form method="POST" onsubmit="return proveriIzbor();">
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            
            <td><?= $row['Zona'] ?></td>
            <td><?= htmlspecialchars($row['Trajanje']) ?></td>
            <td><?= $row['Cena'] ?></td>
            <td><?= htmlspecialchars($row['DatumRezervacije']) ?></td>
            <td><?= htmlspecialchars($row['DatumIsteka']) ?></td>
        </tr>
    <?php endwhile; ?>
<?php
   
    $result->free();   // ✔ ovde oslobađaš resurse
    ?>
</table>

 </form>
</div>
</section>
    

    
    
</body>
</html>