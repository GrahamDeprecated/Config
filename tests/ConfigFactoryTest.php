<?php

/*
 * This file is part of StyleCI Config.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Tests\Config;

use GrahamCampbell\TestBench\AbstractTestCase;

use StyleCI\Config\ConfigFactory;

/**
 * This is the arr test case class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class ConfigFactoryTest extends AbstractTestCase
{
    public function testMakeConfig()
    {
        $config = (new ConfigFactory())->make();

        $this->assertInArray('psr0', $config->getFixers());
        $this->assertInArray('encoding', $config->getFixers());
        $this->assertInArray('elseif', $config->getFixers());
    }

    public function testMakeConfigWithOptions()
    {
        $config = (new ConfigFactory())->make(['preset' => 'symfony']);

        $this->assertInArray('unused_use', $config->getFixers());
    }

    public function testMakeConfigFromYml()
    {
        $path = __DIR__.'/Fixtures';

        $config = (new ConfigFactory())->makeFromYaml(file_get_contents($path.'/config.yml'));

        $this->assertInArray('unused_use', $config->getFixers());
    }

    public function testMakeConfigFromYmlWithEnablers()
    {
        $path = __DIR__.'/Fixtures';

        $config = (new ConfigFactory())->makeFromYaml(file_get_contents($path.'/custom.yml'));

        $this->assertInArray('phpdoc_no_package', $config->getFixers());
        $this->assertNotContains('psr0', $config->getFixers());
    }
}
