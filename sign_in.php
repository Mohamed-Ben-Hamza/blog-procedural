<?php
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';

  
        session_start();


$error =[];


 function flushmessage(){
if(isset($_SESSION['flush'])){
  echo $_SESSION['flush'];}
 

 

}









     if(isset(($_POST['login']))){
// $username = trim(htmlspecialchars($_POST['username'])) ;
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$validatemail = filter_var($email, FILTER_VALIDATE_EMAIL);

$sql = "SELECT * FROM `users` WHERE email=?   " ;
$result1 = $conn->prepare($sql);
$result1->execute([$validatemail]);
$res = $result1->fetch(PDO::FETCH_ASSOC);
    if($res){
        if(password_verify($password,$res['password'])){
            $_SESSION['user']=$res;
            header('location:index.php');
        }
        else{
             $error['login']="email or password is not correct";

        }
    }
    else{
        $error['login']="email or password is not correct";
    }

    $_SESSION['user']=$res;
    
}




if(isset($_SESSION['user'])){
if($_SESSION['user']){
    header('location:index.php');
}
}





include "sign_in.phtml";