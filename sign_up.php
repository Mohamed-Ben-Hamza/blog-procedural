<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';

$errors = [];

    if (isset($_POST['valider'])) {
        $username = trim(htmlspecialchars($_POST['username'])) ;
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $validatemail = filter_var($email, FILTER_VALIDATE_EMAIL);


   
        if (empty($username)) {
            $errors['username'] = "username is empty";
         
        }
        elseif(strlen($username)<4)
        {
        $errors['username']=" username must be  4 caractere";
        }
        else{
            $sql = "SELECT   username FROM `users` WHERE username=? " ;
            $result1 = $conn->prepare($sql);
            $result1->execute([$username]);
            $res = $result1->fetch(PDO::FETCH_ASSOC);
            
                if($res){
    
                    $errors['username']="username exist";
                }
        }
      

        if(empty($email)){
            $errors['email'] = "email is empty";
          
        }
        elseif(!$validatemail){
            $errors['email'] = "email is invalid";
        }
        else{
            
            $sql1 = "SELECT email FROM `users` WHERE email=? " ;
        $result1 = $conn->prepare($sql1);
        $result1->execute([$validatemail]);
        $res1 = $result1->fetch(PDO::FETCH_ASSOC);
      
            if($res1){
                $errors['email']="email exist";
            }    
        }
        
       
       

        if(empty($password)){
            
            $errors['password'] = "password is empty";
         
        }
        elseif(strlen($password)<5){
            $errors['password']=" password  must be  5 caractere";
        }
       

        if(empty($errors)){

      

        $query = "
INSERT INTO
users
(username,admin, email, password, created_at)
VALUES
(?, 0,?, ?, NOW())
";
        $pwdhashed=password_hash($password,PASSWORD_BCRYPT);
        $result = $conn->prepare($query);
        $result->execute([$username, $validatemail, $pwdhashed]);
        
        $_SESSION['flush']="Account created";    
         

        header('location:sign_in.php');
        
    
    }
}

if(isset($_SESSION['user'])){
    if($_SESSION['user']){
        header('location:index.php');
    }
    }
    



include "sign_up.phtml";
