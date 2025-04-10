<?php

/**
 * DokuWiki Plugin upgrade (Helper Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <andi@splitbrain.org>
 */

use dokuwiki\plugin\upgrade\HTTP\DokuHTTPClient;
use splitbrain\PHPArchive\FileInfo;
use splitbrain\PHPArchive\Tar;

class helper_plugin_upgrade extends DokuWiki_Plugin
{
    /** @var string download URL for the new DokuWiki release */
    public $tgzurl;
    /** @var string full path to where the file will be downloaded to */
    public $tgzfile;
    /** @var string full path to where the file will be extracted to */
    public $tgzdir;
    /** @var string URL to the VERSION file of the new DokuWiki release */
    public $tgzversion;
    /** @var string URL to the composer.json file of the new DokuWiki release */
    protected $composer;
    /** @var string URL to the plugin.info.txt file of the upgrade plugin */
    public $pluginversion;

    /** @var admin_plugin_upgrade|cli_plugin_upgrade */
    protected $logger;

    public function __construct()
    {
        global $conf;

        $branch = 'stable';

        $this->tgzurl = "https://github.com/splitbrain/dokuwiki/archive/$branch.tar.gz";
        $this->tgzfile = $conf['tmpdir'] . '/dokuwiki-upgrade.tgz';
        $this->tgzdir = $conf['tmpdir'] . '/dokuwiki-upgrade/';
        $this->tgzversion = "https://raw.githubusercontent.com/splitbrain/dokuwiki/$branch/VERSION";
        $this->composer = "https://raw.githubusercontent.com/splitbrain/dokuwiki/$branch/composer.json";
        $this->pluginversion = "https://raw.githubusercontent.com/splitbrain/dokuwiki-plugin-upgrade/master/plugin.info.txt";
    }

    /**
     * @param admin_plugin_upgrade|cli_plugin_upgrade $logger Logger object
     * @return void
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    // region Steps

    /**
     * Check various versions
     *
     * @return bool
     */
    public function checkVersions()
    {
        $ok = true;

        // we need SSL - only newer HTTPClients check that themselves
        if (!in_array('ssl', stream_get_transports())) {
            $this->log('error', $this->getLang('vs_ssl'));
            $ok = false;
        }

        // get the available version
        $http = new DokuHTTPClient();
        $tgzversion = trim($http->get($this->tgzversion));
        if (!$tgzversion) {
            $this->log('error', $this->getLang('vs_tgzno') . ' ' . hsc($http->error));
            $ok = false;
        }
        $tgzversionnum = $this->dateFromVersion($tgzversion);
        if ($tgzversionnum === 0) {
            $this->log('error', $this->getLang('vs_tgzno'));
            $ok = false;
        } else {
            $this->log('notice', $this->getLang('vs_tgz'), $tgzversion);
        }

        // get the current version
        $versiondata = getVersionData();
        $version = trim($versiondata['date']);
        $versionnum = $this->dateFromVersion($version);
        $this->log('notice', $this->getLang('vs_local'), $version);

        // compare versions
        if (!$versionnum) {
            $this->log('warning', $this->getLang('vs_localno'));
            $ok = false;
        } elseif ($tgzversionnum) {
            if ($tgzversionnum < $versionnum) {
                $this->log('warning', $this->getLang('vs_newer'));
                $ok = false;
            } elseif ($tgzversionnum == $versionnum && $tgzversion == $version) {
                $this->log('warning', $this->getLang('vs_same'));
                $ok = false;
            }
        }

        // check plugin version
        $pluginversion = $http->get($this->pluginversion);
        if ($pluginversion) {
            $plugininfo = linesToHash(explode("\n", $pluginversion));
            $myinfo = $this->getInfo();
            if ($plugininfo['date'] > $myinfo['date']) {
                $this->log('warning', $this->getLang('vs_plugin'), $plugininfo['date']);
                $ok = false;
            }
        }

        // check if PHP is up to date
        $json = $http->get($this->composer);
        $data = json_decode($json, true);
        $minphp = $data['config']['platform']['php'];
        if (version_compare(phpversion(), $minphp, '<')) {
            $this->log('error', $this->getLang('vs_php'), $minphp, phpversion());
            $ok = false;
        }

        return $ok;
    }

