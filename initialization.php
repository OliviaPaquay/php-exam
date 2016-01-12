<?php

    session_start();
    include_once('functions.inc.php');
    include_once('config.inc.php');
    try{
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        $connexion = new PDO($dsn, $user, $password);
    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }

    $admin_username = 'Oli';
    $admin_password = 'ViveLePHP';
?>