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
        <div id="naslov"><h1>Uredjivanje</h1></div>
        <form action="" method="POST">
        <table style="margin-left:10%;">
             <tr>
                    <th><label for="">Izaberi</label></th>
                    <th><label for="">Id rezervacije</label></th>
                    <th><label for="">Trajanje</label></th>
                    <th><label for="">Zona</label></th>
                    <th><label for="">Cena</label></th>
                    <th><label for="">Status</label></th>
            </tr>
            <?php
                session_start();
                require_once("../config/config.php");
                require_once("../funkcije.php");
                provera();
                $dbc=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                $dbc->set_charset('utf8');
                $rezultat=$dbc->query("Select * from karta");
                if(!empty($_POST['izabrani']) && isset($_POST['izmeni'])){
                
                // Prolazimo kroz sve izabrane karte koje je korisnik označio checkbox-om
                    foreach($_POST['izabrani'] as $idKarte){
                        //Priprema upita za izmenu 
                            $stmt=$dbc->prepare("UPDATE karta SET Trajanje=?, Zona=?, Cena = ? WHERE idKarte = ?; ");
                            $trajanje=($_POST['Trajanje']);
                            $zona=$_POST['Zona'];
                            $cena=(float)$_POST['Cena'];
                            $stmt->bind_param('ssdi',$trajanje,$zona,$cena,$idKarte);
                            $stmt->execute();
                            $stmt->close();
                    }
                    
                }
                elseif(!empty($_POST['izabrani']) && isset($_POST['obrisi'])){
                    // Prolazimo kroz sve izabrane karte koje je korisnik označio checkbox-om
                    foreach($_POST['izabrani'] as $idKarte){
                        //Priprema upita za deaktiviranje
                            $stmt=$dbc->prepare("UPDATE karta SET status='neaktivan' WHERE idKarte = ?; ");
                            
                            $stmt->bind_param('i',$idKarte);
                            $stmt->execute();
                            $stmt->close();
                    }
                }

                elseif(isset($_POST['dodaj'])){
                        //Uzimanje unetih podataka
                            $trajanje=($_POST['Trajanje']);
                            $zona=$_POST['Zona'];
                            $cena=(float)$_POST['Cena'];
                            $status=$_POST['Status'];
                        //Priprema upita za unosenje novih podataka
                            $stmt=$dbc->prepare("INSERT INTO karta(Trajanje,Zona,Cena,status) VALUES(?,?,?,?)");
                            $stmt->bind_param('ssds',$trajanje,$zona,$cena,$status);
                           
                            $stmt->execute();
                            $stmt->close();
                }
               


            ?>

     


            <?php while($row=$rezultat->fetch_assoc()):?>
            <tr onclick="popuniFormu(this)">
                <td><input type="checkbox" name="izabrani[]" id="" value="<?=$row['idKarte']?>"></td>
                <td><?=$row['idKarte']?></td>
                <td><?=htmlspecialchars($row['Trajanje']) ?></td>
                <td><?=htmlspecialchars($row['Zona']) ?></td>
                <td><?=$row['Cena']?></td>
                <td><?=htmlspecialchars($row['status']) ?></td>
                
            </tr>
            <?php endwhile;?> 
            <?php
   
    $rezultat->free(); 
    mysqli_close($dbc);  // ✔ ovde oslobađaš resurse
    ?>

            <tr>
                    <th><label for="">Trajanje</label></th>
                    <th><label for="">Zona</label></th>
                    <th><label for="">Cena</label></th>
                    <th><label for="">Status</label></th>
            </tr>
            <tr>
                <th><input type="text" id="trajanje" name="Trajanje" ></th>
                <th><input type="text" id="zona" name="Zona"></th>
                <th><input type="number" id="cena" name="Cena"></th>
                <th><input type="text" id="status" name="Status"></th>
            </tr>
       
            
        </table>
    <br><br>
            <input type="submit" value="Izmeni" name="izmeni" onclick="return proveriIzbor();" style="margin:0px 20px;">
            <input type="submit" value="Obrisi" name="obrisi" onclick="return proveriIzbor();" style="margin:0px 20px;">
            <input type="submit" value="Dodaj" name="dodaj" style="margin:0px 20px;">
        </form>

    <div>
        
    </div>

    

</div>
</div>
</section>
    

    
    
</body>
</html>
