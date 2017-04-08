<?php
session_start();
require_once('functions.php');
if (!isset($_SESSION['auth'])) {
	$_SESSION['flash']['wrong'] = "Vous n'avez pas le droit d'acceder a cette page !";
	header('location: sign_in.php');
	exit();
}
?>

<?php include("header.php"); ?>

<section>
	<h2>Bonjour <?= $_SESSION['auth']->username; ?></h2>
</section>

<?php include("footer.php"); ?>