<?php

use splitbrain\phpcli\Options;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * DokuWiki Plugin upgrade (CLI Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <andi@splitbrain.org>
 */
class cli_plugin_upgrade extends \dokuwiki\Extension\CLIPlugin
{
    protected $logdefault = 'notice';

    /** @inheritDoc */
    protected function setup(Options $options)
    {
        $options->setHelp('Upgrade the wiki to the latest version');
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


        $helper = plugin_load('helper', 'upgrade');
        /** @var helper_plugin_upgrade $helper */
        $helper->setLogger($this);

        if(!$helper->checkVersions() && !$options->getOpt('ignoreversions')) {
            $this->fatal('Upgrade failed');
        }
        $helper->downloadTarball() || $this->fatal('Upgrade failed');
        $helper->extractTarball() || $this->fatal('Upgrade failed');
        $helper->checkPermissions() || $this->fatal('Upgrade failed');
        if (!$dryrun) {
            $helper->copyFiles() || $this->fatal('Upgrade failed');
            $helper->deleteObsoleteFiles() || $this->fatal('Upgrade failed');
        }
        $helper->cleanUp();
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

