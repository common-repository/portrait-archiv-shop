<?php
 
 require_once plugin_dir_path( __FILE__ ) .'/portraitarchiv-frontfunctions.php';

function pawps_refreshSingleShooting($shootingCode) {
    global $wpdb;

    // hole alle Remote-Shootings
    $remoteResult = pawps_getRemoteShootingResult($shootingCode);

    if (is_array($remoteResult) && count($remoteResult) > 0 ) {
        $doUpdate = true;

        if ($doUpdate) {
            // Shootings gefunden -> aktualisiere lokale Datenbank
            foreach ($remoteResult as $jsonResult) {
                    // letztes Update nach lokalem Update -> änderung übernehmen
                    if (($jsonResult->state == 1) && (strlen($jsonResult->title) > 0)) {
                        // Shooting noch aktiv -> Änderungen übernehmen
                        $existierendesShooting = pawps_loadShootingByData(null, $jsonResult->zugriffscode);

                        // Shootingdate
                        $shootingDateElements = explode(".", $jsonResult->date);
                        $shootingDateDbFormat = $shootingDateElements[2] . "-" . $shootingDateElements[1] . "-" . $shootingDateElements[0];

                        // Prüfe Update
                        if (isset($existierendesShooting)) {
                            // Shooting existiert -> Aktualisieren
                            $wpdb->update(
                                PAWPS_TABLENAME_SHOOTINGS,
                                array(
                                    'title' => urldecode($jsonResult->title),
                                    'imageCount' => $jsonResult->imageCount,
                                    'shootingdate' => $shootingDateDbFormat,
                                    'pricelist_id' => $jsonResult->preisliste,
                                    'accesscode' => $jsonResult->zugriffscode,
                                    'lastupdate' => $jsonResult->lastUpdate
                                ),
                                array(
                                    'id' => $existierendesShooting->id
                                ));

                            $shootingId = $existierendesShooting->id;
                        } else {
                            // Shooting existiert noch nicht -> Eintrag in DB vornehmen
                            $wpdb->insert(
                                PAWPS_TABLENAME_SHOOTINGS,
                                array(
                                    'title' => urldecode($jsonResult->title),
                                    'imageCount' => $jsonResult->imageCount,
                                    'shootingdate' => $shootingDateDbFormat,
                                    'pricelist_id' => $jsonResult->preisliste,
                                    'accesscode' => $jsonResult->zugriffscode,
                                    'lastupdate' => $jsonResult->lastUpdate
                                ));

                            $shootingId = $wpdb->insert_id;
                        }
                    } else {
                        // Shooting gelöscht -> entferne aus lokaler Datenbank
                        $wpdb->query('DELETE FROM ' . PAWPS_TABLENAME_SHOOTINGS . " WHERE CODE='" . $jsonResult->zugriffscode . "'");
                }
            }
        }
    }

    update_option(PAWPS_LAST_UPDATE_SHOOTINGS, pawps_getTimestamp());
}

 function pawps_refreshShootings() {
 	global $wpdb;
 	
 	// hole alle Remote-Shootings
 	$remoteResult = pawps_getRemoteShootingShortlist();

 	if (is_array($remoteResult) && count($remoteResult) > 0 ) {
 		// prüfe ob Update notwendig
 		$lastLocaleUpdate = get_option(PAWPS_LAST_UPDATE_SHOOTINGS);
 		$lastRemoteUpdate = pawps_getRemoteLastUpdate();
 		
  		$doUpdate = (((strlen($lastLocaleUpdate) > 5) && ($lastLocaleUpdate < $lastRemoteUpdate)) || (strlen($lastLocaleUpdate) < 5));

  		if ($doUpdate) {
		 	// Shootings gefunden -> aktualisiere lokale Datenbank
		 	foreach ($remoteResult as $jsonResult) {
		 		if ($jsonResult->lastUpdate > $lastLocaleUpdate) {
		 			// letztes Update nach lokalem Update -> änderung übernehmen
					if (($jsonResult->state == 1) && (strlen($jsonResult->title) > 0)) {
                        // Shooting noch aktiv -> Änderungen übernehmen
                        $existierendesShooting = pawps_loadShootingByData(null, $jsonResult->zugriffscode);

                        // Shootingdate
						$shootingDateElements = explode(".", $jsonResult->date);
		 				$shootingDateDbFormat = $shootingDateElements[2] . "-" . $shootingDateElements[1] . "-" . $shootingDateElements[0];
		 					
		 				// Prüfe Update
		 				if (isset($existierendesShooting)) {
		 					// Shooting existiert -> Aktualisieren
		 					$wpdb->update(
		 							PAWPS_TABLENAME_SHOOTINGS,
		 							array(
		 									'title' => urldecode($jsonResult->title),
		 									'imageCount' => $jsonResult->imageCount,
		 									'shootingdate' => $shootingDateDbFormat,
		 									'pricelist_id' => $jsonResult->preisliste,
		 									'accesscode' => $jsonResult->zugriffscode,
		 									'lastupdate' => $jsonResult->lastUpdate
										),
	 								array(
		 									'id' => $existierendesShooting->id
		 							));
		 					
		 					$shootingId = $existierendesShooting->id;
		 				} else {		 						
		 					// Shooting existiert noch nicht -> Eintrag in DB vornehmen
		 					$wpdb->insert(
		 							PAWPS_TABLENAME_SHOOTINGS, 
		 							array(
		 									'title' => urldecode($jsonResult->title),
		 									'imageCount' => $jsonResult->imageCount,
		 									'shootingdate' => $shootingDateDbFormat,
		 									'pricelist_id' => $jsonResult->preisliste,
											'accesscode' => $jsonResult->zugriffscode,
	 										'lastupdate' => $jsonResult->lastUpdate
		 								));
		 						
		 					$shootingId = $wpdb->insert_id; 
		 				}
		 			} else {
		 				// Shooting gelöscht -> entferne aus lokaler Datenbank
						$wpdb->query('DELETE FROM ' . PAWPS_TABLENAME_SHOOTINGS . " WHERE CODE='" . $jsonResult->zugriffscode . "'");
	 				}
	 			}
		 	}
  		}
 	}
  	
  	update_option(PAWPS_LAST_UPDATE_SHOOTINGS, pawps_getTimestamp());
 }
 
 function pawps_loadShootingByData($id = null, $code = null) {
 	global $wpdb;
 	
 	// Select aufbauen
 	$sql = "SELECT * FROM " . PAWPS_TABLENAME_SHOOTINGS . " WHERE ";
 	if (isset($id)) {
 		$sql .= "id=" . $id;
 	} else if (isset($code)) {
 		$sql .= "accesscode='" . $code . "'";
 	} else {
 		return null;
 	}
 	
 	// Datensatz selektieren
 	$result = $wpdb->get_row($sql);
 	if (isset($result)) {
 		return new pawps_shooting($result);
 	} else {
 		return null;
 	}
 }
 
 function pawps_getShootingList() {
 	$sql = "SELECT * FROM " . PAWPS_TABLENAME_SHOOTINGS . " ORDER BY shootingdate DESC";
 	
 	return pawps_getShootingListByStatement($sql);
 }
 
 function pawps_getShootingListByStatement($sql) {
 	global $wpdb;
 	
 	$results = $wpdb->get_results($sql);
 	$resultList = array();
 	
 	foreach ($results as $tmpShooting) {
 		array_push($resultList, new pawps_shooting($tmpShooting));
 	}
 	
 	return $resultList;
 }
 
 function pawps_generateLocalHash() {
 	return pawps_getModuleToken();
 }
  
 function pawps_loadShootingConfig($id = null, $code = null, $guestPassword = null) {
 	$sql = "SELECT * FROM " . PAWPS_TABLENAME_CONFIG . " WHERE ";
 	if (isset($id)) {
 		$sql .= "id=" . $id;
 	} else if (isset($code)) {
 		$sql .= "shootingcode='" . $code . "'";
 	} else if (isset($guestPassword)) {
 		$sql .= "guestpassword='" . $guestPassword . "'";
 	} else {
 		return null;
 	}
 	
 	global $wpdb;
 	
 	$result = $wpdb->get_row($sql);
 	if (isset($result)) {
 		return new pawps_config($result);
 	} else {
 		return null;
 	}
 }

 function pawps_loadEnabledListElements() {
 	$sql = "SELECT * FROM " . PAWPS_TABLENAME_SHOOTINGS . " WHERE accesscode IN (";
 	$sql .= "SELECT shootingcode FROM " . PAWPS_TABLENAME_CONFIG . " WHERE state IN (2,3))";
 	$sql .= " AND imageCount>0 ORDER BY shootingdate DESC";
 	
 	return pawps_getShootingListByStatement($sql);
 }
 
 // Methode um taegliche Aktualisierung durchzufuehren
 function pawps_refresh_cron() {
 	$updateTime = date("d.m.Y - H:i:s");
 	if (get_option(PAWPS_CRONJOB) !== false ) {
 		update_option(PAWPS_CRONJOB, $updateTime );
 	} else {
 		add_option( PAWPS_CRONJOB, $updateTime);
 	}
 	pawps_refreshShootings();
 }
 
 add_action('init', 'do_output_buffer');
 function do_output_buffer() {
 	ob_start();
 }
 
?>