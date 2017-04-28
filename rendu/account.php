<?php
session_start();
require_once('functions.php');
if (!isset($_SESSION['auth'])) {
	$_SESSION['flash']['wrong'] = "Vous n'avez pas le droit d'acceder a cette page !";
	header('location: sign_in.php');
	exit();
}

if (!empty($_POST)) {
	if (empty($_POST['userpassword']) || $_POST['userpassword'] != $_POST['confirm_pass']) {
		$_SESSION['flash']['wrong'] = "Les mots de passe ne correspondent pas !";
	}

	if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $_POST['userpassword'])) {
		$_SESSION['flash']['wrong'] = "Votre mot de passe dois etre compose d'au moins une majuscule, une minuscule, d'un chiffre et de 6 caracteres !";
	}
	else {
		$user_id = $_SESSION['auth']->id;
		$password = password_hash($_POST['confirm_pass'], PASSWORD_BCRYPT);
		require_once('config/database.php');
		$pdo->prepare("UPDATE users SET userpassword = ? WHERE id = ?")->execute([$password, $user_id]);
		$_SESSION['flash']['success'] = "Votre mot de passe a bien ete mis a jour !";
	}
}
?>

<?php include("header.php"); ?>

<section>
	<h2>Bonjour <?= $_SESSION['auth']->username; ?></h2>
</section>

<section>
	<form action="" method="POST" class="form-group">
		<div class="form-group">
			<input type="password" name="userpassword" placeholder="Changer de mot de passe : " required>
		</div>

		<div class="form-group">
			<input type="password" name="confirm_pass" placeholder="Confirmer le mot de passe : " required>
		</div>
		<div class="form-group">
			<button type="submit" class="btn">Changer mon mot de passe !</button>			
		</div>
	</form>
</section>

<section id="myimg">
	<h2>Vos montages !</h2>
	<?php require_once("config/database.php"); $req = $pdo->prepare("SELECT id, id_user, path FROM images WHERE id_user = ?"); $req->execute([$_SESSION['auth']->id]); $test = $req->fetchAll();?>
	<?php 
	$i = 0;
	while ($test[$i]) {
		$i++;
	}
	?>
	<?php for($j = 0; $j < $i; $j++): ?>
		<img src="<?php echo $test[$j]->path; ?>" onclick="supp_select(this);"/>
	<?php endfor; ?>
	<input type="submit" name="delete" value="delete" id="button_del" hidden />
</section>
  <script type="text/javascript" src="delete.js"></script>
<?php include("footer.php"); ?>