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

<section id="hero-section">
    <div class="container">
        <div id="naslov"><h1>Prikazivanje svih logovanja</h1></div>
            <br>

    <div>

    
    <form action="" method="POST" onsubmit="return proveriIzbor();">
            <?php
                $filename = '../log/log.txt';

        // Čitanje svih linija u niz
                $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Prva linija je header
                $header = array_shift($lines);

        // Ispis u HTML tabelu
                echo "<table border='1' cellpadding='5' style='margin-left:35%;'>";
                echo "<tr><th>Datum i vreme</th><th>ID</th><th>Ime</th><th>Uloga</th></tr>";

        foreach($lines as $line) {
            // Razdvajanje po whitespace (jedan ili više razmaka)
            $parts = preg_split('/\s+/', $line);

            // $parts[0] = datum, $parts[1] = vreme, $parts[2] = ID, $parts[3] = Ime, $parts[4] = Uloga
            // Spajamo datum i vreme
            $datum = $parts[0] . ' ' . $parts[1];
            $id = $parts[2];
            $ime = $parts[3];
            $uloga = $parts[4];

            echo "<tr>";
            echo "<td>$datum</td>";
            echo "<td>$id</td>";
            echo "<td>$ime</td>";
            echo "<td>$uloga</td>";
            echo "</tr>";
}

echo "</table>";
?>

        </form>
        
    </div>

    

</div>
</div>
</section>


</body>
</html>
