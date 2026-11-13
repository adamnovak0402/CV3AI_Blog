<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["nickname"])){
        setcookie("error", "Nickname není vyplněn", time()+1, "/register.php");
        header('Location: /register.php');
    }else if(empty($_POST["password"])) {
        setcookie("error", "Heslo není vyplněno", time()+1, "/register.php");
        header('Location: /register.php');
    }else if($_POST["password"] == "123456"){
        setcookie("error", "Heslo je moc jednoduché.", time()+1, "/register.php");
        header('Location: /register.php');
    } else if($_POST["password"] != $_POST["password2"]){
        setcookie("error", "hesla se neshoduji", time()+1, "/register.php");
        header('Location: /register.php');
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
                setcookie("error", "Uživatel již existuje", time()+1, "/register.php");
                header('Location: /register.php');
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
            setcookie("error", "Connection failed: ". $e->getMessage(), time()+1, "/register.php");
            header('Location: /register.php');
        }
    }
}else{
    setcookie("error", "Tato metoda není dostupná", time()+1, "/register.php");
    header('Location: /register.php');
}