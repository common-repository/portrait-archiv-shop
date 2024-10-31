<div class="container">
	<div class="row">
		<div class="col-sm-9">
			<h1><span id="galerieTitel"></span> - <span id="anzahlBilder"></span> Bilder</h1>
			<?php 
				if (isset($_SESSION['PAWPS_LOGIN'])) {
			?>
			<a href="<?php echo add_query_arg ('pawps_galerieReset', '1'); ?>">Galerie wechseln</a>
			<?php
				}
			?>
		</div>
		<div class="col-sm-3">
			<?php
				include plugin_dir_path( __FILE__ ) . 'warenkorbBox.tpl';
			?>
		</div>
	</div>
	
		<div class="row text-center" id="folderSelection">
			<select id="folder" name="folder">
			</select>
		</div>
	 	
	 	<div class="row">
	 		<div class="text-center">
	 			<span id="backToFolderview">zurück zur Übersicht<br/></span>
	 			<ul id="pagination" style="display: none;"></ul>
	 		</div>
	 	</div>

	 	<div class="row" id="images">
 		</div>
 </div>
    
 	<?php
 		$withDetailLink = true;
 		include plugin_dir_path( __FILE__ ) . '../../js/galerieList.php'; 
 	?>