<?php

// phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

use splitbrain\phpcli\Options;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * DokuWiki Plugin upgrade (CLI Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <andi@splitbrain.org>
 */
class cli_plugin_upgrade extends DokuWiki_CLI_Plugin
{
    protected $logdefault = 'notice';
    protected $helper;

    /**
     * initialize
     */
    public function __construct()
    {
        parent::__construct();
        $this->helper = new helper_plugin_upgrade();
        $this->helper->setLogger($this);
    }

    /** @inheritDoc */
    protected function setup(Options $options)
    {
        $options->setHelp(
            'This tool will upgrade your wiki to the newest release. It will automatically check file permissions ' .
            'and download the required tarball. Internet access is required.'
        );
        $options->registerArgument('check|run', 'Either only check if an update can be done or do it', 'true');
        $options->registerOption('ignoreversions', 'Ignore the version check results and continue anyway', 'i');
    }

    /** @inheritDoc */
    protected function main(Options $options)
    {
        $arguments = $options->getArgs();
        if ($arguments[0] === 'check') {
            $dryrun = true;
        } elseif ($arguments[0] === 'run') {
            $dryrun = false;
        } else {
            $this->fatal('Unknown command');
        }

        if (!$this->helper->checkVersions() && !$options->getOpt('ignoreversions')) {
            $this->fatal('Upgrade aborted');
        }
        $this->helper->downloadTarball() || $this->fatal('Upgrade aborted');
        $this->helper->extractTarball() || $this->fatal('Upgrade aborted');
        $this->helper->checkPermissions() || $this->fatal('Upgrade aborted');
        if (!$dryrun) {
            $this->helper->copyFiles() || $this->fatal('Upgrade aborted');
            $this->helper->deleteObsoleteFiles() || $this->fatal('Upgrade aborted');
        }
        $this->helper->cleanUp();
    }

    /** @inheritDoc */
    public function log($level, $message, array $context = array())
    {
        // Log messages are HTML formatted, we need to clean them for console
        $message = strip_tags($message);
        $message = htmlspecialchars_decode($message);
        $message = preg_replace('/\s+/', ' ', $message);
        parent::log($level, $message, $context);
    }
}

// run the script ourselves if called directly
if (basename($_SERVER['SCRIPT_NAME']) == 'cli.php') {
    $cli = new cli_plugin_upgrade();
    $cli->run();
}
