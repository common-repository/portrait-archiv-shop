<?php

 function pawps_setupDatabase() {
 	// Online Last = 9
 	$currentDatabaseVersion = 10;
 	
 	$updateDone = false;
 	
 	if (get_option(PAWPS_DB_VERSION) < $currentDatabaseVersion) {
 		// Drop complete old Database
 		pawps_cleanupDatabase();
 		
	 	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	 	
	 	// Shootings
	 	$tableSql = 'CREATE TABLE ' . PAWPS_TABLENAME_SHOOTINGS . ' (
	 			id MEDIUMINT(5) NOT NULL AUTO_INCREMENT,
	 			title VARCHAR(200) NOT NULL,
	 			imageCount MEDIUMINT(4) NOT NULL DEFAULT 0,
	 			shootingdate DATE NOT NULL, 
	 			pricelist_id MEDIUMINT(5) NOT NULL, 
	 			accesscode VARCHAR(20) NOT NULL,
	 			lastupdate LONG NOT NULL,
	 			PRIMARY KEY(ID));';
		dbDelta( $tableSql );
	
		// lokale Shooting-Config
		$tableSql = 'CREATE TABLE ' . PAWPS_TABLENAME_CONFIG . ' (
				id MEDIUMINT(5) NOT NULL AUTO_INCREMENT,
				shootingcode VARCHAR(20) NOT NULL,
				state MEDIUMINT(1) NOT NULL DEFAULT 0,
				guestpassword VARCHAR(25),
				PRIMARY KEY(id));';
		dbDelta( $tableSql );
		

		if (get_option(PAWPS_DB_VERSION) < 10) {
			// alte Tabellen entfernen
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_ORDNER");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_PRICELISTS");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_PRODUCTS");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_PRICES");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_PRICELIST_COUNTRIES");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_PRICELIST_PRODUCTS");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_IMAGES");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_WARENKORB");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_WARENKORB_PRODUCTS");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_WARENKORB_IMAGES");
			$wpdb->query("DROP TABLE " . $wpdb->prefix . "PAWPS_CUSTOMERS");
			
			// Alte Options entfernen
			delete_option("PAWPS_DISPLAY_ROWS");
			delete_option("PAWPS_DISPLAY_COLS");
			delete_option("PAWPS_TEMPLATE_NAME");
			delete_option("PAWPS_DEBUG");
			
			update_option(PAWPS_OPTION_BOOTSTRAP_ADMIN, 1);
			update_option(PAWPS_OPTION_BOOTSTRAP_PUBLIC, 1);
			update_option(PAWPS_OPTION_COUNT_IMAGES, 24);
		}
		
		// aktuelle Version in DB eintragen
		update_option(PAWPS_DB_VERSION, $currentDatabaseVersion);
		
		// Prüfe Modul-Token
		$paHash = get_option(PAWPS_OPTION_HASHKEY);
		$paHashRemote = get_option(PAWPS_OPTION_HASHKEY_REMOTE);
		$paUserId = get_option(PAWPS_OPTION_USERID);
		
		if ((strlen($paHash) > 0) && (strlen($paUserId) > 0)) {
			// alte Daten gespeichert - prüfe ob noch korrekt
			$currentRemoteHash = pawps_getModuleToken();
			if ($paHash != $currentRemoteHash) {
				// Hash hat sich geändert -> aktualisieren
				update_option(PAWPS_OPTION_HASHKEY, $currentRemoteHash);
				delete_option(PAWPS_OPTION_HASHKEY_REMOTE);
			}
		}
 	}
 }
 
 function pawps_cleanupDatabase() {
 	global $wpdb;
 	
 	$wpdb->query('DROP TABLE ' . PAWPS_TABLENAME_SHOOTINGS);
 	$wpdb->query('DROP TABLE ' . PAWPS_TABLENAME_CONFIG);

 	// Version entfernen
 	delete_option(PAWPS_DB_VERSION);
 }
 
 function pawps_clearDatabaseValues() {
 	update_option(PAWPS_LAST_UPDATE_SHOOTINGS, 0);
 	
 	global $wpdb;
 	
 	$wpdb->query('DELETE FROM ' . PAWPS_TABLENAME_SHOOTINGS);
 }
 
?>