			<div class="row text-center">
				<a href="<?php echo add_query_arg (array('pDetails'=> null, 'pGalerie'=> null, 'pawps_showWarenkorb' => "1")); ?>">Warenkorb</a>
			</div>
			<div class="row">
				<div class="col-sm-6 text-right">Artikel:</div>
				<div class="col-sm-4" id="warenkorbAnzahl">0</div>
			</div>
			<div class="row">
				<div class="col-sm-6 text-right">Summe:</div>
				<div class="col-sm-4" id="warenkorbPreis">0</div>
			</div>
			
	<?php
 		include plugin_dir_path( __FILE__ ) . '../../js/warenkorbBox.php';
 	?>