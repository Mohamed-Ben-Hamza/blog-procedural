<?php 
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';
 

session_start();
$errors = [];
 if(!$_SESSION['user']){
    header('location:../sign_in.php');
}


if(isset($_SESSION['user'])){
    if($_SESSION['user']){
        $_SESSION['user'];
    }
 

    else{
        header('location:../sign_in.php');
        exit;
    }
}


if(isset($_POST['save'])){
    $categorie = trim(htmlspecialchars($_POST['categorie'])) ;

    if (empty($categorie)) {
        $errors['categorie'] = "categorie is empty";
     
    }
    elseif(strlen($categorie)<4)
    {
    $errors['categorie']=" categorie must be  4 caractere";
    }
    else{
        $sql = "INSERT INTO `categoies`( `categorie`) VALUES (?) " ;
        $result1 = $conn->prepare($sql);
        $result1->execute([$categorie]);
      

       
    }
}

$requestCategories="SELECT * from categoies ";
$resultCategories = $conn->prepare($requestCategories);
$resultCategories->execute([]);
$resCategories = $resultCategories->fetchAll(PDO::FETCH_ASSOC);


include "categories.phtml";