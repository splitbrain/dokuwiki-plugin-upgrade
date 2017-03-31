<?php
/**
 * DokuWiki Plugin upgrade (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Simon Delage <simon.geekitude@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');

require_once (DOKU_PLUGIN . 'action.php');

class action_plugin_upgrade extends DokuWiki_Action_Plugin{

    function register(Doku_Event_Handler $controller) {
        $controller->register_hook('INIT_LANG_LOAD', 'AFTER', $this, 'init',array());
    }

    function init(&$event, $param) {
        global $updateVersion;

        $cf = getCacheName($updateVersion, '.updmsg');

        $data = io_readFile($cf);
        // act only if there's a message containing a link to Dokuwiki download page
        if (strpos($data, 'download.dokuwiki.org') !== false) {
            // split data to individual messages
            $msgs = explode("\n%\n",$data);
            $i = -1;
            // check each message
            foreach($msgs as $msg){
                $i++;
                // act only if current message contains a link to Dokuwiki download page
                if (strpos($msg, 'download.dokuwiki.org') !== false) {
                    // prepare new message with link to Upgrade plugin page
                    $newmsg = str_replace('http://download.dokuwiki.org', '/doku.php?do=admin&amp;page=upgrade', $msg);
                    // write new message to cache file (replace if first message or appended
                    if ($i == 0) {
                        io_saveFile($cf, $newmsg."\n%\n", false);
                    } else {
                        io_saveFile($cf, $newmsg."\n%\n", true);
                    }
                }
            }
        }
    }

}
