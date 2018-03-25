<?php
if(file_exists("./vues/header.php")) {
	require_once("./vues/header.php");
}
?>

<section class="todoPanel">
		<p class="topTitle">Inscription : </p>
		<form action="" method="POST">
			<div class="contentNote">
				<table class="loginTable">
					<tr><td>Nom de compte : </td><td><input type="text" name="login" placeholder="Nom de compte"></td></tr>
					<tr><td>Mot de passe : </td><td><input type="password" name="password" placeholder="Mot de Passe"></td></tr>
				</table>
				<div class="contentFooter">
					<p class="err"><?php echo $error; ?></p>
					<button class="btnAdd" type="submit" name="submit">Valider</button>
				</div> 
			</div>
		</form>
<?php
if(file_exists("./vues/footer.php")) {
    require_once("./vues/footer.php");
}
?>


