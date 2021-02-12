<?php

require "connexion.php";
$db = connexionBase();

if (isset ($_POST['valid_add']))
{

///// DECLARATION REGEX /////
    
$yearPattern = "/^(?:(?:19|20)[0-9]{2})$/";
$pricePattern = "/^[0-9]{1,3}(,[0-9]{3})*(([\\.,]{1}[0-9]*)|())$/";
    
///// TABLEAU ERREUR /////

$formError = [];

///// REQUETE PREPAREE /////
    
// Requête SQL pour insérer les valeurs ajoutées dans le formulaire d'ajout
$pdoStat = $db ->prepare("INSERT INTO disc(disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id)
VALUES(:disc_title, :disc_year, :disc_picture, :disc_label, :disc_genre, :disc_price, :artist_id)");

///// CONDITIONS D'INSERTION /////

// TITRE //
    
if(!empty($_POST['disc_title'])) 
{
$disc_title = $_POST['disc_title'];
}  
else 
{
$formError['disc_title'] = 'disc_title=true';
}

// ANNEE //

if(!empty($_POST['disc_year'])) 
{
    if(preg_match($yearPattern, $_POST['disc_year']))
    {
    $disc_year = $_POST['disc_year'];
    }
    else
    {
        $formError['disc_year'] = 'disc_year=true';
    }
}
else
{
    $formError['disc_year'] = 'disc_year=true';
}

// LABEL //

if(!empty($_POST['disc_label'])) 
{
$disc_label = $_POST['disc_label'];
}  
else 
{
$formError['disc_label'] = 'disc_label=true';
}

// GENRE //

if(!empty($_POST['disc_genre'])) 
{
$disc_genre = $_POST['disc_genre'];
}  
else 
{
$formError['disc_genre'] = 'disc_genre=true';
}

// PRIX //

if(!empty($_POST['disc_price'])) 
{
    if(preg_match($pricePattern, $_POST['disc_price']))
    {
    $disc_price = $_POST['disc_price'];
    }
    else
    {
        $formError['disc_price'] = 'disc_price=true';
    }
}
else
{
    $formError['disc_price'] = 'disc_price=true';
}

// IMAGE //

// Vérifie si le fichier a été uploadé sans erreur.
if (!empty($_FILES["fichier"]) && $_FILES["fichier"]["error"] == 0)
{
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["fichier"]["name"];
    $filetype = $_FILES["fichier"]["type"];
    $filesize = $_FILES["fichier"]["size"];

    // Vérifie l'extension du fichier
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed))
    {
        $formError['disc_picture'] = 'disc_picture=true';
    }

    // Vérifie la taille du fichier - 5Mo maximum
    $maxsize = 5 * 1024 * 1024;
    if ($filesize > $maxsize) 
    {
        $formError['disc_picture'] = 'disc_picture=true';
    }

    // Vérifie le type MIME du fichier
    if (in_array($filetype, $allowed))
    {
        // Vérifie si le fichier existe avant de le télécharger.
        if (file_exists("pictures/" . $_FILES["fichier"]["name"]))
        {
            $image = $filename;
        }
        else
        {
            move_uploaded_file($_FILES["fichier"]["tmp_name"], "pictures/" . $_FILES["fichier"]["name"]);
            $image = $filename;
        }
    }

} 

else
    {
        $formError['disc_picture'] = 'disc_picture=true';
    }

// ARTISTE //

if(isset($_POST['artist_id'])) 
{
$artist_id = $_POST['artist_id'];
}  
else 
{
$formError['artist_id'] = 'artist_id=true';
}

///// SI PAS D'ERREUR /////

if(count($formError) === 0) 
{
    $pdoStat->bindValue(':disc_title', $disc_title, PDO::PARAM_STR);
    $pdoStat->bindValue(':disc_year', $disc_year, PDO::PARAM_INT);
    $pdoStat->bindValue(':disc_picture', $image, PDO::PARAM_STR);
    $pdoStat->bindValue(':disc_label', $disc_label, PDO::PARAM_STR);
    $pdoStat->bindValue(':disc_genre', $disc_genre, PDO::PARAM_STR);
    $pdoStat->bindValue(':disc_price', $disc_price, PDO::PARAM_STR);
    $pdoStat->bindValue(':artist_id', $artist_id, PDO::PARAM_INT);

    $pdoStat ->execute();
    header("Location:index.php");

}
else
{
    $sUrl = implode("&", $formError); // Alors on regroupe toutes les erreurs
    header("Location:add_form.php?".$sUrl); // On affiche les erreurs dans le formulaire formulaire.php
    exit; // Arrêt de la condition
}

}