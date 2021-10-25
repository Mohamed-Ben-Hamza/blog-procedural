<?php
include $_SERVER["DOCUMENT_ROOT"].'/blog/database.php';


session_start();

if(isset($_SESSION['user']))
$_SESSION['user'];






include 'index.phtml';
