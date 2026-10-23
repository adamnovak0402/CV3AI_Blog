<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    print_r($_POST);
    try {

        $host = "192.168.100.88";
        $dbname = "tester_blog3AI";
        $user = "tester";
        $password = "tester";
        $dsn = "mysql:host=$host;dbname=$dbname";
        $connection = new PDO($dsn, $user, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $title = $_POST["title"];
        $content = $_POST["content"];
        $id = $_POST["id"];

        $SQL = "UPDATE posts SET title = ?, content = ? WHERE id = ?";

        $statement = $connection->prepare($SQL);

        $statement->execute([$title, $content, $id]);
        echo "Edit příspěvku proběhl úspěšně";



    }catch(Exception $e) {
        echo $e->getMessage();
    }
}