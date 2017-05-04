<?php
$i = 0;
$j = count($_POST);
require_once("config/connexion.php");
while ($i < $j) {
	$req = $pdo->prepare("DELETE FROM images WHERE path = ?");
	$filename = explode("/", $_POST[$i]);
	$filename = $filename[count($filename) - 1];
	$filename = "montages/" . $filename;
	unlink($filename);
	$req->execute([$filename]);
	$i++;
}