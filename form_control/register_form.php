<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["nickname"])){
        echo "Nickname není vyplněn";
    }else if(empty($_POST["password"])) {
        echo "Heslo není vyplněno";
    }else if($_POST["password"] == "123456"){
        echo "Heslo je moc jednoduché.";
    } else if($_POST["password"] != $_POST["password2"]){
        echo "hesla se neshoduji";
    }else{

        try {
            $host = "192.168.100.88";
            $dbname = "tester_blog3AI";
            $user = "tester";
            $password = "tester";

            $dsn = "mysql:host=$host;dbname=$dbname";

            $connection = new PDO($dsn, $user, $password);

            //nastavení debug modu:
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //typ vystupních dat z db do asociativního pole
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $nickname = $_POST["nickname"];
            $password = $_POST["password"];
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $SQL = "INSERT INTO users (nickname, password_hash) VALUES (?, ?)";

            $statement = $connection->prepare($SQL);

            $statement->execute([$nickname, $password_hashed]);
            echo "Registrace je úspěšná";



        }catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}else{
    echo "Tato metoda není dostupná";
}