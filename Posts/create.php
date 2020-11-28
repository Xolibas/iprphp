<?php 
session_start();
require('../header.php');
require('createc.php'); 
?>
<html lang="en">
<head>
  <title>Post creating</title>
</head>
<body>
  <h1>Post</h1>
  <?php require_once '../Account/messages.php' ?>
    <form method="post" action="createc.php">
      Title: <input type="text" name="title" /><br />
      Text: <input type="text" name="text" /><br />
      Active: <input type="checkbox" name="status" /><br />
      <input type="submit" value="Create" name="submit" />
    </form>
</body>
<?php require_once('../footer.php'); ?>
</html> 