    /**
     * Download the tarball
     *
     * @return bool
     */
    public function downloadTarball()
    {
        $this->log('notice', $this->getLang('dl_from'), $this->tgzurl);

        @set_time_limit(300);
        @ignore_user_abort();

        $http = new DokuHTTPClient();
        $http->timeout = 300;
        $data = $http->get($this->tgzurl);

        if (!$data) {
            $this->log('error', $http->error);
            $this->log('error', $this->getLang('dl_fail'));
            return false;
        }

        io_mkdir_p(dirname($this->tgzfile));
        if (!file_put_contents($this->tgzfile, $data)) {
            $this->log('error', $this->getLang('dl_fail'));
            return false;
        }

        $this->log('success', $this->getLang('dl_done'), filesize_h(strlen($data)));
        return true;
    }

    /**
     * Unpack the tarball
     *
     * @return bool
     */
    public function extractTarball()
    {
        $this->log('notice', '<b>' . $this->getLang('pk_extract') . '</b>');

        @set_time_limit(300);
        @ignore_user_abort();

        try {
            $tar = new Tar();
            $tar->setCallback(function ($file) {
                /** @var FileInfo $file */
                $this->log('info', $file->getPath());
            });
            $tar->open($this->tgzfile);
            $tar->extract($this->tgzdir, 1);
            $tar->close();
        } catch (Exception $e) {
            $this->log('error', $e->getMessage());
            $this->log('error', $this->getLang('pk_fail'));
            return false;
        }

        $this->log('success', $this->getLang('pk_done'));

        $this->log(
            'notice',
            $this->getLang('pk_version'),
            hsc(file_get_contents($this->tgzdir . '/VERSION')),
            getVersion()
        );
        return true;
    }

    /**
     * Check permissions of files to change
     *
     * @return bool
     */
    public function checkPermissions()
    {
        $this->log('notice', $this->getLang('ck_start'));
        $ok = $this->traverseCheckAndCopy('', true);
        if ($ok) {
            $this->log('success', '<b>' . $this->getLang('ck_done') . '</b>');
        } else {
            $this->log('error', '<b>' . $this->getLang('ck_fail') . '</b>');
        }
        return $ok;
    }

    /**
     * Copy over new files
     *
     * @return bool
     */
    public function copyFiles()
    {
        $this->log('notice', $this->getLang('cp_start'));
        $ok = $this->traverseCheckAndCopy('', false);
        if ($ok) {
            $this->log('success', '<b>' . $this->getLang('cp_done') . '</b>');
        } else {
            $this->log('error', '<b>' . $this->getLang('cp_fail') . '</b>');
        }
        return $ok;
    }

    /**
     * Delete outdated files
     */
    public function deleteObsoleteFiles()
    {
        global $conf;

        $list = file($this->tgzdir . 'data/deleted.files');
        foreach ($list as $line) {
            $line = trim(preg_replace('/#.*$/', '', $line));
            if (!$line) continue;
            $file = DOKU_INC . $line;
            if (!file_exists($file)) continue;

            // check that the given file is a case sensitive match
            if (basename(realpath($file)) != basename($file)) {
                $this->log('info', $this->getLang('rm_mismatch'), hsc($line));
                continue;
            }

            if (
                (is_dir($file) && $this->recursiveDelete($file)) ||
                @unlink($file)
            ) {
                $this->log('info', $this->getLang('rm_done'), hsc($line));
            } else {
                $this->log('error', $this->getLang('rm_fail'), hsc($line));
            }
        }
        // delete install
        @unlink(DOKU_INC . 'install.php');

        // make sure update message will be gone
        @touch(DOKU_INC . 'doku.php');
        @unlink($conf['cachedir'] . '/messages.txt');

        // clear opcache
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }

