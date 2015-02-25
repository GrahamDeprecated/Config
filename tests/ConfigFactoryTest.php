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
        $fixers = (new ConfigFactory())->make()->getFixers();

        $this->assertInArray('psr0', $fixers);
        $this->assertInArray('encoding', $fixers);
        $this->assertInArray('elseif', $fixers);
        $this->assertNotContains('strict_param', $fixers);
    }

    public function testMakeConfigWithOptions()
    {
        $fixers = (new ConfigFactory())->make(['preset' => 'symfony'])->getFixers();

        $this->assertInArray('unused_use', $fixers);
        $this->assertInArray('phpdoc_no_empty_return', $fixers);
        $this->assertNotContains('strict', $fixers);
    }

    public function testMakeConfigFromYml()
    {
        $fixers = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/config.yml'))->getFixers();

        $this->assertInArray('unused_use', $fixers);
    }

    public function testMakeConfigFromYmlWithEnablers()
    {
        $fixers = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/custom.yml'))->getFixers();

        $this->assertInArray('phpdoc_no_package', $fixers);
        $this->assertNotContains('psr0', $fixers);
    }
}
