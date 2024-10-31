<script>
    
	jQuery(document).ready(function($) {
		papws_refreshBasket();
    });

    function papws_refreshBasket() {
    	var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/orderService/basket";
		jQuery.getJSON( restEndpoint, {
	          apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
	          basketKey: '<?php echo $_SESSION['PAWPS_BASKETKEY']; ?>',
	          detailLevel: "DETAIL"
			})
	          .success(function( data ) {
				  jQuery('#productList').empty();
				  jQuery.each( data.warenkorb.positionen, function( i, item ) {
					  var htmlToAttach = "<tr>\n";
			          htmlToAttach += "<td><center><img src='" + item.image.baseUrl + "/" + item.image.thumbUrl + "' class='img-responsive'></center></td>\n";
			          htmlToAttach += "<td>" + item.productTitle + "</td>\n";
			          htmlToAttach += "<td class='text-right'>" + item.anzahl + "</td>\n";
			          htmlToAttach += "<td class='text-right'>" + pawps_formatAmount(item.positionEinzelpreis) + " EUR" + "</td>\n";
			          htmlToAttach += "<td class='text-right'>" + pawps_formatAmount(item.positionGesamtpreis) + " EUR" + "</td>\n";
			          <?php if (!isset($displayOnly) || !$displayOnly) { ?>
					  	htmlToAttach += "<td><span class='btn btn-danger' onClick='papws_warenkorbAddProduct(" + item.image.id + ", " + item.productId + ",0)'>X</span></td>\n";
					  <?php } ?>
					  htmlToAttach += "</tr>\n";

					  if (item.anzahl > 0) {
	                  	jQuery(htmlToAttach).appendTo( "#productList" );
					  }
	              });

				  zwischensumme.innerText = pawps_formatAmount(data.warenkorb.gesamtpreisOhneVersandkosten) + " EUR";
				  versandkosten.innerText = pawps_formatAmount(data.warenkorb.versandkosten) + " EUR";
				  gesamtpreis.innerText = pawps_formatAmount(data.warenkorb.gesamtpreisInklVersandkosten) + " EUR";

				  if (data.warenkorb.anzahl == 0) {
					  jQuery('#orderArea').hide();
				  }
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

    function pawps_orderBasket() {
    	var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/orderService/createOrder";
        jQuery.post(restEndpoint, {
        		apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
        		basketKey: '<?php echo $_SESSION['PAWPS_BASKETKEY']; ?>',
        		countryIso: 'DE',
    			firstname: jQuery('#firstname').val(),
    			lastname: jQuery('#lastname').val(),
    			email: jQuery('#email').val(),
    			street: jQuery('#street').val(),
    			nr: jQuery('#nr').val(),
    			zip: jQuery('#zip').val(),
    			city: jQuery('#city').val()
    		})
        	  .done(function( data ) {
        		  // Warenkorb leeren ?
        		  alert ("Vielen Dank. Wir haben Ihre Bestellung erhalten und werden diese umgehend bearbeiten. Bitte prüfen Sie Ihren Maileingang auf den Eingang der Bestellbestätigung.");
        	  })
            .fail(function ( data ) {
                alert("Bei der Bestellübertragung ist ein Fehler aufgetreten");
            })
            return true;
    };
</script>

<?php 
	include plugin_dir_path( __FILE__ ) . 'baseFunctions.php';
?>