        $this->log('success', '<b>' . $this->getLang('finish') . '</b>');
        return true;
    }

    /**
     * Remove the downloaded and extracted files
     *
     * @return bool
     */
    public function cleanUp()
    {
        @unlink($this->tgzfile);
        $this->recursiveDelete($this->tgzdir);
        return true;
    }

    // endregion

    /**
     * Traverse over the given dir and compare it to the DokuWiki dir
     *
     * Checks what files need an update, tests for writability and copies
     *
     * @param string $dir
     * @param bool $dryrun do not copy but only check permissions
     * @return bool
     */
    private function traverseCheckAndCopy($dir, $dryrun)
    {
        $base = $this->tgzdir;
        $ok = true;

        $dh = @opendir($base . '/' . $dir);
        if (!$dh) return false;
        while (($file = readdir($dh)) !== false) {
            if ($file == '.' || $file == '..') continue;
            $from = "$base/$dir/$file";
            $to = DOKU_INC . "$dir/$file";

            if (is_dir($from)) {
                if ($dryrun) {
                    // just check for writability
                    if (!is_dir($to)) {
                        if (is_dir(dirname($to)) && !is_writable(dirname($to))) {
                            $this->log('error', '<b>' . $this->getLang('tv_noperm') . '</b>', hsc("$dir/$file"));
                            $ok = false;
                        }
                    }
                }

                // recursion
                if (!$this->traverseCheckAndCopy("$dir/$file", $dryrun)) {
                    $ok = false;
                }
            } else {
                $fmd5 = md5(@file_get_contents($from));
                $tmd5 = md5(@file_get_contents($to));
                if ($fmd5 != $tmd5 || !file_exists($to)) {
                    if ($dryrun) {
                        // just check for writability
                        if (
                            (file_exists($to) && !is_writable($to)) ||
                            (!file_exists($to) && is_dir(dirname($to)) && !is_writable(dirname($to)))
                        ) {
                            $this->log('error', '<b>' . $this->getLang('tv_noperm') . '</b>', hsc("$dir/$file"));
                            $ok = false;
                        } else {
                            $this->log('info', $this->getLang('tv_upd'), hsc("$dir/$file"));
                        }
                    } else {
                        // check dir
                        if (io_mkdir_p(dirname($to))) {
                            // remove existing (avoid case sensitivity problems)
                            if (file_exists($to) && !@unlink($to)) {
                                $this->log('error', '<b>' . $this->getLang('tv_nodel') . '</b>', hsc("$dir/$file"));
                                $ok = false;
                            }
                            // copy
                            if (!copy($from, $to)) {
                                $this->log('error', '<b>' . $this->getLang('tv_nocopy') . '</b>', hsc("$dir/$file"));
                                $ok = false;
                            } else {
                                $this->log('info', $this->getLang('tv_done'), hsc("$dir/$file"));
                            }
                        } else {
                            $this->log('error', '<b>' . $this->getLang('tv_nodir') . '</b>', hsc("$dir"));
                            $ok = false;
                        }
                    }
                }
            }
        }
        closedir($dh);
        return $ok;
    }

    // region utilities

    /**
     * Figure out the release date from the version string
     *
     * @param $version
     * @return int|string returns 0 if the version can't be read
     */
    protected function dateFromVersion($version)
    {
        if (preg_match('/(^|\D)(\d\d\d\d-\d\d-\d\d)(\D|$)/i', $version, $m)) {
            return $m[2];
        }
        return 0;
    }

    /**
     * Recursive delete
     *
     * @author Jon Hassall
     * @link   http://de.php.net/manual/en/function.unlink.php#87045
     */
    protected function recursiveDelete($dir)
    {
        if (!$dh = @opendir($dir)) {
            return false;
        }
        while (false !== ($obj = readdir($dh))) {
            if ($obj == '.' || $obj == '..') continue;

            if (!@unlink($dir . '/' . $obj)) {
                $this->recursiveDelete($dir . '/' . $obj);
            }
        }
        closedir($dh);
        return @rmdir($dir);
    }

    /**
     * Log a message
     *
     * @param string ...$level , $msg
     */
    protected function log()
    {
        $args = func_get_args();
        $level = array_shift($args);
        $msg = array_shift($args);
        $msg = vsprintf($msg, $args);
        if ($this->logger) $this->logger->log($level, $msg);
    }

    // endregion
}
