<?php
session_start();
if(isset($_SESSION["nickname"])) {
    echo('
        <nav>
            <a href="/">Domů</a>
            <a href="#">O mně</a>
            <a href="#">Kontakt</a>
            <a href="/dashboard.php">Dashboard</a>
            <a href="/logout.php">Odhlásit se</a>
        </nav>
    ');
}else{
    echo ('
    <nav>
    <a href="/">Domů</a>
    <a href="#">O mně</a>
    <a href="#">Kontakt</a>
    <a href="/register.php">Registrace</a>
    <a href="/login.php">Přihlášení</a>
</nav>
    ');
}
?>
