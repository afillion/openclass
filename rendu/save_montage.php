<?php
session_start();
require_once("config/database.php");
if (isset($_POST['save_img'])) {
	$img = base64_decode($_POST['save_img']);
	$name = date("d-M-Y") . time() . $_SESSION['auth']->username;
	file_put_contents("montages/" . $name . ".png", $img);
	$req = $pdo->prepare("INSERT INTO images SET id_user = ?, path = ?");
	$id_user = $_SESSION['auth']->id;
	$path = "montages/" . $name . ".png";
	$req->execute([$id_user, $path]);
	$_SESSION['flash']['success'] = "Votre montage a bien ete enregister dans la BDD !";
	header("location: index.php");
}