<?php

// MySQL Config //

$config["host"] = "localhost"; // Serveur mysql
$config["database"] = "dbdopenot"; // Le nom de la base de données
$config["username"] = "dopenot"; // L'utilisateur de la db
$config["password"] = "dopenot"; // Mot de passe de l'utilisateur
$config["maxPerPage"] = 10; // Définit le maximum de note pouvant être affiché par page

// Definition des vues

$vues["erreur"] = "./vues/erreur.php";
$vues["ajouterNote"] = "./vues/ajouterNote.php";
$vues["gestionListes"] = "./vues/gestionListes.php";
$vues["vuePrincipal"] = "./vues/vuePrincipal.php";
$vues["login"] = "./vues/login.php";
$vues["addListe"] = "./vues/addListe.php";
$vues["register"] = "./vues/register.php";