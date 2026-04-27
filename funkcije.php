<?php 
    function CuvanjeLog($string){
        $fh=fopen("log/log.txt","a+");        
         fwrite($fh, $string);
         fclose($fh);
    }

    function provera(){ 
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $timeout = 1800; // 30 minuta

        if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
            session_unset();
            session_destroy();
            header("Location: prijava.php");
            exit();
        }

        $_SESSION['LAST_ACTIVITY'] = time();

    }
 
    function pocetnaProvera(){
        
        if(isset($_SESSION['uloga'])){
            if($_SESSION['uloga']==='Admin'){
                header("Location: admin/pocetnaAdmin.php");
            }
             elseif($_SESSION['uloga']==='Korisnik'){
                header("Location: korisnik/pocetnaKorisnik.php");
            }
        }
    }



    

?>

<script>
       function popuniFormu(row){
        let celija=row.getElementsByTagName("td");

        document.getElementById("trajanje").value=celija[2].innerText;
        document.getElementById("zona").value=celija[3].innerText;
        document.getElementById("cena").value=celija[4].innerText;
        document.getElementById("status").value=celija[5].innerText;
    }


   
function proveriIzbor() {
    let cekirani = document.querySelectorAll('input[name="izabrani[]"]:checked');

    if (cekirani.length === 0) {
        alert("Morate izabrati bar jednu kartu.");
        return false;
    }

    return confirm("Da li ste sigurni da želite da rezervišete izabrane karte?");
}

</script>







