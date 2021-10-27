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

$request="SELECT * FROM `articles` WHERE id=?";
$resultArticles=$conn->prepare($request);
$resultArticles->execute([$_GET['id']]);
$valueArticles=$resultArticles->fetch(PDO::FETCH_ASSOC);


$requestCategories="SELECT * FROM `categoies`  ";
$resultCategory=$conn->prepare($requestCategories);
$resultCategory->execute([]);
$resCategories=$resultCategory->fetchAll(PDO::FETCH_ASSOC);



if(isset($_POST['update'])){
    $picture=time()."-".$_FILES['image']['name'];
    $tmpPicture=$_FILES['image']['tmp_name'];
    $folder=$_SERVER['DOCUMENT_ROOT'].'/blog/images/postsImages/';
    move_uploaded_file($tmpPicture,$folder.$picture);

$sql= " UPDATE `articles` SET `titre`=? ,`description`=? , `image`=?  ,`categories_id`=?  WHERE id= ?";
$result1 = $conn->prepare($sql);
$result1->execute([$_POST['title'],$_POST['description'],$picture,$_POST['category'],$_GET['id']]);
header('location:addArticle.php');
}

include "editArticle.phtml";



