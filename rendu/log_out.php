<?php
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous vous etes deconnecte !";
header("location: sign_in.php");
?>
<?php include("header.php"); ?>
<?php include("footer.php"); ?>