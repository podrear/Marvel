<?php
include_once "../../Models/character.php";
include_once "../../PDO/Character.php";
include_once "../../PDO/PDO.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Authorization');


$ext = explode("/", $_FILES['url']['type'])[1];
$url = str_replace(" ","_",$_POST['nom']);

$target_dir = "../../images/";
$target_dir_API = "../../images/";
$target_BDD =  $target_dir_API . $url;
$target_file = $target_dir . $url.".".$ext;
$uploadOk = 1;
addChar($PDO,$_POST['nom'],$target_BDD,$ext);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
echo $target_file;

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["url"]["tmp_name"]);
  if($check !== false) {
    echo "Ce fichier est une image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "Ce fichier n'est pas une image .";
    $uploadOk = 0;
  }
}
if (file_exists($target_file)) {
  echo "Ce fichier existe deja .";
  $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Format non autorisé, veuillez mettre des images SVP.";
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo "Erreur, votre image n'a pas pu être mise dans notre base .";
} else {
  if (move_uploaded_file($_FILES["url"]["tmp_name"], $target_file)) {
    echo "le fichier ". htmlspecialchars( basename( $_FILES["url"]["name"])). " à été ajouté.";
  } else {
    echo "Le fichier n'a pas pu être ajouté";
  }
}
header("location:../../index.php");
?>
