<?php 
 
 function pawps_admin_menu() {
	add_menu_page(
		'Portrait-Archiv Adminbereich',
		'Portrait-Archiv',
		'manage_options',
		'pawps_admin_menu_mainpage',
		'pawps_admin_menu_mainpage',
        plugins_url( 'resources/logo.png' , __FILE__ ));
	
	add_submenu_page(
		'pawps_admin_menu_mainpage',
		'Portrait-Archiv Anleitung',
		'Anleitung',
		'manage_options',
		'pawps_admin_menu_anleitung',
		'pawps_admin_menu_anleitung');
	
		if (!pawps_isConnectionWorking()) {
			add_submenu_page(
				'pawps_admin_menu_mainpage',
				'Portrait-Archiv Anmeldung',
				'Anmeldung',
				'manage_options',
				'pawps_admin_menu_anmeldung',
				'pawps_admin_menu_anmeldung');
		} else {
			add_submenu_page(
					'pawps_admin_menu_mainpage',
					'Portrait-Archiv Konfiguration',
					'Konfiguration',
					'manage_options',
					'pawps_admin_menu_config',
					'pawps_admin_menu_config');
		}
			
		add_submenu_page(
			'pawps_admin_menu_mainpage',
			'Portrait-Archiv Verbindungsdaten',
			'Verbindungsdaten',
			'manage_options',
			'pawps_admin_menu_grundeinstellungen',
			'pawps_admin_menu_grundeinstellungen');
		
		add_submenu_page(
			'pawps_admin_menu_mainpage',
			'Übersicht der Galerien',
			'Galerien',
			'manage_options',
			'pawps_admin_menu_shootings',
			'pawps_admin_menu_shootings');
 }

 function pawps_showAdminHeader($title = null) {
 	?>
 	 		<div class="wrap">
 		 		<h2><img src="<?php echo plugins_url( 'resources/logo.png' , __FILE__ ); ?>" /> Portrait-Archiv<?php if (isset($title)) echo " > " . $title; ?></h2>
 		 	</div>
 	<?php 	
 }
 
 function pawps_admin_menu_anmeldung() {
	pawps_showAdminHeader("Eröffnung eines neuen Portrait-Archives");
		
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'Ihre aktuelle Berechtigung verhindert den Zugriff auf diese Seite' ) );
	}
	
	?>
	
		<div class="wrap">
			<h3>Anmeldeinformationen</h3>
			Um das Plugin nutzen zu können benötigen Sie einen kostenlosen Account bei Portrait-Archiv. Hier veröffentlichen Sie 
			Ihre Galerien welche über das Plugin in Ihre Seite intergriert werden.<br/><br/>
			Ihnen gefällt unser Portrait-Archiv und Sie möchten Ihren Kunden gerne diesen Onlineservice anbieten?<br/>
			Eröffnen Sie noch heute Ihr eigenes Online Portraitstudio – ganz unverbindlich und ohne Risiko und laufende Kosten. Wenn Sie 
			keine Umsatzsteigerung durch den Einsatz des Portrait-Archiv haben dann kostet Sie dies selbstverständlich keinen Cent.<br/>
			<br/>
			Füllen Sie einfach das nachstehende Formular vollständig aus und wir werden Ihnen in kürze Ihre Zugangsdaten sowie weitere 
			Informationen per Mail zukommen lassen. Bitte beachten Sie dass sämtliche Vertragsschlüsse unseren 
			<a href="http://www.portrait-service.com/portrait-archiv/allgemeine-geschaftsbestimmungen/" target="_blank">Allgemeinen 
			Geschäftsbedingungen</a> unterliegen.
			<br/><br/>
			Um Ihr eigenes Online-Archiv zu eröffnen füllen Sie bitte das Formular unter der folgenden URL aus:<br/>
			<a href="https://www.portrait-service.com/portrait-archiv/eroffnen-sie-ihr-online-portrait-studio/" target="_blank">https://www.portrait-service.com/portrait-archiv/eroffnen-sie-ihr-online-portrait-studio/</a>
		</div>
	
	<?php 	
 }
 
 function pawps_admin_menu_mainpage() {
 	pawps_showAdminHeader();
 	 
 	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'Ihre aktuelle Berechtigung verhindert den Zugriff auf diese Seite' ) );
	}
	
	?>
	
	<div class="wrap">
		<h3>Was ist Portrait-Archiv</h3>
		Das Portrait-Archiv ist ein Angebot der Firma <a href="http://www.Portrait-Service.com" target="_blank">Portrait-Service</a>.
		Mit Hilfe von Portrait-Archiv haben Sie die Möglichkeit, Ihre Bilder einfach und unkompliziert online zum Verkauf 
		anzubieten. Hierbei genügt es Ihre Bilder in Ihrem Online Archiv zu veröffentlichen und die gewünschten Verkaufspreise 
		der einzelnen Artikel anzugeben. Egal ob Photoabzug, Poster, digitaler Download ... fast alles ist möglich. Die gesamte
		Abwicklung, von der Bestellannahme über den Zahlungseingang bis zur Produktion und Auslieferung übernimmt hierbei 
		Portrait-Archiv für Sie. Pünktlich zum Monatsanfang erhalten Sie Ihre detaillierte Provisionsabrechnung und die 
		Überweisung der angefallenen Provisionen auf Ihr angegebenes Konto. <br/><br/>
		
		Weitere Details zu Portrait-Archiv finden Sie unter den nachfolgenden Links:
		<ul>
			<li><a href="http://www.portrait-service.com/portrait-archiv/funktionsweise/?REF=pawps" target="_blank">die Funktionsweise von Portrait-Archiv</a></li>
			<li><a href="http://www.portrait-service.com/portrait-archiv/hochste-qualitat-in-der-produktion-ihrer-kundenbestellungen/?REF=pawps" target="_blank">Laborpartner</a></li>
			<li><a href="http://www.portrait-service.com/portrait-archiv/berechnen-sie-ihre-individuelle-umsatzsteigerung/?REF=pawps" target="_blank">Steigern Sie Ihren Umsatz durch Ihr Online-Portal</a></li>
			<li><a href="http://www.portrait-service.com/portrait-archiv/unsere-antworten-auf-ihre-fragen/?REF=pawps" target="_blank">FAQ - Sie Fragen, wir Antworten</a></li>
			<li><a href="http://www.portrait-service.com/portrait-archiv/eroffnen-sie-ihr-online-portrait-studio/?REF=pawps" target="_blank">Eröffnen Sie Ihr eigenes Portrait-Archiv</a></li>
		</ul> 
				
		<br/>
		<h3>Funktionsweise</h3>
		<img src="<?php echo plugin_dir_url( __FILE__ ); ?>/assets/img/funktion.png" />
 	</div>
	
	<?php 
 }
 
 function pawps_admin_menu_anleitung() {
 	pawps_showAdminHeader("Anleitung");
 
 	if ( !current_user_can( 'manage_options' ) )  {
 		wp_die( __( 'Ihre aktuelle Berechtigung verhindert den Zugriff auf diese Seite' ) );
 	}
 	
 	?>
 		
 		<div class="wrap">
 			<h3>Systemeinrichtung</h3>
 			Damit das Shopmodul auf Ihre Galerien bei Portrait-Archiv zugreifen ist es notwendig dass Sie die 
 			Systemauthentfizierung durchführen. Führen Sie hierzu die folgenden Schritte durch:
 			<ol>
 				<li>Navigieren Sie innerhalb Ihres Wordpress-Modules zum Menüpunkt 'Portrait-Archiv > Verbindungsdaten'. Wählen Sie
 				die Niederlassung aus, bei welcher Sie über einen Nutzeraccount verfügen und notieren Sie sich den Wert aus dem Feld 'Modul-Token'<br/>
 				<img src="<?php echo plugins_url( 'portrait-archiv-shop/resources/docu/pawps_einrichten_1.png' ); ?>" alt="Modul-Token im WP-Adminbereich" class="pawps_image" width="500px" /></li> 				
 				<li>Loggen Sie sich mit Ihren Userdaten auf Portrait-Archiv ein. Klicken Sie auf dem Menüpunkt 
 				'Wordpress-Konfiguration' im Bereich 'Galerieverwaltung' innerhalb Ihres Benutzermenüs.</li>
 				<li>Tragen Sie dort im Feld 'Modul Token' den im Punkt 1 notierten Token ein<br/>
 				<img src="<?php echo plugins_url( 'portrait-archiv-shop/resources/docu/pawps_einrichten_2.png' ); ?>" alt="Modul-Token im WP-Adminbereich" width="500px" class="pawps_image" /></li>
 				<li>Klicken Sie nun auf den Button 'Konfiguration speichern' und wählen notieren Sie den generierten 'Portrait-Archiv Token'<br/>
 				</li>
 				<li>Notieren Sie sich nun die User-ID sowie den generierten 'Portrait-Archiv Token' und übertragen 
 				sie diese in die entsprechenden Felder in den 'Verbindungsdaten' Ihres Modules.<br/>
 				Speichern Sie die Änderungen durch einen Klick auf den Button 'Verbindungsdaten speichern'<br/>
 				<img src="<?php echo plugins_url( 'portrait-archiv-shop/resources/docu/pawps_einrichten_3.png' ); ?>" alt="Modulkonfiguration abschliessen" width="500px" class="pawps_image" /><br/>
 				Die Verbindung zwischen Portrait-Archiv und Ihrer Wordpress-Modulinstallation ist nun erfolgreich
 				hergestellt.</li> 
 			</ol>
 		
 	 		<h3>mögliche Template-Tags</h3>
 	 		Mit Hilfe des Portrait-Archiv Shopmodules haben Sie die Möglichkeit sowohl eine Liste von Galerien  
 	 		als auch einzelne Galerien in Ihre bestehenden Wordpress-Seiten einzubinden. Hierzu genügt es einen bestimmten Tag 
 	 		in Ihre Seite einzufügen. Das Modul ersetzt dieses Tag selbstständig gegen die entsprechenden Inhalte. <br/>
 	 		<br/>
 	 		Derzeit stehen folgende Template-Tags zur Verfügung: 
 	 		
 	 		<table class="wp-list-table widefat fixed pages">
 				<thead>
 					<tr>
 						<th scope='col' width="230px">Beispiel</th>
 						<th scope='col'>Beschreibung</th>
 						</tr>
 				</thead>
 				<tbody id="the-list">
 					<tr valign="top">
 						<td>[pawps_publicList]</td>
 						<td>
 							Fügt eine Liste aller Ihrer Gallieren ein, welche von Ihnen für die Anzeige in der 
 							öffentlichen Liste markiert wurden. Die Galerien werden mit dem Titel sowie einem zufälligen
 							Vorschaubild aus der Galerie dargestellt.  Nach dem Klick auf den Titel oder das Vorschaubild
 							gelangt Ihr Besucher, je nach Konfiguration, entweder zur Eingabe des von Ihnen hinterlegten 
 							Gästekennwortes oder direkt zur Galerie.
 						</td>
 					</tr>
 					<tr valign="top">
 						<td>[pawps_galerie]1[/pawps_galerie]</td>
 						<td>
 							Fügt eine einzelne Galerie zur Anzeige in Ihre Seite ein. Die ID der gewählte Galerie entspricht 
 							der in der Galerieübersicht angezeigten numerischen ID. Ersetzen Sie einfach die 1 aus dem Beispiel
 							gegen die gewünschte ID um die Galerie in Ihre Seite einzufügen. Der Besucher wird direkt beim Besuch 
 							der Seite auf die gewünschte Galerie bzw. zur Abfrage des hitnerlegten Gästekennwortes geleitet. 
 						</td>
 					</tr>
 					<tr valign="top">
 						<td>[pawps_galeriecode]</td>
 						<td>
 							Fügt den Dialog zur Eingabe des Portrait-Archiv Galeriecodes ein. Bei Aufruf der Seite mit dem eingefügten 
 							Tag ist lediglich der Eingabedialog sichtbar. Nach Eingabe des entsprechenden Galeriecodes gelangt der Besucher 
 							zur jeweiligen Galerie. 
 						</td>
 					</tr>
 					<tr valign="top">
 						<td>[pawps_password]</td>
 						<td>
 							Fügt den Dialog zur Eingabe eines Gästepasswortes ein. Bei Aufruf der Seite mit dem eingefügten 
 							Tag ist lediglich der Passwortdialog sichtbar. Nach Eingabe des individuell festgelegten Gästekennwortes 
 							gelangt der Besucher zur jeweiligen Galerie. 
 						</td>
 					</tr>
 				</tbody>
 			</table>
 			
 			<h3>weitere Hilfeartikel</h3>
 	 		<ul>
 	 			<li><a href="http://www.portrait-service.com/portrait-archiv/unsere-antworten-auf-ihre-fragen/wie-stelle-ich-die-verbindung-zwischen-wordpress-und-meinen-galerien-her/" target="_blank">Wie stelle ich die Verbindung zwischen WordPress und meinen Galerien her?</a></li>
 	 			<li><a href="http://www.portrait-service.com/portrait-archiv/unsere-antworten-auf-ihre-fragen/wie-kann-ich-meine-shootings-in-meinen-wordpress-blog-integrieren/" target="_blank">Wie kann ich meine Shootings in meinen WordPress-Blog integrieren?</a></li>
 	 			<li><a href="http://www.portrait-service.com/portrait-archiv/unsere-antworten-auf-ihre-fragen/wie-kann-ich-den-anzeigemodus-einer-galerie-aendern/" target="_blank">Wie kann ich den Anzeigemodus einer Galerie ändern?</a></li>
 	 		</ul>
 	 	</div>
 		
 		<?php  	
 }
 
 function pawps_admin_menu_config() {
 	pawps_showAdminHeader("Konfiguration");
 
 	if ( !current_user_can( 'manage_options' ) )  {
 		wp_die( __( 'Ihre aktuelle Berechtigung verhindert den Zugriff auf diese Seite' ) );
 	}
 	
 	if (isset($_POST['saveGlobalConfig']) && wp_verify_nonce($_POST['nonce'], 'wp_changeconfig')) {
 		update_option(PAWPS_OPTION_BOOTSTRAP_ADMIN, sanitize_text_field($_POST['pawps_bootstrapAdmin']));
 		update_option(PAWPS_OPTION_BOOTSTRAP_PUBLIC, sanitize_text_field($_POST['pawps_bootstrapPublic']));
 		update_option(PAWPS_OPTION_COUNT_IMAGES, sanitize_text_field($_POST['pawps_imagesPerPage']));
 	}
 	
 	?>
 	
 	<div class="wrap">
		<h3>Grundkonfiguration</h3>
		Das Portrait-Archiv.com Wordpress-Modul setzt für die Darstellung der Galerien auf JQuery und Bootstrap.<br/>
		<br/>
		<form name="shootingConfigForm" method="post" action="">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('wp_changeconfig'); ?>" />
			<?php include "portrait-archiv-errorhandler.php"; ?>
 	 		<table class="wp-list-table widefat fixed pages">
 				<tbody id="the-list">
 					<tr valign="top">
 						<td width="300px">eigenes Bootstrap im Admin nutzen</td>
 						<td>
 							<select name="pawps_bootstrapAdmin">
 								<option value="1" <?php if (get_option(PAWPS_OPTION_BOOTSTRAP_ADMIN, 1) == "1") { echo "selected"; } ?>>Ja, Moduleigenes Bootstrap nutzen</option>
 								<option value="0" <?php if (get_option(PAWPS_OPTION_BOOTSTRAP_ADMIN, 1) == "0") { echo "selected"; } ?>>Nein, eigenes Bootstrap deaktivieren</option>
 							</select>
 						</td>
 					</tr>
 					<tr valign="top">
 						<td>eigenes Bootstrap im Template nutzen</td>
 						<td>
 							<select name="pawps_bootstrapPublic">
 								<option value="1" <?php if (get_option(PAWPS_OPTION_BOOTSTRAP_PUBLIC, 1) == "1") { echo "selected"; } ?>>Ja, Moduleigenes Bootstrap nutzen</option>
 								<option value="0" <?php if (get_option(PAWPS_OPTION_BOOTSTRAP_PUBLIC, 1) == "0") { echo "selected"; } ?>>Nein, eigenes Bootstrap deaktivieren</option>
 							</select>
 						</td>
 					</tr>
					<tr valign="top">
 						<td>Fotos je Seite</td>
 						<td>
 							<input type="text" name="pawps_imagesPerPage" value="<?php echo get_option(PAWPS_OPTION_COUNT_IMAGES, 24); ?>" size="2" maxlength="2">
 						</td>
 					</tr>
 				</tbody>
 			</table> 
			<p class="submit">
				<input type="submit" name="saveGlobalConfig" class="button-primary" value="Konfiguration speichern" />
			</p>
		</form>
	</div>
 	
 	<?php 
 }

 function pawps_admin_menu_grundeinstellungen() {
	pawps_showAdminHeader("Verbindungsdaten");
 	 	
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'Ihre aktuelle Berechtigung verhindert den Zugriff auf diese Seite' ) );
	}

	if (isset($_POST['resetGrundeinstellung']) && wp_verify_nonce($_POST['nonce'], 'pa_connectiondata')) {
		update_option(PAWPS_OPTION_HASHKEY, pawps_generateLocalHash());
		update_option(PAWPS_OPTION_USERID, '');
		update_option(PAWPS_OPTION_HASHKEY_REMOTE, '');
	}
	
	// alte Werte aus Options laden
	$paHash = get_option(PAWPS_OPTION_HASHKEY);
	$paHashRemote = get_option(PAWPS_OPTION_HASHKEY_REMOTE);
	$paUserId = get_option(PAWPS_OPTION_USERID);
	$paSystemCountry = get_option(PAWPS_SYSTEMCOUNTRY);
	
	if (isset($_POST['grundeinstellungSubmit']) && wp_verify_nonce($_POST['nonce'], 'pa_connectiondata')) {
		// Einstellungen übernehmen
		$paHashRemote = sanitize_text_field(trim($_POST['PA_HASHKEY_REMOTE']));
		$paUserId = sanitize_text_field(trim($_POST['PA_USERID']));
		
		update_option(PAWPS_OPTION_HASHKEY_REMOTE, $paHashRemote );
		update_option(PAWPS_OPTION_USERID, $paUserId);
		update_option(PAWPS_SYSTEMCOUNTRY, sanitize_text_field($_POST['PA_NIEDERLASSUNG']));
		
		// Verbindung prüfen
		if (!isset($error) || (strlen($error) == 0)) {
			if (!pawps_isConnectionWorking()) {
				$error = "Die Verbindung konnte nicht hergestellt werden, bitte überprüfen Sie die hinterlegten Token";
			} else {
				// Datenbank leeren
				require_once plugin_dir_path ( __FILE__ ) .'/portraitarchiv-setup.php';
				pawps_clearDatabaseValues();
				pawps_refreshShootings();
				$message = "Die Verbindung wurde erfolgreich hergestellt und alle lokalen Veranstaltungsdaten entfernt";
			}
		}
	}	
	
	?>
 		<div class="wrap">
 			<h3>Portrait-Archiv Verbindungsdaten</h3>
 			<?php include "portrait-archiv-errorhandler.php"; ?>
 			<form name="verbindungsDatenForm" method="post" action="">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('pa_connectiondata'); ?>" />
				<table class="wp-list-table widefat fixed pages">
					<tr>
						<td width="150px">User-ID:</td>
						<td><input type="text" name="PA_USERID" value="<?php echo $paUserId; ?>" size="10" maxlength="10" ></td>
					</tr>
					<tr>
						<td>Portrait-Archiv Niederlassung:</td>
						<td>
							<select name="PA_NIEDERLASSUNG">
								<option value="DE"<?php if ($paSystemCountry == 'DE') echo " selected"; ?>>Deutschland (Portrait-Archiv)</option>
								<option value="CH"<?php if ($paSystemCountry == 'CH') echo " selected"; ?>>Schweiz (Portrait-Archiv.ch)</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Modul-Token:</td>
						<td>
							<input type="text" name="PA_HASHKEY" value="<?php echo $paHash; ?>" size="20" maxlength="20" readonly>
							<div style="font-size:10px"><b>Hinweis:</b> Dieser Token muss von Ihnen auf Portrait-Archiv in Ihrer Wordpress-Konfiguration hinterlegt werden</div>
						</td>
					</tr>
					<tr>
						<td>Portrait-Archiv Token:</td>
						<td>
							<input type="text" name="PA_HASHKEY_REMOTE" value="<?php echo $paHashRemote; ?>" size="20" maxlength="20" >
							<div style="font-size:10px"><b>Hinweis:</b> Dieser Token wird Ihnen nach Eingabe des Modul-Tokes auf Portrait-Archiv bereitgestellt und muss hier hinterlegt werden</div>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="submit" name="grundeinstellungSubmit" class="button-primary" value="Verbindungsdaten speichern" />
					<input type="submit" name="resetGrundeinstellung" class="button-primary" value="aktuelle Konfiguration löschen" />
				</p>
			
			</form>
 		</div>
 		
 	<?php  	 		
 }
 
 function pawps_admin_menu_shootings() {
	pawps_showAdminHeader("Galerien"); 
 		
 	if ( !current_user_can( 'manage_options' ) )  {
 		wp_die( __( 'Ihre aktuelle Berechtigung verhindert den Zugriff auf diese Seite' ) );
 	}

 	if (!pawps_isConnectionWorking()) {
		wp_die( __( 'Bitte konfigurieren Sie zunächst die Verbindung im Menü >Verbindungsdaten<' ) );
	}

	// Errors anzeigen
	include "portrait-archiv-errorhandler.php";

	// Entscheiden was anzuzeigen ist
	if (isset($_GET['showShootingImages']) && is_numeric($_GET['showShootingImages'])) {
		pawps_admin_content_shootingImages(sanitize_text_field($_GET['showShootingImages']));
	} else if (isset($_GET['editShootingConfig']) && is_numeric($_GET['editShootingConfig'])) {
		pawps_admin_content_shootingEditConfig(sanitize_text_field($_GET['editShootingConfig']));
	} else {
		pawps_admin_content_shootingList();
	}	
 }
 
 function pawps_admin_content_shootingEditConfig($shootingId) {
 	$shooting = pawps_loadShootingByData($shootingId);
 
 	if (!isset($shooting)) {
 		$error = "Das gewünschte Shooting konnte nicht geladen werden";
 		pawps_admin_content_shootingList();
 		exit();
 	}
 	
 	// Anzeigen
 	$config = pawps_loadShootingConfig(null, $shooting->accesscode);
 	
 	if (!isset($config)) {
		// Keine Config vorhanden -> lege leere an
		global $wpdb;
		
		$wpdb->insert(
			PAWPS_TABLENAME_CONFIG,
			array(
					'shootingcode' => $shooting->accesscode
			));

		$config = pawps_loadShootingConfig(null, $shooting->accesscode);
	}
	
	if (!isset($config)) {
		$error = "Beim Laden der gewünschten Informationen ist ein Fehler aufgetreten.";
		pawps_admin_content_shootingList();
		exit();
	}

	if (isset($_POST['shootingConfigSpeichern']) && wp_verify_nonce($_POST['nonce'], 'pa_shootingconfig')) {
		// geÃƒÂ¤nderte Konfigurationswerte übernehmen und persistieren
		global $wpdb;
		
		$pwd = "";
		if (isset($_POST['PA_SHOOTINGTYPE']) && 
			(($_POST['PA_SHOOTINGTYPE'] == "1") || ($_POST['PA_SHOOTINGTYPE'] == "3"))) {
			// Gästepasswort validieren
			if (strlen($_POST['PA_GUESTPASSWORD']) == 0) {
				$error = "Bei dem von Ihnen gewählten Shooting-Typ ist die Angabe eines Gästepasswortes zwingend erforderlich";
			} else {
				// Prüfe ob Passwort eindeutig
				$sql = "SELECT COUNT(*) FROM " . PAWPS_TABLENAME_CONFIG . " WHERE ";
				$sql .= "id<>" . $config->id;
				$sql .= " AND guestpassword='" . sanitize_text_field($_POST['PA_GUESTPASSWORD']) . "'";
				$count = $wpdb->get_var( $sql );
				if ($count > 0) {
					$error = "Das von Ihnen gewählte Gästepasswort ist bereits vergeben.";
				} else {
					$pwd = sanitize_text_field($_POST['PA_GUESTPASSWORD']);
				}
			}
		}
		
		if (!isset($error) & (strlen($error) < 1)) {
			// änderungen persistieren
			// Existiert -> aktualisieren
			$wpdb->update(
					PAWPS_TABLENAME_CONFIG,
					array(
							'state' => sanitize_text_field($_POST['PA_SHOOTINGTYPE']),
							'guestpassword' => $pwd
					),
					array(
							'id' => $config->id
					));

			$message = "Ihre Änderungen wurden gespeichert";
		}
		
		$config = pawps_loadShootingConfig($config->id);
	}
	
	// Config anzeigen ...
	?>
	<div class="wrap">
		<h3>Folgende Konfiguration wurde derzeit für das Shooting '<?php echo $shooting->title; ?>' hinterlegt</h3>
		
		<h4>Basisinformationen</h4>
		<table class="wp-list-table widefat fixed pages">
			<tr>
				<td width="150px">Titel:</td>
				<td>
					<?php echo $shooting->title; ?>
				</td>
			</tr>
			<tr>
				<td>Datum:</td>
				<td><?php echo $shooting->shootingdate; ?></td>
			</tr>
			<tr>
				<td>Anzahl Bilder:</td>
				<td><?php echo $shooting->imageCount; ?></td>
			</tr>
		</table>
		
		<h4>Konfiguration</h4>
		<form name="shootingConfigForm" method="post" action="">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('pa_shootingconfig'); ?>" />
			<?php include "portrait-archiv-errorhandler.php"; ?>
			<table class="wp-list-table widefat fixed pages">
				<tr>
					<td width="150px">Shooting-Typ:</td>
					<td>
						<select name="PA_SHOOTINGTYPE">
							<option value="0" <?php if ($config->state == 0) echo 'selected';?>>inaktiv - Shooting ist auf dieser Seite nicht verfügbar</option>
							<option value="1" <?php if ($config->state == 1) echo 'selected';?>>Verfügbar durch Eingabe des Gästepasswortes</option>
							<option value="5" <?php if ($config->state == 5) echo 'selected';?>>Verfügbar durch Eingabe des Galeriecodes</option>
							<option value="2" <?php if ($config->state == 2) echo 'selected';?>>Darstellung in öffentlicher Liste ohne Passwort</option>
							<option value="3" <?php if ($config->state == 3) echo 'selected';?>>Darstellung in öffentlicher Liste mit Gästepasswort</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Gästepasswort:</td>
					<td><input type="text" name="PA_GUESTPASSWORD" value="<?php echo $config->getPassword(); ?>" size="25" maxlength="25" ></td>
				</tr>
			</table>
			
			<p class="submit">
				<input type="submit" name="shootingConfigSpeichern" class="button-primary" value="Konfiguration speichern" />
			</p>
		</form>
	</div>
	<?php 
 }
 
 function pawps_admin_content_shootingImages($shootingId) {
 	$shooting = pawps_loadShootingByData($shootingId);
 	
 	if (!isset($shooting)) {
 		$error = "Das gewünschte Shooting konnte nicht geladen werden";
 		pawps_admin_content_shootingList();
 		exit();
 	}
 	
 	?>
 	<div class="container">
	 	<h1>Galerie-Titel: '<span id="galerieTitel"></span>' - <span id="anzahlBilder"></span> Bilder</h1>
	 	<div class="row">
	 		<div class="text-center">
	 			<ul id="pagination" style="display: none;"></ul>
	 		</div>
	 	</div>
	 	
	 	<div class="row" id="images">
 		</div>
 	</div>
    
 	<?php
 		$hideSubFolders = true;
 		
 		include 'js/galerieList.php'; 
 }

 function pawps_admin_content_shootingList() {
	// führe direkten Refresh durch	
	if (isset($_POST['manuellerDatenrefreshDurchfuehren']) && wp_verify_nonce($_POST['nonce'], 'pa_refresh')) {
		update_option(PAWPS_LAST_UPDATE_SHOOTINGS, 0);
		pawps_refreshShootings();
	}
	
	// loesche Datenbankinhalte
	if (isset($_POST['manuelleDatenbereinigungDurchfuehren']) && wp_verify_nonce($_POST['nonce'], 'pa_refresh')) {
		require_once plugin_dir_path( __FILE__ ) .'/portraitarchiv-setup.php';
		pawps_clearDatabaseValues();
	}
	
	?>
		<div class="wrap">
	  		<form name="refreshForm" method="post" action="">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('pa_refresh'); ?>" />
	 			<?php 
	 				$lastLocaleUpdate = get_option(PAWPS_LAST_UPDATE_SHOOTINGS);	 	
	 				if (strlen($lastLocaleUpdate) > 5) {
						$lastLocaleUpdateString = date('d.m.Y H:i:s', $lastLocaleUpdate / 1000);
					} else {
						unset ($lastLocaleUpdateString);
					}
					
					if (isset($lastLocaleUpdateString)) {
						// Aktualisierung wurde bereits durchgeführt
						$remoteUpdateString = date('d.m.Y H:i:s', pawps_getRemoteLastUpdate() / 1000);
						?> Die letzten Datenaktualisierungen: Modul: <?php echo $lastLocaleUpdateString; ?>, Online: <?php echo $remoteUpdateString; ?>.<br/><?php 
					} else {
						// noch keine Aktualisierung durchgefÃƒÂ¼hrt
						?> Ihre Daten wurden bisher noch nicht aktualisiert / geladen. Bitte füren Sie eine manuelle Datenaktualisierung durch. <?php
					}				
	 			?>
					Zur manuellen Datenaktualisierung genügt ein Klick auf den folgenden Button:					
					<p class="submit">
						<input type="submit" name="manuellerDatenrefreshDurchfuehren" class="button-primary" value="<?php esc_attr_e('Refresh') ?>" />
					</p>
			</form>
			
			<h3>Aktuelle Galerien</h3>
			<?php 
				$aktuelleShootings = pawps_getShootingList();
				if (isset($aktuelleShootings) && (count($aktuelleShootings) > 0)) {
					// Shootings vorhanden
					?>
						<table class="wp-list-table widefat fixed pages">
							<thead>
								<tr>
									<th scope='col' width='50px'>&nbsp;</th>
									<th scope='col' width='50px'>ID</th>
									<th scope='col'>Titel</th>
									<th scope='col' width='150px'>Datum</th>
									<th scope='col' width='150px'>Anzahl Bilder</th>
									<th scope='col' width='50px'>Status</th>
								</tr>
							</thead>
							<tbody id="the-list">
								<?php 
									foreach ($aktuelleShootings as $shooting) {
										echo "<tr valign=\"top\">";
											echo "<td align='center'>";
											echo "<a href='" . add_query_arg ('showShootingImages', $shooting->id) . "' title='Bilder der Galerie anzeigen'><img src='" . plugins_url( 'resources/eye.png' , __FILE__ ) . "' border='0' height='15px' width='15px' /></a>";
											echo "</td>";
											echo "<td>";
											echo $shooting->id;
											echo "</td>";
											echo "<td>";
											echo $shooting->title;
											echo "<br/>";
											echo "<a href='https://www.Portrait-Archiv/?vCode=" . $shooting->accesscode . "' target='_blank'>" . $shooting->accesscode . "</a>"; 
											echo "</td>";
											echo "<td>" . date('d.m.Y', strtotime($shooting->shootingdate)) . "</td>";
											echo "<td>" . $shooting->imageCount . "</td>";
											echo "<td align='center'>";
												echo "<a href='" . add_query_arg ('editShootingConfig', $shooting->id) . "'>";
												if ($shooting->getIntegrationState() == 0) {
													echo "<img src='" . plugins_url( 'resources/x_alt.png' , __FILE__ ) . "' border='0' height='15px' width='15px' title='nicht angeboten' />";
												} else if (($shooting->getIntegrationState() == 2) || ($shooting->getIntegrationState() == 4)) {
													echo "<img src='" . plugins_url( 'resources/unlock_stroke.png' , __FILE__ ) . "' border='0' height='15px' width='15px' title='oeffentlich, ohne Passwort' />";
												} else {
													echo "<img src='" . plugins_url( 'resources/unlock_fill.png' , __FILE__ ) . "' border='0' height='15px' width='15px' title='mit Gaestepasswort' />";
												}
												echo "</a>";
											echo "</td>";
											echo "</tr>";
									}
								?>
							</tbody>
						</table>
						
						<h4>Legende</h4>
						<ul>
							<li><img src='<?php echo plugins_url( 'resources/x_alt.png' , __FILE__ ); ?>' border='0' height='15px' width='15px' title='nicht angeboten' /> - Veranstaltung nicht öffentlich verfügbar</li>
							<li><img src='<?php echo plugins_url( 'resources/unlock_stroke.png' , __FILE__ ); ?>' border='0' height='15px' width='15px' title='öffentlich ohne Kennwort' /> - Veranstaltung öffentlich verfügbar - ohne Gästekennwort</li>
							<li><img src='<?php echo plugins_url( 'resources/unlock_fill.png' , __FILE__ ); ?>' border='0' height='15px' width='15px' title='nur mit Kennwort' /> - Veranstaltung verfügbar - nur mit Gästekennwort</li>
						</ul>
						
					<?php 
				} else {
					// keine Shootings vorhanden
					?>- Bisher sind keine Galerien für Sie hinterlegt - <?php 
				}
			
			?>
			
			<?php 
				if (isset($lastLocaleUpdateString)) {
			?>
					<h3>manuelle Datenbereinigung</h3>
					<form name="cleanupForm" method="post" action="">
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('pa_refresh'); ?>" />
						Zur manuellen Bereinitung der Datenbank klicken Sie bitte auf den folgenden Button:
						<p class="submit">
							<input type="submit" name="manuelleDatenbereinigungDurchfuehren" class="button-primary" value="<?php esc_attr_e('Clean') ?>" />
						</p>
					</form>					
			<?php 
				}			
			?>
		</div>
		<?php 
  }
?>