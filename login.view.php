<form method="post">
        <ul>
            <li class="name">
                <label for="name">Mail</label>
                <input type="text" name="name" id="name" value="">
            </li>
            <li>
                <label for="username">Nom d'utilisateur * :</label>
                <input type="text" name="username" id="username" value="">
                <?php echo message_erreur($errors, 'username'); ?>
            </li>
            <li>
                <label for="password">Mot de passe * :</label>
                <input type="password" name="password" id="password">
                <?php echo message_erreur($errors, 'password'); ?>
            </li>
            <li>
                <input type="submit" value="Connexion" name="connexion">
            </li>
        </ul>
</form>