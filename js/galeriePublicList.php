<script>

	function showEinzelgalerie(code, galerieid) {
		var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/galerieService/galerie";
		jQuery.getJSON( restEndpoint, {
	    	apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
			galerieCode: code,
	        type: 'COMPLETE'
		})
	    .success(function( data ) {
		    if (data.images.length > 0) {
			    var htmlToAttach = "<a href='?pawps_shooting=" + galerieid + "'>";

			    htmlToAttach += "<div class='col-md-4 col-xs-6 text-center'>";

			    var image = data.images[0];
			    var url = image.baseUrl + "/" + image.detailUrl;
			    htmlToAttach += "<img class='img-responsive img-thumbnail' src='" + url + "'><br/>";
			    
			    htmlToAttach += data.galerie.title;
		    	htmlToAttach += "</div>";
		    	htmlToAttach += "</a>";
		    	
		    	jQuery(htmlToAttach).appendTo( "#publicGalerieList");
		    }
		});  
	}

</script>

<!-- 
				<a href='<?php echo remove_query_arg('pawps_galerieReset', add_query_arg ('pawps_shooting', $shooting->id)); ?>' title='Shooting <?php echo $shooting->title; ?> anzeigen'>
 -->
<?php 
	include plugin_dir_path( __FILE__ ) . 'baseFunctions.php';
?>