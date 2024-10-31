<div class="container">
 	<div class="row" id="publicGalerieList">
	</div>
</div>

<?php
	include plugin_dir_path( __FILE__ ) . '../../js/galeriePublicList.php'; 
	
?>
	<script>
<?php
	foreach ($shootings as $shooting) {
	?>
		showEinzelgalerie("<?php echo $shooting->accesscode; ?>", "<?php echo $shooting->id; ?>");
	<?php
	}
?>
	</script>
