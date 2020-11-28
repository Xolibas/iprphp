<?php session_start();
    require('../db.php'); 
    $id = $_GET['id'];
    $statement = $connection->prepare("SELECT * FROM posts WHERE posts.id = '".$id."' AND (posts.user_id = ".$_SESSION['id']." OR posts.status = 1) LIMIT 1");
    $statement->execute();
    $post = $statement->fetch();
    if(empty($post))
    { 
        $_SESSION['messages'][] = 'This post is not available';
        require('myposts.php');
    }
    else{
        $status;
        $status=$post['status']; 
        require('sharing.php');
    }
?>