<?php
session_start();
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
    <?php
    foreach ($prispevky as $prispevek) {
        echo ('
        <article class="post">
            <a href="prispevek.php?id='.htmlspecialchars($prispevek['id']).'" class="post-title">'.htmlspecialchars($prispevek['title']).'</a>
            <div class="post-date">'.htmlspecialchars($prispevek['created_at']).'</div>
            <div class="post-content">
                <p>'.htmlspecialchars($prispevek['content']).'</p>
            </div>
            ');
        if(isset($_SESSION["nickname"])){
            echo ('<a href="edit.php?id='.htmlspecialchars($prispevek['id']).'" >Editovat 🔧</a>');
        }
        echo ('
        </article>
    
    ');

    }

    ?>

</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>