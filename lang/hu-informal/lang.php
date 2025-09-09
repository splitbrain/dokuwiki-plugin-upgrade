<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * 
 * @author Marina Vladi <deldadam@gmail.com>
 * @author DelD <deldadam@gmail.com>
 * @author Szíjártó Levente Pál <szijartoleventepal@gmail.com>
 */

// menu entry for admin plugins
$lang['menu']                  = 'Wiki-frissítő';

// custom language strings for the plugin
$lang['vs_php']                = 'Az új DokuWiki-verzióknak legalább a PHP %s verziójára van szükség, de ez a wiki a %s verziót használja. A wiki frissítése előtt a PHP-verziót is frissíteni kell!';
$lang['vs_tgzno']              = 'Nem lehet megállapítani a DokuWiki legújabb verzióját.';
$lang['vs_tgz']                = 'Letölthető a DokuWiki <b>%s</b>.';
$lang['vs_local']              = 'Ez a wiki jelenleg a DokuWiki <b>%s</b> változatát használja.';
$lang['vs_localno']            = 'Nem lehet megállapítani, hogy milyen régi a jelenleg használt DokuWiki-verzió. Javasolt a kézi frissítés.';
$lang['vs_newer']              = 'A DokuWiki jelenleg használt verziója újabbnak tűnik, mint a hivatalosan kiadott legfrissebb verzió, ezért a frissítés nem javasolt.';
$lang['vs_same']               = 'Ez a DokuWiki már naprakész – nincs szükség frissítésre.';
$lang['vs_plugin']             = 'Elérhetővé vált a frissítésőbővítmény egy újabb verziója (%s\'). A folytatás előtt a frissítsd a bővítményt.';
$lang['vs_ssl']                = 'Úgy tűnik, hogy a jelenleg telepített PHP-verzió nem támogatja az SSL-adatfolyamokat, ezért a szükséges adatok letöltése jó eséllyel hibás lesz. Javasolt a kézi frissítés.';

$lang['dl_from']               = 'Archívum letöltése a következő helyről: %s…';
$lang['dl_fail']               = 'A letöltés sikertelen.';
$lang['dl_done']               = 'A letöltés befejeződött (%s).';
$lang['pk_extract']            = 'Archívum kicsomagolása folyamatban…';
$lang['pk_fail']               = 'A kicsomagolás sikertelen.';
$lang['pk_done']               = 'A kicsomagolás befejeződött.';
$lang['pk_version']            = 'A DokuWiki <b>%s</b> készen áll a telepítésre. (Jelenlegi verzió: b>%s</b>)';
$lang['ck_start']              = 'Fájlok hozzáférési jogosultságainak ellenőrzése folyamatban…';
$lang['ck_done']               = 'Minden fájl írható. A frissítés készen áll a telepítésre.';
$lang['ck_fail']               = 'Néhány fájl nem írható. Az automatikus frissítés nem lehetséges.';
$lang['cp_start']              = 'Fájlok frissítése folyamatban…';
$lang['cp_done']               = 'Minden fájl frissítve.';
$lang['cp_fail']               = 'Hiba történt. Javasolt a kézi ellenőrzés.';
$lang['tv_noperm']             = 'A(z) <code>%s</code> nem írható.';
$lang['tv_upd']                = 'A(z) <code>%s</code> frissítésre kerül.';
$lang['tv_nocopy']             = 'A(z) <code>%s</code> fájl lemásolása sikertelen.';
$lang['tv_nocopy']             = 'A létező <code>%s</code> fájl másolata felülírás előtt sikertelen.';
$lang['tv_nodir']              = 'A(z) <code>%s</code> könyvtár létrehozása sikertelen.';
$lang['tv_done']               = '<code>%s</code> frissítve';
$lang['rm_done']               = 'Elavult fájl törölve: <code>%s</code>.';
$lang['rm_fail']               = 'Az elavult fájl törlése sikertelen: <code>%s</code>. <b>Javasolt a kézi törlés.</b>';
$lang['rm_mismatch']           = 'Az elavult <code>%s</code> fájl kis- és nagybetűi nem egyeznek a várttal. Ellenőrizd, hogy valóban törölhető-e.';
$lang['finish']                = 'A frissítés kész. Használd egészséggel a DokuWiki új verzióját!';

$lang['btn_continue']          = 'Folytatás';
$lang['btn_abort']             = 'Megszakítás';

$lang['step_version']          = 'Ellenőrzés';
$lang['step_download']         = 'Letöltés';
$lang['step_unpack']           = 'Kicsomagolás';
$lang['step_check']            = 'Vizsgálat';
$lang['step_upgrade']          = 'Telepítés';

$lang['careful']               = 'Hiba történt. A művelet folytatása <b>nem</b> javasolt!';
