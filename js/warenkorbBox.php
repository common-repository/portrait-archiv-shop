<script>
    
	jQuery(document).ready(function($) {
		papws_refreshBasket();
    });

    function papws_refreshBasket() {
    	var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/orderService/basket";
		jQuery.getJSON( restEndpoint, {
	          apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
	          basketKey: '<?php echo $_SESSION['PAWPS_BASKETKEY']; ?>',
	          detailLevel: "BASE"
			})
	          .success(function( data ) {
	        	  warenkorbAnzahl.innerText = data.warenkorb.anzahl;
	        	  warenkorbPreis.innerText = pawps_formatAmount(data.warenkorb.gesamtpreisOhneVersandkosten) + " EUR";
	          });
    }

    function papws_warenkorbAddProduct(fotoId, productId, anzahl) {
    	var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/orderService/addOrUpdateProduct";
        jQuery.post(restEndpoint, {
        		apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
        		basketKey: '<?php echo $_SESSION['PAWPS_BASKETKEY']; ?>',
        		fotoId: fotoId,
        		artikelId: productId,
        		anzahl: anzahl
        	})
        	  .done(function( data ) {
        		  papws_refreshBasket();
        	  });
    }
</script>

<?php 
	include plugin_dir_path( __FILE__ ) . 'baseFunctions.php';
?>