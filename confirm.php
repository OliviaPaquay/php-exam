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

        $user_id = $_GET['id'];

        $query = $connexion->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $query->bindValue(':user_id', $user_id);
        $query->execute();
        $user = $query->fetch();

        $errors = array();

        $inscription_date = $user['date'];
        $timesub = strtotime($inscription_date);
        $currenttime = time();

        if($user != '') {

            if ($user['state'] == 'off'){

                if($currenttime > ($timesub + 30*60)){

                    $query = $connexion->prepare('DELETE FROM users WHERE user_id = :user_id');
                    $query->bindValue(':user_id', $user_id);
                    $query->execute();

                    echo "Vous avez attendu trop longtemps avant de confirmer votre adresse e-mail, celle-ci a donc été supprimé de notre base de donnée. Réessayez";
                } else {
                    $query = $connexion->prepare('UPDATE users SET state = "on" WHERE user_id = :user_id');
                    $query->bindValue(':user_id', $user_id);
                    $query->execute();

                    echo "Votre inscription a bien été confirmée";
                }

            } else {
                $errors['state'] = 'Votre compte a déjà été vérifié.';
            }
        } 

        ?>
    </body>
</html>