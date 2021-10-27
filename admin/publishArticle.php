<?php
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';
session_start();
$errors = [];
if(isset($_SESSION['user'])){
    if($_SESSION['user']){
        $_SESSION['user'];
    }

    else{
        header('location:../sign_in.php');
    }
}





$sql= " UPDATE `articles` SET `publish`=1 WHERE id= ?";
$result1 = $conn->prepare($sql);
$result1->execute([$_GET['id']]);
header('location:addArticle.php');



header('location:addArticle.php');