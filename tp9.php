<?php
include "connexpdo.php";
$dsn = 'pgsql:host=localhost;port=5432;dbname=graphenotes;';
$user = 'postgres';
$password = 'new_password';
$idcon = connexpdo($dsn, $user, $password);
$query1="select note from notes where etudiant='E1'";
$query2="select note from notes where etudiant='E2'";
$result1=$idcon->prepare($query1);
$result2=$idcon->prepare($query2);
$result1->execute();
$result2->execute();
$tabE1=$result1->fetchAll();
$tabE2=$result2->fetchAll();
$sumE1=0;
$sumE2=0;
for ($i=0; $i<10; $i++){
    $sumE1+=$tabE1[$i][0];
    $sumE2+=$tabE2[$i][0];
}
$moyE1=$sumE1/10;
$moyE2=$sumE2/10;


//--------------------------------
header ("Content-type: image/png");
$image = imagecreate(1000,300);

$gris = imagecolorallocate($image, 125, 125, 125);
$bleu = imagecolorallocate($image, 0, 0, 255);
$blanc = imagecolorallocate($image, 255, 255, 255);
$noir = imagecolorallocate($image, 0,0,0);

imagefilledrectangle($image, 0, 0, 1000, 500, $gris);
imagestring($image, 4, 400, 15, "Notes des etudiants E1 et E2 !", $noir);

for ($i=1; $i<10; $i++){
    imageline($image, ($i-1)*100, 180-$tabE1[$i-1][0], $i*100, 180-$tabE1[$i][0], $bleu);
    imageline($image, ($i-1)*100, 180-$tabE2[$i-1][0], $i*100, 180-$tabE2[$i][0], $blanc);
}

imagestring($image, 4, 35, 220, "E1", $bleu);
imagestring($image, 4, 70, 220, "E2", $blanc);
imagestring($image, 3, 800, 220, "Moyenne des notes de E1 $moyE1", $noir);
imagestring($image, 3, 800, 240, "Moyenne des notes de E2 $moyE2", $noir);

imagepng($image);
?>
