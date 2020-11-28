<?php 
    $dsn = 'mysql:dbname=iprphp;host=localhost';
    $dbUser = 'root';
    $dbPassword = 'root';
    try{
        $connection = new PDO($dsn,$dbUser,$dbPassword);
    } catch (PDOException $exception) {
        header('Location: register.php');
        exit;
    }
    