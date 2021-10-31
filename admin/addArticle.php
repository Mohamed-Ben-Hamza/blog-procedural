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



$requestCategories="SELECT * from categoies ";
$resultCategories = $conn->prepare($requestCategories);
$resultCategories->execute([]);
$resCategories = $resultCategories->fetchAll(PDO::FETCH_ASSOC);

$uploads='../images/postsImages';

if(isset($_POST['post'])){
    $titlePost=$_POST['title'];
    $descriptionPost=$_POST['description'];
    $categoryPost=$_POST['category'];
    
   $picture=time()."-".$_FILES['image']['name'];
   $tmpPicture=$_FILES['image']['tmp_name'];
   $folder=$_SERVER['DOCUMENT_ROOT'].'/blog/images/postsImages/';
   move_uploaded_file($tmpPicture,$folder.$picture);

$sql=" INSERT INTO `articles`( `titre`, `description`, `image`, `publish`, `date`, `user_id`, `categories_id`) VALUES (?,?,?,0,NOW(),?,?)    "  ;
$resultArticle = $conn->prepare($sql);
$resultArticle->execute([$titlePost, $descriptionPost, $picture, $_SESSION['user']['id'] , $categoryPost]);  

}






$requestArticles="SELECT * from articles ";
$resultArticles = $conn->prepare($requestArticles);
$resultArticles->execute([]);
$resArticles = $resultArticles->fetchAll(PDO::FETCH_ASSOC);



function readMore($string,$lenght){

    if(strlen($string) > $lenght){
        $stringCut = substr($string,0,$lenght);
        $string = substr($stringCut,0, strrpos($stringCut,' ')). " ...";
       return(substr($string,0,$lenght));
    }
    return $string;
}

include "addArticle.phtml";