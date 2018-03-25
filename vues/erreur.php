<?php
if(file_exists("./vues/header.php")) {
	require_once("./vues/header.php");
}
?>

<section class="todoPanel">
		<p class="topTitle">ERREUR !!!!</p>

		<div class="contentNote">
			<p class="err"><?php echo $erreur; ?></p>
		</div> 
<?php
if(file_exists("./vues/footer.php")) {
    require_once("./vues/footer.php");
}
?>


