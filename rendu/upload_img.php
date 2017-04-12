<?php
session_start();
if (!empty($_FILES)) {
	$img = $_FILES['img'];
	$ext = strtolower(substr($img['name'], -3));
	$allow_ext = array("jpg", "png", "gif");
	if (in_array($ext, $allow_ext)) {
		move_uploaded_file($img['tmp_name'], "images/".$img['name']);
		$_SESSION['flash']['success'] = "Votre image a bien ete enregistrer !";
	}
	else {
		$_SESSION['flash']['wrong'] = "Votre fichier n'est pas une image !";
	}
}
else {
	$_SESSION['flash']['wrong'] = "Vous n'avez pas uploader d'image !";
}
header("location: index.php");
exit();