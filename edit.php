
<?php
require_once('layout/header.php');
?>

<?php
require_once('layout/navigation.php');
?>

<main class="container">
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

                //print_r($prispevek);

                echo ('
                
                <form method="POST" action="form_control/edit_post_form.php">
                    <input type="hidden" name="id" value="'.$prispevek['id'].'">
                    <input type="text" name="title" value="'.$prispevek['title'].'">
                    <br>
                    <textarea name="content" rows="5" cols="60">'.$prispevek['content'].'</textarea>
                    <br>
                    <input type="submit">
                </form>
                
                ');

            }catch(Exception $e) {
                echo $e->getMessage();
            }

        }

    }else{
        echo "Tato metoda není podporovaná";
    }
    ?>


</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>