<!DOCTYPE html>
<html lang="fr-FR">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<link rel="stylesheet" href="./src/css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800" rel="stylesheet">
	<title>TODO List</title>
</head>
<body>
	<div class="content">
		<nav>
			<div class="nav_content">
				<p class="logo"><a href="./">TODO List</a></p>
			</div>
			<div class="nav_link">
				<ul>
					<li>
						<a href="./">Accueil</a>
					</li>
					<li>
						<div class="link">
							<a href="?action=gestionListes">Gestion Listes</a>
						</div>
					</li>
					<?php if(isset($_SESSION["user"])){ ?>
					<li>
						<div class="link">
							<a href="?action=logout">Deconnexion <?php echo $_SESSION["user"]; ?></a>
						</div>
					</li>
					
					<?php }else{?>
					<li>
						<div class="link">
							<a href="?action=login">Connexion</a>
						</div>
					</li>
					<li>
						<div class="link">
							<a href="?action=register">S'inscrire</a>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</nav>