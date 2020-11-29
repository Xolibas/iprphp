<?php session_start();
    require('../db.php'); 
    $id = $_GET['id'];
    if(!empty($_SESSION['id']))
    {
        $statement = $connection->prepare("SELECT * FROM posts WHERE posts.id = '".$id."' AND (posts.user_id = ".$_SESSION['id']." OR posts.status = 1) LIMIT 1");
    }
    else
    {
        $statement = $connection->prepare("SELECT * FROM posts WHERE posts.id = '".$id."' AND posts.status = 1 LIMIT 1");
    }
    $statement->execute();
    $post = $statement->fetch();
    if(empty($post))
    { 
        $_SESSION['messages'][] = 'This post is not available';
        if(!empty($_SESSION['id'])) header('Location: ../Posts/myposts.php');
        else header('Location: ../Account/loginf.php');
    }
    else{
        $status=$post['status'];
    }
?>