<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["nickname"])){
        echo "Nickname není vyplněn";
    }else if(empty($_POST["password"])) {
        echo "Heslo není vyplněno";
    }else if($_POST["password"] == "123456"){
        echo "Heslo je moc jednoduché.";
    } else {
        echo "OK";
    }
}else{
    echo "Tato metoda není dostupná";
}