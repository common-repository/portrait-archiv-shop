<?php

 // Database wird benötigt um Prefix aufzulösen
 global $wpdb;

 // Definiere benötigte Felder
 define ('PAWPS_OPTION_HASHKEY', 'PAWPS_HASH');
 define ('PAWPS_OPTION_HASHKEY_REMOTE', 'PAWPS_HASH_REMOTE');
 define ('PAWPS_OPTION_USERID', 'PAWPS_USERID');
 define ('PAWPS_OPTION_BOOTSTRAP_ADMIN', 'PAWPS_CFG_BOOTSTR_ADMIN');
 define ('PAWPS_OPTION_BOOTSTRAP_PUBLIC', 'PAWPS_CFG_BOOTSTR_PUB');
 define ('PAWPS_OPTION_COUNT_IMAGES', 'PAWPS_CFG_IMGCOUNT');
 define ('PAWPS_LAST_UPDATE_SHOOTINGS', 'PAWPS_LASTUPDATE_SHOOTINGS');
 define ('PAWPS_CRONJOB', 'PAWPS_CRONJOB');
 define ('PAWPS_DB_VERSION', 'PAWPS_DB_VERSION');
 define ('PAWPS_SYSTEMCOUNTRY', 'PAWPS_SYSTEMCOUNTRY');
 
 define ('PAWPS_TABLENAME_SHOOTINGS', $wpdb->prefix . "PAWPS_SHOOTINGS");
 define ('PAWPS_TABLENAME_CONFIG', $wpdb->prefix . "PAWPS_CONFIG");
 
 // Standardwerte
 define ('PAWPS_USERTPL_START', 'eigeneVorlage-');
 define ('PAWPS_LOCAL_DEV', 0); // 0 = Live, 1 = WS Local, 2 = WS Remote

?>