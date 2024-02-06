<?php

/**
 * DokuWiki Plugin upgrade (Admin Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <andi@splitbrain.org>
 */

require_once __DIR__ . '/vendor/autoload.php';

class admin_plugin_upgrade extends DokuWiki_Admin_Plugin
{
    protected $haderrors = false;

    /** @var helper_plugin_upgrade */
    protected $helper;

    /**
     * initialize helper
     */
    public function __construct()
    {
        $this->helper = plugin_load('helper', 'upgrade');
        $this->helper->setLogger($this);
    }

    /** @inheritDoc */
    public function getMenuSort()
    {
        return 555;
    }

    /** @inheritDoc */
    public function handle()
    {
        if (!empty($_REQUEST['step']) && !checkSecurityToken()) {
            unset($_REQUEST['step']);
        }
    }

    public function html()
    {
        $abrt = false;
        $next = false;
        $ok = true;

        echo '<h1>' . $this->getLang('menu') . '</h1>';

        echo '<div id="plugin__upgrade">';
        // enable auto scroll
        ?>
        <script type="text/javascript">
            var plugin_upgrade = window.setInterval(function () {
                var obj = document.getElementById('plugin__upgrade');
                if (obj) obj.scrollTop = obj.scrollHeight;
            }, 25);
        </script>
        <?php

        // handle current step
        $this->nextStep($abrt, $next, $ok);

        // disable auto scroll
        ?>
        <script type="text/javascript">
            window.setTimeout(function () {
                window.clearInterval(plugin_upgrade);
            }, 50);
        </script>
        <?php
        echo '</div>';

        $careful = '';
        if (!$ok) {
            echo '<div id="plugin__upgrade_careful">' . $this->getLang('careful') . '</div>';
            $careful = 'careful';
        }

        $action = script();
        echo '<form action="' . $action . '" method="post" id="plugin__upgrade_form">';
        echo '<input type="hidden" name="do" value="admin" />';
        echo '<input type="hidden" name="page" value="upgrade" />';
        echo '<input type="hidden" name="sectok" value="' . getSecurityToken() . '" />';
        if ($next) {
            echo '<button type="submit"
                          name="step[' . $next . ']"
                          value="1"
                          class="button continue ' . $careful . '">' .
                $this->getLang('btn_continue') .
                ' ➡</button>';
        }
        if ($abrt) {
            echo '<button type="submit"
                          name="step[cancel]"
                          value="1"
                          class="button abort">✖ ' .
                $this->getLang('btn_abort') .
                '</button>';
        }
        echo '</form>';

        $this->displayProgressBar($next);
    }

    /**
     * Display a progress bar of all steps
     *
     * @param string $next the next step
     */
    private function displayProgressBar($next)
    {
        $steps = ['version', 'download', 'unpack', 'check', 'upgrade'];
        $active = true;
        $count = 0;

        echo '<div id="plugin__upgrade_meter"><ol>';
        foreach ($steps as $step) {
            $count++;
            if ($step == $next) $active = false;
            if ($active) {
                echo '<li class="active">';
                echo '<span class="step">✔</span>';
            } else {
                echo '<li>';
                echo '<span class="step">' . $count . '</span>';
            }

            echo '<span class="stage">' . $this->getLang('step_' . $step) . '</span>';
            echo '</li>';
        }
        echo '</ol></div>';
    }

    /**
     * Decides the current step and executes it
     *
     * @param bool $abrt
     * @param bool $next
     * @param bool $ok
     */
    private function nextStep(&$abrt, &$next, &$ok)
    {

        if (isset($_REQUEST['step']) && is_array($_REQUEST['step'])) {
            $keys = array_keys($_REQUEST['step']);
            $step = array_shift($keys);
        } else {
            $step = '';
        }

        if ($step == 'cancel' || $step == 'done') {
            $ok = $this->helper->cleanup();
            if ($step == 'cancel') $step = '';
        }

        if ($step) {
            $abrt = true;
            $next = false;
            if ($step == 'version') {
                $ok = $this->helper->checkVersions();
                $next = 'download';
            } elseif ($step == 'done') {
                echo $this->locale_xhtml('final');
                $next = '';
                $abrt = '';
            } elseif (!file_exists($this->helper->tgzfile)) {
                if ($ok = $this->helper->downloadTarball()) $next = 'unpack';
            } elseif (!is_dir($this->helper->tgzdir)) {
                if ($ok = $this->helper->extractTarball()) $next = 'check';
            } elseif ($step != 'upgrade') {
                if ($ok = $this->helper->checkPermissions()) $next = 'upgrade';
            } elseif ($step == 'upgrade') {
                if ($ok = $this->helper->copyFiles()) {
                    $ok = $this->helper->deleteObsoleteFiles();
                    $this->helper->cleanup();
                    $next = 'done';
                    $abrt = '';
                }
            } else {
                echo 'uhm. what happened? where am I? This should not happen';
            }
        } else {
            # first time run, show intro
            echo $this->locale_xhtml('step0');
            $this->helper->cleanup(); // make sure we start clean
            $abrt = false;
            $next = 'version';
        }
    }

    /**
     * Print the given message and flush buffers
     *
     * @param string $level
     * @param string $message
     */
    public function log($level, $message)
    {
        echo '<div class="log-' . $level . '">' . $message . '</div>';
        flush();
        ob_flush();
    }
}
