<?php 
session_start();
if (empty($_SESSION['username'])) {
    session_destroy();
    session_start();
    $_SESSION['messages'][] = 'You must login to do this.';
    header('Location: ../Account/loginf.php');
    exit;
  }
require('../header.php');
require('../db.php'); 
?>
<html lang="en">
<head>
  <title>Post creating</title>
</head>
<body>
  <h1>Post</h1>
    <?php
        if (isset($_POST['submit']) && (!empty($_POST['title'])&& (!empty($_POST['text']))))
        {
            $data = $_POST;
            $status = (isset($_POST['status']))? 1 : 0;
            if($statement = $connection->prepare('INSERT INTO posts (title, text, status,user_id) VALUES (:title, :text, :status, :user_id)')){
                $result = $statement->execute([
                    ':title' => $data['title'],
                    ':text' => $data['text'],
                    ':status' => $status,
                    ':user_id' => $_SESSION['id'],
                ]);

                if($result){
                    echo 'Post is succesfully added.';
                }
                else
                {

                }
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
      Title: <input type="text" name="title" /><br />
      Text: <input type="text" name="text" /><br />
      Active: <input type="checkbox" name="status" /><br />
      <input type="submit" value="Create" name="submit" />
    </form>
</body>
<?php require_once('../footer.php'); ?>
</html> 