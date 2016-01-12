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
        <a href="admin.php" class="uppercase admin-button">Admin</a>
        <?php

            if(count($_POST) > 0) {
            
                // 1.Honeypot
                
                if($_POST['name'] != ''){
                    die('Spammeur !');
                }
                
                // 2.Nettoyage
                
                $email = trim(strip_tags($_POST['email']));
                
                // 3.Validation
                
                $errors = array();
                
                if(!is_valid_email($email)) {
                    $errors['email'] = 'Vous devez entrer une adresse email valide.';
                } else if(emailExists($connexion, $email)){
                    $errors['email'] = 'Cette adresse email est déjà dans notre base de données.';
                }
                
                if(count($errors) < 1){
                    
                    $uniqid = uniqid();
                    include 'mail.inc.php';
                    
                    $sql = 'INSERT INTO users(user_id, email, date, state) VALUES(:user_id, :email, now(), :state)';
                    $preparedStatement = $connexion->prepare($sql);
                    $preparedStatement->bindValue('user_id', $uniqid);
                    $preparedStatement->bindValue('email', $email);
                    $preparedStatement->bindValue('state', 'off');
                    $preparedStatement->execute();
                }
            
            }

        ?>
        <form class="inscription-form" method="post">
            <label class="name" for="name">Name</label>
            <input class="name" type="text" id="name" name="name">
            <div>
                <label for="email">Inscription à la newsletter</label>
                <input type="text" id="email" name="email" placeholder="exemple@mail.com">
                <?php echo message_erreur($errors, 'email'); ?>
            </div>
            <input type="submit" name="inscription" value="Inscription">
        </form>
    </body>
</html>