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
	$req = $pdo->prepare("SELECT id FROM images WHERE path = ?");
	$req->execute([$_POST['img_name']]);
	$id_img = $req->fetch();
	$id_img = $id_img->id;
	$req = $pdo->prepare("INSERT INTO comments SET id_img = ?, id_user = ?, comment = ?");
	$req->execute([$id_img, $_SESSION['auth']->id, $_POST['comment']]);
	echo $_POST['comment'];
}