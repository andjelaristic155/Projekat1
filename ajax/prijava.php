  <?php
  //Startovanje sesije
  session_start();
require_once('../config/config.php');
header('Content-Type: application/json');
//povezivanje sa bazom
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$dbc->set_charset("utf8");
$greska="";

////Uzimanje podataka iz POST zahteva i uklanjanje praznih karaktera(razmaka)
$email = trim($_POST['email']);
$pass = trim($_POST['pass']);

//Provera unetih podataka sa podacima iz baze 
$upit="SELECT idKorisnika, ime, uloga 
       FROM korisnik 
       WHERE email=? AND sifra=SHA2(?,512)";

$stmt=$dbc->prepare($upit);
$stmt->bind_param("ss",$email,$pass);
$stmt->execute();
$stmt->store_result();

//Ako je korisnik uneo validne podatke
if($stmt->num_rows==1){

    $stmt->bind_result($id,$ime,$uloga);
    $stmt->fetch();

    //Pravljenje sesije
    $_SESSION['id']=$id;
    $_SESSION['ime']=$ime;
    $_SESSION['uloga']=$uloga;
//Pravljenje Cookies-a
    if(isset($_POST['zapamti'])){
        setcookie("email",$email,time()+3600,"/");
        setcookie("id",$id,time()+3600,"/");
    }
// Slanje JSON odgovora klijentu i prekid daljeg izvršavanja skripte 
   echo json_encode([
    "status"=>"ok",
    "uloga"=>$uloga
]);
exit();

}
else{
 // Slanje JSON odgovora klijentu u slucaju greske pri logovanju
    echo json_encode([
        "status"=>"error",
        "poruka"=>"Neispravna email adresa ili lozinka"
    ]);

}
//zatvaranje konekcije
$stmt->close();
$dbc->close();



  ?>

 