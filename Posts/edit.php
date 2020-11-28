<?php 
session_start();

if (empty($_SESSION['username'])) {
    session_destroy();
    session_start();
    $_SESSION['messages'][] = 'You must login to do this.';
    header('Location: ../Account/loginf.php');
    exit;
}
if(empty($_GET['id'])) header('Location: ../Posts/myposts.php');
require_once('../header.php');
require('../db.php'); 
?>
<html lang="en">
<head>
  <title>Post creating</title>
</head>
<body>
  <h1>Post</h1>
    <?php
        $id = $_GET['id'];
        $statement = $connection->prepare("SELECT * FROM posts WHERE posts.id = ".$id." AND posts.user_id = ".$_SESSION['id']);
        $statement->execute();
        $row = $statement->fetch();
        if (isset($_POST['submit']) && (!empty($_POST['title'])&& (!empty($_POST['text']))))
        {
            $data = $_POST;
            $status = (isset($_POST['status']))? 1 : 0;
            try{
            if($statement = $connection->prepare("UPDATE posts SET title = '".$data['title']."', text= '".$data['text']."', status = ".$status." WHERE posts.id = ".$data['id']."")){
                $result = $statement->execute();

                if($result){
                    echo 'Post is succesfully modified.';
                }
            }
            }
            catch (PDOException $exception) {
                die('Connection failed: '. $exception->getMessage());

            }
        }
        else
        {
            if ((isset($_POST['submit']))&&(empty($_POST['title'])))
            {
                echo 'Title is empty!';
            }
            if ((isset($_POST['submit']))&&(empty($_POST['text'])))
            {
                echo 'Post text is empty!';
            }
        }
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
      Title: <input type="text" name="title" value="<?php echo $row['title'] ?>"/><br />
      Text: <input type="text" name="text" value="<?php echo $row['text'] ?>"/><br />
      Active: <input type="checkbox" name="status"/><br />
      <input type="submit" value="Edit" name="submit" />
    </form>
</body>
<?php require_once('../footer.php'); ?>
</html> 