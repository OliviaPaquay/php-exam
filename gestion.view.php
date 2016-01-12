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
                <label for="email">Ajouter une adresse e-mail</label>
                <input type="text" id="email" name="email" placeholder="exemple@mail.com">
                <?php echo message_erreur($errors, 'email'); ?>
            </div>
            <input type="submit" name="inscription" value="Ajouter">
        </form>
        
        <?php
        $query = $connexion->prepare('SELECT * FROM users WHERE state = :state');
        $query->bindValue(':state', 'on');
        $query->execute();
        $user_confirmed = $query->fetch();
        ?>
        
        
       
      