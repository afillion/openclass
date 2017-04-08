<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();	
}
?>
<?php require_once("functions.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8"/>
  <meta author="Alexis Fillion" />
  <link rel="stylesheet" href="global.css"/>
  <title>Camagru</title>
</head>
<body>
<header>
	<div class="element_header" onclick="location.href='index.php'">
		<h1><a href="index.php">Bienvenue sur Camagru</a></h1>
		<p><a href="index.php">Camagru est un site de montage photo</a></p>
	</div>
</header>

<?php if ($_SESSION['flash']): ?>
	<?php foreach ($_SESSION['flash'] as $type => $msg): ?>
		<section class="alert-<?= $type; ?>">
			<p><?= $msg; ?></p>
		</section>
	<?php endforeach; ?>
	<?php unset($_SESSION['flash']); ?>
<?php endif; ?>