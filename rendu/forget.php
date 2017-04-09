<?php
session_start();
require_once('functions.php');

if (!empty($_POST) && !empty($_POST['usermail'])) {
	require_once('config/database.php');
	$req = $pdo->prepare("SELECT * FROM users WHERE usermail = ? AND confirmed_at IS NOT NULL");
	$req->execute([$_POST['usermail']]);
	$user = $req->fetch();
	if ($user) {
		$reset_token = str_random(60);
		$pdo->prepare("UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?")->execute([$reset_token, $user->id]);
		$_SESSION['flash']['success'] = "Un email vous a ete envoyer pour recreer un mot de passe !";
		mail($_POST['usermail'], "Reinitialisation de votre mot de passe", "Pour reinitialiser votre mot de passe cliquez sur ce lien\nhttp://localhost:8080/openclass/rendu/reset.php?id={$user->id}&token=$reset_token");
		header("location: sign_in.php");
		exit();
	}
	else {
		$_SESSION['flash']['wrong'] = "Aucune compte ne correspond a cette adresse !";
	}
}
?>

<?php include("header.php"); ?>

<br/>

<section>
	<header id="header_section">
		<h2>Mot de passe oublie ?</h2>
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
			<label for="">E-mail</label>
			<input type="email" name="usermail" required/>
		</div>

		<button type="submit" class="btn">Reinitialiser mon mot de passe !</button>

	</form>
</section>

<?php include("footer.php"); ?>