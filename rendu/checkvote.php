<?php
session_start();

require_once("config/database.php");

$id_user = $_SESSION['auth']->id; //on pourrait rajouter un check if(id_user == null) mais normalement c'est ok le button ne s'effiche que si $_SESSION['auth']
$req = $pdo->prepare("SELECT id FROM images WHERE path = ?");
$req->execute([$_POST['img_name']]);
$id_img = $req->fetch();
$id_img = $id_img->id;

$req = $pdo->prepare("SELECT * FROM votes WHERE id_user = ? AND id_img = ?");
$req->execute([$id_user, $id_img]);
$vote = $req->fetch();

if (!$vote) {
	$req = $pdo->prepare("INSERT INTO votes SET id_user = ?, id_img = ?, type = ?");
	$req->execute([$id_user, $id_img, $_POST['vote_value']]);
	if ($_POST['vote_value'] === '1') {
		$req = $pdo->prepare("SELECT likes FROM images WHERE id = ?");
		$req->execute([$id_img]);
		$likes = $req->fetch();
		$likes = $likes->likes;
		$likes = $likes + 1;
		$req = $pdo->prepare("UPDATE images SET likes = ? WHERE id = ?");
		$req->execute([$likes, $id_img]);
	}
	else if($_POST['vote_value'] === '-1') {
		$req = $pdo->prepare("SELECT dislikes FROM images WHERE id = ?");
		$req->execute([$id_img]);
		$dislikes = $req->fetch();
		$dislikes = $dislikes->dislikes;
		$dislikes = $dislikes + 1;
		$req = $pdo->prepare("UPDATE images SET dislikes = ? WHERE id = ?");
		$req->execute([$dislikes, $id_img]);
	}
}
else {
	if ($vote->type === $_POST['vote_value']) {
		//echo "Vous avez deja effectue ce vote !";
	}
	else {
		$req = $pdo->prepare("UPDATE votes SET type = ? WHERE id_user = ? AND id_img = ?");
		$req->execute([$_POST['vote_value'], $id_user, $id_img]);
		if ($_POST['vote_value'] === '1') {
			$req = $pdo->prepare("SELECT likes, dislikes FROM images WHERE id = ?");
			$req->execute([$id_img]);
			$votes = $req->fetch();
			$likes = $votes->likes;
			$dislikes = $votes->dislikes;
			$likes = $likes + 1;
			$dislikes = $dislikes - 1;
			$req = $pdo->prepare("UPDATE images SET likes = ?, dislikes = ? WHERE id = ?");
			$req->execute([$likes, $dislikes, $id_img]);
		}
		else if($_POST['vote_value'] === '-1') {
			$req = $pdo->prepare("SELECT likes, dislikes FROM images WHERE id = ?");
			$req->execute([$id_img]);
			$votes = $req->fetch();
			$likes = $votes->likes;
			$dislikes = $votes->dislikes;
			$likes = $likes - 1;
			$dislikes = $dislikes + 1;
			$req = $pdo->prepare("UPDATE images SET likes = ?, dislikes = ? WHERE id = ?");
			$req->execute([$likes, $dislikes, $id_img]);
		}
	}
}

$req = $pdo->prepare("SELECT likes, dislikes FROM images WHERE id = ?");
$req->execute([$id_img]);
$to_ret = $req->fetch();
echo json_encode($to_ret);