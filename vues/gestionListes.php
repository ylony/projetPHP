<?php
if(file_exists("./vues/header.php")) {
	require_once("./vues/header.php");
}
?>
<script type="text/javascript">
function ConfirmDelete(type){
	if (confirm("Attention cette action est irréversible ! Êtes-vous certains ?")){
		if(type == "public"){
	   		var option = document.getElementById("selectPublic");
	   	}
	   	else{
	   		var option = document.getElementById("selectPrivate");
	   	}
			var id = option.options[option.selectedIndex].value;
	      	document.location.href="./?action=deleteListe&id=" + id;
	   }
}
</script> 
<section class="todoPanel">
		<p class="topTitle">Gestion des listes</p>

		<div class="contentNote">
			<p class="subTitle">Les listes publiques :</p>
				<?php $i = 0; if(empty($dataListeNotePublic[$i])){ echo "<p class=err>Aucune liste n'a été trouvé dans la DB</p>" ; } 
				else {
					echo "<select class=subSelect name=liste id=selectPublic>";
					while(isset($dataListeNotePublic[$i])) { ?>	
						<option <?php echo "value='".$dataListeNotePublic[$i]->getListeId()."'>".$dataListeNotePublic[$i]->getNom()."</option>"; ?>
					<?php $i++;} ?>	
				</select>
				<button class="btnDelete" onclick="ConfirmDelete('public');">Supprimer cette liste</button>
				<?php } ?>
			<p class="subTitle">Vos listes privés :</p>
				<?php $i = 0; if(empty($dataListeNotePrivate[$i]) && empty($_SESSION["user"])){ echo "<p class=err>Vous devez être connecté pour accéder à vos listes perso</p>"; }
							  elseif(empty($dataListeNotePrivate[$i])){ echo "<p class=err>Aucune liste n'a été trouvé dans la DB</p>" ;}
							  else {
									echo "<select class=subSelect name=liste id=selectPrivate>";
									while(isset($dataListeNotePrivate[$i])) { ?>	
										<option <?php echo "value='".$dataListeNotePrivate[$i]->getListeId()."'>".$dataListeNotePrivate[$i]->getNom()."</option>"; ?>
									<?php $i++; } ?>	
								</select>
								<button class="btnDelete" onclick="ConfirmDelete('private');">Supprimer cette liste</button>
							<?php } ?>
				<div class="contentFooter">
					<a href="?action=addListe"><button class="btnAdd">Ajouter une liste</button></a>
				</div>
		</div> 
<?php
if(file_exists("./vues/footer.php")) {
    require_once("./vues/footer.php");
}
?>


