<?php
session_start();
if (!empty($_FILES)) {
	$img = $_FILES['img'];
	$ext = strtolower(substr($img['name'], -3));
	$allow_ext = array("png");

	if (strlen($img['name']) >= 100) {
		$_SESSION['flash']['wrong'] = "Le nom de votre fichier est trop long !";
		header("location: index.php");
		exit();
	}
	else if (strcmp($img['type'], "image/png") != 0 ) {
		$_SESSION['flash']['wrong'] = "Votre fichier n'est pas une image !";
		header("location: index.php");
		exit();
	}

	if (in_array($ext, $allow_ext)) {
		move_uploaded_file($img['tmp_name'], "images/".$img['name']);
		$_SESSION['flash']['success'] = "Votre image a bien ete uploader !";
		header("location: index.php");
		exit();
	}
	else {
		$_SESSION['flash']['wrong'] = "Votre fichier n'est pas une image !";
		header("location: index.php");
		exit();
	}
}
else {
	$_SESSION['flash']['wrong'] = "Vous n'avez pas uploader d'image !";
}
header("location: index.php");
exit();