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





$sql= "DELETE FROM users WHERE id=?";
$result1 = $conn->prepare($sql);
$result1->execute([$_GET['id']]);



header('location:users.php');