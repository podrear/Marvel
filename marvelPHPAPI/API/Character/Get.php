<?php
include_once "../../Models/character.php";
include_once "../../PDO/Character.php";
include_once "../../PDO/PDO.php";


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Authorization');



$Char=getChar($PDO,$_GET['page']);
$count=1;
if (count($Char)) {
    // Open the table
    echo "<table>";

    // Cycle through the array
    foreach ($Char as $Chars) {
        if($count==1){
           echo "<tr>";   
        }
        echo "<td><img width='200 px'height='200px' id='img$Chars->id'onclick=apparition(document.getElementById('".$Chars->id."')) src=$Chars->url.$Chars->extension></br>";
        
        echo "$Chars->nom</br><div style='display:none' id='".$Chars->id."'><p>Nom : $Chars->nom</p></div></td>";

        if($count==4||$count==8){

            echo "</tr><tr>";
        }
        else if ($count==12){
            echo "</tr>";
        }
        $count+=1;
    }

    // Close the table
    echo "</table>";
    
}
?>


