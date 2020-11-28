<?php session_start();
        if (empty($_SESSION['username'])) {
            session_destroy();
            session_start();
            $_SESSION['messages'][] = 'You must login to do this.';
            header('Location: ../Account/loginf.php');
            exit;
        }
        if(empty($_GET['id'])) header('Location: ../Posts/myposts.php');
        require('../db.php'); 
        $id = $_GET['id'];
        $statement = $connection->prepare("SELECT * FROM posts WHERE posts.id = '".$id."' AND posts.user_id = ".$_SESSION['id']);
        $statement->execute();
        $row = $statement->fetch();
        if (isset($_POST['submit']) && (!empty($_POST['title'])&& (!empty($_POST['text']))))
        {
            $data = $_POST;
            $status = (isset($_POST['status']))? 1 : 0;
            $updated_at = date('d-m-y h:i:s');
            if($statement = $connection->prepare("UPDATE posts SET title = '".$data['title']."', text= '".$data['text']."', status = ".$status.", updated_at = '".$updated_at."' WHERE posts.id = '".$data['id']."'")){
                $result = $statement->execute();

                if($result){
                    $_SESSION['messages'][] = 'Post is succesfully modified.';
                    header('Location: edit.php?id='.$id);
                    exit; 
                }
            }
        }
        else
        {
            if ((isset($_POST['submit']))&&(empty($_POST['title'])))
            {
                $_SESSION['messages'][] = 'Title is empty!';
                header("Location: edit.php?id=".$_GET['id']);
                exit; 
            }
            if ((isset($_POST['submit']))&&(empty($_POST['text'])))
            {
                $_SESSION['messages'][] = 'Post text is empty!';
                header("Location: edit.php?id=".$_GET['id']);
                exit; 
            }
        }
    ?>