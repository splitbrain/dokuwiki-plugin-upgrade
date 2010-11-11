<?php
/**
 * English language file for upgrade plugin
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 */

// menu entry for admin plugins
$lang['menu'] = 'Wiki Upgrade';

// custom language strings for the plugin
$lang['dl_from'] = 'Downloading archive from %s...';
$lang['dl_fail'] = 'Download failed.';
$lang['dl_done'] = 'Download completed (%s).';
$lang['pk_extract'] = 'Unpacking archive...';
$lang['pk_fail']    = 'Unpacking failed.';
$lang['pk_done']    = 'Unpacking completed.';
$lang['pk_version'] = 'DokuWiki <b>%s</b> is ready to install (You\'re currently running <b>%s</b>).';
$lang['ck_start']   = 'Checking file permissions...';
$lang['ck_done']    = 'All files are writable. Ready to upgrade.';
$lang['ck_fail']    = 'Some files aren\'t writable. Automatic upgrade not possible.';
$lang['cp_start']   = 'Updating files...';
$lang['cp_done']    = 'All files updated.';
$lang['cp_fail']    = 'Uh-Oh. Something went wrong. Better check manually.';
$lang['tv_noperm']  = '<code>%s</code> is not writable!';
$lang['tv_upd']     = '<code>%s</code> will be updated.';
$lang['tv_nocopy']  = 'Could not copy file <code>%s</code>!';
$lang['tv_nodir']   = 'Could not create directory <code>%s</code>!';
$lang['tv_done']    = 'updated <code>%s</code>';
$lang['rm_done']    = 'Deprecated <code>%s</code> deleted.';
$lang['rm_fail']    = 'Could not delete deprecated <code>%s</code>. <b>Please delete manually!</b>';
$lang['finish']     = 'Upgrade completed. Enjoy your new DokuWiki';

//Setup VIM: ex: et ts=4 enc=utf-8 :
