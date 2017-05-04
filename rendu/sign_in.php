<?php
session_start();
require_once('functions.php');

// if(isset($_COOKIE['remember'])) {
// 	var_dump($_COOKIE);
// }

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['userpassword'])) {
	require_once('config/connexion.php');
	$req = $pdo->prepare("SELECT * FROM users WHERE (username = :username OR usermail = :username) AND confirmed_at IS NOT NULL");
	$req->execute(['username' => $_POST['username']]);
	$user = $req->fetch();
	if (password_verify($_POST['userpassword'], $user->userpassword)) {
		session_start();
		$_SESSION['auth'] = $user;
		$_SESSION['flash']['success'] = "Vous etes connecte !";
		if ($_POST['remember']) {
			$remember_token = str_random(60);
			$pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?")->execute([$remember_token, $user->id]);
			setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . "ratonslaveurs"), time()+60*60*24*7);
		}
		header("location: account.php");
		exit();
	}
	else {
		$_SESSION['flash']['wrong'] = "Identifiant ou mot de passe incorrecte !";
	}
}
?>

<?php include("header.php"); ?>

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
			<input type="text" name="username" required/>
		</div>

		<div class="form-group">
			<label for="">Mot de passe</label>
			<input type="password" name="userpassword" required/>
		</div>

		<div class="form-group">
			<label>Se souvenir de moi</label>
			<input type="checkbox" name="remember" value="1"/>
		</div>

		<div class="form-group">
			<button type="submit" class="btn">Se connecter</button>		
		</div>

		<p><a href="forget.php" style="text-decoration: underline; color: red;">(Mot de passe oublie ?)</a></p>

	</form>
</section>

<?php include("footer.php"); ?>