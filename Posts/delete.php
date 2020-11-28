<?php
session_start();
require('../db.php');   
$statement = $connection->prepare("SELECT COUNT(*) FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = ".$_GET['id']." AND users.username = '".$_SESSION['username']."'");
$statement->execute();
$posts = $statement->fetchColumn();
if($posts>0)
    if($statement = $connection->prepare("DELETE p FROM posts p WHERE p.id = :id")){
        $statement->execute(array('id'=>$_GET['id']));
        header('Location: myposts.php');
        exit;
    }
    else{
        die('Query is incorrect.');
    }
else die("It's not your post.");
