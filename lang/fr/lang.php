<?php
/**
 * French language file for upgrade plugin
 *
 * @author Guillaume Turri <guillaume.turri@gmail.com>
 */

// menu entry for admin plugins
$lang['menu'] = 'Mise a jour du wiki';

// custom language strings for the plugin
$lang['dl_from'] = 'Téléchargement de l\'archive depuis %s...';
$lang['dl_fail'] = 'Échec du téléchargement.';
$lang['dl_done'] = 'Téléchargement achevé (%s).';
$lang['pk_extract'] = 'Décompression de l\'archive...';
$lang['pk_fail']    = 'Échec de la décompression.';
$lang['pk_done']    = 'Décompression achevée.';
$lang['pk_version'] = 'DokuWiki <b>%s</b> est prêt à être installé (Vous utilisez actuellement <b>%s</b>).';
$lang['ck_start']   = 'Vérification des permissions des fichiers...';
$lang['ck_done']    = 'Tous les fichiers sont autorisés en écriture. Prêt à mettre à jour.';
$lang['ck_fail']    = 'Quelques fichiers sont interdits en écriture. La mise à jour automatique n\'est pas possible.';
$lang['cp_start']   = 'Mise à jour des fichiers...';
$lang['cp_done']    = 'Tous les fichiers ont été mis à jour.';
$lang['cp_fail']    = 'Oh-oh. Quelque chose est allé de travers. Il vaudrait mieux vérifier à la main.';
$lang['tv_noperm']  = '<code>%s</code> est interdit en écriture !';
$lang['tv_upd']     = '<code>%s</code> sera mis à jour.';
$lang['tv_nocopy']  = 'Impossible de copier le fichier <code>%s</code>!';
$lang['tv_nodir']   = 'Impossible de créer le répertoire <code>%s</code>!';
$lang['tv_done']    = 'Mis à jour : <code>%s</code>';
$lang['rm_done']    = 'Suppression du fichier obsolète <code>%s</code>.';
$lang['rm_fail']    = 'Impossible de supprimer le fichier obsolète <code>%s</code>. <b>Veuillez le supprimer à la main.</b>';
$lang['finish']     = 'Mise à jour accomplie. Profitez de votre nouveau Dokuwiki !';

//Setup VIM: ex: et ts=4 enc=utf-8 :
