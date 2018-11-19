<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * English language file for upgrade plugin
 *
 * @author Katerina Katapodi <extragold1234@hotmail.com>
 * @author Andreas Gohr <andi@splitbrain.org>
 */
$lang['menu']                  = 'Αναβάθμιση Wiki';
$lang['vs_php']                = 'Οι νέες εκδόσεις του DokuWiki χρειάζονται τουλάχιστον PHP %s, αλλά τώρα λειτουργεί το  %s. Πρέπει να αναβαθμίσετε το  PHP σας πριν αυτή την αναβάθμιση !';
$lang['vs_tgzno']              = 'Δεν μπόρεσε να προσδιορίσει την νεότερη εκδοχή του  DokuWiki.';
$lang['vs_tgz']                = 'Το DokuWiki <b>%s</b> είναι διαθέσιμη προς άνοιγμα από τον υπολογιστή.';
$lang['vs_local']              = 'Προς το παρόν λειτουργεί το DokuWiki <b>%s</b>.';
$lang['vs_localno']            = 'Δεν είναι σαφές πόσο παλιά είναι η τρέχουσα λειτουργία, για αυτό συστήνεται αναβάθμιση χειροκίνητα. ';
$lang['vs_newer']              = 'Φαίνεται ότι το τρέχον DokuWiki είναι ακόμη πιο καινούργιο από την πιο πρόσφατη έκδοση. Δεν χρειάζεται αναβάθμιση release. ';
$lang['vs_same']               = 'Το παρόν DokuWiki είναι ήδη ενήμερο. Δεν χρειάζεται αναβάθμιση.';
$lang['vs_plugin']             = 'There is a newer upgrade plugin available (%s) you should update the plugin before continuing.';
$lang['vs_ssl']                = 'Your PHP seems not to support SSL streams, downloading the needed data will most likely fail. Upgrade manually instead.';
$lang['dl_from']               = 'Downloading archive from %s...';
$lang['dl_fail']               = 'Download failed.';
$lang['dl_done']               = 'Download completed (%s).';
$lang['pk_extract']            = 'Unpacking archive...';
$lang['pk_fail']               = 'Unpacking failed.';
$lang['pk_done']               = 'Unpacking completed.';
$lang['pk_version']            = 'DokuWiki <b>%s</b> is ready to install (You\'re currently running <b>%s</b>).';
$lang['ck_start']              = 'Checking file permissions...';
$lang['ck_done']               = 'All files are writable. Ready to upgrade.';
$lang['ck_fail']               = 'Some files aren\'t writable. Automatic upgrade not possible.';
$lang['cp_start']              = 'Updating files...';
$lang['cp_done']               = 'All files updated.';
$lang['cp_fail']               = 'Uh-Oh. Something went wrong. Better check manually.';
$lang['tv_noperm']             = '<code>%s</code> is not writable!';
$lang['tv_upd']                = '<code>%s</code> will be updated.';
$lang['tv_nocopy']             = 'Could not remove existing file <code>%s</code> before overwriting!';
$lang['tv_nodir']              = 'Could not create directory <code>%s</code>!';
$lang['tv_done']               = 'updated <code>%s</code>';
$lang['rm_done']               = 'Deprecated <code>%s</code> deleted.';
$lang['rm_fail']               = 'Could not delete deprecated <code>%s</code>. <b>Please delete manually!</b>';
$lang['rm_mismatch']           = 'Case mismatch for deprecated file <code>%s</code>. Please check manually if file should really be deleted.';
$lang['finish']                = 'Upgrade completed. Enjoy your new DokuWiki';
$lang['btn_continue']          = 'Continue';
$lang['btn_abort']             = 'Abort';
$lang['step_version']          = 'Check';
$lang['step_download']         = 'Download';
$lang['step_unpack']           = 'Unpack';
$lang['step_check']            = 'Verify';
$lang['step_upgrade']          = 'Install';
$lang['careful']               = 'Errors above! You should <b>not</b> continue!';
