<?php

try {
$pdo = new PDO('mysql:host=localhost;dbname=camagru', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(PDOExepction $e) {
	echo 'La base de donnee est indisponible !';
}