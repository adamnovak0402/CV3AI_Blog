<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["nickname"])){
        echo "Nickname není vyplněn";
    } else if(empty($_POST["password"])){
        echo "Heslo není vyplněno";
    }else {
        try {
            $host = "192.168.100.88";
            $dbname = "tester_blog3AI";
            $user = "tester";
            $password = "tester";

            $dsn = "mysql:host=$host;dbname=$dbname";

            $connection = new PDO($dsn, $user, $password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $nickname = $_POST["nickname"];
            $password = $_POST["password"];
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $SQL = "SELECT * FROM users WHERE nickname = ?";
            $statement = $connection->prepare($SQL);
            $statement->execute([$nickname]);
            $user = $statement->fetch();


            $jeHesloSpravne = password_Verify($_POST["password"], $user["password_hash"]);

            if($jeHesloSpravne) {
                $_SESSION["nickname"] = $nickname;

                echo "Úspěšně jsi se přihlásil";

                header("Location: /dashboard.php");
            }else{
                echo "Heslo se neshoduje";
            }

            //print_r($user);



        }catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}
