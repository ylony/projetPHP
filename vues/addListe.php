<?php
if(file_exists("./vues/header.php")) {
	require_once("./vues/header.php");
}
?>
<section class="todoPanel">
		<p class="topTitle">Ajouter une Liste :</p> 
		<div class="contentNote">
		<form action="" method="POST">
			<table class="addListeTable">
				<tr><td><p class="subTitle">Nom :</p></td><td><input type="text" name="listeName" placeholder="Nom de la liste"></td></tr>	
				<tr><td><p class="subTitle">Liste privé ? :</p></td><td><input name="isPrivate" type="checkbox" value="private"></td></tr>
			</table>
			<div class="contentFooter">
				<button class="btnAdd" type="submit" name="submit">Valider</button>
			</div>
		</form>
		</div>
</section>
<?php
if(file_exists("./vues/footer.php")) {
    require_once("./vues/footer.php");
}
?>
