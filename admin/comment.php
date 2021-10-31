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
        exit;
    }
}



$requestComments="SELECT * from comments ";
$resultComments = $conn->prepare($requestComments);
$resultComments->execute([]);
$resComments = $resultComments->fetchAll(PDO::FETCH_ASSOC);
include "comment.phtml";