<?php session_start();
if (empty($_SESSION['username'])) {
    session_destroy();
    session_start();
    $_SESSION['messages'][] = 'You must login to do this.';
    header('Location: loginf.php');
    exit;
  }
require('../header.php');
require('../db.php'); 
?>
<html lang="en">
    <head>
        <title>My posts</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body style="text-align: center">
        <h1><?php echo $_SESSION['username']?>'s posts</h1>
        <?php
            $statement = $connection->prepare("SELECT COUNT(*) FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.username = '".$_SESSION['username']."'");
            $statement->execute();
            $posts = $statement->fetchColumn();
            if($posts!=0){
                $num = 10;
                $page = $_GET['page'];
                $total = (int)(($posts - 1) / $num) + 1;
                $page = (int)($page);
                if(empty($page) or $page < 0) $page = 1;
                if($page > $total) $page = $total;
                $start = $page * $num - $num;
                $statement = $connection->prepare("SELECT title, posts.id AS id, text FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.username = '".$_SESSION['username']."' LIMIT $start, $num");
                $statement->execute();
                echo "<table><tr><td>Title</td><td colspan=\"2\">Action</td></tr>";
                foreach($statement->fetchAll() as $postrow)
                {
                    echo "<tr>
                        <td><a href='post.php?id=".$postrow['id']."'>".$postrow['title']."</a></td>
                        <td><a href='edit.php?id=".$postrow['id']."'>Edit</a></td>
                        <td><a href= delete.php?id=".$postrow['id'].">Delete</a></td></tr>
                    <tr><td colspan=\"4\">".$postrow['text']."</td></tr>";
                }
                echo "</table>";
                require('mpagination.php');
            }
            else echo"There is no posts.";
        ?>
    </body>
    <?php require_once('../footer.php'); ?>
</html>