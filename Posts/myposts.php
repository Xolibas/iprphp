<?php
    session_start();
    require('../header.php');
    require('mypostsc.php');
?>
<html lang="en">
    <head>
        <title>My posts</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body style="text-align: center">
        <h1><?php echo $_SESSION['username']?>'s posts</h1>
        <?php require_once '../Account/messages.php' ?>
        <table>
            <tr><td>Title</td><td colspan="2">Action</td></tr>
            <?php foreach($statement->fetchAll() as $postrow) { ?>
            <tr><td><a href='post.php?id=<?php echo $postrow['id']; ?>'><?php echo $postrow['title']; ?></a></td>
            <td><a href='edit.php?id=<?php echo $postrow['id']; ?>'>Edit</a></td>
            <td><a href= 'delete.php?id=<?php echo $postrow['id'] ?>'>Delete</a></td></tr>
            <tr><td colspan="4"><?php echo $postrow['text'] ?></td></tr>
            <?php } ?>
        </table>
    <?php require('mpagination.php'); 
        require_once('../footer.php'); 
?>