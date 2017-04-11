<?php
session_start();
if (isset($_GET['id']) && isset($_GET['token'])) {
	require_once('config/database.php');
	$req = $pdo->prepare("SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)");
	$req->execute([$_GET['id'], $_GET['token']]);
	$user = $req->fetch();
	if ($user) {
		if (!empty($_POST)) {
			if (!empty($_POST['userpassword']) && $_POST['userpassword'] == $_POST['confirm_password']) {
				$pass = password_hash($_POST['confirm_password'], PASSWORD_BCRYPT);
				$req = $pdo->prepare("UPDATE users SET userpassword = ?, reset_token = NULL, reset_at = NULL WHERE id = ? AND usermail = ?");
				$req->execute([$pass, $user->id, $user->usermail]);
				//session_start();
				$_SESSION['flash']['success'] = "Votre mot de passe a bien ete modifie !";
				$_SESSION['auth'] = $user;
				header("location: account.php");
				exit();
			}
		}
	}
	else {
		//session_start();
		$_SESSION['flash']['wrong'] = "Ce token n'est pas valide !";
		header("location: sign_in.php");
		exit();
	}
}
else {
	header("location: sign_in.php");
	exit();
}
?>

<?php include("header.php"); ?>

<section>
	<header id="header_section">
		<h2>Reinitialisation du mot de passe</h2>
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
			<label for="">Mot de passe</label>
			<input type="password" name="userpassword" required/>
		</div>

		<div class="form-group">
			<label for="">Confirmation du mot de passe</label>
			<input type="password" name="confirm_password" required/>
		</div>

		<button type="submit" class="btn">Reinitialiser mon mot de passe !</button>

	</form>
</section>

<?php include("footer.php"); ?>