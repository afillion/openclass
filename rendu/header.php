<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();	
}
?>

<?php require_once("functions.php");?>

<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8"/>
  <meta author="Alexis Fillion" />
  <meta name="viewport" content="initial-scale=1.0, user-scalable=yes, width=device-width" />
  <link rel="stylesheet" href="global.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Camagru</title>
</head>
<body>
<header>
	<div class="element_header" onclick="location.href='index.php'">
		<h1 style="font-family: cursive;"><a href="index.php">Camagru</a></h1>
		<p><a href="index.php">Camagru est un site de montage photo</a></p>
	</div>
</header>
<nav>
  <?php if(isset($_SESSION['auth'])): ?>
  	<div class="element_nav" onclick="location.href='account.php'">
  		<p>Mon compte</p>
  	</div>
  	<div class="element_nav" onclick="location.href='gallerie.php'">
  		<p>Gallerie</p>
  	</div>
  	<div class="element_nav" onclick="location.href='log_out.php'">
  		<p>Se deconnecter</p> <!-- Se deconnecter -->
  	</div>
  <?php else: ?>
    <div class="element_nav" onclick="location.href='sign_up.php'">
      <p><a href="sign_up.php">Sign Up</a></p> <!-- S'enregistrer / S'inscrire -->
    </div>
    <div class="element_nav" onclick="location.href='gallerie.php'">
      <p>Gallerie</p>
    </div>
    <div class="element_nav" onclick="location.href='sign_in.php'">
      <p><a href="sign_in.php">Sign In</a></p> <!-- Se connecter -->
    </div>
  <?php endif; ?>
</nav>
<?php if ($_SESSION['flash']): ?>
	<?php foreach ($_SESSION['flash'] as $type => $msg): ?>
		<div class="alert-<?= $type; ?>">
			<p><?= $msg; ?></p>
		</div>
	<?php endforeach; ?>
	<?php unset($_SESSION['flash']); ?>
<?php endif; ?>