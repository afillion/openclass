<?php
session_start();
require_once('functions.php');

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['userpassword'])) {
	require_once('config/database.php');
	$req = $pdo->prepare("SELECT * FROM users WHERE (username = :username OR usermail = :username) AND confirmed_at IS NOT NULL");
	$req->execute(['username' => $_POST['username']]);
	$user = $req->fetch();
	if (password_verify($_POST['userpassword'], $user->userpassword)) {
		session_start();
		$_SESSION['auth'] = $user;
		$_SESSION['flash']['success'] = "Vous etes connecte !";
		header("location: account.php");
		exit();
	}
	else {
		$_SESSION['flash']['wrong'] = "Identifiant ou mot de passe incorrecte !";
	}
}
?>

<?php include("header.php"); ?>

<br/>

<section>
	<header id="header_section">
		<h2>Se connecter</h2>
	</header>

	<form action="" method="POST" class="form-group">

		<?php if (!empty($errors)): ?>
			<section class="alert-wrong">
				<p>Vous n'avez pas remplit le formulaire correctement !</p>
				<ul>
					<?php foreach($errors as $error): ?>
						<li> <?= $error ?></li>
					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>

		<div class="form-group">
			<label for="">Pseudo ou e-mail</label>
			<input type="text" name="username"/>
		</div>

		<div class="form-group">
			<label for="">Mot de passe</label>
			<input type="password" name="userpassword"/>
		</div>

		<button type="submit" class="btn">Se connecter</button>

	</form>
</section>

<?php include("footer.php"); ?>