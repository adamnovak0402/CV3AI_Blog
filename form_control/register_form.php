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
        $host = "192.168.100.88";
        $dbname = "tester_blog3AI";
        $dbuser = "tester";
        $dbpassword = "tester";
        $dsn = "mysql:host=$host;dbname=$dbname";

        try{
            $connection = new PDO($dsn, $dbuser, $dbpassword);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $SQL = "select * from users where nickname = ?";
            $statement = $connection->prepare($SQL);
            $statement->execute([$_POST["nickname"]]);
            $user = $statement->fetch();
            if($user){
                echo "Uživatel již existuje";
                die();
            }else{
                try {
                    $connection = new PDO($dsn, $dbuser, $dbpassword);

                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                    $nickname = $_POST["nickname"];
                    $dbpassword = $_POST["password"];
                    $password_hashed = password_hash($dbpassword, PASSWORD_DEFAULT);

                    $SQL = "INSERT INTO users (nickname, password_hash) VALUES (?, ?)";

                    $statement = $connection->prepare($SQL);

                    $statement->execute([$nickname, $password_hashed]);
                    echo "Registrace je úspěšná";


                }catch(Exception $e) {
                    echo $e->getMessage();
                }
            }


        }catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}else{
    echo "Tato metoda není dostupná";
}