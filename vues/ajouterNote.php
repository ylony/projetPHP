<?php
if(file_exists("./vues/header.php")) {
	require_once("./vues/header.php");
}
?>
<section class="todoPanel">
		<p class="topTitle">Ajouter une note :</p> 
		<div class="contentNoteAdd">
		<form action="" method="POST">
			<table>
				<tr><td>Message :</td><td><input type="text" name="message" placeholder="Message"></td></tr>
				<tr><td>Listes :</td><td>
				<?php
					$i = 0;  
					if(empty($dataListeNotePublic[$i])){ echo "<p class=err>Aucune liste n'a été trouvé dans la DB</p>" ; }
					echo "<select name=liste>";
					while(isset($dataListeNotePublic[$i])) { ?>	
						<option <?php echo "value='".$dataListeNotePublic[$i]->getListeId()."'>".$dataListeNotePublic[$i]->getNom()."</option>"; ?>
					<?php $i++; } 
					$i = 0;  
					while(isset($dataListeNotePrivate[$i])) { ?>	
						<option <?php echo "value='".$dataListeNotePrivate[$i]->getListeId()."'>".$dataListeNotePrivate[$i]->getNom()."</option>"; ?>
					<?php $i++; } ?>	
				</select></td></tr>
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
