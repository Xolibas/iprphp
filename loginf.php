<?php session_start();
if (!empty($_SESSION['username'])) {
    header('Location: index.php');
    exit;
  }
  require_once('header.php');
?>
<html lang="en">
    <head>
        <title>User Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <?php require_once 'messages.php'; ?>
        <form action="login.php" method="POST">
            Username: <input type="text" name="username" /><br />
            Password: <input type="password" name="password" /><br />
            <input type="submit" value="Login" />
        </form> 
    </body>
    <?php require_once('footer.php'); ?>
</html>