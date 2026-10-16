<?php
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(!isset($_GET["id"])) {
        echo "ID chybí";
        die();
    }elseif(!is_numeric($_GET["id"])) {
        echo "ID není číslo";
        die();
    }else{
        try {
            $host = "192.168.100.88";
            $dbname = "tester_blog3AI";
            $user = "tester";
            $password = "tester";

            $dsn = "mysql:host=$host;dbname=$dbname";

            $connection = new PDO($dsn, $user, $password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $SQL = "SELECT id, title, created_at, content FROM posts WHERE id = ?";

            $statement = $connection->prepare($SQL);
            $id = $_GET["id"];
            $statement->execute([$id]);

            $prispevek = $statement->fetch();

            print_r($prispevek);

        }catch(Exception $e) {
            echo $e->getMessage();
        }

    }

}else{
    echo "Tato metoda není podporovaná";
}
