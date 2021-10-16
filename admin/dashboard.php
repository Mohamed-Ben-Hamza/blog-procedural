<?php
include "../database.php";
 

session_start();

if(isset($_SESSION['user'])){
    if($_SESSION['user']){
        $_SESSION['user'];
    }

    else{
        header('location:../sign_in.php');
    }
}


$sql="SELECT * from users ORDER BY  created_at LIMIT 6 ";
$result1 = $conn->prepare($sql);
$result1->execute([]);
$res = $result1->fetchAll(PDO::FETCH_ASSOC);

$requestCount="SELECT * from users ";
$requestCount = $conn->prepare($requestCount);
$requestCount->execute([]);
$resultCount = $requestCount->fetchAll(PDO::FETCH_ASSOC);

$sql="SELECT * from comments";
$resultComments = $conn->prepare($sql);
$resultComments->execute([]);
$resComments = $resultComments->fetchAll(PDO::FETCH_ASSOC);

include "dashboard.phtml";