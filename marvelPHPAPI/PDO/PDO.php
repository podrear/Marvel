<?php
$user="kecxaugg_Podrear";
$pass='LYw(%q764Zzs4U';
$database="kecxaugg_marvel";
try {
    $PDO = new PDO('mysql:host=localhost;dbname='.$database.';charset=utf8', $user, $pass);
    ini_set('max_execution_time', 300);
} catch (PDOException $e) {

    
    
}

?>