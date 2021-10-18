<?php


include "../database.php";

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

$request="SELECT * FROM `categoies` WHERE id=?";
$resultCategory=$conn->prepare($request);
$resultCategory->execute([$_GET['id']]);
$valueCategory=$resultCategory->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['update'])){

$sql= " UPDATE `categoies` SET `categorie`=? WHERE id= ?";
$result1 = $conn->prepare($sql);
$result1->execute([$_POST['updateCategory'],$_GET['id']]);
header('location:categories.php');
}

include "editCategory.phtml";



