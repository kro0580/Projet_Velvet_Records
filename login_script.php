<?php

session_start();

require "connexion.php";
$db = connexionBase();

if (isset ($_POST['valid_login']))
{

///// DECLARATION REGEX /////

$passwordPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!?*$@%_])([-+!?*$@%_\w]{8,15})$/";

///// DECLARATION VARIABLE /////

$mail = $_POST['email'];
$password = $_POST['password'];

///// TABLEAU ERREUR /////

$formError = [];

///// REQUETE PREPAREE /////

// REQUETE POUR RECHERCHER L'UTILISATEUR //
$requete_mail = "SELECT * FROM utilisateur WHERE users_mail = :users_mail";
$pdoStat= $db->prepare($requete_mail);
$pdoStat->bindValue(':users_mail', $mail, PDO::PARAM_STR);
$pdoStat -> execute();

$user = $pdoStat ->fetch(PDO::FETCH_OBJ);

// REQUETE POUR BLOQUER L'UTILISATEUR //
$users_block = $db->prepare("UPDATE utilisateur SET users_block = :users_block WHERE users_mail = :users_mail");

///// CONDITIONS DE VALIDATION /////

if($_POST['email'] === "" || $_POST['password'] === "")
{
    $formError['input_empty'] = 'input_empty=true';
}

// Si le fetch() ne renvoie rien
elseif(empty($user))
{
    $formError['compte'] = 'compte=true';
}

elseif(!preg_match($passwordPattern, $_POST['password']))
{
    $formError['password_invalid'] = 'password_invalid=true';
}

elseif($user->users_block === "1"){
    $formError['compte_b'] = 'compte_b=true';
}

// Si le mot de passe saisi correspond au mot de passe enregistré dans la BDD, alors l'utilisateur peut se connecter
elseif(password_verify($_POST['password'], $user->users_mdp))
{
    $_SESSION["identifiant"] = $mail;
    header("Location: index.php");
}
else
{
    $formError['wrong'] = 'wrong=true';

        if(!isset($_SESSION['essai']))
        {
            $_SESSION['essai'] = 1;
        }
        else
        {
            $_SESSION['essai'] ++;
            // var_dump($_SESSION['essai']);
                if($_SESSION['essai'] > 3)
                {
                    $formError['essai'] = 'essai=true';
                    
                    $users_block->bindValue(':users_mail', $mail, PDO::PARAM_STR);
                    $users_block->bindValue(':users_block', true, PDO::PARAM_BOOL);
                    $users_block->execute();

                    // Destruction de la session essai pour que le compteur s'arrête
                    unset($_SESSION['essai']);
                        if (ini_get("session.use_cookies"))
                            {
                                setcookie(session_name(), '', time()-42000);
                            }
                            session_destroy();
                }
        }
}
    if(count($formError) !== 0) 
    {
        $sUrl = implode("&", $formError); // Alors on regroupe toutes les erreurs
        header("Location:login_form.php?".$sUrl); // On affiche les erreurs dans le formulaire formulaire.php
        exit; // Arrêt de la condition
    }
}    

?>