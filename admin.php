<?php
    include_once ('initialization.php');
?>
   

<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Exam</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    </head>
    
    <body>
      <?php
       if ($_SESSION['logged_in'] != 'ok'){
           
           if (count($_POST) > 0){
               
               // 1. Honeypot
               if ($_POST['name'] != '') {
                   die('Raté !');
               }
               
               // 2. Nettoyage
               $username = trim(strip_tags($_POST['username']));
               $password = trim(strip_tags($_POST['password']));
               
               // 3. Validation
               $errors = array();
               
               if ($username == '') {
                   $errors['username'] = 'Veuillez entrer votre nom d\'utilisateur';
               }
               
               if ($password == '') {
                   $errors['password'] = 'Veuillez entrer votre mot de passe';
               }
               
               if (count($errors) < 1) {
                   if($username == $admin_username && $password == $admin_password){
                       $_SESSION['logged_in'] = 'ok';
                   }
               }
               
           }
           
           include 'login.view.php';
           
       } else {
           include 'gestion.view.php';
       }
      ?>
   </body>
   
</html>