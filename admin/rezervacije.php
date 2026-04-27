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
          <a class="nav-link" href="rezervacije.php">Karte</a>
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
        
            

    <div>

    <div id="naslov"><h1>Rezervacije</h1></div>
        <form action="" method="POST" onsubmit="return proveriIzbor();">
            
<table style="margin-left:10%; margin-top:50px;">
    <tr>
        <th>Izaberi</th>
        <th>Id rezervacije</th>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Email</th>
        <th>Zona</th>
        <th>Trajanje</th>
        <th>Cena</th>
        <th>Datum rezervacije</th>
        <th>Datum isteka</th>
    </tr>

    <?php
    session_start();
    require_once('../config/config.php');
    require_once('../funkcije.php');
    provera();

    $greska="";
    $dbc= new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $dbc->set_charset("utf8");

    //Priprema upita za prikaz informacija o rezervaciji
    $rezultat = $dbc->query("SELECT k.idKorisnika, ka.idKarte, idRezervacije, ime, prezime, email, Zona, Trajanje, Cena, DatumRezervacije, DatumIsteka 
                            FROM rezervacija r 
                            JOIN korisnik k ON r.idKorisnika=k.idKorisnika 
                            JOIN karta ka ON r.idKarte=ka.idKarte;");

    // Brisanje
    if(isset($_POST['obrisi']) && !empty($_POST['izabrani'])) {
        $stmt = $dbc->prepare("DELETE FROM rezervacija WHERE idRezervacije = ?");
        foreach($_POST['izabrani'] as $idRezervacije) {
            $stmt->bind_param("i", $idRezervacije);
            $stmt->execute();
        }
        $stmt->close();
    }

  $greska="";
    // Izmena
    if(isset($_POST['izmeni']) && !empty($_POST['izabrani']) && $_POST['zona'] != "") {
         
           $idKarte = (int)$_POST['zona']; 
           $stmt = $dbc->prepare("UPDATE rezervacija SET idKarte = ? WHERE idRezervacije = ?;");
        foreach($_POST['izabrani'] as $idRezervacije) {
            $stmt->bind_param("ii", $idKarte,$idRezervacije);
            $stmt->execute();
            if (mysqli_stmt_execute($stmt)) {
            
                if (mysqli_stmt_affected_rows($stmt) != 0) {
                     $greska="Podaci nisu izmenjeni";
            } else {
                $greska="Podaci su uspesno izmenjeni";
                }
                
        } 
        else {
            $greska="Greška prilikom izvršenja upita ";
        }
        }
        $stmt->close();

} 
    
?>



    <?php while($row=$rezultat->fetch_assoc()):?>
        <tr>
            <td><input type="checkbox" name="izabrani[]" id="" value="<?= $row['idRezervacije']?>"></td>
            <td><?= $row['idRezervacije'] ?></td>
            <td><?= htmlspecialchars($row['ime'])?></td>
            <td><?= htmlspecialchars($row['prezime'])?></td>
            <td><?= htmlspecialchars($row['email'])?></td>
            <td><?= htmlspecialchars($row['Zona'])?></td>
            <td><?= htmlspecialchars($row['Trajanje'])?></td>
            <td><?= $row['Cena']?></td>
            <td><?= htmlspecialchars($row['DatumRezervacije'])?></td>
            <td><?= htmlspecialchars($row['DatumIsteka'])?></td>
        </tr>
    <?php endwhile;?>
    <?php
   
    $rezultat->free(); 
    mysqli_close($dbc);  
    ?>



        <table>
            <br><br>
            <label for="zona" style="margin:0px 20px;"><h5>Izaberite zonu:</h5></label>
<select id="zona" name="zona">
    <option value="">-- Izaberite zonu --</option>
    <?php
    $dbc= new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $dbc->set_charset("utf8");
    $rez = mysqli_query($dbc, "SELECT idKarte, Zona, Trajanje FROM Karta ORDER BY Zona ASC");
    while ($row = mysqli_fetch_assoc($rez)) {
        echo '<option value="'.$row['idKarte'].'">'.$row['Zona'].' - '.$row['Trajanje'].'</option>';
    }
    mysqli_close($dbc); 
    ?>
</select>
           
           
<br>
            <input type="submit" value="Obrisi" name="obrisi" style="margin:0px 20px;">
            <input type="submit" value="Izmeni" name="izmeni">
        </form>
        
    </div><br><br>
 <label>
        <?php if(isset($greska)) echo $greska; ?>
        </label><br>
    

</div>
</div>
</section>
    

    
    
</body>
</html>