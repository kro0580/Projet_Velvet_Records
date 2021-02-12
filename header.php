<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Site Velvets Records - Bootstrap</title>
  <!-- Normalize CSS -->
  <link rel="stylesheet" href="./assets/normalize.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Feuille de style CSS -->
  <link rel="stylesheet" href="./assets/style.css">
  
  <!-- Penser par la suite à ajouter le lien vers le fichier normalize.css qui est une feuille de style dans laquelle on applique aux éléments HTML une réinitialisation des valeurs à 0 -->
</head>

<body>

<header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Velvet Records</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_form.php">Ajouter un vinyle</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Espace Client</a>
        <div class="dropdown-menu bg-dark">
          <?php if (!isset($_SESSION["identifiant"])) 
          { ?>
          <a class="dropdown-item" href="registration_form.php">Inscription</a>
          <a class="dropdown-item" href="login_form.php">Connexion</a>
          <?php 
          } else 
          { ?>
          <a class="dropdown-item" href="logout_script.php">Déconnexion</a>
          <?php
          }
          ?>
        </div>
      </li>
    </ul>
  </div>
</nav>

</header>