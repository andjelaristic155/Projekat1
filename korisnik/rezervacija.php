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
          <a class="nav-link " aria-current="page" href="pocetnaKorisnik.php" style="color:black;">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="rezervacija.php" style="color:black;">Rezervacija</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mojeRezervacije.php" style="color:black;">
            Moje rezervacije
          </a>
          
        </li>
         <li class="nav-item">
          <a class="nav-link" href="../karte.html" style="color:black;" >
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
    <div class="container" style="text-align:center;">
        <br>
        <div id="naslov"><h1>Rezervacija autobuskih karata gradskog prevoza</h1></div>
    <br>
        
    
    <?php 
    //Pokretanje sesije, ucitavanje konfiguracionog fajla i funkcije
    session_start();
    require_once('../config/config.php');
    require_once('../funkcije.php');
    //funkcija za proveru da li je korisnik prijavljen i da li ima pravo pristupa na toj stranici
    provera();
    $greska="";
    //Izvlacenje ID korisnika preko sesije
    $korisnik_id = $_SESSION['id'];
    //POvezivanje sa bazom
   $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $dbc->set_charset("utf8");
    
//Priprema upita za prikaz svih aktivnih karata
    $result = $dbc->query("SELECT * FROM karta where status='aktivan'");


     if(isset($_POST['sacuvaj'])) {

    $izabrani = $_POST['izabrani'];   // Preuzimanje niza izabranih karata iz forme
// Prolazak kroz sve izabrane karte
    foreach($izabrani as $id) {
        // Pripremljeni SQL upit za preuzimanje trajanja karte
        $stmt = $dbc->prepare("SELECT Trajanje FROM karta WHERE idKarte = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($trajanje);
        $stmt->fetch();
        $stmt->close();
        
        $datum=date("Y-m-d");
        $datumIsteka;
        // Određivanje datuma isteka karte na osnovu trajanja
        switch($trajanje){
            case "Dnevna":
                $datumIsteka = date("Y-m-d", strtotime("+1 day"));
                break;
            
            case "Mesecna":
                $datumIsteka = date("Y-m-d", strtotime("+1 month"));
                break;
            
            default: $datumIsteka=null;
        }
         // Pripremljeni SQL upit za unos rezervacije u bazu
          $stmt = $dbc->prepare("INSERT INTO rezervacija (idKorisnika, idKarte,DatumRezervacije,DatumIsteka) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("iiss", $korisnik_id, $id,$datum,$datumIsteka);
         $stmt->execute();
          if (mysqli_stmt_execute($stmt)) {
    
            if (mysqli_stmt_affected_rows($stmt) == 1) {
                header("Location: rezervacija.php"); 
                    $greska="Rezervacija je uspesna";
            } 
            else {
                header("Location: rezervacija.php"); 
                    $greska="Rezervacija nije uspesna";
             }
          $stmt->close();
            
      
    }
        
        
     mysqli_close($dbc);
        } 
        
    }



   

?>

<script>
function proveriIzbor() {
    let cekirani = document.querySelectorAll('input[name="izabrani[]"]:checked');

    if (cekirani.length === 0) {
        alert("Morate izabrati bar jednu kartu.");
        return false;
    }

    return confirm("Da li ste sigurni da želite da rezervišete izabrane karte?");
}
</script>


  <table border="1" cellpadding="8" style="margin-left:35%;">
    <tr>
        <th>Izaberi</th>
        <th>ID</th>
        <th>Trajanje</th>
        <th>Naziv</th>
        <th>Cena</th>
    </tr>
<form action="" method="POST" onsubmit="return proveriIzbor();">
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td>
                <input type="checkbox" name="izabrani[]" value="<?= $row['idKarte'] ?>">
            </td>
            <td><?= $row['idKarte'] ?></td>
            <td><?= htmlspecialchars($row['Trajanje']) ?></td>
            <td><?= htmlspecialchars($row['Zona']) ?></td>
            <td><?= $row['Cena'] ?></td>
        </tr>
    <?php endwhile; ?>
   
    <?php
   
    $result->free();   // ✔ ovde oslobađaš resurse
    ?>

</table>
<br><br>
<button type="submit" name="sacuvaj" >Rezervisi</button>
 <br>
         <label>
        <?php if(isset($greska)) echo $greska; ?>
        </label><br>
 </form>
    
</div>
</section>
    

    
    
</body>
</html>