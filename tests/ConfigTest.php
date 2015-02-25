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
use StyleCI\Config\Config;

/**
 * This is the array helper test case class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class ConfigTest extends AbstractTestCase
{
    public function testPreset()
    {
        $config = new Config();

        $config->preset('styleci');

        $this->assertInArray('psr0', $config->getFixers());
        $this->assertInArray('encoding', $config->getFixers());
        $this->assertInArray('elseif', $config->getFixers());
    }

    public function testEnableConfig()
    {
        $config = new Config();

        $config->enable('psr0');

        $this->assertInArray('psr0', $config->getFixers());
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFixerException
     */
    public function testEnableInvalidConfig()
    {
        $config = new Config();

        $config->enable('foo');
    }

    public function testDisableConfig()
    {
        $config = new Config();

        $config->preset('styleci');
        $this->assertInArray('psr0', $config->getFixers());

        $config->disable('psr0');
        $this->assertNotContains('psr0', $config->getFixers());
    }
}
