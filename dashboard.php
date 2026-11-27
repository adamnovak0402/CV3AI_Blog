<?php
session_start();
if(!isset($_SESSION["nickname"])) {
    header("location: /login.php");
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
        <tr>
            <td>1</td>
            <td>Hokej</td>
            <td><a href="">Editovat</a></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Fotbal</td>
            <td><a href="">Editovat</a></td>
        </tr>
    </table>
</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>