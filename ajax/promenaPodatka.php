<?php
    session_start();
    $poruka="";
    $greska="";
    $korisnik_id = $_SESSION['id'];
    $email=$_POST['email1'];
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
 

    require_once('../funkcije.php');
    require_once('../config/config.php');
    
    
    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $dbc->set_charset("utf8");
    
        $korisnik_id = $_SESSION['id'];
        
        $stmt=mysqli_prepare($dbc,"UPDATE korisnik SET ime = ?, prezime=?, email=? WHERE `korisnik`.`idKorisnika` = ?;");
        mysqli_stmt_bind_param($stmt,"sssi",$ime,$prezime,$email,$korisnik_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_execute($stmt)) {
    // Provera koliko redova je promenjeno
    if (mysqli_stmt_affected_rows($stmt) == 0) {
        $poruka="Podaci su uspešno izmenjeni!";
    } else {
        $greska="Podaci nisu izmenjeni";
    }
} else {
    $greska="Greška prilikom izvršenja upita ";
}
        
     $stmt=$dbc->prepare("select CONCAT(ime, ' ', prezime) AS PunoIme,Uloga,email from korisnik where idKorisnika=?");
    $stmt->bind_param("i", $korisnik_id);
    $stmt->execute();
    
    $stmt->bind_result($prikaz,$uloga,$email);
    $stmt->fetch();
    $stmt->close();
    

?>

<script>
    <?php if(!empty($poruka)) {?>
    
        $("#prikaziPoruku").html("<div><?=$poruka?></div>");
        <?php
        }
        if(!empty($greska)){?>
            $("#prikaziPoruku").html("<div><?=$greska?></div>");
        <?php
        }
        ?>
</script>






    

   
        <div class="card card-body" id="forma1">

            <h4>Unesite ime: <input type="text" name="ime" id="ime"></h4>
            <div id="imeError" class="text-danger"></div>

            <h4>Unesite prezime: <input type="text" name="prezime" id="prezime"></h4>
            <div id="prezimeError" class="text-danger"></div>

            <h4>Unesite email adresu: <input type="email" name="email1" id="email1"></h4>
            <div id="email1Error" class="text-danger"></div>

            <input type="button" value="Promenite podatke" onClick="izmeniPodatke()">
        </div>
   




    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../ajax/ajax.js"></script>
    <script src="../ajax/ajax2.js"></script>
