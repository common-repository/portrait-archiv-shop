<?php

 class pawps_shooting {
 	var $id, $title, $imageCount, $shootingdate, $pricelist_id, $accesscode, $lastupdate;
 	
 	// TMP Values
 	var $tmpPricelist, $tmpImagelist, $tmpConfig, $tmpPreviewImage;
 	var $tmpImgPageStart, $tmpImgPageEnd, $tmpImgPage, $tmpOrdner;
 	
 	function __construct($values) {
 		$this->id = $values->id;
 		$this->title = $values->title;
 		$this->imageCount = $values->imageCount;
 		$this->shootingdate = $values->shootingdate;
 		$this->pricelist_id = $values->pricelist_id;
 		$this->accesscode = $values->accesscode;
 		$this->lastupdate = $values->lastupdate;
 	}

 	function getIntegrationState() {
 		if (!isset($this->tmpConfig)) {
 			$this->tmpConfig = pawps_loadShootingConfig(null, $this->accesscode);
 		}
 		
 		if (isset($this->tmpConfig)) {
 			return $this->tmpConfig->state;
 		} else {
	 		return 0;
 		}
 	}
 	
 	function getShootingConfig() {
 		return pawps_loadShootingConfig(null, $this->accesscode);
 	}
 }
 
 class pawps_config {
 	var $id, $shootingcode, $state, $guestpassword;
 	
 	function __construct($values) {
 		$this->id = $values->id;
 		$this->shootingcode = $values->shootingcode;
 		// 0 = inaktiv
 		// 1 = nur per Passwort
 		// 2 = Liste
 		// 3 = Liste und Passwort 		
 		$this->state = $values->state;
 		$this->guestpassword = $values->guestpassword;
 	}
 	
 	function getPassword() {
 		if (!isset($this->guestpassword)) {
 			return "";
 		} else {
 			return $this->guestpassword;
 		}
 	}
 }
 
 class pawps_newFotograf {
 	var $firma, $name, $vorname, $strasse, $nr, $plz, $ort, $telefon, $email, $homepage, $wpUrl, $land;
 }

?>