<?php

session_start();
require('../db.php');
$data = $_POST;

if (empty($data['username']) || empty($data['password']))
{
    $_SESSION['messages'][] = 'Username or password are required!';
    header('Location: loginf.php');
    exit;
}

$username = $data['username'];
$password = $data['password'];

$statement = $connection->prepare('SELECT * FROM users WHERE username = :username');
$statement->execute(['username'=> $username]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if (empty($result)){
    $_SESSION['messages'][] = 'No user with this username!';
    header('Location: loginf.php');
    exit;
}

$user = array_shift($result);

if($user['username'] === $username && $user['password'] === $password){
    $_SESSION['username'] = $user['username'];
    $_SESSION['id'] = $user['id'];
    header('Location: ../index.php');
} else {
    $_SESSION['messages'][] = 'Incorrect username or password!';
    header('Location: loginf.php');
    exit;
}