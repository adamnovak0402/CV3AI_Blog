<?php
session_start();
if(!isset($_SESSION["nickname"])) {
    header("location: /login.php");
}
?>
<?php
session_start();
$prispevky = null;
try {
    $host = "192.168.100.88";
    $dbname = "tester_blog3AI";
    $user = "tester";
    $password = "tester";

    $dsn = "mysql:host=$host;dbname=$dbname";

    $connection = new PDO($dsn, $user, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $SQL = "SELECT id, title, created_at, content FROM posts";

    $statement = $connection->query($SQL);

    $prispevky = $statement->fetchAll();

}catch(Exception $e) {
    echo $e->getMessage();
}
?>

<?php
require_once('layout/header.php');
?>
<?php
require_once('layout/navigation.php');
?>
<main class="container">
    <table>
        <tr>
            <th>ID</th>
            <th>Název příspěvku</th>
            <th>Akce</th>
        </tr>
        <?php
            foreach($prispevky as $item) {
                echo ('
                <tr>
                    <td>'.$item["id"].'</td>
                    <td>'.$item["title"].'</td>
                    <td><a href="/edit.php?id='.$item["id"].'">Editovat</a></td>
                </tr>
                ');
            }

        ?>

    </table>
</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>