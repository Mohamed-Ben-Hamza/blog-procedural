<?php
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';


session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']){
        $_SESSION['user'];
    }

    else{
        header('location:sign_in.php');
        exit;
    }
}
$sql="SELECT  * FROM  articles WHERE id=?";
$result1 = $conn->prepare($sql);
$result1->execute([$_GET['id']]);
$articles = $result1->fetch(PDO::FETCH_ASSOC);


// comment Article

if(isset($_POST['post_comment'])){
    if(!$_SESSION['user']){
        header('location:sign_in.php');
    }

    $sql=" INSERT INTO `comments`( `pseudo`, `comment`, `date_comment`, `id_article`) VALUES (?,?,NOW(),?)    "  ;
    $resultComments = $conn->prepare($sql);
    $resultComments->execute([$_SESSION['user']['username'], $_POST['comment'] ,$_GET['id']]);  
    
  
}
function dateFormate($date){
    $dateObj = date_create($date);
    return date_format($dateObj,"F j, Y, g:i a");
}


$resquestComments="SELECT * FROM comments WHERE id_article=? ";
$result1 = $conn->prepare($resquestComments);
$result1->execute([$_GET['id']]);
$comments = $result1->fetchAll(PDO::FETCH_ASSOC);









include "article.phtml";