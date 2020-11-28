<?php
session_start();
require('../db.php');   
$statement = $connection->prepare("SELECT COUNT(*) FROM posts WHERE posts.id = '".$_GET['id']."' AND posts.user_id = '".$_SESSION['id']."'");
$statement->execute();
$posts = $statement->fetchColumn();
$statement = $connection->prepare("SELECT status FROM posts WHERE posts.id = '".$_GET['id']."'");
$statement->execute();
$status = $statement->fetchColumn();
if($status==1){ $_SESSION['messages'][] = "This post is active"; header('Location: myposts.php'); exit;}
else
{
    if($posts>0){
        if($statement = $connection->prepare("DELETE p FROM posts p WHERE p.id = :id")){
            $statement->execute(array('id'=>$_GET['id']));
            header('Location: myposts.php');
            exit;
        }
    }
    else{ $_SESSION['messages'][] = "It's not your post."; header('Location: myposts.php'); exit;}
}