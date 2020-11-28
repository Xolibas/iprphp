<?php session_start();
require_once('../header.php');
require('editc.php');
?>
<html lang="en">
<head>
  <title>Post creating</title>
</head>
<body>
<h1>Post</h1>
<?php require_once '../Account/messages.php'; ?>
<form method="post" action="editc.php?id=<?php echo $_GET['id'];?>">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
    Title: <input type="text" name="title" value="<?php echo $row['title'] ?>"/><br />
    Text: <input type="text" name="text" value="<?php echo $row['text'] ?>"/><br />
    Active: <input type="checkbox" name="status" <?php if($row['status']==1) echo 'checked'; ?>/><br />
    <input type="submit" value="Edit" name="submit" />
</form>
</body>
<?php require_once('../footer.php'); ?>
</html> 