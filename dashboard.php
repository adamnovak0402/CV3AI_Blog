<?php
session_start();
if(!isset($_SESSION["nickname"])) {
    header("location: /login.php");
}else{
    echo ("Tajná stránka jen pro přihlášené a je pro tebe dostupná");
}

