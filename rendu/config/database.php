<?php

try {
$DB = new PDO('mysql:host=localhost;dbname=camagru', 'root', '');
$DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOExepction $e) {
	echo 'La base de donnee est indisponible !';
}



?>