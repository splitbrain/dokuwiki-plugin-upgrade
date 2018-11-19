<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * English language file for upgrade plugin
 *
 * @author Katerina Katapodi <extragold1234@hotmail.com>
 * @author Andreas Gohr <andi@splitbrain.org>
 */
$lang['menu']                  = 'Wiki Upgrade';
$lang['vs_php']                = 'New DokuWiki releases need at least PHP %s, but you\'re running %s. You should upgrade your PHP version before upgrading!';
$lang['vs_tgzno']              = 'Could not determine the newest version of DokuWiki.';
$lang['vs_tgz']                = 'DokuWiki <b>%s</b> is available for download.';
$lang['vs_local']              = 'You\'re currently running DokuWiki <b>%s</b>.';
$lang['vs_localno']            = 'It\'s not clear how old your currently running version is, manual upgrade is recommended.';
$lang['vs_newer']              = 'It seems your current DokuWiki is even newer than the latest stable release. Upgrade not recommended.';
$lang['vs_same']               = 'Your current DokuWiki is already up to date. No need for upgrading.';
$lang['vs_plugin']             = 'Υπάρχει μια νεώτερη εκδοχή αναβάθμισης, το (%s) πρέπει να ενημερώσετε την έκδοση πριν συνεχίσετε.';
$lang['vs_ssl']                = 'Το PHP φαίνεται να υποστηρίζει την λειτουργία  SSL , το κατέβασμα από τον υπολογιστή των δεδομένων που χρειάζονται, μάλλον θα αποτύχει. Αναβάθμιση πρέπει να γίνει χειροκίνητα.';
$lang['dl_from']               = 'Φόρτωση αρχείου από %s...';
$lang['dl_fail']               = 'Η εκφόρτωση αρχείου απέτυχε';
$lang['dl_done']               = 'Η εκφόρτωση αρχείου ολοκληρώθηκε (%s).';
$lang['pk_extract']            = 'Άνοιγμα αρχείου ..';
$lang['pk_fail']               = 'Το άνοιγμα αρχείου απέτυχε.';
$lang['pk_done']               = 'Το άνοιγμα αρχείου ολοκληρώθηκε';
$lang['pk_version']            = ' Το DokuWiki <b>%s</b> είναι έτοιμο για εγκατάσταση (Προς το παρόν χειρίζεστε την λειτουργία του<b>%s</b>).';
$lang['ck_start']              = 'Έλεγχος αδειών...';
$lang['ck_done']               = 'Όλα τα αρχεία είναι έτοιμα προς επεξεργασία. Έτοιμα προς αναβάθμιση. . ';
$lang['ck_fail']               = 'Μερικά αρχεία δεν είναι σε μορφή επεξεργασίας και δεν μπορείς να γράψεις.. Η αυτόματη αναβάθμιση δεν είναι δυνατή. ';
$lang['cp_start']              = 'Ενημέρωση αρχείων...';
$lang['cp_done']               = 'Όλα τα αρχεία ενημερώθηκαν..';
$lang['cp_fail']               = 'Ω,. Κάτι πήγε στραβά. Καλύτερα να τα ελέγξετε προσωπικά.';
$lang['tv_noperm']             = ' Το <code>%s</code> δεν είναι σε μορφή επεξεργασίας και δεν μπορείς να γράψεις!';
$lang['tv_upd']                = ' Το <code>%s</code> θα ενημερωθεί.';
$lang['tv_nocopy']             = 'Δεν μπόρεσε να αφαιρέσει τον παρόντα φάκελλο <code>%s</code>πριν ξαναγράψει στο ίδιο κείμενο του αρχείου!';
$lang['tv_nodir']              = 'Δεν μπόρεσε να δημιουργήσει λίστα διευθύνσεων <code>%s</code>!';
$lang['tv_done']               = 'ενημερωμένο <code>%s</code>';
$lang['rm_done']               = 'Το μη έγκυρο <code>%s</code> διαγράφηκε.';
$lang['rm_fail']               = 'Δεν μπόρεσε να απαλείψει το<code>%s</code>. <b>Παρακαλώ σβήστε/απαλείψετε  χειροκίνητα !</b>';
$lang['rm_mismatch']           = 'Στοιχείο μη αντιστοίχησης του μη εγκεκριμένου αρχείου.  <code>%s</code>. Παρακαλώ ελέγξετε αν το αρχείο πρέπει να διαγραφεί. ';
$lang['finish']                = 'Η αναβάθμιση ολοκληρώθηκε. Απολαύστε το νέο σας  DokuWiki';
$lang['btn_continue']          = 'Continue';
$lang['btn_abort']             = 'Abort';
$lang['step_version']          = 'Check';
$lang['step_download']         = 'Download';
$lang['step_unpack']           = 'Unpack';
$lang['step_check']            = 'Verify';
$lang['step_upgrade']          = 'Install';
$lang['careful']               = 'Errors above! You should <b>not</b> continue!';
