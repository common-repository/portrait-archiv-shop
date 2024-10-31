<?php 

 function pawps_publicEventList() {
 	// allgemeine URL-Requests behandeln
 	$mode = pawps_handlePublicRequests();
 	
 	if ($mode == 1) {
	 	$shootings = pawps_loadEnabledListElements();
	 	
	 	if (isset($shootings) && (count($shootings) > 0)) {
	 		// Shootings verfügbar
	 		$currentPos = 0;
	 		$displayCols = get_option(PAWPS_DISPLAY_COLS);

	 		// Template anzeigen
	 		require pawps_getTemplatePath('eventList');
	 	} else {
	 		// keine Shootings verfügbar
	 		$noEntriesMessage = "Derzeit sind keine öffentlichen Shootings verfügbar";
	 		
	 		// Template anzeigen
	 		require pawps_getTemplatePath ('noEntries');
	 	}
 	}
 } 
 
 function pawps_showPublicEvent($shootingId) {
 	$_GET['pawps_shooting'] = $shootingId;
 	
 	$shooting = pawps_loadShootingByData($shootingId);
 	
 	if (isset($shooting)) {
 		pawps_handlePublicRequests(true);
 	} else {
 		// Fehler
 		$noEntriesMessage = "Das gewünschte Shooting ist nicht verfügbar";
	 		
	 	// Template anzeigen
	 	require pawps_getTemplatePath ('noEntries');
 	}
 }
 
 function pawps_shootingByGalleriecode() {
 	if (!isset($_SESSION['PAWPS_LOGIN'])) {
 		$passwordCheckDone = false;
 		if (isset($_POST['PA_GALLERIECODE']) && (strlen($_POST['PA_GALLERIECODE']) > 0)) {
 			// Suche Veranstaltung anhand Galleriecode
 			$config = pawps_loadShootingConfig(null, sanitize_text_field($_POST['PA_GALLERIECODE']));
 			if (isset($config) && ($config->state > 0)) {
 				$shooting = pawps_loadShootingByData(null, $config->shootingcode);
 				if (isset($shooting)) {
 					// Shooting anzeigen
 					$passwordCheckDone = true;
 					$_SESSION['PAWPS_LOGIN'] = $config->id;
 				}
 			}
 
 			if (!$passwordCheckDone) {
 				$error = "Zu dem von Ihnen eingegebenen Code konnte keine Galerie gefunden reden";
 			}
 		}
 			
 		// noch kein Passwort in Session -> frage Passwort ab
 		if (!$passwordCheckDone) {
 			require pawps_getTemplatePath ('galleriecodeForm');
 		}
 	}
 
 	if (isset($_SESSION['PAWPS_LOGIN'])) {
 		// Passwort in Session gesetzt -> Lade Veranstaltung
 		$config = pawps_loadShootingConfig($_SESSION['PAWPS_LOGIN']);
 		if (isset($config)) {
 				
 			// Shooting setzen
 			$shooting = pawps_loadShootingByData(null, $config->shootingcode);
 			if (isset($shooting)) {
 				$_GET['pawps_shooting'] = $shooting->id;
 			}
 		}
 			
 		if (isset($shooting)) {
 			pawps_handlePublicRequests();
 			//pawps_showEvent(null, $shooting);
 		} else {
 			unset ($_SESSION['PAWPS_LOGIN']);
 			pawps_shootingByGalleriecode();
 		}
 	}
 }
 
 function pawps_shootingByCode() {
 	if (isset($_GET['pawps_galerieReset']) && ($_GET['pawps_galerieReset'] == 1) && isset($_SESSION)) {
 		unset($_SESSION['PAWPS_LOGIN']);
 	}
 	
 	if (!isset($_SESSION['PAWPS_LOGIN'])) {
 		$passwordCheckDone = false;
 		
 		if (isset($_POST['PA_GUESTPASSWORD']) && (strlen($_POST['PA_GUESTPASSWORD']) > 0)) {
 			// Suche Veranstaltung anhand Gästepasswort
 			$config = pawps_loadShootingConfig(null, null, sanitize_text_field($_POST['PA_GUESTPASSWORD']));
 			if (isset($config) && ($config->state > 0)) {
 				$shooting = pawps_loadShootingByData(null, $config->shootingcode);
 				if (isset($shooting)) {
 					// Shooting anzeigen
 					$passwordCheckDone = true;
 					$_SESSION['PAWPS_LOGIN'] = $config->id;
 				}
 			}
 			
 			if (!$passwordCheckDone) {
 				$error = "Das eingegebene Passwort ist ungültig";
 			}
 		}
 		
 		// noch kein Passwort in Session -> frage Passwort ab
 		if (!$passwordCheckDone) {
 			require pawps_getTemplatePath ('passwordForm');
 		}
 	}
 	
 	if (isset($_SESSION['PAWPS_LOGIN'])) {
 		// Passwort in Session gesetzt -> Lade Veranstaltung
 		$config = pawps_loadShootingConfig($_SESSION['PAWPS_LOGIN']);
 		if (isset($config)) {
 		
	 		// Shooting setzen
	 		$shooting = pawps_loadShootingByData(null, $config->shootingcode);
	 		if (isset($shooting)) {
	 			$_GET['pawps_shooting'] = $shooting->id;
	 		}
 		}
 		
 		if (isset($shooting)) {
 			pawps_handlePublicRequests();
 			//pawps_showEvent(null, $shooting);
 		} else {
 			unset ($_SESSION['PAWPS_LOGIN']);
 			pawps_shootingByCode();
 		}
 	}
 }
 
 function pawps_showImage($imageId) {
 	$config = pawps_loadShootingConfig(sanitize_text_field($_GET['pGalerie']));
 	
 	if (!isset($config)) {
 		// Config ungültig -> raus hier
 		return;
 	}
 	
 	if ($config->state == 0) {
 		// Biete auf Status 4 um - so kann Galerie angezeigt werden ... hoffentlich
 		$config->state = 4;
 	}
 	
 	$shooting = pawps_loadShootingByData(null, $config->shootingcode);
 	
 	// Shooting - Config und Image da - Anzeigen
	require pawps_getTemplatePath('pictureDetails');
 }
 
 function pawps_showEvent($eventCode = null, $shooting = null, $overuleState = false) {
	if (!isset($shooting) && isset($eventCode)) {
		$shooting = pawps_loadShootingByData(null, $eventCode);
	}
	
	if (!isset($shooting)) {
		// Shooting nicht gefunden / übergeben
		return;
	}
	
	$config = $shooting->getShootingConfig();
	
	if (!isset($config)) {
		global $wpdb;
				
		$wpdb->insert(
			PAWPS_TABLENAME_CONFIG,
			array(
					'shootingcode' => $shooting->accesscode
			));
		
		$config = pawps_loadShootingConfig(null, $shooting->accesscode);		
	}
	
	if (!$overuleState && $config->state == 0) {
		// ist inaktiv -> keine Anzeige
		return;
	}

	$passwordCheckDone = false;
	
	if (isset($_SESSION['PAWPS_LOGIN']) && ($_SESSION['PAWPS_LOGIN'] == $config->id)) {
		$passwordCheckDone = true;
	} else {
		unset($_SESSION['PAWPS_LOGIN']);
		
		if (isset($_POST['PA_GUESTPASSWORD'])) {
			if ($_POST['PA_GUESTPASSWORD'] == $config->guestpassword) {
				$_SESSION['PAWPS_LOGIN'] = $config->id;
				$passwordCheckDone = true;
			} else {
				$error = "Das eingegebene Passwort ist ungültig";
			}
		}
	}
	
	// bei Config-Typ 2 -> Keine Passwortprüfung
	if ($overuleState) {
		$passwordCheckDone = true;
	} else {
		if (($config->state == 2) || ($config->state == 4)) {
			$passwordCheckDone = true;
		} else if (!$passwordCheckDone && 
			(($config->state == 1) || ($config->state == 3))) {
			// mit Passwort -> check anzeigen
			pawps_showPasswordRequestForm($shooting);
		}
	}
	
	if ($passwordCheckDone) {
		// Template anzeigen
		require pawps_getTemplatePath ('event');
	} else {
		$noEntriesMessage = "Das gewünschte Element kann leider nicht angezeigt werden";
		require pawps_getTemplatePath ('noEntries');
	}
 }
 
 function pawps_showPasswordRequestForm($shooting) {
	if (!isset($shooting)) {
		// Keine Daten übergeben -> und raus
		return;
	}
	
	// Template anzeigen
	require pawps_getTemplatePath ('passwordForm');
 }
 
 function pawps_showWarenkorb() {
	// entscheiden was anzuzeigen ist
 	$agbText = file_get_contents(plugin_dir_path( __FILE__ ) .'/resources/agb.tpl');
 	$datenschutzText = file_get_contents(plugin_dir_path( __FILE__ ) .'/resources/datenschutz.tpl');
 	require pawps_getTemplatePath ('warenkorbList');
 }
 
 function pawps_handlePublicRequests($overuleState = false) {
 	if (isset($_POST['bestellungAbsenden'])) {
 		unset($_SESSION['PAWPS_CONNECTIONWORKING']);	
 		unset($_SESSION['PAWPS_RESTKEY']);
 		unset($_SESSION['PAWPS_BASKETKEY']);
 	}
 	
 	if (!pawps_isConnectionWorking()) {
 		// Verbindung nicht existent -> Fehlerseite anzeigen
 		$noEntriesMessage = "Die gewünschte Funktion steht derzeit nicht zur Verfügung";
 		
 		// Template anzeigen
 		require pawps_getTemplatePath ('noEntries');
 		
 		return 0;
 	} else {
		// Request behandeln
		if (isset($_GET['pawps_showWarenkorb']) && ($_GET['pawps_showWarenkorb'] == 1)) {
			pawps_showWarenkorb();
			return 4;
		} else if (isset($_GET['pDetails']) && is_numeric($_GET['pDetails'])) {
			pawps_showImage(sanitize_text_field($_GET['pDetails']));
			return 3;
		} else if (isset($_GET['pawps_shooting']) && is_numeric($_GET['pawps_shooting'])) {
			// Shooting laden
			$shooting = pawps_loadShootingByData(sanitize_text_field($_GET['pawps_shooting']));
			pawps_showEvent($shooting->accesscode, $shooting, $overuleState);
			return 2;
		} else {
			return 1;
		}
 	}
 }
 
?>