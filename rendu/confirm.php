<?php

$user_id = $_GET['id'];
$token = $_GET['token'];

require_once("./config/database.php");
$req = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$req->execute([$user_id]);
$user = $req->fetch();
session_start();

if ($user && $user->confirmation_token == $token) {
	$pdo->prepare("UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?")->execute([$user_id]);
	$_SESSION['auth'] = $user;
	$_SESSION['flash']['success'] = "Votre compte a bien ete valider !";
	header("location: account.php");
	exit();
}
else {
	$_SESSION['flash']['wrong'] = "Ce token n'est plus valide";
	header("location: sign_in.php");
	exit();
}