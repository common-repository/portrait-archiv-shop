<script>
    jQuery(document).ready(function($){
    	pawps_showImageDetail(<?php echo sanitize_text_field($_GET['pDetails']); ?>, 0);
    });

	var currentImageId;
	var currentImagePos;
    
	function pawps_showImageDetail(imageId, offset) {
		var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/galerieService/imagedetails";
		
		jQuery.getJSON( restEndpoint, {
	          apikey: '<?php echo sanitize_text_field($_SESSION['PAWPS_RESTKEY']); ?>',
	          galerieCode: '<?php echo $shooting->accesscode; ?>',
	          imageId: imageId,
	          offset: offset
			})
	          .success(function( data ) {
	        	  galerieTitel.innerText = data.galerie.title;

	        	  currentImageId = data.image.id;
	        	  currentImagePos = data.currentPosition;
		        	  
	        	  var url = data.image.baseUrl + "/" + data.image.detailUrl;
	        	  jQuery('#detailImage').empty();
	        	  jQuery("<img class='img-responsive' src='" + url + "'>").appendTo( "#detailImage" );

	        	  jQuery('#products').empty();
	          	  jQuery.each( data.pricelist.artikel, function( i, item ) {
	                  var htmlToAttach = "";
	                  
	                  htmlToAttach += "<option value='" + item.id + "'>";
	                  htmlToAttach += item.title;

	                  htmlToAttach += " - " + pawps_formatAmount(pawps_ermittlePreis(item, 1)) + " EUR";
	                  
	                  htmlToAttach += "</option>";

	                  jQuery(htmlToAttach).appendTo( "#products" );
	                });

	          		jQuery('#pagination').twbsPagination({
		  	          totalPages: <?php echo sanitize_text_field($_GET['pFolderCount']); ?>,
		  	          startPage: data.currentPosition,
		  	          visiblePages: 1,
		  	          first: '',
		  	          last: '',
		  	          prev: '<',
		  	          next: '>',
		  	          onPageClick: function (event, page) {
			  	          if (currentImagePos < page) {
			  	        	pawps_showImageDetail (currentImageId, +1);
			  	          } else if (currentImagePos > page) {
			  	        	pawps_showImageDetail (currentImageId, -1);
			  	          }
		  	          }
			  	    });

			  	    if (<?php echo sanitize_text_field($_GET['pFolderCount']); ?> > 1) {
	          	 		jQuery('#pagination').show();
			  	    } else {
			  	    	jQuery('#pagination').hide();
			  	    }
	          });
	}

	function pawps_addToBasket() {
		var selectedProduct = jQuery('#products').val();
		var count = jQuery('#anzahl').val();

		papws_warenkorbAddProduct(currentImageId, selectedProduct, count);

		return false;
	}
    
    function pawps_ermittlePreis(artikel, anzahl) {
    	for (var i = 0; i < artikel.preise.length; i++) {
        	var obj = artikel.preise[i];

        	var gueltigAb = papws_getJsonValue(obj, "gueltigAb");
        	if (gueltigAb <= anzahl) {
        		return papws_getJsonValue(obj, "preis");
        	}
    	}

        return 0;
    }
</script>

<?php 
	include plugin_dir_path( __FILE__ ) . 'baseFunctions.php';
?>