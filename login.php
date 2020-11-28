<?php

session_start();
require('db.php');
$data = $_POST;

if (empty($data['username']) || empty($data['password']))
{
    die('Username or password are required!');
}

$username = $data['username'];
$password = $data['password'];

$statement = $connection->prepare('SELECT * FROM users WHERE username = :username');
$statement->execute(['username'=> $username]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if (empty($result)){
    die('No user with this username!');
}

$user = array_shift($result);

if($user['username'] === $username && $user['password'] === $password){
    $_SESSION['username'] = $user['username'];
    $_SESSION['id'] = $user['id'];
    header('Location: index.php');
} else {
    die('Incorrect username or password!');
}