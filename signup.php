<?php

session_start();
require('db.php');
$data = $_POST;

if (empty($data['username']) ||
    empty($data['password']) ||
    empty($data['email']) ||
    empty($data['password_confirm'])) {
    $_SESSION['messages'][] = "Please fill all required fields!";
    header('Location: register.php');
    exit;
}
if(strlen($data['password'])<=5 ||
!preg_match("/^(?=.*[A-Z])(?=.*\d).*$/",$data['password'])){
    $_SESSION['messages'][] = "Password must have:";
    $_SESSION['messages'][] = "- not less, than 6 letters;";
    $_SESSION['messages'][] = "- minimum one numeric;";
    $_SESSION['messages'][] = "- minimum one character in uppercase.";
    header('Location: register.php');
    exit;
}
if ($data['password'] !== $data['password_confirm']) {
    $_SESSION['messages'][] = "Password and Confirm password should match!";  
    header('Location: register.php');
    exit; 
}

$statement = $connection->prepare('SELECT * FROM users WHERE username = :username OR email  = :email');
if($statement){
    $statement->execute([
        ':username' => $data['username'],
        ':email' => $data['email'],
    ]);

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($result)){
        $_SESSION['messages'][] = 'User with this username is already exists!';
        header('Location: register.php');
        exit;
    }
}

$statement = $connection->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
if($statement){
    $result = $statement->execute([
        ':username' => $data['username'],
        ':email' => $data['email'],
        ':password' => $data['password'],
    ]);

    if($result){
        $_SESSION['messages'][] = 'Thank you for registration.';
        header('Location: loginf.php');
        exit;
    }
}

