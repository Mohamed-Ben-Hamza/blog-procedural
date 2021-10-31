<?php

include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';
session_start();






$sql= "DELETE FROM comments WHERE id=?   ";
$result1 = $conn->prepare($sql);
$result1->execute([$_GET['id']]);


header( "location:article.php?id=".$_GET['postId']);