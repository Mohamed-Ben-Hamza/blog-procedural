<?php
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';


session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']){
        $_SESSION['user'];
    }

    else{
        header('location:../sign_in.php');
    }
}
$sql="SELECT  * FROM  articles WHERE id=?";
$result1 = $conn->prepare($sql);
$result1->execute([$_GET['id']]);
$articles = $result1->fetch(PDO::FETCH_ASSOC);


include "article.phtml";