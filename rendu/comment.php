<?php
session_start();
require_once("config/database.php");
if(strlen($_POST['comment']) > 150) {
	http_response_code(201);
	echo "Votre commentaire ne dois pas exceder 150 caracteres !";
}
else if (empty($_POST['comment'])) {
	http_response_code(201);
	echo "Votre commentaire est vide !";
}
else {
	$_POST['comment'] = htmlentities($_POST['comment']);
	$req = $pdo->prepare("SELECT id, id_user FROM images WHERE path = ?");
	$req->execute([$_POST['img_name']]);
	$id_img = $req->fetch();
	$owner_img = $id_img->id_user;
	$id_img = $id_img->id;
	$req = $pdo->prepare("INSERT INTO comments SET id_img = ?, id_user = ?, comment = ?, comment_username = ?");
	$req->execute([$id_img, $_SESSION['auth']->id, $_POST['comment'], $_SESSION['auth']->username]);
	$req = $pdo->prepare("SELECT * FROM users WHERE id = ?");
	$req->execute([$owner_img]);
	$user = $req->fetch();
	$sender = $_SESSION['auth']->username;
	mail($user->usermail, 'Un de vos montage a ete commente !', "L'utilisateur $sender a commente votre montage !");
	echo $_POST['comment'];
}