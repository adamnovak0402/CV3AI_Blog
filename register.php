<?php
require_once('layout/header.php');
?>

<?php
require_once('layout/navigation.php');
?>

<main class="container">

   <form method="POST" action="form_control/register_form.php">
       <input name="nickname" type="text">
       <br>
       <input name="password" type="password">
       <br>
       <input type="submit" value="Registrovat se">
   </form>

</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>