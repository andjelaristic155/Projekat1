<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['ime']);
unset($_SESSION['uloga']);
    
session_destroy();   // uništava sesiju

header("Location: prijava.php");
setcookie("email", "", time() - 1, "/");
exit();
?>