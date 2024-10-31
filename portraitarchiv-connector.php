<?php

function pawps_isConnectionWorking() {
	if ($_SESSION['PAWPS_CONNECTIONWORKING'] == true && 
			isset($_SESSION['PAWPS_RESTKEY'])) {
		return true;
	}
	
	if ((PAWPS_LOCAL_DEV == 0) && !checkdnsrr(pawps_getHost())) {
		return false;
	}
	
	$result = pawps_readRemoteUrl ( "ws/public/wpBaseService/isAvailable" );
	
	$_SESSION['PAWPS_CONNECTIONWORKING'] = $result->{'success'};
	if ($_SESSION['PAWPS_CONNECTIONWORKING']) {
		$_SESSION['PAWPS_RESTKEY'] = $result->{'restkey'};
		$_SESSION['PAWPS_BASKETKEY'] = $result->{'basketkey'};
	}
	return $_SESSION['PAWPS_CONNECTIONWORKING'];
}

function pawps_getModuleToken() {
	return pawps_readRemoteUrl ( "ws/public/userService/getModulToken" )->{'token'};
}

function pawps_doAnmeldung($anmeldedaten) {
	$url = PAWPS_BASE_URL . "ws/public/userService/createFotograf?customerData=";
	$url .= json_encode ( $anmeldedaten );
	
	$result = pawps_justReadRemote ( $url );
	
	return $result;
}

function pawps_createReadRemoteUrl($scriptName, $paramString = null) {
	// Parameter auslesen
	$paHash = get_option ( PAWPS_OPTION_HASHKEY );
	$paHashRemote = get_option ( PAWPS_OPTION_HASHKEY_REMOTE );
	$paUserId = get_option ( PAWPS_OPTION_USERID );
	if (! isset ( $paHash ) || ! isset ( $paUserId ) || ! isset ( $paHashRemote )) {
		return PAWPS_DEFAULT_ERROR;
	}
	
	// Build URL
	$systemUrl = urlencode(site_url());
	
	$url = pawps_getUrl(true);
	$url .= $scriptName . "?";
	$url .= "loginData=";
 	$url .= json_encode(array('id' => trim($paUserId), 'hash' => trim($paHash), 'remoteHash' => trim($paHashRemote),  'systemUrl' => trim($systemUrl)));
	
 	if (isset($_SESSION['PAWPS_RESTKEY'])) {
 		$url .= "&apikey=" . $_SESSION['PAWPS_RESTKEY'];
 	}
 	
	if (isset ( $paramString )) {
		$url .= "&" . $paramString;
	}

	return $url;
}

function pawps_readRemoteUrl($scriptName, $paramString = null ,$debug = false) {
	$url = pawps_createReadRemoteUrl ( $scriptName, $paramString );

	$result = pawps_justReadRemote ( $url );
	
	return json_decode ( $result );
}

function pawps_justReadRemote($url) {
    $maxTries = 3;
    $currentTry = 0;
    while (TRUE) {
        $currentTry ++;

        $response = wp_remote_get($url);
        $http_code = wp_remote_retrieve_response_code( $response );

        if ($http_code == 200) {
            $body = wp_remote_retrieve_body($response);
            return $body;
        }

        if ($currentTry >= $maxTries) {
            return null;
        }
    }
}

function pawps_getRemoteLastUpdate() {
	$result = pawps_readRemoteUrl ( "ws/public/galerieService/lastGalerieUpdateTime" );
	
	if (! $result->{'success'}) {
		return "FEHLER";
	}
	
	return $result->lastUpdate;
}

function pawps_getTimestamp() {
	$result = pawps_readRemoteUrl ( "ws/public/galerieService/lastGalerieUpdateTime" );
	
	if (! $result->{'success'}) {
		return "FEHLER";
	}
	
	return $result->currentTime;
}

function pawps_getRemoteShootingResult($shootingCode = null) {

    if ($shootingCode == null){
        $shootingCode = "none";
    }

	$result = pawps_readRemoteUrl ( "ws/public/galerieService/retrieveGalerienFiltered", "singleGalerieCode=" . $shootingCode );
	
	return $result;
}

function pawps_getRemoteShootingShortlist() {

    $result = pawps_readRemoteUrl ( "ws/public/galerieService/retrieveGalerienShortlist");

    return $result;
}

function pawps_getHost() {
	if (PAWPS_LOCAL_DEV == 1) {
		return 'localhost:8080';
	}
	$chosenCountry = get_option(PAWPS_SYSTEMCOUNTRY);
	if ($chosenCountry == "DE") {
		return 'portrait-archiv.com';
	} else if ($chosenCountry == "CH") {
		return 'portrait-archiv.ch';
	}
}

function pawps_getUrl($base = true) {
    if ($base) {
        if (PAWPS_LOCAL_DEV == 1) {
            return "http://" . pawps_getHost() . "/PortraitArchiv_war/";
        }
        return 'https://www.' . pawps_getHost() . '/';
	} else {
		return 'https://images.' . pawps_getHost() . '/';
	}
}

?>