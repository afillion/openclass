<?php
session_start();
setcookie('remember', NULL, -1);
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous vous etes deconnecte !";
header("location: sign_in.php");
exit();