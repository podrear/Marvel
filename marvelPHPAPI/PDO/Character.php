<?php
include_once "../../Models/character.php";
include_once "../../PDO/PDO.php";


   
    

function getChar($PDO,$page){
    $chiffre1=($page-1)*12;   
    $query=$PDO->prepare( "SELECT * FROM personnage order by nom Limit $chiffre1,12 ");
    $query->execute();
    $datas=$query->fetchAll();
    $res=array();
    foreach($datas as $d){
        $new=new Character;
        $new->id=$d['id'];
        $new->nom=$d['nom'];
        $new->url=$d['url'];
        $new->extension=$d['extension'];
        array_push($res,$new);

    }
    return $res;
    
}

function addChar($PDO,$nom,$Url,$ext){
    $query=$PDO->prepare("insert into personnage (nom,url,extension) values (:nom,:url,:ext) ");
    $query->bindValue("nom",$nom);
    $query->bindValue("url",$Url);
    $query->bindValue("ext",$ext);
    $query->execute();
}



