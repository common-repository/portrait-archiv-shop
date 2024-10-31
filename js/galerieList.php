<script>
	var fotosJeSeite = <?php echo get_option(PAWPS_OPTION_COUNT_IMAGES, 24); ?>;
	var currentFolder = "";
	var folderCount = 0;
	var currentFolderImagecount = 0;

	<?php
		if ($withDetailLink) {
	?>
			linkImageToDetailview = true;
	<?php
		} else {
	?>
			linkImageToDetailview = false;
	<?php
		}
	?>
	
    jQuery(document).ready(function($){
      var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/galerieService/galerie";
      $.getJSON( restEndpoint, {
          apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
          galerieCode: '<?php echo $shooting->accesscode; ?>',
          type: 'BASE'
		})
          .success(function( data ) {
		      folderCount = <?php if ($hideSubFolders) { echo 1; } else { ?>data.galerie.unterordner.length <?php } ?>;

		      if (folderCount > 1) {
				  showUnterordnerList(data);
			  }	else {
				  showOrdnerinhalt(data, data.galerie.unterordner[0]);
			  }      
          });  
    });

    function showUnterordnerList(galerie) {
    	galerieTitel.innerText = galerie.galerie.title;
    	anzahlBilder.innerText = galerie.galerie.imageCount;

        // kein Blättern bei Unterordner-Liste
        jQuery('#folderSelection').hide();
        jQuery('#backToFolderview').hide();
        jQuery('#images').empty();
        jQuery('#pagination').twbsPagination('destroy');

		jQuery.each( galerie.galerie.unterordner, function( i, ordner ) {
      		var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/galerieService/images";
      	    jQuery.getJSON( restEndpoint, {
      	    	apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
				galerieCode: '<?php echo $shooting->accesscode; ?>',
      	    	imagesPerPage: 1,
      	    	currentPage: 1,
      	    	folder: ordner.titel
      	    })
      	    .success(function( data ) {
      	    	jQuery.each( data.images, function( x, item ) {
      	        var url = item.baseUrl + "/" + item.detailUrl;

      	        var htmlToAttach = "";

              	var id = 'folder_' + ordner.titel;
              	
      	    	htmlToAttach += "<div class='col-sm-3 text-center' id='" + id + "'>";
      	        htmlToAttach += "<img class='img-responsive img-thumbnail' src='" + url + "'>";

      			htmlToAttach += ordner.titel + " (";
      			if (ordner.imageCount == 1) {
      				htmlToAttach += "1 Foto)";
      			} else {
      				htmlToAttach += ordner.imageCount + " Fotos)";
      			}
      			htmlToAttach += "</div>";

      			jQuery(htmlToAttach).appendTo( "#images" );

      			jQuery("#" + id).click(function (data) {
      				showOrdnerinhalt(galerie, ordner);
      			});
			});
		});  
		});

		jQuery("#backToFolderview").click(function (data) {
			showUnterordnerList(galerie);
		});
	}

	function showOrdnerinhalt(galerie, aktuellerOrdner) {
		galerieTitel.innerText = galerie.galerie.title;
    	anzahlBilder.innerText = galerie.galerie.imageCount;

    	folderCount = <?php if ($hideSubFolders) { echo 1; } else { ?>galerie.galerie.unterordner.length <?php } ?>;

    	if (folderCount > 1) {
    		jQuery('#backToFolderview').show();
    	} else {
    		jQuery('#backToFolderview').hide();
    	}
    	
	    var anzahlSeiten = 1;
	    currentFolder = aktuellerOrdner.titel;
    	currentFolderImagecount = aktuellerOrdner.imageCount;
	      
        if (folderCount > 1) {
            jQuery('#folder').empty();
        	jQuery.each( galerie.galerie.unterordner, function( i, item ) {
				var htmlToAttach = "";

              htmlToAttach += "<option>" + item.titel + " (";
				if (item.imageCount == 1) {
					htmlToAttach += "1 Foto)";
				} else {
					htmlToAttach += item.imageCount + " Fotos)";
				}
				htmlToAttach += "</option>";

              jQuery(htmlToAttach).appendTo( "#folder" );
            });	

           anzahlSeiten = Math.ceil(currentFolderImagecount / fotosJeSeite);	

           jQuery("#folder").on('change', function() {
	             var split = this.value.split("(");
	             var folderName = split[0].trim();
	             var imageCount = split[1];
	             split = imageCount.split("Foto");
	             imageCount = split[0].trim();

	             currentFolder = folderName;
	             currentFolderImagecount = imageCount;

	             createPagination(Math.ceil(imageCount / fotosJeSeite));
	             showImages(1);
           });	  
		   } else {
	      	  jQuery('#folderSelection').hide();
	      	  anzahlSeiten = Math.ceil(galerie.galerie.imageCount / fotosJeSeite);
	        }
        
         createPagination(anzahlSeiten);
	}

	function createPagination(anzahlSeiten) {
    	jQuery('#pagination').twbsPagination('destroy');
    	jQuery('#pagination').twbsPagination({
	          totalPages: anzahlSeiten,
	          visiblePages: 4,
	          first: '',
	          last: '',
	          prev: '<',
	          next: '>',
	          onPageClick: function (event, page) {
	              showImages( page );
	          }
	       });
       if (anzahlSeiten > 1) {
	   	   jQuery('#pagination').show();
	   } else {
		   jQuery('#pagination').hide();
	   }
    }

    function showImages(requestedPage) {
        var restEndpoint = "<?php echo pawps_getUrl(); ?>/rest/galerieService/images";
        var folderString = null;
        if (folderCount > 1) {
            folderString = currentFolder;
        }
            jQuery.getJSON( restEndpoint, {
            	apikey: '<?php echo $_SESSION['PAWPS_RESTKEY']; ?>',
	            galerieCode: '<?php echo $shooting->accesscode; ?>',
	            imagesPerPage: fotosJeSeite,
	            currentPage: requestedPage,
	            folder: folderString
	  		})
            .success(function( data ) {
                jQuery('#images').empty();
            	jQuery.each( data.images, function( i, item ) {
                    var url = item.baseUrl + "/" + item.detailUrl;

                    var htmlToAttach = "";

                    if (linkImageToDetailview) {
                    	htmlToAttach += "<a href='?pGalerie=<?php echo $config->id; ?>";
                    	htmlToAttach += "&pFolder=" + currentFolder;
                    	htmlToAttach += "&pFolderCount=" + currentFolderImagecount;
                    	htmlToAttach += "&pDetails=" + item.id + "' title='Detailansicht anzeigen'>";
                    }
                    
                    htmlToAttach += "<div class='col-sm-2'><img class='img-responsive img-thumbnail' src='" + url + "'></div>";

                    if (linkImageToDetailview) {
                    	htmlToAttach += "</a>";
                    }

                    jQuery(htmlToAttach).appendTo( "#images" );
                  });
            });  
    }

</script>
    
<?php 
	include plugin_dir_path( __FILE__ ) . 'baseFunctions.php';
?>