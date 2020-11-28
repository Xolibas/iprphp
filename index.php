<?php session_start();
require('header.php');
require('db.php'); ?>
<html lang="en">
    <head>
        <title>Posts</title>
    </head>
    <body style="text-align: center">
        <h1>All posts</h1>
        <?php
            $statement = $connection->prepare("SELECT COUNT(*) FROM posts WHERE posts.status = true");
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
                $statement = $connection->prepare("SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.status = true LIMIT $start, $num");
                $statement->execute();
                echo "<table>";
                foreach($statement->fetchAll() as $postrow)
                {
                    echo "<tr>
                        <td>".$postrow['title']."</td>
                        <td>".$postrow['username']."<td></tr>
                    <tr><td colspan=\"2\">".$postrow['text']."</td></tr>";
                }
                echo "</table>";
                require('pagination.php');
            }
            else echo"There is no posts.";
        ?>
    </body>
</html>