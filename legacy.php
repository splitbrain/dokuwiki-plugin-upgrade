<?php

/**
 * Legacy command line upgrade script
 *
 * This script can be used to upgrade old versions of DokuWiki that won't easily run on
 * modern PHP releases. It works by not actually loading any of the existing (and outdated)
 * DokuWiki code, but instead fakes an absolute minimal environment to run the upgrade.
 *
 * This means this script will make more assumptions and take shortcuts:
 *
 * - no proxy support
 * - no tmp dir changes
 * - english only
 * - only "normal" releases (no snapshots or git checkouts)
 *
 * Only use this if you can't run the normal upgrade script.
 */

// phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

require_once __DIR__ . '/vendor/autoload.php';

// fake a minimal dokuwiki environment
define('DOKU_INC', __DIR__ . '/../../../');
global $conf;
$conf['savedir'] = __DIR__ . '/../../../data/';
$conf['cachedir'] = $conf['savedir'] . 'cache/';
$conf['tmpdir'] = $conf['savedir'] . 'tmp/';
$conf['proxy'] = ['host' => '', 'port' => '', 'user' => '', 'pass' => '', 'ssl' => '', 'except' => ''];
$conf['allowdebug'] = false;

function linesToHash($lines)
{
    $lines = array_map('trim', $lines);
    $lines = array_filter($lines);
    $lines = array_map(function ($item) {
        return array_map('trim', explode(' ', $item, 2));
    }, $lines);
    return array_combine(array_column($lines, 0), array_column($lines, 1));
}

function conf_decodeString($string)
{
    return $string;
}

function filesize_h($size)
{
    return $size . 'b';
}

function hsc($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function io_mkdir_p($dir)
{
    if (file_exists($dir)) return true;
    return mkdir($dir, 0777, true);
}

function getVersionData()
{
    $version = array();
    if (file_exists(DOKU_INC . 'VERSION')) {
        //official release
        $version['date'] = trim(file_get_contents(DOKU_INC . 'VERSION'));
        $version['type'] = 'Release';
    }
    return $version;
}

function getVersion()
{
    $version = getVersionData();
    return $version['type'] . ' ' . $version['date'];
}

class Doku_Event
{
    public function __construct($name, &$data)
    {
    }

    public function advise_before()
    {
        return true;
    }

    public function advise_after()
    {
    }
}

trait UpgradePluginTrait
{
    protected $lang = null;

    /**
     * @return string
     */
    public function getInfo()
    {
        $data = file(__DIR__ . '/plugin.info.txt', FILE_IGNORE_NEW_LINES);
        return linesToHash($data);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getLang($key)
    {
        if ($this->lang === null) {
            $lang = [];
            include __DIR__ . '/lang/en/lang.php';
            $this->lang = $lang;
        }
        return $this->lang[$key] ?? $key;
    }
}

abstract class DokuWiki_CLI_Plugin extends splitbrain\phpcli\CLI
{
    use UpgradePluginTrait;
}

class DokuWiki_Plugin
{
    use UpgradePluginTrait;
}

// now the CLI plugin should load and run
include(__DIR__ . '/cli.php');
(new cli_plugin_upgrade())->run();
