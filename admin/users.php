<?php 
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';

session_start();
if(!$_SESSION['user']){
    header('location:../sign_in.php');
}
$errors = [];
if(isset($_SESSION['user'])){
    if($_SESSION['user']){
        $_SESSION['user'];
    }

    else{
        header('location:../sign_in.php');
    }
}




$requestUsers="SELECT * from users where id != ?";
$resultUsers = $conn->prepare($requestUsers);
$resultUsers->execute([$_SESSION['user']['id']]);
$resUsers = $resultUsers->fetchAll(PDO::FETCH_ASSOC);


include "users.phtml";