<?php session_start();
if(empty($_SESSION['username'])) header('Location: Account/loginf.php');
else header('Location: Posts/myposts.php');
?>