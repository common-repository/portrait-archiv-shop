﻿=== Portrait-Archiv.com Photostore ===
Contributors: Thomas Schiffler
Tags: Portrait-Archiv, Store, Onlineshop, Shop, Foto, Bild, verkaufen
Donate link: http://www.Portrait-Service.com
Requires at least: 3.0.1
Tested up to: 5.3
Stable tag: 3.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Der Portrait-Archiv.com Photostore stellt dem Benutzer die Moeglichkeit zur einfachen Integration eines Online Foto Nachbestellsystems zur Verfuegung

== Description ==
Das Portrait-Archiv ist ein Angebot der Firma Portrait-Service. 
Mit Hilfe von Portrait-Archiv haben Sie die Möglichkeit, Ihre Bilder einfach und unkompliziert online zum Verkauf anzubieten. Hierbei genügt es Ihre Bilder in Ihrem Online Archiv zu veröffentlichen und die gewünschten Verkaufspreise  der einzelnen Artikel anzugeben. Egal ob Photoabzug, Poster, digitaler Download ... fast alles ist möglich. Die gesamte Abwicklung, von der Bestellannahme über den Zahlungseingang bis zur Produktion und Auslieferung übernimmt hierbei Portrait-Service für Sie. Pünktlich zum Monatsanfang erhalten Sie Ihre detaillierte Provisionsabrechnung und die Überweisung der angefallenen Provisionen auf Ihr angegebenes Konto.

Mit Hilfe dieses Modules haben Sie die Möglichkeit Ihre bei Portrait-Archiv.com oder Portrait-Archiv.ch veröffentlichten Onlinegalerien einfach und unkompliziert in Ihre bestehende Wordpress-Seite zu integrieren. 

Folgende Funktionen stehen Ihnen derzeit zur Verfügung:
* Anzeige einzelner Galerien (mit oder ohne individuellem Gästekennwort)
* Anzeige einer Liste von Galerien (mit oder ohne individuellem Gästekennwort)
* Eingabe eines Gästekennwortes mit Anzeige der jeweilig gültigen Galerie
* Bestellfunktion der Bilder mit automatischer Übertragung zu Portrait-Archiv.com / Portrait-Archiv.ch
* Bezahlung per Vorkasse oder PayPal

Weitere Informationen zur Benutzung des Online Foto Nachbestellsystems 'Portrait-Archiv' finden Sie auf unserer Informationsseite unter folgendem Link:
http://www.portrait-service.com/portrait-archiv

== Installation ==
1. Plugin herunterladen, entpacken und Plugin-Ordner 'portrait-archiv-shop' per FTP nach wp-content/plugins übertragen
2. Plugin im Menü "Plugins" im Wordpress-Adminbereich aktivieren
3. Konfiguration unter Menüpunkt "Portrait-Archiv.com > Grundeinstellungen" vornehmen
4. gewünschten Tag in Seite einfügen

Weitere Informationen entnehmen Sie bitte dem Menüpunkt "Portrait-Archiv.com > Anleitung" nach Installation des Plugins

== Frequently Asked Questions ==
= Kann ich das Plugin auch ausserhalb Deutschlands nutzen? =
Ja, prinzipiell ist die Nutzung des Modules auch ausserhalb Deutschlands möglich. Bitte beachten Sie hierbei allerdings dass 
einige Labore die Lieferung von Fotoabzügen, Postern oder Leinwänden nur innerhalb Deutschlands anbieten. 
Der Verkauf von digitalen Bildprodukten ist selbstverständlich weltweit möglich.
Zur Anmeldung eines Portrait-Archiv.com Accounts aus dem Ausland kontaktieren Sie uns bitte über Portrait-Service.com

= Wie veröffentliche ich Galerien? =
Das Plugin zeigt Ihnen alle unter Ihrem Benutzeraccount auf Portrait-Archiv.com veröffentlichten Galerien an. Um eine neue Galerie
zu veröffentlichen gehen Sie einfach wie gewohnt vor und veröffentlichen die Galerie auf Portrait-Archiv.com. Die neue Galerie 
wird automatisch in die Galerieliste in Ihrem Adminbereich aufgenommen. 

= Ich habe eine neue Galerie auf Portrait-Archiv veröffentlicht, diese wird aber nicht angezeigt =
Das Plugin arbeitet intern mit einem kleinen Caching-Mechanismus. Hierdurch soll der Seitenaufbau beschleunigt und unnötige Anfragen 
zwischen Ihrem Blog und Portrait-Archiv.com vermieden werden. Änderungen werden automatisch täglich synchronisiert, sollten Sie eine 
direkte Aktualisierung Ihrer Daten wünschen so genügt ein Klick auf den Button 'Aktualisieren' in der Administration unter dem
Menüpunkt 'Galerien'.

== Screenshots ==
1. Anzeige aller Galerien im Admin-Bereich
2. Entscheiden Sie, wie Sie Ihre Galerie veröffentlichen möchten
3. Anzeige einer Galerie auf Ihrer Internetseite
4. Der Warenkorb

== Changelog ==
= 3.7 = 
* Bugfix für Übertragung der Bestellung

= 3.5 =
* Stabilität verbessert

= 3.1 =
* kleine Anpassungen für Wordpress 5

= 3.0 =
* Anbindung der neuen REST-API von Portrait-Archiv.com
* Umstellung auf JQuery und Bootstrap im Frontend
* starke Performanceoptimierung
* kleine Bugfixes im täglichen Update der Galerien
* Reduzierung der lokalen Datenhaltung auf ein Minimum

= 2.3 =
* Optimierung der Cron-Jobs zur aktualisierung der Galerien
* Entfernung von Verwendung von deprecated Methoden
* kleine Bugfixes im Adminbereich
* Zahlungsweise PayPal nur noch anbieten wenn Rechnungsbetrag > 0 Euro
* Anpassungen für neue Wordpress-Modulverzeichnis

= 2.2.3 =
* kleine Bugfixes in Verbindung mit PHP 7
* Sortierung der Galerieliste nach Datum

= 2.2 =
* Bereitstellung des Buttons zur Tagerstellung im Editor
* neue TLDs als valide Domains hinzugenommen
* kleine Anpassungen im Layout

= 2.1.3 =
* Bugfix bei täglichem Shooting-Refresh

= 2.1 =
* technische Backendumstellung
* Anbindung der Schweizer Niederlassung
* Einbindung von PayPal als Zahlungsweise
* neues zusätzliches Bootstrap-Template (Responsive Design) 

= 1.7 =
* erste Vorbereitungen für Relaunch von Portrait-Archiv.com

= 1.6.4 = 
* kleiner Bugfix bei Rundungen im Warenkorb

= 1.6.2 = 
* kleiner Bugfix bei CURL Verbindungen

= 1.6 =
* Fallbacklösung falls Serverkonfiguration Remotezugriff nicht erlaubt

= 1.5 =
* Anzeige der Galerien mit Unterordnern ermöglicht

= 1.4 =
* neues Template-Tag - Einbindung über Galeriecode
* Template-Editor - Erstellen Sie direkt online Ihre eigenen Templates
* Korrektur kleinerer Fehler

= 1.3 =
* kleine Fixes

= 1.2 =
* kleine Performanceoptimierungen
* Eröffnung eines Portrait-Archiv.com Accounts direkt über das Modul

= 1.0.1 =
* kleine Anpassungen im Default-Template
* Erweiterung der Readme zur Anzeige der Bilder im Pluginverzeichnis

= 1.0 =
* erste initiale Veröffentlichung

== Upgrade Notice ==
= 1.0 =
* erste initiale Veröffentlichung