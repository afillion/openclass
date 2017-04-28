<?php
session_start();
//header("content-type: image/png");

//print_r($_POST);
$check = 0;
$image = $_POST['img'];
$filter = $_POST['filter'];
$image = explode(',', $image);
$image = $image[1];
file_put_contents('img.png', base64_decode($image));
$src = imagecreatefrompng("img.png");
$add = imagecreatefrompng($filter);

$larg_src = imagesx($src);
$larg_add = imagesx($add);
$haut_src = imagesy($src);
$haut_add = imagesy($add);
$xdest_add = $larg_src - $larg_add;
$ydest_add = $haut_src - $haut_add;
//imagecolorallocatealpha($add, 255, 255, 255, 0);

if (!imagecopyresized($src, $add, 20, 20, 0, 0, 100, 100, $larg_add, $haut_add)) {
	$_SESSION['flash']['wrong'] = "Erreur lors de `imagecopymerge` !";
}

header("content-type: image/png");
imagepng($src, "img.png");
echo "data:image/png;base64," . base64_encode(file_get_contents("img.png"));