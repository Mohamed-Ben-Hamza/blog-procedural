<?php

use function PHPSTORM_META\sql_injection_subst;

include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';


session_start();

if(isset($_SESSION['user']))
$_SESSION['user'];



$sql="SELECT * from articles   INNER JOIN   categoies ON  categoies.id=articles.categories_id where publish=1 ORDER BY date";
$result1 = $conn->prepare($sql);
$result1->execute([]);
$articles = $result1->fetchAll();






$requestCategories="SELECT * from categoies ";
$resultCategories = $conn->prepare($requestCategories);
$resultCategories->execute([]);
$resCategories = $resultCategories->fetchAll(PDO::FETCH_ASSOC);


function coutCategories($posts){
    global $conn;

    $sql="SELECT * from articles   INNER JOIN   categoies ON  categoies.id=articles.categories_id  where publish=1 AND categorie=?       ORDER BY date";
    $result1 = $conn->prepare($sql);
    $result1->execute([$posts]);
    $posts = $result1->fetchAll();
    return count($posts);
}






function readMore($string,$lenght){

    if(strlen($string) > $lenght){
        $stringCut = substr($string,0,$lenght);
        $string = substr($stringCut,0, strrpos($stringCut,' ')). " ...";
       return(substr($string,0,$lenght));
    }
    return $string;
}


include 'index.phtml';
