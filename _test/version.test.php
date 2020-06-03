<?php

/**
 * Version parsing tests for the upgrade plugin
 *
 * @group plugin_upgrade
 * @group plugins
 */
class version_plugin_upgrade_test extends DokuWikiTest
{
    /**
     * @return array
     * @see testVersions
     */
    public function provideVersions()
    {
        return [
            ['2018-04-22c "Greebo"', '2018-04-22'],
            ['rc2020-06-01 "Hogfather"', '2020-06-01'],
            ['rc2-2020-06-01 "Hogfather" RC2', '2020-06-01'],
            ['Git 2020-06-03', '2020-06-03'],
            ['rc2013-11-18 "Binky RC2"', '2013-11-18'],
            ['foobar', 0],
        ];
    }

    /**
     * @dataProvider provideVersions
     * @param string $version
     * @param string $expected
     */
    public function testVersions($version, $expected)
    {
        $plugin = new admin_plugin_upgrade();

        $this->assertSame($expected, $plugin->dateFromVersion($version));
    }

}
