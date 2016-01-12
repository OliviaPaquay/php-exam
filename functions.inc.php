<?php

function is_valid_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function message_erreur($errors, $input){
    
    if(count($_POST)>0 && $errors[$input] != ''){
        return $errors[$input];
    }
    
}

function emailExists($connexion, $email){
    $query = $connexion->prepare('SELECT COUNT(*) AS total FROM users WHERE email = :email');
    $query->bindValue(':email', $email);
    $query->execute();
    if($result = $query->fetch()){
        return !empty($result['total']);
    }
    return false;
}

?>