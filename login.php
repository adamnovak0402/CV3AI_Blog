<?php
require_once('layout/header.php');
?>

<?php
require_once('layout/navigation.php');
?>

<main class="container">

    <form method="POST" action="form_control/login_form.php">
        <label for="nickname">Nickname:</label>
        <input name="nickname" type="text" id="nickname">
        <br>
        <label for="password">Password:</label>
        <input name="password" type="password" id="password">
        <br>
        <input type="submit" value="Přihlásit se">
    </form>

</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>