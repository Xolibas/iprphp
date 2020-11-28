<?php
    session_start();
    require('../db.php');
    if (empty($_SESSION['username'])) {
        $_SESSION['messages'][] = 'You must login to do this.';
        header('Location: ../Account/loginf.php');
        exit;
    }
    if (isset($_POST['submit']) && (!empty($_POST['title'])&& (!empty($_POST['text']))))
    {
        $data = $_POST;
        $status = (isset($_POST['status']))? 1 : 0;
        do{
            $id = uniqid();
            $statement = $connection->prepare('SELECT COUNT(*) FROM posts WHERE id = '.$id.'');
            $statement->execute();
            $countp = $statement->fetchColumn();
        }
        while($countp>0);
        if($statement = $connection->prepare('INSERT INTO posts (id, title, text, status,user_id,created_at) VALUES (:id, :title, :text, :status, :user_id, :created_at)')){
            $result = $statement->execute([
                ':id' => $id,
                ':title' => $data['title'],
                ':text' => $data['text'],
                ':status' => $status,
                ':user_id' => $_SESSION['id'],
                ':created_at' => date('d-m-y h:i:s'),
            ]);

            if($result){
                $_SESSION['messages'][] = 'Post is succesfully added.';
                header('Location: myposts.php');
                exit;
            }
        }
    }
    else
    {
        if ((isset($_POST['submit']))&&(empty($_POST['title'])))
        {
            $_SESSION['messages'][] = 'Title is empty!';
            header('Location: create.php');
            exit;
        }
        if ((isset($_POST['submit']))&&(empty($_POST['text'])))
        {
            $_SESSION['messages'][] = 'Post text is empty!';
            header('Location: create.php');
            exit;
        }
    }
?>