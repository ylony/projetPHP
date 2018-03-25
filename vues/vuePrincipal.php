<script type="text/javascript">
function choisirListe(id)
{
	document.location.href="./?selectedList="+ id;
}
</script>
<?php
if(file_exists("./vues/header.php")) {
	require_once("./vues/header.php");
}
?>
<section class="todoPanel">
		<p class="topTitle">Liste publique : 
		<?php
		$i = 0;
		global $config;  
		if(empty($dataListeNotePublic[$i])){ echo "<p class=err>Aucune liste n'a été trouvé dans la DB</p>" ; }
		echo "<select>";
		while(isset($dataListeNotePublic[$i])) { ?>	
			<option onclick="choisirListe(<?php echo $dataListeNotePublic[$i]->getListeId(); ?>)"<?php echo "value='".$dataListeNotePublic[$i]->getListeId()."'";if($dataListeNotePublic[$i]->getListeId() == $id){ echo "selected"; } echo ">".$dataListeNotePublic[$i]->getNom()."</option>"; ?>
		<?php $i++; } $i = 0;
		while(isset($dataListeNotePrivate[$i])) { ?>	
			<option onclick="choisirListe(<?php echo $dataListeNotePrivate[$i]->getListeId(); ?>)"<?php echo "value='".$dataListeNotePrivate[$i]->getListeId()."'";if($dataListeNotePrivate[$i]->getListeId() == $id){ echo "selected"; } echo ">".$dataListeNotePrivate[$i]->getNom()."</option>"; ?>
		<?php $i++; } ?>	

		</select></p>
		<div class="contentNote">
			<ul>
                <?php $i = 0; while(isset($dataNotes[$i])) { ?>
				<li><?php echo $dataNotes[$i]->getMessage(); ?> <a href=?action=supprimerNote&id=<?php echo $dataNotes[$i]->getId()?>><img class="done" src="./src/img/validate.png"></a></li>
				<?php $i++; } ?>
			</ul>
			<p class="pagination">
				<?php if($page != 0){ ?>
				<a href="?page=<?php echo $page - 1; ?>&selectedList=<?php echo $id; ?>"><- Page précedente</a> <?php } ?>| <?php if($nbNote > ($page + 1) * $config["maxPerPage"]){ ?>
				<a href="?page=<?php echo $page + 1; ?>&selectedList=<?php echo $id; ?>">Page suivante -></a> <?php } ?>	
			</p>
		</div>
		<div class="contentFooter">
			<a href="?action=ajouterNote"><button class="btnAdd">Ajouter une note</button></a>
		</div>
</section>
<?php
if(file_exists("./vues/footer.php")) {
    require_once("./vues/footer.php");
}
?>


