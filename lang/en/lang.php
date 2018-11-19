<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * English language file for upgrade plugin
 *
 * @author Katerina Katapodi <extragold1234@hotmail.com>
 * @author Andreas Gohr <andi@splitbrain.org>
 */
$lang['menu']                  = 'Αναβάθμιση του Wiki';
$lang['vs_php']                = 'Οι συνεισφορές του DokuWiki χρειάζονται PHP %s,τουλάχιστον αλλά λειτουργεί με  %s. Πρέπει να αναβαθμίσετε το PHP όπως είναι πριν την αναβάθμιση !';
$lang['vs_tgzno']              = 'Δεν μπόρεσε να προσδιορίσει την πιο πρόσφατη εκδοχή του  DokuWiki.';
$lang['vs_tgz']                = 'DokuWiki <b>%s</b> είναι διαθέσιμο να κατεβάσετε από τον υπολογιστή.';
$lang['vs_local']              = 'Αυτή την στιγμή χειρίζεστε την λειτουργία του DokuWiki <b>%s</b>.';
$lang['vs_localno']            = 'Δεν είναι σαφές πόσο παλιά είναι η παρούσα μορφή/εκδοχή , συστήνεται χειροκίνητη αναβάθμιση';
$lang['vs_newer']              = 'Φαίνεται πως το παρόν DokuWiki είναι πολύ νεότερο από την τελευταία του μορφή. Δεν χρειάζεται αναβάθμιση. ';
$lang['vs_same']               = 'Το παρόν σας  DokuWiki είναι ήδη νέο. Δεν χρειάζεται αναβάθμιση.';
$lang['vs_plugin']             = 'Υπάρχει ένα νέο πρόσθετο διαθέσιμο  (%s) που πρέπει να ενημερώσετε πριν συνεχίσετε.';
$lang['vs_ssl']                = 'Φαίνεται πως το PHP δεν υποστηρίζει λειτουργία του SSL , το κατέβασμα  δεδομένων υπολογιστή μάλλον θα  αποτύχει. Χρειάζεται αντιθέτως αναβάθμιση με το χέρι. ';
$lang['dl_from']               = 'Κατέβασμα αρχείου από %s...';
$lang['dl_fail']               = 'Το κατέβασμα από τον υπολογιστή απέτυχε.';
$lang['dl_done']               = 'Το κατέβασμα από τον υπολογιστή ολοκληρώθηκε(%s).';
$lang['pk_extract']            = 'Διαδικασία κατεβάσματος από τον υπολογιστή..';
$lang['pk_fail']               = 'Το κατέβασμα απέτυχε.';
$lang['pk_done']               = 'Η διαδικασία (ανοίγματος και κατεβάσματος από τον υπολογιστή)ολοκληρώθηκε.';
$lang['pk_version']            = ' Το DokuWiki <b>%s</b> είναι έτοιμο προς εγκατάσταση. (Προς το παρόν γίνεται ολοκλήρωση του <b>%s</b>).';
$lang['ck_start']              = 'Έλεγχος αδειών...';
$lang['ck_done']               = 'Μπορείς να γράψεις σε όλα τα αρχεία.. Έτοιμο προς  αναβάθμιση ';
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
