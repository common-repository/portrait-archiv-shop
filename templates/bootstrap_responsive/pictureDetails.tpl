<div class="container">
	<div class="row">
		<div class="col-sm-9">
			<h1><span id="galerieTitel"></span></h1>
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
	 	
	 	<div class="row">
	 		<div class="text-center">
	 			<ul id="pagination" style="display: none;"></ul>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-sm-2">&nbsp;</div>
	 		<div class="col-sm-8">
	 			<div id="detailImage"></div>
	 		</div>
 		</div>
 		
 		<div class="row text-center">
 			<form class="form-inline" onsubmit="return pawps_addToBasket();">
			  <div class="form-group">
			    <select name="chosenProduct" class="form-control" id="products"></select>
			  </div>
			  <div class="form-group">
			    x
			  </div>
			  <div class="form-group">
			    <input type="anzahl" class="form-control" id="anzahl">
			  </div>
			  <button type="submit" class="btn btn-primary"> bestellen</button>
			</form>
 		</div>
 </div>
    
 	<?php
 		include plugin_dir_path( __FILE__ ) . '../../js/imageDetails.php'; 
 	?>