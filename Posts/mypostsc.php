<?php session_start();
if (empty($_SESSION['username'])) {
    $_SESSION['messages'][] = 'You must login to do this.';
    header('Location: ../Account/loginf.php');
    exit;
  }
require('../db.php'); 
?>
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
            }
            else $_SESSION['messages'][] = "There is no posts.";
        ?>
    </body>
</html>