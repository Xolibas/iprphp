<?php session_start();
if (!empty($_SESSION['username'])) {
  header('Location: ../index.php');
  exit;
}
require_once('../header.php');
?>
<html lang="en">
<head>
  <title>User Registration</title>
</head>
<body>
  <h1>Register</h1>
    <?php require_once 'messages.php'; ?>
    <form action="signup.php" method="POST">
      Username: <input type="text" name="username" /><br />
      Email: <input type="text" name="email" /><br />
      Password: <input type="password" name="password" /><br />
      Confirm password: <input type="password" name="password_confirm" /><br />
      <input type="submit" value="Register" />
    </form>
</body>
<?php require_once('../footer.php'); ?>
</html> 