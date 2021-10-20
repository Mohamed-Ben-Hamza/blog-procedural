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




$requestUsers="SELECT * from users where id != ?";
$resultUsers = $conn->prepare($requestUsers);
$resultUsers->execute([$_SESSION['user']['id']]);
$resUsers = $resultUsers->fetchAll(PDO::FETCH_ASSOC);


include "users.phtml";