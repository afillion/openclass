<?php

require_once('./functions.php');
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!empty($_POST)) {

	require_once('./config/database.php');

	$errors = array();

	if (empty($_POST['username'])) {
		$errors['username'] = "Veuillez renseigner un pseudonyme !";
	}
	else if (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
		$errors['username'] = "Votre pseudo dois etre compose de caractere alphanumerique !";
	}
	else {
		$req = $pdo->prepare("SELECT id FROM users WHERE username = ?");
		$req->execute([$_POST['username']]);
		$user = $req->fetch();
		if ($user) {
			$errors['username'] = "Ce pseudonyme est deja utilise !";
		}
	}

	if (empty($_POST['usermail']) || !filter_var($_POST['usermail'], FILTER_VALIDATE_EMAIL)) {
		$errors['usermail'] = "Votre e-mail n'est pas valide !";
	}
	else {
		$req = $pdo->prepare("SELECT id FROM users WHERE usermail = ?");
		$req->execute([$_POST['usermail']]);
		$user = $req->fetch();
		if ($user) {
			$errors['usermail'] = "Cet e-mail est deja utilise !";
		}
	}

	if (empty($_POST['userpassword'])) {
		$errors['userpassword'] = "Veuillez renseigner un mot de passe !";
	}
	else if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $_POST['userpassword'])) {
		$errors['userpassword'] = "Votre mot de passe dois etre compose d'au moins une majuscule, une minuscule, d'un chiffre et de 6 caracteres !";
	}
	else if ($_POST['userpassword'] != $_POST['userconfirmpassword']) {
		$errors['userpassword'] = "Le champs de confirmation du mot de passe de correspond pas au mot de passe";
	}

	if (empty($errors)) {
		$req = $pdo->prepare("INSERT INTO users SET username = ?, usermail = ?, userpassword = ?, confirmation_token = ?");
		$pass = password_hash($_POST['userpassword'], PASSWORD_BCRYPT);
		$token = str_random(60);
		$req->execute([$_POST['username'], $_POST['usermail'], $pass, $token]);
		$user_id = $pdo->lastInsertId();
		mail($_POST['usermail'], "Confirmation d'inscription", "Pour valider votre inscription, veuillez cliquez sur ce lien:\nhttp://localhost:8080/openclass/rendu/confirm.php?id=$user_id&token=$token");
		$_SESSION['flash']['success'] = "Un e-mail de confirmation vous a ete envoye !";
		header("location: sign_in.php");
		exit();
	}
}

?>

<?php include("header.php"); ?>

<?php if (!empty($errors)): ?>
	<div class="alert-wrong">
		<p>Vous n'avez pas remplit le formulaire correctement !</p>
		<ul>
			<?php foreach($errors as $error): ?>
				<li> <?= $error ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<section>
	<header id="header_section">
		<h2>Inscription</h2>
	</header>

	<form action="" method="POST" class="form-group">

		<div class="form-group">
			<label for="">Pseudo</label>
			<input type="text" name="username" required/>
		</div>

		<div class="form-group">
			<label for="">Email</label>
			<input type="text" name="usermail" required/>
		</div>

		<div class="form-group">
			<label for="">Mot de passe</label>
			<input type="password" name="userpassword" required/>
		</div>

		<div class="form-group">
			<label for="">Confirmer le mot de passe</label>
			<input type="password" name="userconfirmpassword" required/>
		</div>

		<div class="form-group">
			<button type="submit" class="btn">S'inscrire</button>			
		</div>


	</form>
</section>

<?php include("footer.php"); ?>